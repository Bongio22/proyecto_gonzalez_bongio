<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoriaModel;
use App\Models\ProductoModel;

class Home extends Controller
{

    /*LLama a la pagina principal*/
    public function index()
    {
        $data['titulo'] = 'FrikiVerse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/principal') . view('plantillas/footer');
    }

    /*LLama a la pagina quienes somos*/
    public function quienes_somos()
    {
        $data['titulo'] = '¿Quienes Somos?';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/quienesSomos') . view('plantillas/footer');
    }

    /*LLama a la pagina comercializacion*/
    public function comercializacion()
    {
        $data['titulo'] = 'Comercialización';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/comercializacion') . view('plantillas/footer');
    }

    /*LLama a la pagina terminos y usos*/
    public function terminos_usos()
    {
        $data['titulo'] = 'Términos y Usos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/terminosyUsos') . view('plantillas/footer');
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

    public function modificarDatos()
    {
        $data['titulo'] = 'MisDatos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('usuario/misDatos') . view('plantillas/footer');
    }
    

    public function panelAdmin(){
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header',$data);
        echo view('front/admin/panelAdmin');
        echo view('plantillas/footer');
    }

    public function panelUsuario(){
        $data['titulo'] = 'Panel de Administración';
        echo view('plantillas/header',$data);
        echo view('front/admin/panelUsuario');
        echo view('plantillas/footer');
    }

   
}