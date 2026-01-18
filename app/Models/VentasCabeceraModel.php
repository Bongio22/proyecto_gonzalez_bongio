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

}