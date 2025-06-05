<div class="main-container">
    <div class="container">
        <h1>Lista de Usuarios</h1>
        
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['idUsuario']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['correoElectronico']) ?></td>
                            <td><?= htmlspecialchars($usuario['nroTelefono']) ?></td>
                            <td><?= $usuario['idEstadoUsuario'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td>
                                <a href="<?= base_url('admin/editarUsuario/' . $usuario['idUsuario']) ?>" class="btn-editar">Editar</a>
                                <?php if ($usuario['idEstadoUsuario'] == 1): ?>
                                    <a href="<?= base_url('admin/bajaUsuario/' . $usuario['idUsuario']) ?>" class="btn-baja">Dar de Baja</a>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/altaUsuario/' . $usuario['idUsuario']) ?>" class="btn-alta">Reactivar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?= base_url('panelAdmin'); ?>" class="btn-Volver">Volver al Panel de Administración</a>
    </div>
</div>

<style>
    .btn-Volver {
        background-color: #28a745; /* Color similar a los otros botones */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
        text-decoration: none; /* Eliminar subrayado */
        display: inline-block; /* Asegura que el enlace se comporte como un botón */
        margin-bottom: 20px; /* Espacio inferior para separar del contenido */
    }

    .btn-Volver:hover {
        background-color: #218838; /* Color más oscuro al pasar el mouse */
    }
</style>
