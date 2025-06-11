<?php

namespace App\Controllers;

use App\Models\VentasDetalleModel;
use App\Models\VentasCabeceraModel;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class VentasDetalleController extends Controller
{
    public function verDetalle($ventaId)
    {
        $ventaModel = new VentasCabeceraModel();
        $detalleModel = new VentasDetalleModel();
        $productoModel = new ProductoModel();
        $usuarioModel = new UsuarioModel();

        // Obtener datos de la venta
        $venta = $ventaModel->find($ventaId);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada');
        }

        // Obtener datos del usuario
        $usuario = $usuarioModel->find($venta['usuario_id']);

        // Obtener los detalles de la venta
        $detalles = $detalleModel->where('venta_id', $ventaId)->findAll();

        // Combinar detalles con información del producto
        $detalleConProductos = [];

        foreach ($detalles as $detalle) {
            $producto = $productoModel->find($detalle['producto_id']);

            $detalleConProductos[] = [
                'producto_descripcion' => $producto['descripcion'] ?? 'Producto desconocido',
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio']
            ];
        }

        // Pasar los datos a la vista
        return view('ventas/detalle', [
            'venta' => $venta,
            'usuario' => $usuario,
            'detalles' => $detalleConProductos
        ]);
    }

    public function crear($ventaId, $productoId, $cantidad, $precio)
    {
        $detalleModel = new VentasDetalleModel();

        return $detalleModel->insert([
            'venta_id' => $ventaId,
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
            'precio' => $precio
        ]);
    }
}