<div id="sidebar">
    <h2>Categorías</h2>
    <ul>
        <li><a href="<?= base_url('principal'); ?>">🏠 Inicio</a></li>
        <li><a href="<?= base_url('listadoUsuarios');?>">👤 Usuarios</a></li>
        <li><a href="<?= base_url('productos');?>">📦 Cargar Productos</a></li>
        <li><a href="<?= base_url('cerrarSesion');?>">🚪 Cerrar Sesión</a></li>
    </ul>
</div>

<style>
   #sidebar {
    width: 250px;
    background-color:rgb(142, 35, 138); /* Color de fondo atractivo */
    padding: 20px;
    border-right: 1px solid #ccc;
    height: 100vh; /* Altura completa de la ventana */
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
    border-radius: 8px; /* Bordes redondeados */
    transition: background-color 0.3s; /* Transición suave */
}

#sidebar h2 {
    text-align: center;
    color: #fff; /* Color del texto del título */
    margin-bottom: 20px; /* Espacio debajo del título */
    font-size: 1.8rem; /* Tamaño de fuente del título */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Sombra para el texto */
}

#sidebar ul {
    list-style-type: none;
    padding: 0;
}

#sidebar ul li {
    margin: 15px 0;
}

#sidebar ul li a {
    text-decoration: none;
    color: #fff; /* Color de los enlaces */
    font-weight: bold;
    padding: 12px; /* Espaciado interno */
    display: block; /* Hacer que el área del enlace sea más grande */
    border-radius: 5px; /* Bordes redondeados en los enlaces */
    transition: background-color 0.3s, color 0.3s; /* Transición suave */
    position: relative; /* Para el efecto de subrayado */
</style>
