<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultaModel extends Model
{
    protected $table = 'Consulta'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idConsulta'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'idUsuario',
        'nombre',
        'apellido',
        'asunto',
        'email',
        'descripcion',
        'respondido',
        'respuesta',
        'telefono'
    ];
}