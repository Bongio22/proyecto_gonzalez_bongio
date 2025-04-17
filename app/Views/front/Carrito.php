<div class="container">
    <h3 class="text-center">PRODUCTOS EN TU CARRITO</h3>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('mensaje')) : ?>
    <div class="alert alert-info text-center">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
    <?php endif; ?>

    <div class="table-responsive">
        <?php if (!empty($productos)) : ?>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php $gran_total = 0; ?>
                <?php foreach ($productos as $producto) : ?>
                <?php $subtotal = $producto['qty'] * $producto['price']; ?>
                <tr>
                    <td><?= esc($producto['id']) ?></td>
                    <td><?= esc($producto['name']) ?></td>
                    <td>$<?= number_format($producto['price'], 2) ?></td>
                    <td><?= esc($producto['qty']) ?></td>
                    <td>$<?= number_format($subtotal, 2) ?></td>
                    <td>
                        <a href="<?= base_url('remover_producto/' . $producto['rowid']) ?>"
                            class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php $gran_total += $subtotal; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-center"><b>Total:</b></td>
                    <td><b>$<?= number_format($gran_total, 2) ?></b></td>
                    <td class="text-end">
                        <a href="<?= base_url('eliminar_carrito') ?>" class="btn btn-danger btn-sm">Vaciar carrito</a>
                        <a href="#" class="btn btn-warning btn-sm">Comprar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php else : ?>
        <p class="text-center">Tu carrito está vacío. Agrega productos para continuar.</p>
        <?php endif; ?>
    </div>
</div>