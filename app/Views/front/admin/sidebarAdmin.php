<div id="sidebar">
    <h2>Panel de Administrador</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="users.php">Usuarios</a></li>
        <li><a href="<?php echo base_url('productos');?>">Productos</a></li>
        <li><a href="<?php echo base_url('cerrarSesion');?>">Cerrar Sesión</a></li>
    </ul>
</div>

<style>
    #sidebar {
        width: 250px;
        background-color: rgb(180, 81, 191);
        padding: 15px;
        border-right: 1px solid #ccc;
        height: 100vh; /* Altura completa de la ventana */
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Sombra para dar profundidad */
        border-radius: 5px; /* Bordes redondeados */
    }
    #sidebar h2 {
        text-align: center;
        color: #fff; /* Color del texto del título */
        margin-bottom: 20px; /* Espacio debajo del título */
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
        padding: 10px; /* Espaciado interno */
        display: block; /* Hacer que el área del enlace sea más grande */
        border-radius: 3px; /* Bordes redondeados en los enlaces */
        transition: background-color 0.3s, color 0.3s; /* Transición suave */
    }
    #sidebar ul li a:hover {
        background-color: rgba(255, 255, 255, 0.2); /* Fondo al pasar el mouse */
        color: #fff; /* Color del texto al pasar el mouse */
    }
</style>
