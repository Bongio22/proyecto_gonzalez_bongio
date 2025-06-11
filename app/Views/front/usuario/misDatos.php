<div class="form-wrapper">
    <div class="form-container-usuario">
        <!-- Sección del Formulario -->
        <div class="form-content">
            <h2>Modificar Datos</h2>
            <form action="<?php echo base_url('usuario/misDatos'); ?>" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>

                <label for="nroTelefono">Número de Teléfono</label>
                <input type="text" id="nroTelefono" name="nroTelefono" placeholder="Ingresa tu número de teléfono"
                    required>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">

                <div class="buttons">
                    <button type="submit" class="save-btn">Guardar</button>
                    <input type="reset" value="Limpiar" class="btn-reset">
                    <button type="button" class="cancel-btn"
                        onclick="window.location.href='<?php echo base_url('inicio'); ?>';">Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>