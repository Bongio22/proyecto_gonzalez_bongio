<?php
//sesionController se manejan los datos del usuario
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class loginController extends BaseController
{
    //se instancia el modelo de usuario
    protected $usuarioModel;

    //se instancia el modelo de usuario
    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel(); // Instanciar el modelo de Usuario
    }
        /*LLama a la pagina iniciar sesión*/
    public function iniciar_sesion()
    {
        $data['titulo'] = 'Iniciar Sesión';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('back/iniciarSesion') . view('plantillas/footer');
    }
    /*LLama a la pagina de registro*/
    public function registrarse()
    {
        $data['titulo'] = 'Registrarse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('back/registrarse') . view('plantillas/footer');
    }

        public function panelAdmin(){
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header',$data);
        echo view('front/admin/panelAdmin');
        echo view('plantillas/footer');
    }
    
    public function modificarDatos()
    {
        $data['titulo'] = 'MisDatos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/usuario/misDatos') . view('plantillas/footer');
    }
    //se registra el usuario
    public function registrarUsuario()
    {
        if ($this->request->getMethod() === 'POST') {
            $nombre = trim($this->request->getPost('nombre'));
            $apellido = trim($this->request->getPost('apellido'));
            $email = trim($this->request->getPost('email'));
            $telefono = trim($this->request->getPost('telefono'));
            $password = $this->request->getPost('password');

            $errores = [];
            if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
            if (empty($apellido)) $errores[] = "El apellido es obligatorio.";
            if (empty($email)) $errores[] = "El correo electrónico es obligatorio.";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido.";
            if (empty($password)) $errores[] = "La contraseña es obligatoria.";

            if (!empty($errores)) {
                session()->setFlashdata('errores', $errores);
                return redirect()->to('registrarse');
            }

            if ($this->usuarioModel->where('correoElectronico', $email)->countAllResults() > 0) {
                session()->setFlashdata('errores', ["El correo electrónico ya está registrado."]);
                return redirect()->to('registrarse');
            }

            $hashedPassword = hashPassword($password);

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correoElectronico' => $email,
                'nroTelefono' => $telefono,
                'contrasenia' => $hashedPassword,
                'idRol' => 2,
                'idEstadoUsuario' => 1
            ];

            if ($this->usuarioModel->insert($data)) {
                session()->setFlashdata('mensaje', 'Te has registrado con éxito.');
                return redirect()->to('registrarse');
            } else {
                session()->setFlashdata('errores', ["Hubo un problema al registrar al usuario."]);
                return redirect()->to('registrarse');
            }
        }

        return redirect()->to('/registrarse');
    }
    public function iniciarSesion()
    {
        $correo = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$correo || !$password) {
            session()->setFlashdata('error', 'Debes completar ambos campos.');
            return redirect()->to('iniciarSesion');
        }


        // Buscar el usuario en la base de datos
        $usuario = $this->usuarioModel->where('correoElectronico', $correo)->first();

        if (!$usuario) {
            error_log("Error: No se encontró un usuario con el correo: " . $correo);
            session()->setFlashdata('error', 'Credenciales inválidas.');
            return redirect()->to('iniciarSesion');
        }
        // Verificar si la cuenta está activa
        if ($usuario['idEstadoUsuario'] == 2) {
            session()->setFlashdata('error', 'Tu cuenta está dada de baja.');
            error_log("Error: La cuenta está desactivada.");
            return redirect()->to('iniciarSesion');
        }

        // Verificación correcta usando password_verify()
        if (password_verify($password, $usuario['contrasenia'])) {
            // Guardar datos en la sesión
            session()->set('idUsuario', $usuario['idUsuario']);
            session()->set('idRol', $usuario['idRol']);
            session()->set('nombre', $usuario['nombre']);
            session()->set('apellido', $usuario['apellido']);
            session()->set('nroTelefono', $usuario['nroTelefono']);
            return ($usuario['idRol'] == 1) ? redirect()->to('panelAdmin') : redirect()->to('principal');
        } else {
            error_log("Error: La contraseña no coincide.");
            session()->setFlashdata('error', 'Contraseña incorrecta.');
            return redirect()->to('iniciarSesion');
        }
    }

    public function cerrarSesion()
    {
        // Destruir la sesión actual para cerrar la sesión del usuario
        $session = session();
        $session->destroy();

        // Redirigir al usuario a la página de inicio de sesión
        return redirect()->to(base_url('iniciarSesion'));
    }

    public function modificarUsuario()
    {
        // Obtener el ID del usuario desde la sesión
        $idUsuario = session('idUsuario');

        // Verificar si el ID del usuario está disponible en la sesión
        if (!$idUsuario) {
            session()->setFlashdata('error', 'Debes iniciar sesión para realizar esta acción.');
            return redirect()->to('iniciarSesion');
        }

        // Obtener datos del formulario
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $nroTelefono = $this->request->getPost('nroTelefono');

        // Validar el número de teléfono
        if (!ctype_digit($nroTelefono)) {
            return redirect()->back()->with('error', 'El número de teléfono debe contener solo dígitos.');
        }
        $nroTelefono = intval($nroTelefono);
        // Datos a actualizar
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correoElectronico' => $email,
            'nroTelefono' => $nroTelefono,
        ];

        // Solo actualizar la contraseña si se ha ingresado una nueva
        if (!empty($password)) {
            $data['contrasenia'] = password_hash($password, PASSWORD_BCRYPT); // Encriptar la nueva contraseña
        }

        // Actualizar datos en la base de datos
        $this->usuarioModel->update($idUsuario, $data);

        // Actualizar los datos de la sesión
        session()->set('nombre', $nombre);
        session()->set('apellido', $apellido);
        session()->set('nroTelefono', $nroTelefono);

        return redirect()->to('principal')->with('mensaje', 'Datos actualizados correctamente.');
    }
}

function hashPassword($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}