<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasCabeceraModel extends Model
{
    protected $table = 'Ventas_cabecera'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idVentas'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'fecha',
        'total_venta',
        'usuario_id',
        'idMetodoPago'
    ];

    public function crearVentaCabecera($total, $usuarioId, $idMetodoPago)
    {
        $builder = $this->builder();

        $builder->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $usuarioId,
            'idMetodoPago' => $idMetodoPago
        ]);

        return $this->getInsertID();
    }

    public function buscarVenta($ventaId)
    {
        return $this->builder()
            ->where('idVentas', (int)$ventaId)
            ->get()
            ->getRowArray();
    }

    public function buscarVentas($idUsuario)
    {
        $builder = $this->builder();

        return $builder
            ->where('usuario_id', (int)$idUsuario)
            ->get()
            ->getResult();
    }

    public function listarVentas()
    {
        return $this->builder()
            ->get()
            ->getResultArray();
    }

    public function completarVenta(&$venta, $metodosPagoMap)
    {
        $usuarioModel = new UsuarioModel();
        // Método de pago
        $venta['metodo'] = $metodosPagoMap[$venta['idMetodoPago']] ?? 'Desconocido';

        // Usuario
        $usuario = $usuarioModel->buscarUsuario($venta['usuario_id']);

        if ($usuario) {
            $venta['nombre'] = $usuario['nombre'];
            $venta['apellido'] = $usuario['apellido'];
            $venta['correoElectronico'] = $usuario['correoElectronico'];
        }
    }

    public function procesarCompra(array $carrito, $idUsuario, $idMetodoPago): array
    {
        if (!$this->datosValidos($carrito, $idUsuario, $idMetodoPago)) {
            return $this->error('Datos inválidos.');
        }

        if (!$this->metodoPagoValido($idMetodoPago)) {
            return $this->error('Método de pago inválido.');
        }

        if (!$this->stockDisponible($carrito)) {
            return $this->error('Stock insuficiente para uno o más productos.');
        }

        $total   = $this->calcularTotal($carrito);
        $ventaId = $this->crearCabecera($total, $idUsuario, $idMetodoPago);

        $this->crearDetallesYActualizarStock($ventaId, $carrito);

        return $this->exito($total);
    }
    private function datosValidos($carrito, $idUsuario, $idMetodoPago): bool
    {
        return !empty($carrito) && $idUsuario && $idMetodoPago;
    }

    private function metodoPagoValido($idMetodoPago): bool
    {
        $metodoPagoModel = new \App\Models\MetodoPagoModel();
        return (bool) $metodoPagoModel->find($idMetodoPago);
    }

    private function stockDisponible(array $carrito): bool
    {
        $productoModel = new \App\Models\ProductoModel();

        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['idProducto']);
            if (!$producto || $producto['stock'] < $item['cantidad']) {
                return false;
            }
        }
        return true;
    }

    private function calcularTotal(array $carrito): float
    {
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precioUnit'] * $item['cantidad'];
        }
        return $total;
    }

    private function crearCabecera($total, $idUsuario, $idMetodoPago): int
    {
        return $this->insert([
            'fecha'        => date('Y-m-d H:i:s'),
            'total_venta'  => $total,
            'usuario_id'   => $idUsuario,
            'idMetodoPago' => $idMetodoPago
        ]);
    }

    private function crearDetallesYActualizarStock(int $ventaId, array $carrito): void
    {
        $detalleModel  = new \App\Models\VentasDetalleModel();
        $productoModel = new \App\Models\ProductoModel();

        foreach ($carrito as $item) {
            $detalleModel->insert([
                'venta_id'    => $ventaId,
                'producto_id' => $item['idProducto'],
                'cantidad'    => $item['cantidad'],
                'precio'      => $item['precioUnit']
            ]);

            $producto = $productoModel->find($item['idProducto']);
            $productoModel->update($item['idProducto'], [
                'stock' => $producto['stock'] - $item['cantidad']
            ]);
        }
    }

    private function error(string $mensaje): array
    {
        return [
            'ok'      => false,
            'mensaje' => $mensaje
        ];
    }

    private function exito(float $total): array
    {
        return [
            'ok'      => true,
            'mensaje' => '¡Compra realizada con éxito!',
            'total'   => $total
        ];
    }
}