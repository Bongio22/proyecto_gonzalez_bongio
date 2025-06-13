<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class panelController extends Controller
{
    public function panelAdmin()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        $productoModel = new \App\Models\ProductoModel();
        $totalProductos = $productoModel->countAll();
        $totalUsuarios = $usuarioModel->countAll();
        $data = [
            'titulo' => 'Panel de Administración',
            'totalProductos' => $totalProductos,
            'totalUsuarios' => $totalUsuarios,

        ];

        return  view('plantillas/header', $data) .
            view('front/admin/panelAdmin', $data) .
            view('plantillas/footer');
    }

    public function listadoUsuarios()
    {
        $session = session();
        $idUsuarioActual = $session->get('idUsuario');

        $usuarioModel = new UsuarioModel();

        // Obtener todos los usuarios activos excepto el de la sesión actual
        $data['usuarios'] = $usuarioModel->where('idUsuario !=', $idUsuarioActual)
            ->findAll();

        // Cargar las vistas necesarias
        $data['titulo'] = 'Lista de Usuarios'; // Título para la vista
        return view('plantillas/header', $data)
            . view('front/admin/listadoUsuarios', $data) .
            view('plantillas/footer');
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

        return redirect()->to(site_url('front/admin/listadoUsuarios'));
    }

    public function altaUsuario($idUsuario)
    {
        $usuarioModel = new UsuarioModel();

        // Actualizar el estado del usuario a 1 (activo)
        if ($usuarioModel->update($idUsuario, ['idEstadoUsuario' => 1])) {
            session()->setFlashdata('success', 'Usuario dato de alta correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al dar de alta al usuario.');
        }

        return redirect()->to(site_url('front/admin/listadoUsuarios'));
    }

    public function modificarUsuario($idUsuario)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($idUsuario);
        // Modifica el rol del usuario
        //De administrador a Cliente
        if ($usuario['idRol'] == 1) {
            $usuarioModel->update($idUsuario, ['idRol' => 2]);
            //De cliente a Administrador
        } else if ($usuario['idRol'] == 2) {
            $usuarioModel->update($idUsuario, ['idRol' => 1]);
        }
        return redirect()->to(site_url('front/admin/listadoUsuarios'));
    }
}