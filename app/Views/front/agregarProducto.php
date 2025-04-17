<h1>Agregar Producto</h1>

<form method="post" action="<?= site_url('agregarProducto'); ?>" enctype="multipart/form-data"
    class="form-agregar-producto">
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción" required>

    <label for="precioUnit">Precio Unitario:</label>
    <input type="number" id="precioUnit" name="precioUnit" placeholder="Ingrese el precio unitario" required
        step="0.01">

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" placeholder="Ingrese el stock" required>

    <label for="idCategoria">Categoría:</label>
    <select id="idCategoria" name="idCategoria" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $categoria): ?>
        <option value="<?= htmlspecialchars($categoria['idCategoria']); ?>">
            <?= htmlspecialchars($categoria['descripcion']); ?>
        </option>
        <?php endforeach; ?>
    </select>

    <label for="foto">Foto del Producto:</label>
    <input type="file" id="foto" name="foto">

    <button type="submit" class="btn-agregar-producto">Agregar Producto</button>
</form>