<?php

namespace App\Controllers;

use App\Models\VentasCabeceraModel;
use App\Models\VentasDetalleModel;
use App\Models\ProductoModel;
use App\Models\UsuarioModel;
use \App\Models\MetodoPagoModel;
use CodeIgniter\Controller;

class VentasCabeceraController extends Controller
{
    //Variables
    protected $ventasCabeceraModel;
    protected $ventasDetalleModel;
    protected $usuarioModel;
    protected $productoModel;
    protected $metodoPagoModel;
    //Constructor
     public function __construct()
    {
        $this->ventasCabeceraModel = new VentasCabeceraModel();
        $this->ventasDetalleModel = new VentasDetalleModel();
        $this->usuarioModel = new UsuarioModel();
        $this->productoModel = new ProductoModel();
        $this->metodoPagoModel = new MetodoPagoModel();
    }

    public function crear($total, $usuarioId, $idMetodoPago)
    {
        $this->ventasCabeceraModel->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $usuarioId,
            'idMetodoPago' => $idMetodoPago
        ]);

        return $this->ventasCabeceraModel->insertID();
    }
    public function listarVentas()
    {
        $ventas = $this->ventasCabeceraModel->listarVentas();

        $metodosPagoMap = $this->metodoPagoModel->obtenerMetodosPagoMap();

        foreach ($ventas as &$venta) {
            $this->ventasCabeceraModel->completarVenta($venta, $metodosPagoMap);
        }

        $data['compras'] = $ventas;

        return view('plantillas/header')
            . view('front/admin/detalleVentas', $data)
            . view('plantillas/footer');
    }
    public function misCompras()
    {
        //Busca las cabeceras con respecto al id del usuario
        $ventas = $this->ventasCabeceraModel->buscarVentas(session()->get('idUsuario'));
        $compras = [];
        //Busca los detalles de ventas con respecto a la cabecera
        foreach ($ventas as $venta) {
            $detalles = $this->ventasDetalleModel->buscarVentaDetalle($venta->idVentas);
            //Busca los productos con respecto a los detalles
            foreach ($detalles as $detalle) {
                $producto = $this->productoModel->buscarProducto($detalle->producto_id);
                //Agrega los productos de las compras
                if ($producto) {
                    $compras[] = [
                        'fecha' => $venta->fecha,
                        'descripcion' => $producto['descripcion'],
                        'precioUnit' => $producto['precioUnit'],
                        'cantidad' => $detalle->cantidad

                    ];
                }
            }
        }
        $data['compras'] = $compras;
        //Devuelve la vista de las compras del usuario
        return view('plantillas/header', $data) . view('plantillas/navbar')
            . view('front/usuario/misCompras', $data)
            . view('plantillas/footer');
    }
}