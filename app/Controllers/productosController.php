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

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
        $this->usuarioModel = new UsuarioModel();
        $this->categoriaModel = new CategoriaModel();
        $this->db = Config::connect(); // Conectar a la base de datos
    }

    // Método para cargar la vista de productos
    public function productos()
    {
        // Obtener las categorías
        $categorias = $this->obtenerCategorias();

        // Obtener parámetros de búsqueda
        $categoria = $this->request->getGet('categoria'); // Obtener la categoría seleccionada
        $busqueda = $this->request->getGet('busqueda'); // Obtener el término de búsqueda

        // Cargar productos según los filtros aplicados
        $productos = $this->cargarProductos($categoria, $busqueda);

        // Pasar los datos a la vista
        $data = [
            'productos' => $productos,
            'categorias' => $categorias,
        ];

        // Cargar las diferentes partes de la plantilla
        $header = view('plantillas/header');
        $navbar = view('plantillas/navbar');
        $productosView = view('front/productos', $data);
        $footer = view('plantillas/footer');

        // Devolver la vista completa
        return $header . $navbar . $productosView . $footer;
    }



    private function cargarProductos($categoria = null, $busqueda = null)
    {
        $conditions = [];

        // Filtrar por categoría
        if ($categoria) {
            $conditions['idCategoria'] = intval($categoria); // Filtrar por categoría seleccionada
        }

        // Filtrar por búsqueda
        if ($busqueda) {
            $conditions['LOWER(descripcion) LIKE'] = '%' . strtolower($busqueda) . '%';
        }

        return $this->productoModel->where($conditions)->findAll(); // Retornar productos filtrados
    }


    public function obtenerCategorias()
    {
        return $this->categoriaModel->findAll();
    }


    public function cargarVistaModificarProducto($idProducto)
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
            view('front/modificarProducto', [
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
            'idEstado' => ($stock == 0) ? 0 : 1,
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


    public function guardarProducto()
    {
        $data = [
            'descripcion' => $this->request->getPost('descripcion'),
            'precioUnit' => $this->request->getPost('precioUnit'),
            'stock' => $this->request->getPost('stock'),
            'idCategoria' => $this->request->getPost('idCategoria'),
        ];

        // Establecer el estado del producto según el stock
        if ($data['stock'] == 0) {
            $data['idEstado'] = 0; // Producto no disponible
        } else {
            $data['idEstado'] = 1; // Producto disponible
        }

        // Procesar la subida de imagen si se proporciona
        if ($this->request->getFile('foto')->isValid()) {
            $foto = $this->request->getFile('foto');
            $foto->move('uploads/productos', $foto->getName());
            $data['fotoProducto'] = $foto->getName(); // Cambiar 'foto' por 'fotoProducto'
        }

        // Guardar el producto en la base de datos
        if ($this->productoModel->insert($data)) {
            session()->setFlashdata('success', 'Producto agregado correctamente.');
        } else {
            session()->setFlashdata('error', 'Error al agregar el producto.');
        }

        return redirect()->to(site_url('productos'));
    }

    public function eliminarProducto($idProducto)
{
    // Verificar si se recibió un ID de producto
    if (empty($idProducto)) {
        session()->setFlashdata('error', 'No se seleccionó ningún producto para eliminar.');
        return redirect()->to(site_url('productos'));
    }

    // Datos a actualizar: stock = -1 y estado = 2
    $data = [
        'stock' => -1,
        'idEstado' => 0
    ];

    // Actualizar el producto en la base de datos
    if ($this->productoModel->where('idProducto', $idProducto)->set($data)->update()) {
        session()->setFlashdata('success', 'Producto eliminado correctamente.');
    } else {
        session()->setFlashdata('error', 'Error al eliminar el producto.');
    }

    // Redirigir de nuevo a la página de productos
    return redirect()->to(site_url('productos'));
}

}