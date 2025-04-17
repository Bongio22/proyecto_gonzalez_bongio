<h2 class="texto-Formulario">¡Bienvenido a FrikiVerse!</h2>
<p class="texto-Formulario">Regístrate para estar informado sobre las novedades de nuestra tienda.</p>

<div class="form-container">
    <h2>Registro</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="mensaje-exito" style="color: green;">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errores')): ?>
    <div class="alert alert-danger">
        <?php foreach (session()->getFlashdata('errores') as $error): ?>
        <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

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

        <?php if (isset($errores) && !empty($errores)): ?>
        <div class="error">
            <?php foreach ($errores as $error): ?>
            <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <input type="submit" value="Registrarse">
    </form>

    <p class="texto-Formulario">
        ¿Ya tienes cuenta? <a href="<?= base_url('iniciarSesion') ?>" class="no-subrayado">Inicia Sesión</a>
    </p>
</div>