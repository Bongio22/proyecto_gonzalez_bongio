<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasCabeceraModel extends Model
{
    protected $table = 'Ventas_cabecera'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idVentas'; // Clave primaria

    // Columnas permitidas para operaciones de inserción y actualización
    protected $allowedFields = [
        'fecha',
        'total_venta',
        'usuario_id'
    ];
}