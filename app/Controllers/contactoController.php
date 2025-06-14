<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConsultaModel;

class contactoController extends BaseController
{
    protected $consultaModel;

    public function __construct()
    {
        $this->consultaModel = new ConsultaModel();
    }
    public function contacto()
    {
        $data['titulo'] = 'contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') . view('plantillas/footer');
    }

    // Mostrar todas las consultas
    public function consultas()
    {
        $consultas = $this->consultaModel->findAll();
        return view('consultas', ['consultas' => $consultas]);
    }
    
    
    public function crearConsulta()
    {
        $data = [
            'nombre'            => $this->request->getPost('nombre'),
            'apellido'          => $this->request->getPost('apellido'),
            'asunto'            => $this->request->getPost('asunto'),
            'correoElectronico' => $this->request->getPost('email'),
            'descripcion'       => $this->request->getPost('descripcion'),
            'idEstado'          => 1
        ];

        $this->consultaModel->insert($data);
        return redirect()->to('contacto')->with('mensaje', 'Consulta enviada correctamente.');
    }

    // Ver detalle de una consulta
    public function ver($idConsulta)
    {
        $consulta = $this->consultaModel->find($idConsulta);
        if (!$consulta) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Consulta no encontrada");
        }
        return view('consultas/ver', ['consulta' => $consulta]);
    }

    // Cambiar estado de una consulta
    public function actualizarEstado($id)
    {
        $nuevoEstado = $this->request->getPost('idEstado');
        $this->consultaModel->update($id, ['idEstado' => $nuevoEstado]);

        return redirect()->to('/consultas')->with('mensaje', 'Estado actualizado.');
    }
}