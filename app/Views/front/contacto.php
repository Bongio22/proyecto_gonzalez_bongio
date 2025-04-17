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




<div class="store-container">
    <p class="store-text">
        Para una mejor atención podés acercarte a nuestra tienda, ubicada en La Rioja 850
    </p>
    <img src=<?php echo base_url("assets/img/Tienda/frikiverseTienda.jpg"); ?> alt="Imagen de la tienda FrikiVerse"
        class="store-image">
</div>