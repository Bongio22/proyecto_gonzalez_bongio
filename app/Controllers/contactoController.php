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

    // Ver detalle de una consulta y marcar como respondida
    public function ver($idConsulta)
    {
        // Marcar como respondida (idEstado = 2)
        $this->consultaModel->update($idConsulta, ['idEstado' => 2]);
        $consulta = $this->consultaModel->find($idConsulta);
        if (!$consulta) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Consulta no encontrada");
        }
        return view('consultas/ver', ['consulta' => $consulta]);
    }

    // Cambiar estado de una consulta
    public function actualizarEstado($id)
    {
        $consulta = $this->consultaModel->find($id);
        if ($consulta) {
            $nuevoEstado = ($consulta['idEstado'] == 1) ? 2 : 1;
            $this->consultaModel->update($id, ['idEstado' => $nuevoEstado]);
        }
        return redirect()->to('/consultas')->with('mensaje', 'Estado actualizado.');
    }

    // Eliminar una consulta
    public function eliminarConsulta($id)
    {
        // Baja lógica: actualiza el estado a 0 (eliminado)
        $this->consultaModel->update($id, ['idEstado' => 0]);
        return redirect()->to('/consultas')->with('mensaje', 'Consulta eliminada correctamente.');
    }

    

}