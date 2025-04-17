<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleFacturaModel extends Model
{
    protected $table = 'DetalleFactura'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idDetalleFactura'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'cantidad',
        'subtotal',
        'idProducto',
        'idFactura'
    ];
}