<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'Producto'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idProducto'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'descripcion',
        'precioUnit',
        'stock',
        'fotoProducto',
        'idCategoria',
        'idEstado' // Campo ajustado para coincidir con la tabla
    ];
}