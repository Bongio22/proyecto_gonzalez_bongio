<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table = 'Factura'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idFactura'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'importeTotal',
        'fecha',
        'idMetodoPago',
        'idEnvio',
        'idUsuario'
    ];
}