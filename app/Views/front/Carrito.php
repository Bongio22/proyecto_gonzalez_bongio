<h1 class="titulo-carrito">Carrito de Compras</h1>

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
            <td><a href="?del=<?= $i ?>" class="btn-remove">X</a></td>
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
        <form method="post"><button type="submit" name="vaciar">Vaciar Carrito</button></form>
        <form action="productos.php"><button type="submit">Añadir Producto</button></form>
    </div>
    <div class="acciones-derecha">
        <span class="total-carrito">Total: $<?= number_format($total, 2) ?></span>
        <form method="post"><button type="submit" name="comprar">Finalizar Compra</button></form>
    </div>
</div>