<div class="main-container">
    <section class="dashboard">
        <div class="stats">
            <div class="stat-item">
                <h2>Total Productos</h2>
                <p>150</p>
            </div>
            <div class="stat-item">
                <h2>Total Usuarios</h2>
                <p>300</p>
            </div>
        </div>

        <div class="actions">
            <div class="action-buttons">
                <a href="<?= base_url('productos'); ?>" class="btn">Crud Producto</a>
                <a href="<?= base_url('listadoUsuarios'); ?>" class="btn">Crud Usuario</a>
                <a href="<?= base_url('listadoUsuarios'); ?>" class="btn">Detalle Ventas</a>
            </div>
            <a href="<?= base_url('cerrarSesion'); ?>" class="btn-Volver">Cerrar Sesion</a>
        </div>
    </section>
</div>

<style>
.main-container {
    display: flex;
    min-height: 100vh;

}

header h1 {
    margin: 0;
    font-size: 2rem;
}

nav ul {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 20px;
    /* Espacio entre los enlaces */
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.dashboard {
    flex-grow: 1;
    /* El contenido principal ocupa el espacio restante */
    padding: 20px;
}

.stats {
    display: flex;
    justify-content: space-around;
    /* Espacio entre los elementos */
    margin-bottom: 20px;
}

.stat-item {
    background-color: #fff;
    /* Fondo blanco para las estadísticas */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Sombra para las estadísticas */
    text-align: center;
    flex: 1;
    /* Cada item ocupa el mismo espacio */
    margin: 0 10px;
    /* Espacio entre los items */
}

.actions {
    margin-bottom: 20px;
    text-align: center;
    /* Centra los botones */
}

.action-buttons {
    display: flex;
    justify-content: center;
    /* Centra los botones en la fila */
    gap: 10px;
    /* Espacio entre los botones */
}

.btn {
    background-color: #28a745;
    /* Color del botón */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    text-decoration: none;
    /* Eliminar subrayado */
    display: inline-block;
    /* Asegura que el enlace se comporte como un botón */
}

.btn:hover {
    background-color: #218838;
    /* Color más oscuro al pasar el mouse */
}

.btn-Volver {
    background-color: #28a745;
    /* Color similar a los otros botones */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    text-decoration: none;
    /* Eliminar subrayado */
    display: inline-block;
    /* Asegura que el enlace se comporte como un botón */
    margin-top: 10px;
    /* Espacio superior para separar del grupo de botones */
}

.btn-Volver:hover {
    background-color: #218838;
    /* Color más oscuro al pasar el mouse */
}

.notifications {
    background-color: #f8d7da;
    /* Color de fondo para notificaciones */
    padding: 15px;
    border-radius: 5px;
    text-align: center;
}

footer {
    background-color: #343a40;
    /* Color de fondo del pie de página */
    color: white;
    text-align: center;
    padding: 10px;
    position: relative;
    /* Asegura que esté correctamente posicionado */
    bottom: 0;
    width: 100%;
    /* Asegura que el footer ocupe todo el ancho */
}
</style>