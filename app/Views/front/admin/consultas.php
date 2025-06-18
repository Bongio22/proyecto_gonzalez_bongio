<div class="main-container">
    <div class="container">
        <h1>Lista de Consultas</h1>

        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Asunto</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($consultas)): ?>
                <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?= esc($consulta['idConsulta']) ?></td>
                    <td><?= esc($consulta['nombre']) ?></td>
                    <td><?= esc($consulta['apellido']) ?></td>
                    <td><?= esc($consulta['correoElectronico']) ?></td>
                    <td><?= esc($consulta['asunto']) ?></td>
                    <td><?= esc($consulta['descripcion']) ?></td>
                    <td><?= $consulta['idEstado'] == 1 ? 'Pendiente' : 'Respondida' ?></td>
                    <td>
                        <a href="<?= base_url('atenderConsulta' . $consulta['idConsulta']) ?>" class="btn-editar">Atender Consulta</a>
                        <a href="<?= base_url('eliminarConsulta' . $consulta['idConsulta']) ?>" class="btn-baja" onclick="return confirm('¿Seguro que deseas eliminar esta consulta?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8">No hay consultas registradas.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="<?= base_url('panelAdmin'); ?>" class="btn-Volver">Volver al Panel de Administración</a>
    </div>
</div>

<style>
.btn-Volver {
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
}

.btn-Volver:hover {
    background-color: #218838;
}

.btn-editar, .btn-baja {
    padding: 4px 10px !important;
    font-size: 14px !important;
    border-radius: 4px !important;
    min-width: 0 !important;
    min-height: 0 !important;
    line-height: 1.2 !important;
}
</style>