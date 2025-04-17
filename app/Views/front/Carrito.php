<div class="container mt-5">
    <h2><?= esc($titulo) ?></h2>

    <?php if (!empty($mensaje)): ?>
    <div class="alert alert-warning">
        <?= esc($mensaje) ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($productos)): ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= esc($producto['id']) ?></td>
                    <td><?= esc($producto['name']) ?></td>
                    <td>$<?= number_format($producto['price'], 2) ?></td>
                    <td><?= esc($producto['qty']) ?></td>
                    <td>$<?= number_format($producto['subtotal'], 2) ?></td>
                    <td>
                        <a href="<?= site_url('eliminarDelCarrito/' . $producto['rowid']) ?>"
                            class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php $total += $producto['subtotal']; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="text-end">
        <a href="<?= site_url('vaciarCarrito') ?>" class="btn btn-warning">Vaciar carrito</a>
    </div>
    <?php endif; ?>
</div>