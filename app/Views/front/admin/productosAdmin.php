<?= $this->include('plantillas/header'); ?>

<div class="main-container">
    <aside id="sidebar-left">
        <h2>Categorías</h2>
        <ul>
            <li><a href="<?= base_url('principal'); ?>">Inicio</a></li>
            <li><a href="#" onclick="cargarVista('usuarios')">Mangas</a></li>
            <li><a href="#" onclick="cargarVista('productos')">Comics</a></li>
            <li><a href="#" onclick="cargarVista('usuarios')">Figuras</a></li>
            <li><a href="<?= base_url('carrito'); ?>">Mi Carrito</a></li>
            <li><a href="<?= base_url('cerrarSesion');?>">Cerrar Sesión</a></li>
        </ul>
    </aside>
    <main class="content">
        <h1>Listado de Productos - Administrador</h1>
        <form method="get" action="<?= site_url('productosAdmin'); ?>" style="display: flex; align-items: center; gap: 10px;">
            <select name="categoria" onchange="this.form.submit();" style="max-width: 200px;">
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
                value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="<?= site_url('agregarProducto'); ?>" class="btn btn-success">Agregar Producto</a>
        </form>

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
                    <tr>
                        <td>
                            <?php if (!empty($producto['fotoProducto'])): ?>
                            <img src="<?= base_url('uploads/productos/' . htmlspecialchars($producto['fotoProducto'])); ?>"
                                alt="Foto del Producto" style="width: 100px; height: auto;">
                            <?php else: ?>
                            Sin Imagen
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']); ?><br>
                            <strong>Precio Unitario:</strong> $<?= htmlspecialchars($producto['precioUnit']); ?><br>
                            <strong>Stock:</strong> <?= htmlspecialchars($producto['stock']); ?><br>
                        </td>
                        <td>
                            <a href="<?= site_url('modificarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                                class="btn btn-warning">Modificar</a>
                            <a href="<?= site_url('productosController/eliminarProducto/' . htmlspecialchars($producto['idProducto'])); ?>"
                                class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
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
    </main>
    <aside id="sidebar-right">
        <section class="sidebar-section">
            <h3>Filtros</h3>
            <!-- Aquí puedes poner filtros adicionales, por ejemplo por precio, stock, etc. -->
        </section>
    </aside>
</div>
