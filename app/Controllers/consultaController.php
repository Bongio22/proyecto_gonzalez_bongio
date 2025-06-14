<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConsultaModel;

class ConsultaController extends BaseController
{
    protected $consultaModel;

    public function __construct()
    {
        $this->consultaModel = new ConsultaModel();
    }

    // Mostrar todas las consultas
    public function index()
    {
        $consultas = $this->consultaModel->findAll();
        return view('consultas/index', ['consultas' => $consultas]);
    }

    // Guardar nueva consulta (desde formulario)
    public function crear()
    {
        $data = [
            'nombre'            => $this->request->getPost('nombre'),
            'apellido'          => $this->request->getPost('apellido'),
            'asunto'            => $this->request->getPost('asunto'),
            'correoElectronico' => $this->request->getPost('correoElectronico'),
            'descripcion'       => $this->request->getPost('descripcion'),
            'idEstado'          => 1,
            'telefono'          => $this->request->getPost('telefono')
        ];

        $this->consultaModel->insert($data);
        return redirect()->to('/consultas')->with('mensaje', 'Consulta enviada correctamente.');
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