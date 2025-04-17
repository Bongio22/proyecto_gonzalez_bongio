<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'Usuario'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idUsuario'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'nombre',
        'apellido',
        'correoElectronico',
        'contrasenia',
        'fotoPerfil',
        'nroTelefono',
        'idRol',
        'idEstadoUsuario'
    ];
}