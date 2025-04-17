<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'Categoria'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idCategoria'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'descripcion'
    ];
}