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

    public function listarMetodosPago()
    {
        return $this->builder()
            ->get()
            ->getResultArray();
    }
    public function obtenerMetodosPagoMap()
    {
        $metodos = $this->listarMetodosPago();
        $map = [];

        foreach ($metodos as $m) {
            $map[$m['idMetodoPago']] = $m['nombre'];
        }

        return $map;
    }

}