<?php

namespace App\Controllers;

use App\Models\VentasCabeceraModel;
use CodeIgniter\Controller;

class VentasCabeceraController extends Controller
{
    public function crear($total, $usuarioId)
    {
        $ventaModel = new VentasCabeceraModel();

        $ventaModel->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $usuarioId
        ]);

        return $ventaModel->insertID();
    }
}