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
                    <td>$<?= number_format($item['precioUnit'], 2, ',', '.') ?></td>
                    <td>
                        <form action="<?= base_url('carrito/actualizarCantidad') ?>" method="post" style="display:inline-flex; flex-direction:column; align-items:center;">
                            <input type="hidden" name="idProducto" value="<?= $item['idProducto'] ?>">
                            <button type="submit" name="accion" value="sumar" class="btn-cantidad btn-up">&#9650;</button>
                            <span style="margin: 4px 0;"><?= $item['cantidad'] ?></span>
                            <button type="submit" name="accion" value="restar" class="btn-cantidad btn-down">&#9660;</button>
                        </form>
                    </td>
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
        <button type="button" id="btnFinalizarCompra" class="btn btn-primary">
            Finalizar compra
        </button>

    </div>
</div>

<!-- Modal resumen de compra -->
<div class="modal fade" id="modalResumenCompra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #461242; color: white;">
            <div class="modal-header border-0">
                <h5 class="modal-title">Detalle de compra</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="contenidoResumenCompra">
                <p class="text-center">Cargando datos...</p>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-between">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnConfirmarCompra">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnFinalizar = document.getElementById("btnFinalizarCompra");
        const btnConfirmar = document.getElementById("btnConfirmarCompra");

        btnFinalizar.addEventListener("click", function() {
            fetch("<?= base_url('carrito/comprar') ?>")
                .then(async response => {
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const data = await response.json();
                        if (data.mensaje) {
                            alert(data.mensaje);
                            return;
                        }
                    }
                    // Si no es JSON, es el HTML del resumen
                    const html = await response.text();
                    document.getElementById("contenidoResumenCompra").innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById("modalResumenCompra"));
                    modal.show();
                })
                .catch(() => {
                    document.getElementById("contenidoResumenCompra").innerHTML =
                        "<div class='text-danger'>Error al cargar los datos.</div>";
                });
        });
        btnConfirmar.addEventListener("click", function() {
            // Enviar confirmación de compra a la ruta especificada
            const formData = new FormData();
            formData.append("idMetodoPago", document.getElementById("metodoPago").value);

            fetch("<?= base_url('carrito/comprar/confirmar') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.mensaje) {
                        alert(data.mensaje);
                        location.reload(); // 🔁 Recarga la página luego de aceptar el mensaje
                    } else {
                        alert("Error al confirmar la compra.");
                    }
                })

                .catch(() => {
                    alert("Error de comunicación con el servidor.");
                });

        });
    });
</script>
</body>

</html>