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

    //se registra el usuario
    public function registrarUsuario()
    {

        // Verificar que el formulario fue enviado
        if ($this->request->getMethod() === 'POST') {
            // Capturar los datos del formulario
            $nombre = trim($this->request->getPost('nombre'));
            $apellido = trim($this->request->getPost('apellido'));
            $email = trim($this->request->getPost('email'));
            $telefono = trim($this->request->getPost('telefono'));
            $password = $this->request->getPost('password');

            // Validar datos
            $errores = [];
            if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
            if (empty($apellido)) $errores[] = "El apellido es obligatorio.";
            if (empty($email)) $errores[] = "El correo electrónico es obligatorio.";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido.";
            if (empty($password)) $errores[] = "La contraseña es obligatoria.";

            // Si hay errores, almacenarlos en la sesión y redirigir
            if (!empty($errores)) {
                session()->setFlashdata('errores', $errores);
                return redirect()->to('registrarse');
            }

            // Verificar si el email ya está registrado
            if ($this->usuarioModel->where('correoElectronico', $email)->countAllResults() > 0) {
                session()->setFlashdata('errores', ["El correo electrónico ya está registrado."]);
                return redirect()->to('registrarse');
            }

            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correoElectronico' => $email,
                'nroTelefono' => $telefono,
                'contrasenia' => $password,
                'idRol' => 2, // Rol por defecto para usuarios
                'idEstadoUsuario' => 1 // Estado activo por defecto
            ];

            if ($this->usuarioModel->insert($data)) {
                session()->setFlashdata('mensaje', "Usuario registrado con éxito");
                return redirect()->to('registrarse');
            } else {
                session()->setFlashdata('errores', ["Hubo un problema al registrar al usuario. Por favor, intenta nuevamente más tarde."]);
                return redirect()->to('registrarse');
            }
        }

        // Si no es POST, redirigir al formulario
        return redirect()->to('/registrarse');
    }


    public function iniciarSesion()
    {
        // Obtener los datos del formulario
        $correo = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verificar que se hayan completado ambos campos
        if (!$correo || !$password) {
            session()->setFlashdata('error', 'Debes completar ambos campos.');
            return redirect()->to('iniciarSesion');
        }

        // Buscar al usuario en la base de datos
        $usuario = $this->usuarioModel->where('correoElectronico', $correo)->first();

        // Verificar las credenciales
        if ($usuario) {
            // Verificar si la cuenta está activa
            if ($usuario['idEstadoUsuario'] == 0) {
                session()->setFlashdata('error', 'Tu cuenta está dada de baja. Por favor, contacta al administrador.');
                return redirect()->to('iniciarSesion');
            }

            if ($password === $usuario['contrasenia'] && $usuario['idRol'] == 1) {
                // Iniciar sesión
                session()->set('idUsuario', $usuario['idUsuario']);
                session()->set('idRol', $usuario['idRol']);
                session()->set('nombre', $usuario['nombre']);
                session()->set('apellido', $usuario['apellido']);
                session()->set('nroTelefono', $usuario['nroTelefono']);
                session()->set('fotoPerfil', $usuario['fotoPerfil']);
                return redirect()->to('panelAdmin');
            } else {
                // Iniciar sesión
                session()->set('idUsuario', $usuario['idUsuario']);
                session()->set('idRol', $usuario['idRol']);
                session()->set('nombre', $usuario['nombre']);
                session()->set('apellido', $usuario['apellido']);
                session()->set('nroTelefono', $usuario['nroTelefono']);
                session()->set('fotoPerfil', $usuario['fotoPerfil']);
                return redirect()->to('principal');
            }
        }

        session()->setFlashdata('error', 'Credenciales inválidas.');
        return redirect()->to('iniciarSesion');
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
        $profileImage = $this->request->getFile('profileImage');

        // Validar el número de teléfono
        if (!ctype_digit($nroTelefono)) {
            return redirect()->back()->with('error', 'El número de teléfono debe contener solo dígitos.');
        }
        $nroTelefono = intval($nroTelefono);

        // Validar y procesar la imagen (si fue enviada)
        $imagePath = null;
        if ($profileImage && $profileImage->isValid()) {
            $imagePath = 'uploads/perfiles/' . $profileImage->getRandomName();
            $profileImage->move('uploads/perfiles', $imagePath);
        }

        // Datos a actualizar
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'correoElectronico' => $email,
            'nroTelefono' => $nroTelefono,
        ];

        // Si hay imagen, agregarla al array
        if ($imagePath) {
            $data['fotoPerfil'] = $imagePath;
        }

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
        if ($imagePath) {
            session()->set('fotoPerfil', $imagePath);
        }

        return redirect()->to('principal')->with('mensaje', 'Datos actualizados correctamente.');
    }
}