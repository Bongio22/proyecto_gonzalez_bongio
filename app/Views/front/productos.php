<?= $this->include('plantillas/header'); ?>

<div class="main-container">
    <main class="content">
        <form method="get" action="<?= site_url('productos'); ?>" class="search-form">
            <select name="categoria" onchange="this.form.submit();" class="form-select">
                <option value="">Categorías</option>
                <?php if (!empty($categorias)): ?>
                <?php foreach ($categorias as $categoria): ?>
                <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>"
                    <?= (isset($_GET['categoria']) && $_GET['categoria'] == $categoria['idCategoria']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($categoria['descripcion']); ?>
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="">No hay categorías disponibles</option>
                <?php endif; ?>
            </select>

            <input type="text" name="busqueda" placeholder="Buscar producto..."
                value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>" class="form-input">
            <button type="submit" class="btn btn-outline-dark me-2">Buscar</button>

            <?php if (session()->get('idRol') == 1): ?>
            <div class="admin-buttons">
                <a href="<?= site_url('agregarProducto'); ?>" class="btn btn-primary">Agregar Producto</a>
                <a href="<?= site_url('panelAdmin'); ?>" class="btn btn-primary">Volver</a>
            </div>
            <?php endif; ?>
        </form>

        <form method="post" action="<?= site_url('agregarAlCarrito'); ?>" id="carritoForm">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Detalles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                        <?php if (session()->get('idRol') == 2 && $producto['stock'] == 0): ?>
                        <!-- No mostrar el producto si idRol = 2 y stock = 0 -->
                        <?php continue; ?>
                        <?php endif; ?>
                        <tr>
                            <td>
                                <?php if (!empty($producto['fotoProducto'])): ?>
                                <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['fotoProducto'])); ?>"
                                    alt="Foto del Producto" class="product-image">
                                <?php else: ?>
                                Sin Imagen
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']); ?><br>
                                <strong>Precio Unitario:</strong>
                                $<?= htmlspecialchars(number_format($producto['precioUnit'], 2, ',', '.')); ?><br>

                                <strong>Stock:</strong> <?= htmlspecialchars($producto['stock']); ?><br>
                            </td>
                            <td>
                                <?php if (session()->get('idRol') == 2): ?>
                                <?php if ($producto['stock'] == 0): ?>
                                <span class="text-danger">No hay stock disponible</span>
                                <?php else: ?>
                                <a href="<?= site_url('agregar/' . urlencode($producto['idProducto'])); ?>"
                                    class="btn btn-success">
                                    Agregar al carrito
                                </a>
                                <?php endif; ?>
                                <?php elseif (session()->get('idRol') == 1): ?>
                                <a href="<?= site_url('modificarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                                    class="btn btn-warning">
                                    Modificar
                                </a>
                                <a href="<?= site_url('productosController/eliminarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                    Eliminar
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3">No hay productos disponibles</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>

        <script>
        document.getElementById('agregarCarritoBtn').addEventListener('click', function() {
            document.getElementById('carritoForm').submit();
        });
        </script>
    </main>
</div>