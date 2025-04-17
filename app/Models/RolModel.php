<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'Rol'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idRol'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'descripcion' // Solo las columnas modificables
    ];
}