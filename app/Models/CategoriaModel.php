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

    public function obtenerCategorias()
    {
        return $this->findAll();
    }

    public function buscarCategoria($categoriaGet, $categoriaRuta)
    {
        //Evalua si alguno de los valores es null
        $categoriaBuscada = $categoriaGet ?? $categoriaRuta;

        $builder = $this->builder();
        //realiza la consulta a la bd
        $builder->select('idCategoria')
            ->where('idCategoria', (int)$categoriaBuscada)
            ->limit(1);
        //Obtiene el valor de la consulta
        $resultado = $builder->get()->getRow();
        //Devuelve el valor de la consulta
        return $resultado ? (int)$resultado->idCategoria : null;
    }
}