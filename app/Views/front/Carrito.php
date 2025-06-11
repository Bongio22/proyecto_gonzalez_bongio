<?= $this->include('plantillas/header'); ?>

<h1 class="titulo-carrito">Carrito de Compras</h1>

<?php
$total = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['precioUnit'] * $item['cantidad'];
    }
}
?>
<table class="tabla-carrito">
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($_SESSION['carrito'])): ?>
        <?php foreach ($_SESSION['carrito'] as $i => $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['descripcion']) ?></td>
            <td>$<?= number_format($item['precioUnit'], 2) ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>
                <form action="<?= base_url('carrito/eliminarProducto') ?>" method="post" style="display:inline;">
                    <input type="hidden" name="idProducto" value="<?= $item['idProducto'] ?>">
                    <button type="submit" class="btn-remove">X</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="4">El carrito está vacío.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="acciones-carrito">
    <div class="acciones-izquierda">
        <form action="<?= base_url('carrito/vaciar') ?>" method="post">
            <button type="submit">Vaciar Carrito</button>
        </form>

        <form action="<?php echo base_url('productos'); ?>"><button type="submit">Añadir Producto</button></form>
    </div>
    <div class="acciones-derecha">
        <span class="total-carrito">
            Total: $<?= number_format($total, 2) ?>
        </span>
        <form action="<?= base_url('/carrito/comprar') ?>" method="post">
            <button type="submit">Finalizar Compra</button>
        </form>

    </div>
</div>