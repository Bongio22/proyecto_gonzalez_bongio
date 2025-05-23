<?php
// ... código existente ...
?>

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

<style>
    h1 {
        text-align: center;
        color: rgb(180, 81, 191);
        margin-bottom: 20px;
    }
    .table-responsive {
        margin-top: 20px;
        overflow-x: auto;
    }
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom th, .table-custom td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    .table-custom th {
        background-color: rgb(180, 81, 191);
        color: white;
    }
    .btn {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-primary {
        background-color: rgb(0, 123, 255);
        color: white;
    }
    .btn-success {
        background-color: rgb(40, 167, 69);
        color: white;
    }
    .btn-warning {
        background-color: rgb(255, 193, 7);
        color: black;
    }
    .btn-danger {
        background-color: rgb(220, 53, 69);
        color: white;
    }
    .btn:hover {
        opacity: 0.9;
    }
</style>

<?php
// ... código existente ...
?>
