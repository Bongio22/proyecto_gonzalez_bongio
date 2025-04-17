<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <!-- Logo o ícono que actúa como enlace -->
        <a class="navbar-brand" href="<?php echo base_url('principal'); ?>">
            <img src="<?php echo base_url("assets/img/logo/icono.png"); ?>" alt="Logo" width="50" height="50"
                class="d-inline-block align-text-top">
        </a>

        <!-- Botón desplegable para móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('principal'); ?>">Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('comercializacion'); ?>">Comercialización</a>
                </li>
                <?php if (session('idUsuario') !== null): // Verifica si hay sesión activa ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('productos'); ?>">Productos</a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('quienesSomos'); ?>">¿Quiénes Somos?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contacto'); ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('terminosyUsos'); ?>">Términos y Usos</a>
                </li>
            </ul>

            <!-- Condiciones para mostrar diferentes elementos -->
            <div class="d-flex align-items-center">
                <?php if (session('idUsuario') !== null): // Solo muestra las siguientes opciones si hay sesión activa ?>
                <?php if (session('idRol') == 2): // Asumiendo que 2 es el ID para Cliente ?>
                <!-- Opciones para Cliente -->
                <!-- Botón de carrito -->
                <a class="btn btn-light me-2" href="<?php echo base_url('carrito'); ?>">
                    <img src="<?php echo base_url('ruta_a_imagen_carrito.png'); ?>" alt="Carrito" width="30"
                        height="30">
                </a>
                <input type="search" class="form-control me-2" placeholder="Buscar..." aria-label="Buscar">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="ruta_a_imagen_perfil.jpg" alt="Foto de Perfil" width="30" height="30"
                            class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="<?php echo base_url('misDatos'); ?>">Mis datos</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('cerrarSesion'); ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php elseif (session('idRol') == 1): // Asumiendo que 1 es el ID para Administrador ?>
                <!-- Opciones para Administrador -->
                <a class="btn btn-outline-dark me-2" href="<?php echo base_url('adminPanel'); ?>">Administrar</a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="ruta_a_imagen_perfil.jpg" alt="Foto de Perfil" width="30" height="30"
                            class="rounded-circle">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="<?php echo base_url('misDatos'); ?>">Mis datos</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('cerrarSesion'); ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <!-- Botones de Inicio de Sesión y Registro -->
                <a class="btn btn-outline-dark me-2" href="<?php echo base_url('iniciarSesion'); ?>">Iniciar Sesión</a>
                <a class="btn btn-dark" href="<?php echo base_url('registrarse'); ?>">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>