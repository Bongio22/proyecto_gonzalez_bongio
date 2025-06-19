<div class="product-container">
    <h1>Detalle Ventas</h1>

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Fecha de Compra</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electronico</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($compras)): ?>
                <?php foreach ($compras as $compra): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['fecha']); ?></td>
                    <td><?= htmlspecialchars($compra['apellido']); ?></td>
                    <td><?= htmlspecialchars($compra['nombre']); ?></td>
                    <td><?= htmlspecialchars($compra['correoElectronico']); ?></td>
                    <td>$<?= htmlspecialchars(number_format($compra['total_venta'], 2)); ?></td>
                    <td>
                        <?= isset($compra['metodo']) 
                            ? htmlspecialchars($compra['metodo']) 
                            : 'No especificado'; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="3">No se encontraron compras.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?= base_url('panelAdmin'); ?>" class="btn-Volver">Volver al Panel de Administración</a>
    </div>
</div>