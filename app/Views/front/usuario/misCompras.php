<div class="product-container">
    <h1>Mis Compras</h1>

    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Fecha de Compra</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($compras)): ?>
                <?php foreach ($compras as $compra): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['fecha']); ?></td>
                    <td><?= htmlspecialchars($compra['descripcion']); ?></td>
                    <td>$<?= htmlspecialchars($compra['precioUnit']); ?></td>
                    <td><?= htmlspecialchars($compra['cantidad']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">No se encontraron compras.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>