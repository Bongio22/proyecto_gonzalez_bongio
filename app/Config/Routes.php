<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas de las páginas
$routes->get('/', 'Home::index');

$routes->get('principal', 'Home::index');

$routes->get('contacto', 'Home::contacto');

$routes->get('quienesSomos', 'Home::quienes_somos');

$routes->get('comercializacion', 'Home::comercializacion');

$routes->get('terminosyUsos', 'Home::terminos_usos');

$routes->get('registrarse', 'Home::registrarse'); // Ruta para mostrar el formulario
$routes->post('registrarse', 'sesionController::registrarUsuario');

$routes->get('iniciarSesion', 'Home::iniciar_sesion');
$routes->post('iniciarSesion', 'sesionController::iniciarSesion');

$routes->get('cerrarSesion', 'sesionController::cerrarSesion');

$routes->get('misDatos', 'Home::modificarDatos');
$routes->post('misDatos', 'sesionController::modificarUsuario');

$routes->get('productos', 'productosController::productos'); // Ruta para listar productos

$routes->get('modificarProducto/(:num)', 'productosController::cargarVistaModificarProducto/$1');
$routes->post('modificarProducto', 'productosController::modificarProducto'); // Ruta para guardar cambios

$routes->get('productosController/eliminarProducto/(:num)', 'productosController::eliminarProducto/$1');

$routes->get('agregarProducto', 'Home::agregarProducto'); // Ruta para cargar el formulario
$routes->post('agregarProducto', 'productosController::guardarProducto');    // Ruta para guardar el producto

$routes->get('carrito', 'CarritoController::carrito'); // Ruta para ver el carrito
$routes->post('agregarAlCarrito/(:num)', 'CarritoController::add_carrito/$1');
$routes->get('agregarAlCarrito/(:num)', 'CarritoController::add_carrito/$1');

$routes->post('eliminarDelCarrito', 'CarritoController::remover_producto');