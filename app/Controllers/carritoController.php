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

    $carrito      = $session->get('carrito') ?? [];
    $idUsuario    = $session->get('idUsuario');
    $idMetodoPago = $this->request->getPost('idMetodoPago');

    $ventasModel = new \App\Models\VentasCabeceraModel();

    $resultado = $ventasModel->procesarCompra(
        $carrito,
        $idUsuario,
        $idMetodoPago
    );

    if ($resultado['ok']) {
        $session->remove('carrito');
    }

    return $this->response->setJSON($resultado);
}


public function actualizarCantidad()
{
    $idProducto = $this->request->getPost('idProducto');
    $accion = $this->request->getPost('accion'); // 'sumar' o 'restar'
    $session = session();
    $carrito = $session->get('carrito') ?? [];

    foreach ($carrito as &$item) {
        if ($item['idProducto'] == $idProducto) {
            if ($accion === 'sumar') {
                $item['cantidad'] += 1;
            } elseif ($accion === 'restar' && $item['cantidad'] > 1) {
                $item['cantidad'] -= 1;
            }
            break;
        }
    }
    $session->set('carrito', $carrito);
    return redirect()->to('/carrito');
}
}