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
public function ventaDetalle() 
{
    if (!session()->has('idUsuario')) {
        return view('modales/error_sesion');
    }

    $usuarioModel = new \App\Models\UsuarioModel();
    $productoModel = new \App\Models\ProductoModel();
    $metodoPagoModel = new \App\Models\MetodoPagoModel(); 

    $carrito = session('carrito') ?? [];

    $usuario = $usuarioModel->find(session('idUsuario'));

    $detalle = [];
    foreach ($carrito as $item) {
        $producto = $productoModel->find($item['idProducto']);
        $detalle[] = [
            'descripcion' => $producto['descripcion'],
            'cantidad' => $item['cantidad'],
            'precio' => $producto['precioUnit']
        ];
    }

    $metodos = $metodoPagoModel->where('idEstado', 1)->findAll(); 

    return view('front/usuario/ventaDetalle', [
        'usuario' => $usuario,
        'detalle' => $detalle,
        'metodos' => $metodos 
    ]);
}


}