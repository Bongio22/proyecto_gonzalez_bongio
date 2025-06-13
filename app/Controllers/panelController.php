<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class panelController extends Controller
{


    public function index()
    {
        $session = session();
        $nombre = $session->get('idUsuario');
        $perfil = $session->get('idRol');

        if ($nombre == null) {
            return redirect()->to(base_url('iniciarSesion'));
        }

        $data['idRol'] = $perfil;
    }

    public function panelAdmin()
    {

        $totalProductos = $this->productoModel->countAll();
        $totalUsuarios = $this->usuarioModel->countAll();
        $data = [
            'titulo' => 'Panel de Administración',
            'totalProductos' => $totalProductos,
            'totalUsuarios' => $totalUsuarios,

        ];

        echo view('plantillas/header', $data);
        echo view('front/admin/panelAdmin', $data);
        echo view('plantillas/footer');
    }

    public function panelUsuario()
    {
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header', $data);
        echo view('plantillas/navbar');
        echo view('back/panelUsuario');
        echo view('plantillas/footer');
    }

    public function cargarVista($vista)
    {
        if ($vista === 'usuarios') {
            $usuarioModel = new \App\Models\UsuarioModel();
            $data['usuarios'] = $usuarioModel->findAll();
            return view('admin/usuarios', $data);
        } elseif ($vista === 'productos') {
            $productoModel = new \App\Models\ProductoModel();
            $data['productos'] = $productoModel->findAll();
            return view('admin/productos', $data);
        } else {
            return 'Vista no válida';
        }
    }

    public function mostrarProductos()
    {
        $productoModel = new \App\Models\ProductoModel();
        $data['productos'] = $productoModel->findAll();
        return view('productos.php', $data);
    }

    public function listadoUsuarios()
    {
        $session = session();
        $idUsuarioActual = $session->get('idUsuario');

        $usuarioModel = new UsuarioModel();
        
        // Obtener todos los usuarios activos excepto el de la sesión actual
        $data['usuarios'] = $usuarioModel->where('idUsuario !=', $idUsuarioActual)
                                        ->where('idEstadoUsuario', 1)
                                        ->findAll();
        
        // Cargar las vistas necesarias
        $data['titulo'] = 'Lista de Usuarios'; // Título para la vista
        echo view('plantillas/header', $data);
        echo view('front/admin/listadoUsuarios', $data); // Asegúrate de que esta vista exista
    }

    public function bajaUsuario($idUsuario)
    {
        $usuarioModel = new UsuarioModel();

        // Actualizar el estado del usuario a 2 (inactivo)
        if ($usuarioModel->update($idUsuario, ['idEstadoUsuario' => 2])) {
            session()->setFlashdata('success', 'Usuario dado de baja correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al dar de baja al usuario.');
        }

        return redirect()->to(site_url('admin/listadoUsuarios'));
    }
}