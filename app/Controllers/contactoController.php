<?php

namespace App\Controllers;
use App\Models\ConsultaModel;
use CodeIgniter\Controller;

class ContactoController extends BaseController
{
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') . view('plantillas/footer');
    }

    public function guardarConsulta()
    {
        $consultaModel = new ConsultaModel();

        // Obtener datos del formulario
        $datos = [
            'idUsuario'   => session()->get('idUsuario') ?? null, // si no hay sesión puede quedar null
            'nombre'      => $this->request->getPost('nombre'),
            'apellido'    => $this->request->getPost('apellido'),
            'email'       => $this->request->getPost('email'),
            'asunto'      => $this->request->getPost('motivo'),
            'descripcion' => $this->request->getPost('consulta'),
            'respondido'  => 0,  // Por defecto no respondido
            'respuesta'   => null,
            'telefono'    => null 
        ];

        // Guardar en la base de datos
        if ($consultaModel->insert($datos)) {
            // Redireccionar o mostrar mensaje de éxito
            return redirect()->to(site_url('contacto'))->with('mensaje', 'Consulta enviada correctamente.');
        } else {
            // Manejar error, podrías pasar errores a la vista o mostrar un mensaje
            return redirect()->to(site_url('contacto'))->with('error', 'Hubo un problema al enviar la consulta.');
        }
    }
}