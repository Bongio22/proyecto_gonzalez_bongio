<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table = 'Estado'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idEstado'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'descripcion'
    ];
}