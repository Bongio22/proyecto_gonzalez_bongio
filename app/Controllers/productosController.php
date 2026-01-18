<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;
use CodeIgniter\Database\Config;

class productosController extends BaseController
{
    protected $productoModel;
    protected $usuarioModel;
    protected $categoriaModel;
    protected $db;

    //constructor
    public function __construct()
    {
        $this->productoModel = new ProductoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
        $this->db = Config::connect(); // Conectar a la base de datos
    }

    //vista productos
    public function productos($categoriaRuta = null)
    {
        // Categoría por filtro
        $categoriaGet = $this->request->getGet('categoria');
        
        //Buscar categoria por filtro o por ruta
        $categoriaBuscada = $this->categoriaModel->buscarCategoria($categoriaGet,$categoriaRuta);
        
        //Guarda los datos
        $data = [
            'productos' => $this->productoModel->buscarProductos($categoriaBuscada, $this->request->getGet('busqueda')),
            'categorias' => $this->categoriaModel->obtenerCategorias(),
            'categoriaSeleccionada' => $categoriaBuscada
        ];
        //Devuelve la vista
        return view('plantillas/header')
            . view('plantillas/navbar')
            . view('front/productos', $data)
            . view('plantillas/footer');
    }
    public function viewModificarProducto($idProducto)
    {
        // Verificar si llega el ID
        if (!$idProducto) {
            session()->setFlashdata('error', 'No se recibió un ID válido.');
            return redirect()->to(site_url('productos'));
        }

        // Obtener el producto por ID
        $producto = $this->productoModel->find($idProducto);
        if (!$producto) {
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->to(site_url('productos'));
        }

        // Obtener las categorías
        $categorias = $this->categoriaModel->findAll();

        // retorna las vistas
        return view('plantillas/header') .
            view('plantillas/navbar') .
            view('front/admin/modificarProducto', [
                'producto' => $producto,
                'categorias' => $categorias,
            ]) .
            view('plantillas/footer');
    }

    public function modificarProducto()
    {
        // Obtener el ID del producto del formulario
        $idProducto = $this->request->getPost('idProducto');

        // Validar que el ID del producto no esté vacío
        if (empty($idProducto)) {
            session()->setFlashdata('error', 'ID de producto no proporcionado.');
            return redirect()->to(site_url('productos'));
        }

        // Obtener los datos del formulario
        $stock = $this->request->getPost('stock');
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'precioUnit' => $this->request->getPost('precioUnit'),
            'stock' => $stock,
            'idCategoria' => $this->request->getPost('idCategoria'),
            // Actualizamos el estado según el stock
            'idEstadoProducto' => ($stock == 0) ? 0 : 1,
        ];

        // Verificar si se ha enviado un archivo y si es válido
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $foto->move('uploads/productos', $foto->getName());
            $data['fotoProducto'] = $foto->getName();
        }

        // Actualizar el producto en la base de datos
        if ($this->productoModel->update($idProducto, $data)) {
            session()->setFlashdata('success', 'Producto actualizado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al actualizar el producto.');
        }

        return redirect()->to(site_url('productos'));
    }

    public function agregarProducto()
    {
        $data['categorias'] = $this->categoriaModel->findAll(); // Obtener todas las categorías
        return view('plantillas/header', $data)
            . view('plantillas/navbar')
            . view('front/admin/agregarProducto', $data) // Pasar las categorías a la vista
            . view('plantillas/footer');
    }

    public function crearProducto()
    {
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'precioUnit' => $this->request->getPost('precioUnit'),
            'stock' => $this->request->getPost('stock'),
            'idCategoria' => $this->request->getPost('idCategoria'),
        ];
        // Procesar la subida de imagen si se proporciona
        if ($this->request->getFile('foto')->isValid()) {
            $foto = $this->request->getFile('foto');
            $foto->move('uploads/productos', $foto->getName());
            $data['fotoProducto'] = $foto->getName(); // Cambiar 'foto' por 'fotoProducto'
        }
        
        $this->productoModel->crearProducto($data);

        return redirect()->to(site_url('productos'));
    }

    public function eliminarProducto($idProducto)
    {
        // Verificar si se recibió un ID de producto
        if (empty($idProducto)) {
            session()->setFlashdata('error', 'No se seleccionó ningún producto para eliminar.');
            return redirect()->to(site_url('productos'));
        }
        //Llama a la funcion para eliminar
        $this->productoModel->eliminarProducto($idProducto);
        // Redirigir de nuevo a la página de productos
        return redirect()->to(site_url('productos'));
    }

    
}