<?php
// Inicia sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si ya hay una sesión iniciada y redirige
if (isset($_SESSION['usuario'])) {
    header("Location: principal"); // Redirige a la página principal
    exit();
}

// Configuración de la conexión a la base de datos
function conectarBaseDatos()
{
    $servidor = "localhost"; // Cambiar si usás un servidor diferente
    $usuario = "root"; // Usuario de tu base de datos
    $contraseña = ""; // Contraseña de tu base de datos
    $baseDatos = "frikiverse"; // Cambiar por el nombre de tu base

    $conexion = new mysqli($servidor, $usuario, $contraseña, $baseDatos);

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

// Retorna la conexión lista para usar
$conexion = conectarBaseDatos();