<form class="form-modificar-producto" method="post" action="<?= site_url('modificarProducto'); ?>"
    enctype="multipart/form-data">
    <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['idProducto']); ?>">

    <label for="productoDescripcion">Descripción:</label>
    <input type="text" id="productoDescripcion" name="descripcion"
        value="<?= htmlspecialchars($producto['descripcion']); ?>" required>

    <label for="productoPrecioUnitario">Precio Unitario:</label>
    <input type="number" id="productoPrecioUnitario" name="precioUnit"
        value="<?= htmlspecialchars($producto['precioUnit']); ?>" required step="0.01">

    <label for="productoStock">Stock:</label>
    <input type="number" id="productoStock" name="stock" value="<?= htmlspecialchars($producto['stock']); ?>" required>

    <label for="productoCategoria">Categoría:</label>
    <select id="productoCategoria" name="idCategoria" required>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>"
            <?= $producto['idCategoria'] == $categoria['idCategoria'] ? 'selected' : ''; ?>>
            <?= htmlspecialchars($categoria['descripcion']); ?>
        </option>
        <?php endforeach; ?>
    </select>

    <label for="productoFoto">Foto del Producto:</label>
    <input type="file" id="productoFoto" name="foto">

    <button class="btn-guardar-cambios" type="submit">Guardar Cambios</button>
</form>