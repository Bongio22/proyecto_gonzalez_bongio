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

    /*LLama a la pagina contacto*/
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') . view('plantillas/footer');
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
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/iniciarSesion') . view('plantillas/footer');
    }

    /*LLama a la pagina de registro*/
    public function registrarse()
    {
        $data['titulo'] = 'Registrarse';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/registrarse') . view('plantillas/footer');
    }

    public function modificarDatos()
    {
        $data['titulo'] = 'MisDatos';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/misDatos') . view('plantillas/footer');
    }
    public function agregarProducto()
{
    $categoriaModel = new \App\Models\CategoriaModel();
    $data['categorias'] = $categoriaModel->findAll(); // Obtener todas las categorías

    return view('plantillas/header', $data)
        . view('plantillas/navbar')
        . view('front/agregarProducto', $data) // Pasar las categorías a la vista
        . view('plantillas/footer');
}

}