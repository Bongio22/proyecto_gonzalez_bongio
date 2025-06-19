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
        $consultas = $this->consultaModel->where('idEstado !=', 2)->findAll();

        return view('plantillas/header')
        . view('front/admin/consultas', ['consultas' => $consultas])
        . view('plantillas/footer');
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

public function atenderConsulta()
{
    // Obtener JSON (porque el fetch lo envía así)
    $data = $this->request->getJSON(true); // <- clave

    $idConsulta = $data['idConsulta'] ?? null;
    $respuesta = $data['respuesta'] ?? null;

    if (!$idConsulta || !$respuesta) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Datos incompletos'
        ]);
    }

    $consultaModel = new \App\Models\ConsultaModel();

    $consultaModel->update($idConsulta, [
        'respuesta' => $respuesta,
    ]);

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Consulta respondida correctamente'
    ]);
}

    
    // Eliminar una consulta
    public function eliminarConsulta($id)
    {
        // Baja lógica: actualiza el estado a 2 (eliminado)
        $this->consultaModel->update($id, ['idEstado' => 2]);
        return redirect()->to('/consultas')->with('mensaje', 'Consulta eliminada correctamente.');
    }

}