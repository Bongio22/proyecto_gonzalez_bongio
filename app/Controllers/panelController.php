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
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header', $data);
        echo view('back/panelAdmin');
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
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();
        
        // Cargar las vistas necesarias
        $data['titulo'] = 'Lista de Usuarios'; // Título para la vista
        echo view('plantillas/header', $data);
        echo view('front/admin/listadoUsuarios', $data); // Asegúrate de que esta vista exista
    }
}