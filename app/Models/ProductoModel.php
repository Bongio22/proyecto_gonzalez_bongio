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

    public function buscarProducto($idProducto)
    {
        return $this->builder()
            ->where('idProducto', (int)$idProducto)
            ->get()
            ->getRowArray();
    }

    public function modificarProductoDesdeRequest($request)
    {
        $idProducto = $request->getPost('idProducto');

        $data = $this->armarDatosProducto($request);
        $this->procesarFoto($request, $data);

        return $this->update($idProducto, $data);
    }
    private function armarDatosProducto($request): array
    {
        $stock = (int) $request->getPost('stock');

        return [
            'descripcion' => $request->getPost('descripcion'),
            'precioUnit' => $request->getPost('precioUnit'),
            'stock' => $stock,
            'idCategoria' => $request->getPost('idCategoria'),
            'idEstadoProducto' => $this->calcularEstado($stock),
        ];
    }

    private function calcularEstado(int $stock): int
    {
        return ($stock === 0) ? 0 : 1;
    }
    private function procesarFoto($request, array &$data): void
    {
        $foto = $request->getFile('foto');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $nombreFoto = $foto->getRandomName();
            $foto->move('uploads/productos', $nombreFoto);
            $data['fotoProducto'] = $nombreFoto;
        }
    }

    public function obtenerDatosEdicion(int $idProducto): ?array
    {
        $producto = $this->find($idProducto);

        if (!$producto) {
            return null;
        }

        return [
            'producto' => $producto,
            'categorias' => model('CategoriaModel')->findAll(),
        ];
    }


}