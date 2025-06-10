<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaDetalleModel extends Model
{
    protected $table = 'Ventas_detalle'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idVentasDetalle'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'cantidad',
        'precio',
        'venta_id',
        'producto_id'
    ];
}