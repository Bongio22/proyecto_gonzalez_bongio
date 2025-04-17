<h2 class="texto-Formulario">¡Bienvenido a FrikiVerse!</h2>
<?php if (isset($_SESSION['error'])): ?>
<div class="error">
    <?= $_SESSION['error']; ?>
    <?php unset($_SESSION['error']); // Limpia el mensaje después de mostrarlo 
        ?>
</div>

<?php endif;
?>

<div class="form-container">
    <h2>Iniciar Sesión</h2>
    <form action="<?= base_url('iniciarSesion') ?>" method="POST">

        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Iniciar Sesión">
        </>
        <p class="texto-Formulario">
            ¿Aun no tienes cuenta? <a href="<?= base_url('registrarse') ?>" class="no-subrayado">Registrate</a>
        </p>
        <p class="texto-Formulario">
            <a href="<?= base_url('iniciarSesion') ?>" class="no-subrayado">¿Olvidaste tu contraseña?</a>
        </p>
</div>