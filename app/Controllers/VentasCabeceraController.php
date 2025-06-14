<?php

namespace App\Controllers;

use App\Models\VentasCabeceraModel;
use CodeIgniter\Controller;

class VentasCabeceraController extends Controller
{
   public function crear($total, $usuarioId, $idMetodoPago)
{
    $ventaModel = new VentasCabeceraModel();

    $ventaModel->insert([
        'fecha' => date('Y-m-d H:i:s'),
        'total_venta' => $total,
        'usuario_id' => $usuarioId,
        'idMetodoPago' => $idMetodoPago
    ]);

    return $ventaModel->insertID();
}
public function listarVentas()
{
    $ventaModel = new \App\Models\VentasCabeceraModel();
    $metodoModel = new \App\Models\MetodoPagoModel();

    // Trae todas las ventas
    $ventas = $ventaModel->findAll();

    // Opcional: Mapear ID de método a nombre (si tenés pocos métodos de pago)
    $metodos = $metodoModel->findAll();
    $metodosMap = [];
    foreach ($metodos as $m) {
        $metodosMap[$m['idMetodoPago']] = $m['nombre'];
    }

    // Agrega el nombre del método de pago a cada venta
    foreach ($ventas as &$venta) {
        $venta['metodo'] = $metodosMap[$venta['idMetodoPago']] ?? 'Desconocido';
    }

    $data['compras'] = $ventas;

    return view('plantillas/header')
        . view('front/admin/detalleVentas', $data)
        . view('plantillas/footer');
}

}