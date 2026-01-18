<?php
$usuarioLogueado = isset($_SESSION['idRol']) && $_SESSION['idRol'] == 2;
?>
<!-- Carrusel de imágenes -->
<div class="container-principal">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="<?= base_url('assets/img/Presentacion/presentacion1.png') ?>" class="d-block w-100"
                    alt="presentacion1">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="<?= base_url('assets/img/Presentacion/presentacion2.png') ?>" class="d-block w-100"
                    alt="presentacion2">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="<?= base_url('assets/img/Presentacion/presentacion3.png') ?>" class="d-block w-100"
                    alt="presentacion3">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Texto de bienvenida -->
<div class="container-texto-bienvenida">
    <h2 class="text-center mt-4">
        <strong>¡Bienvenidos a FrikiVerse!</strong>
    </h2>
    <p class="texto-bienvenida">
        Somos FrikiVerse, un espacio dedicado a todos los apasionados del mundo geek, otaku y
        coleccionista.
        Desde nuestros inicios hace 5 años en la provincia de Corrientes, hemos trabajado con dedicación para
        ofrecerte una experiencia única, donde tus hobbies y pasiones toman vida.
    </p>
</div>


<!-- Sección de Categorías de Productos -->
<div class="product-container">
    <h1 class="text-center mt-4">Categorías de Productos</h1>
    <div class="product-row">

        <!-- Categoría: Cómics -->
        <div class="product-col">
            <div class="product-card">
                <a href="<?= base_url('front/productos/categoria/2') ?>" class="category-link">
                    <img src="<?= base_url("assets/img/Comics/spiderman1.jpg") ?>" alt="Cómic" class="product-image">
                </a>
                <div class="product-info">
                    <h2 class="product-title">
                        <a href="<?= base_url('front/productos/categoria/2') ?>" class="category-link">Cómics</a>
                    </h2>
                    <p class="product-description">Explora una gran variedad de cómics de tus superhéroes y villanos
                        favoritos.</p>
                </div>
            </div>
        </div>

        <!-- Categoría: Mangas -->
        <div class="product-col">
            <div class="product-card">
                <a href="<?= base_url('front/productos/categoria/1') ?>" class="category-link">
                    <img src="<?= base_url("assets/img/Mangas/deathnote01.jpg") ?>" alt="Manga" class="product-image">
                </a>
                <div class="product-info">
                    <h2 class="product-title">
                        <a href="<?= base_url('front/productos/categoria/1') ?>" class="category-link">Mangas</a>
                    </h2>
                    <p class="product-description">Descubre los mejores mangas directamente desde Japón.</p>
                </div>
            </div>
        </div>

        <!-- Categoría: Figuras -->
        <div class="product-col">
            <div class="product-card">
                <a href="<?= base_url('front/productos/categoria/3') ?>" class="category-link">
                    <img src="<?= base_url("assets/img/Figuras/figuraflash.jpg") ?>" alt="Figura" class="product-image">
                </a>
                <div class="product-info">
                    <h2 class="product-title">
                        <a href="<?= base_url('front/productos/categoria/3') ?>" class="category-link">Figuras</a>
                    </h2>
                    <p class="product-description">Figuras coleccionables de alta calidad para todos los fanáticos.</p>
                </div>
            </div>
        </div>

        <!-- Categoría: Merchandising -->
        <div class="product-col">
            <div class="product-card">
                <a href="<?= base_url('front/productos/categoria/4') ?>" class="category-link">
                    <img src="<?= base_url("assets/img/Merch/remerahellfireclub.jpg") ?>" alt="Merchandising"
                        class="product-image">
                </a>
                <div class="product-info">
                    <h2 class="product-title">
                        <a href="<?= base_url('front/productos/categoria/4') ?>" class="category-link">Merchandising</a>
                    </h2>
                    <p class="product-description">Ropa temática para que muestres tu lado friki con estilo.</p>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal de advertencia -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="background-color: #461242; color: white;">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Icono en la parte superior -->
                <img src="<?= base_url('assets/img/logo/icono.png') ?>" alt="Icono"
                    style="width: 120px; margin-top: -30px; margin-bottom: 15px;">

                <p>Para tener una mejor experiencia te recomendamos iniciar sesión.<br>¿Ya tienes cuenta?</p>
                <div class="d-grid gap-2 mt-3">
                    <a href="<?= base_url('iniciarSesion') ?>" class="btn btn-light text-black border">Iniciar
                        sesión</a>
                    <span class="fw-bold">O</span>
                    <a href="<?= base_url('registrarse') ?>" class="btn btn-light text-black border">Registrarse</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (!session()->has('idUsuario')): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryLinks = document.querySelectorAll(".category-link");
    const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));

    categoryLinks.forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault(); // Evita navegación
            loginModal.show(); // Muestra el modal
        });
    });
});
</script>
<?php endif; ?>