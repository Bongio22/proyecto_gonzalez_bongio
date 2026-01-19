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
    public function viewModificarProducto($idProducto = null)
    {
        if (!$idProducto) {
            session()->setFlashdata('error', 'ID inválido.');
            return redirect()->to(site_url('productos'));
        }

        $data = $this->productoModel->obtenerDatosEdicion($idProducto);

        if (!$data) {
            session()->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->to(site_url('productos'));
        }

        return view('plantillas/header')
            . view('plantillas/navbar')
            . view('front/admin/modificarProducto', $data)
            . view('plantillas/footer');
    }

    public function modificarProducto()
    {
        $this->productoModel->modificarProductoDesdeRequest($this->request);

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