<?php

namespace App\Models;

use CodeIgniter\Model;

class MetodoPagoModel extends Model
{
    protected $table = 'MetodoPago'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idMetodoPago'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'nombre',
        'idEstado'
    ];
}