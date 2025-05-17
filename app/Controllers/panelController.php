<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class panel_controller extends Controller{
    public function index(){
        $session = session();
        $nombre=$session->get('idUsuario');
        $perfil=$session->get('idRol');

        if($nombre==null){
            return redirect()->to(base_url('iniciarSesion'));
        }

        $data['idRol']=$perfil;
    }

    public function panelAdmin(){
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header',$data);
        echo view('plantillas/navbar');
        echo view('back/panelAdmin');
        echo view('plantillas/footer');
    }

    public function panelUsuario(){
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header',$data);
        echo view('plantillas/navbar');
        echo view('back/panelUsuario');
        echo view('plantillas/footer');
    }

}