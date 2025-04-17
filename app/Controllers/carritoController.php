<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\PedidoDetalleModel;
use App\Models\PedidoModel;
use App\Models\ProductoModel;

class CarritoController extends BaseController
{
    protected $helpers = ['url', 'form'];

    // CARRITO DE COMPRAS
    public function carrito()
{
    $cart = \Config\Services::cart();
    $data['titulo'] = 'Carrito de compras';
    $data['productos'] = $cart->contents();

    // Verifica si el carrito tiene productos
    if (empty($data['productos'])) {
        $data['mensaje'] = 'Tu carrito está vacío.';
    }

    return view('plantillas/header', $data)
        . view('plantillas/navbar')
        . view('front/carrito', $data)
        . view('plantillas/footer');
}


public function add_carrito($id_producto = null)
{
    if (!$id_producto) {
        return redirect()->to('/carrito')->with('mensaje', 'Producto no válido.');
    }

    $cart = \Config\Services::cart();
    $productoModel = new ProductoModel();
    $producto = $productoModel->find($id_producto);

    if ($producto && $producto['stock'] > 0) {
        $data = [
            'id'    => $producto['idProducto'],
            'name'  => $producto['descripcion'],
            'price' => $producto['precioUnit'],
            'qty'   => 1,
        ];
        $cart->insert($data);

        return redirect()->to('/carrito')->with('mensaje', '¡Producto agregado al carrito!');
    }

    return redirect()->to('/carrito')->with('mensaje', '¡No hay stock disponible!');
}

    public function guardar_venta()
    {
        // Este método se queda igual, ya que no se necesitan cambios
        $cart = \Config\Services::cart();
        $venta = new PedidoModel();
        $detalle = new PedidoDetalleModel();
        $productos = new ProductoModel();
        $request = \Config\Services::request();

        // Verifica el stock de los productos
        $cart1 = $cart->contents();

        foreach ($cart1 as $item) {
            $producto = $productos->where('id_producto', $item['id'])->first();

            if ($producto['stock_producto'] < $item['qty'] || $producto['stock_producto'] == 0) {
                return redirect()->route('carrito')->with('mensaje', '¡No hay Stock suficiente!');
            }
        }

        // Datos de la venta
        $data = array(
            'id_cliente' => session("id_usuario"),
            'fecha_pedido' => date('Y-m-d')
        );

        // Inserta la venta
        $id_venta = $venta->insert($data);

        // Detalles de la venta
        foreach ($cart1 as $item) {
            // Llamar a la función para actualizar el estado del producto si el stock es cero
            $this->actualizarStockProducto($item['id'], $item['qty']);

            $data = [
                "stock_producto" => $producto["stock_producto"] - $item['qty']
            ];

            $pedido_detalle = array(
                'id_pedido' => $id_venta,
                'id_producto' => $item['id'],
                'cantidad_pedido' => $item['qty'],
                'precio_unitario' => $item['price']
            );

            $productos->update($item['id'], $data);

            // Inserta el detalle de la venta
            $detalle->insert($pedido_detalle);
        }

        // Vacía el carrito
        $cart->destroy();

        return redirect()->route('carrito')->with('mensaje', '¡Gracias por su compra!');
    }

    public function actualizarStockProducto($id_producto, $cantidad_producto)
    {
        // Este método se queda igual, ya que no se necesitan cambios
        $productoModel = new ProductoModel();

        // Obtener el producto actual
        $producto_actual = $productoModel->find($id_producto);

        // Calcular el nuevo stock
        $nuevo_stock = $producto_actual['stock_producto'] - $cantidad_producto;

        // Actualizar el stock del producto
        $productoModel->update($id_producto, ['stock_producto' => $nuevo_stock]);

        // Verificar y actualizar el estado del producto basado en el stock
        if ($nuevo_stock <= 0) {
            $productoModel->update($id_producto, ['estado_producto' => 0]);
        }
    }

    public function borrar($rowid)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowid);
        return redirect()->route('carrito')->with('mensaje', 'Producto eliminado del carrito!');
    }

    public function vaciar()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->route('carrito')->with('mensaje', 'Carrito vaciado!');
    }
}