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
        <form id="comprarForm" action="<?php echo base_url('carrito/comprar'); ?>">
            <button type="submit">Finalizar</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div id="modalResumen" style="display:none;">
    <h2>Resumen de Compra</h2>
    <div id="detallesCompra"></div>
    <button id="cerrarModal">Cerrar</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#comprarForm').on('submit', function(e) {
        e.preventDefault(); // Evitar el envío normal del formulario

        $.ajax({
            url: '<?= base_url('carrito/comprar') ?>',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                // Mostrar el modal con los detalles de la compra
                let detallesHtml = '<table><tr><th>Descripción</th><th>Precio Unitario</th><th>Cantidad</th><th>Total</th></tr>';
                response.detalles.forEach(function(detalle) {
                    detallesHtml += `<tr>
                        <td>${detalle.descripcion}</td>
                        <td>$${detalle.precioUnit.toFixed(2)}</td>
                        <td>${detalle.cantidad}</td>
                        <td>$${(detalle.precioUnit * detalle.cantidad).toFixed(2)}</td>
                    </tr>`;
                });
                detallesHtml += '</table>';
                detallesHtml += `<h3>Total: $${response.total.toFixed(2)}</h3>`;
                detallesHtml += `<p>Tu localizador de reserva es el <strong>${response.localizador}</strong></p>`;

                $('#detallesCompra').html(detallesHtml);
                $('#modalResumen').show(); // Mostrar el modal
            },
            error: function() {
                alert('Error al procesar la compra.');
            }
        });
    });

    $('#cerrarModal').on('click', function() {
        $('#modalResumen').hide(); // Cerrar el modal
    });
});
</script>