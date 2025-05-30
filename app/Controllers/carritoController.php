<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class carritoController extends BaseController
{
    public function index()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];

        return view('front/carrito', ['carrito' => $carrito]);
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

    public function vaciar()
{
    $session = session();
    $session->remove('carrito'); // Elimina el carrito de la sesión

    return redirect()->to('/carrito'); // Redirige de nuevo al carrito
}


    public function comprar()
    {
        $carrito = session()->get('carrito');
        $idUsuario = session()->get('idUsuario'); // asumimos que se guarda el ID de usuario

        if ($carrito && $idUsuario) {
            // Aquí deberías insertar la venta en la base de datos
            // y los detalles en otra tabla (ej: 'ventas' y 'detalle_venta')

            session()->remove('carrito');

            return redirect()->to('/carrito')->with('mensaje', '¡Compra realizada con éxito!');
        }

        return redirect()->to('/carrito')->with('mensaje', 'No se pudo realizar la compra.');
    }
}