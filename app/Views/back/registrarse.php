<h2 class="texto-Formulario">¡Bienvenido a FrikiVerse!</h2>
<p class="texto-Formulario">Regístrate para estar informado sobre las novedades de nuestra tienda.</p>

<div class="message-container text-center ">
    <!-- Mensaje de éxito -->
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success p-3 rounded shadow" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <strong class="h5"><?= session()->getFlashdata('mensaje'); ?></strong>
            <br>
            <a href="<?= base_url('iniciarSesion'); ?>" class="alert-link">Iniciar sesión</a>
        </div>
    <?php endif; ?>
    
    <!-- Mensaje de errores -->
    <?php if (session()->getFlashdata('errores')): ?>
        <div class="alert alert-danger p-3 rounded shadow" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <strong class="h5">
                <?php foreach (session()->getFlashdata('errores') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </strong>
        </div>
    <?php endif; ?>
</div>

<div class="form-container">
    <h2>Registro</h2>
    <!-- se crea el formulario de registro -->
    <form action="<?= base_url('registrarse') ?>" method="POST" id="registerForm">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="telefono">Número de Teléfono</label>
        <input type="tel" id="telefono" name="telefono" required pattern="[0-9]+">

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <div class="button-container">
            <input type="submit" value="Registrarse">
            <input type="reset" value="Limpiar" class="btn-reset"> <!-- Botón de limpieza -->
        </div>

        <?php if (isset($errores) && !empty($errores)): ?>
        <div class="error">
            <?php foreach ($errores as $error): ?>
            <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </form>

    <div class="texto-Formulario text-center mt-4">
        <p>¿Ya tienes cuenta?</p>
        <button onclick="window.location.href='<?= base_url('iniciarSesion') ?>'" class="btn-iniciar-sesion">Iniciar Sesión</button>
    </div>
</div>