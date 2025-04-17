<?php

namespace App\Models;

use CodeIgniter\Model;

class EnvioModel extends Model
{
    protected $table = 'Envio'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idEnvio'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'descripcion',
        'idEstado'
    ];
}