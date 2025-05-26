<div id="sidebar">
    <h2>Panel de Administrador</h2>
    <ul>
        <li><a href="#" onclick="cargarVista('usuarios')">Usuarios</a></li>
        <li><a href="#" onclick="cargarVista('productos')">Productos</a></li>
        <li><a href="<?php echo base_url('cerrarSesion');?>">Cerrar Sesión</a></li>
    </ul>
</div>

<script>
function cargarVista(vista) {
    fetch(vista)
        .then(response => response.text())
        .then(html => {
            document.getElementById('contenido-admin').innerHTML = html;
        })
        .catch(error => {
            console.error('Error al cargar la vista:', error);
        });
}
</script>