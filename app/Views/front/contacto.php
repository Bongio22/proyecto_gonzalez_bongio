<!-- Pagina de contacto -->
<!-- presentacion -->
<h2 class="texto-Formulario">¡Estamos aquí para ayudarte!</h2>
<p class="texto-Formulario">Si tienes alguna duda, consulta o reclamo, no dudes en contactarnos.<br> Nuestro equipo de
    atención al cliente está disponible para brindarte la asistencia que necesites</p>
<p class="texto-Formulario">¡Esperamos saber de ti pronto!</p>

<!-- Columna de contacto -->

<div class="form-container">
    <h2>Contacto</h2>
    <form action="contactar.php" method="POST" id="contactForm">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" required>

        <label for="motivo">Asunto</label>
        <input type="text" id="motivo" name="motivo" required>

        <label for="consulta">Desarrolla tu consulta</label>
        <textarea id="consulta" name="consulta" rows="4" required></textarea>

        <input type="submit" value="Enviar Consulta">
    </form>
</div>

<div class="info-nosotros text-center">
    <div class="titulo">
        <h2>Información de nosotros</h2>
    </div>
    <hr style="color:aliceblue">
    <div class="titulo mt-5">
        <h4>Contáctenos</h4>
    </div>
    <div class="descripcion">
        <h5>
            <img src="<?php echo base_url('assets/img/Iconos/contacto/telefono.png') ?>" alt="Teléfono" class="icono-contacto">
            3794-955499
        </h5>
        <h5>
            <img src="<?php echo base_url('assets/img/Iconos/contacto/email.png') ?>" alt="Email" class="icono-contacto">
            equilibrioZen@gmail.com
        </h5>
    </div>
    <div class="titulo mt-5">
        <h4>Nuestra sucursal</h4>
    </div>
    <div class="ubicacion">
        <h5>Av. 3 de abril 3564</h5>
        <img src="<?php echo base_url('assets/img/Iconos/contacto/ubicacion.png') ?>" alt="Ubicación" class="icono-ubicacion mt-2">
    </div>

</div>

</div>