<div class="main-container">
    <?php include 'sidebarAdmin.php'; ?>

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
</div>
