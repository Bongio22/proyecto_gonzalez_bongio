<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*Rutas principales*/
$routes->get('/', 'Home::index');
$routes->get('principal', 'Home::index');
$routes->get('contacto', 'contactoController::contacto');
$routes->get('quienesSomos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('terminosyUsos', 'Home::terminos_usos');
/*Rutas principales*/

/*Rutas par el manejo de Usuario*/
$routes->get('registrarse', 'Home::registrarse'); // Ruta para mostrar el formulario
$routes->post('registrarse', 'loginController::registrarUsuario');
$routes->get('iniciarSesion', 'Home::iniciar_sesion');
$routes->post('iniciarSesion', 'loginController::iniciarSesion');
$routes->get('cerrarSesion', 'loginController::cerrarSesion');
$routes->get('misDatos', 'Home::modificarDatos');
$routes->post('misDatos', 'loginController::modificarUsuario');
$routes->get('panelAdmin', 'Home::panelAdmin');
$routes->get('admin/usuarios', 'panelController::mostrarUsuarios');
/*Rutas para el manejo de Usuario*/

/*Rutas para el manejo de Productos*/
$routes->get('productos', 'productosController::productos'); // Ruta para listar productos
$routes->get('productosAdmin', 'productosController::productosAdmin');
$routes->get('modificarProducto/(:num)', 'productosController::cargarVistaModificarProducto/$1');
$routes->post('modificarProducto', 'productosController::modificarProducto'); // Ruta para guardar cambios
$routes->post('agregarProducto', 'productosController::guardarProducto');    // Ruta para guardar el producto
$routes->get('productosController/eliminarProducto/(:num)', 'productosController::eliminarProducto/$1');
/*Rutas para el manejo de Productos*/

/*Rutas para el manejo del Carrito*/
$routes->get('agregarProducto', 'productosController::agregarProducto'); // Ruta para cargar el formulario
$routes->get('carrito', 'carritoController::index'); // Ruta para ver el carrito
$routes->get('agregar/(:num)', 'carritoController::agregar/$1');
$routes->post('agregar/(:num)', 'carritoController::agregar/$1');
$routes->post('eliminarDelCarrito', 'carritoController::remover_producto');
$routes->post('carrito/vaciar', 'carritoController::vaciar');

/*Rutas para el manejo del Carrito*/

/*Rutas para el manejo del panel */
// Rutas para el panel de administración
$routes->get('panelAdmin', 'panelController::panelAdmin'); // Vista principal
$routes->get('adminUsuarios', 'panelController::mostrarUsuarios'); // Cargar tabla usuarios
$routes->get('adminProductos', 'panelController::mostrarProductos'); // Cargar tabla productos
$routes->get('listadoUsuarios', 'panelController::listadoUsuarios');
/*Rutas para el manejo del panel */

/*Contacto*/
$routes->post('contactoController/guardarConsulta', 'ContactoController::guardarConsulta');
$routes->get('contactoController/guardarConsulta', 'ContactoController::guardarConsulta');
/*Contacto*/