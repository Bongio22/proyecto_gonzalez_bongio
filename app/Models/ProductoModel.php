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
        'idEstadoProducto'
    ];

    public function crearProducto($data)
    {
        // Establecer el estado del producto según el stock
        if ($data['stock'] == 0) {
            $data['idEstadoProducto'] = 2; // Producto no disponible
        } else {
            $data['idEstadoProducto'] = 1; // Producto disponible
        }

        //El builder construye la consulta sql
        $builder = $this->builder();

        if ($builder->insert($data)) {
            session()->setFlashdata('success', 'Producto agregado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al agregar el producto.');
        }
    }

    public function eliminarProducto($idProducto)
    {
        //Actualiza el stock y el estado del producto
        $data = [
            'stock' => 0,
            'idEstadoProducto' => 2
        ];
        //crea la consulta y la manda a la bd
        return $this->builder()
            ->where('idProducto', (int)$idProducto)
            ->update($data);
    }

    public function buscarProductos($categoria, $busqueda)
    {
        //El builder construye la consulta sql
        $builder = $this->builder(); 

        if (!empty($categoria)) {
            $builder->where('idCategoria', (int)$categoria);
        }
        
        if (!empty($busqueda)) {
            $builder->like('descripcion', $busqueda);
        }

        return $builder->get()->getResultArray();
    }

}