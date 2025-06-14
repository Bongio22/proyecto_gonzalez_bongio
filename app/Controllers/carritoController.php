<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class carritoController extends BaseController
{
    public function index()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];
        $data['titulo'] = 'Carrito';
        return view('plantillas/header', $data) .view('plantillas/navbar') . view('front/carrito', ['carrito' => $carrito]) . view('plantillas/footer');
    }

    public function agregar($idProducto)
    {
        $productoModel = new ProductoModel();
        $producto = $productoModel->find($idProducto);

        if ($producto) {
            $session = session();
            $carrito = $session->get('carrito') ?? [];

            $encontrado = false;
            foreach ($carrito as &$item) {
                if ($item['idProducto'] == $idProducto) {
                    $item['cantidad'] += 1;
                    $encontrado = true;
                    break;
                }
            }

            if (!$encontrado) {
                $carrito[] = [
                    'idProducto' => $producto['idProducto'],
                    'descripcion' => $producto['descripcion'],
                    'precioUnit' => $producto['precioUnit'],
                    'cantidad' => 1
                ];
            }

            $session->set('carrito', $carrito);
        }

        return redirect()->to('/carrito');
    }

    public function eliminar($index)
    {
        $session = session();
        $carrito = $session->get('carrito');
        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            $session->set('carrito', array_values($carrito));
        }

        return redirect()->to('/carrito');
    }
    public function eliminarProducto()
    {
        $idProducto = $this->request->getPost('idProducto');
        $session = session();
        $carrito = $session->get('carrito');

        // Filtrar todos los productos excepto el que tiene el idProducto
        $nuevoCarrito = array_filter($carrito, function ($item) use ($idProducto) {
            return $item['idProducto'] != $idProducto;
        });

        $session->set('carrito', array_values($nuevoCarrito));
        return redirect()->to('/carrito');
    }

    public function vaciar()
    {
        $session = session();
        $session->remove('carrito'); // Elimina el carrito de la sesión

        return redirect()->to('/carrito'); // Redirige de nuevo al carrito
    }


    public function finalizarCompra()
{
    $session = session();
    $carrito = $session->get('carrito') ?? [];
    $idUsuario = $session->get('idUsuario');

    if (empty($carrito) || !$idUsuario) {
        return redirect()->to('/carrito')->with('mensaje', 'No se pudo realizar la compra.');
    }

    // Obtener método de pago desde POST
    $idMetodoPago = $this->request->getPost('idMetodoPago');
    if (!$idMetodoPago) {
        return redirect()->to('/carrito')->with('mensaje', 'Método de pago no especificado.');
    }

    // Verificar que el método de pago exista
    $metodoPagoModel = new \App\Models\MetodoPagoModel();
    if (!$metodoPagoModel->find($idMetodoPago)) {
        return redirect()->to('/carrito')->with('mensaje', 'Método de pago inválido.');
    }

    $productoModel = new \App\Models\ProductoModel();
    $cabeceraController = new \App\Controllers\VentasCabeceraController();
    $detalleController = new \App\Controllers\VentasDetalleController();

    // Verificar stock antes de hacer cualquier operación
    foreach ($carrito as $item) {
        $producto = $productoModel->find($item['idProducto']);

        if (!$producto || $producto['stock'] < $item['cantidad']) {
            return redirect()->to('/carrito')->with('mensaje', 'Stock insuficiente para: ' . $item['descripcion']);
        }
    }

    // Calcular total de la compra
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precioUnit'] * $item['cantidad'];
    }

    // Crear cabecera de venta
    $ventaId = $cabeceraController->crear($total, $idUsuario, $idMetodoPago);

    // Insertar cada detalle y actualizar stock
    foreach ($carrito as $item) {
        $detalleController->crear($ventaId, $item['idProducto'], $item['cantidad'], $item['precioUnit']);

        $producto = $productoModel->find($item['idProducto']);
        $productoModel->update($item['idProducto'], [
            'stock' => $producto['stock'] - $item['cantidad']
        ]);
    }

    $session->remove('carrito');

    // En lugar de redirigir, puedes devolver los detalles de la compra
    return $this->response->setJSON([
        'mensaje' => '¡Compra realizada con éxito!',
        'total' => $total,
        'detalles' => $carrito,
        'localizador' => rand(10000000, 99999999) // Generar un localizador aleatorio
    ]);
}
}