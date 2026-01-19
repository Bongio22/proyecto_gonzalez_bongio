<?php

namespace App\Controllers;

use App\Models\VentasDetalleModel;
use App\Models\VentasCabeceraModel;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class VentasDetalleController extends Controller
{
    protected $ventaCabeceraModel;
    protected $ventaDetalleModel;
    protected $productoModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->ventaCabeceraModel = new VentasCabeceraModel();
        $this->ventaDetalleModel = new VentasDetalleModel();
        $this->productoModel = new ProductoModel();
        $this->usuarioModel = new UsuarioModel();
    }

    public function verDetalle($ventaId)
    {
        

        // Obtener datos de la venta
        $venta = $this->ventaCabeceraModel->buscarVenta($ventaId);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada');
        }

        // Obtener datos del usuario
        $usuario = $this->usuarioModel->buscarUsuario($venta['usuario_id']);

        // Obtener los detalles de la venta
        $detalles = $this->ventaDetalleModel->buscarVentaDetalle($venta['venta_id']);

        // Combinar detalles con información del producto
        $detalleConProductos = [];

        foreach ($detalles as $detalle) {
            $producto = $this->productoModel->buscarProducto($detalles['p']);

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

        // Validación de stock antes de mostrar el resumen
        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['idProducto']);
            if (!$producto || $producto['stock'] < $item['cantidad']) {
                return $this->response->setJSON([
                    'mensaje' => 'El stock no es suficiente para: ' . ($producto['descripcion'] ?? $item['descripcion'])
                ]);
            }
        }

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