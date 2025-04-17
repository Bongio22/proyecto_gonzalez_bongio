<!-- Carrusel de imágenes -->
<div class="container-principal">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src=<?= base_url("assets/img/Presentacion/presentacion1.png") ?> class="d-block img-fluid mx-auto"
                    alt="presentacion1">
            </div>
            <div class="carousel-item">
                <img src=<?= base_url("assets/img/Presentacion/presentacion2.png") ?> class="d-block img-fluid mx-auto"
                    alt="presentacion2">
            </div>
            <div class="carousel-item">
                <img src=<?= base_url("assets/img/Presentacion/presentacion3.png") ?> class="d-block img-fluid mx-auto"
                    alt="presentacion3">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Texto de bienvenida -->
    <div class="container-texto-bienvenida">
        <h1 class="text-center mt-4">
            <strong>¡Bienvenidos a FrikiVerse!</strong>
        </h1>
        <p class="texto-bienvenida">
            <bold>Somos FrikiVerse, un espacio dedicado a todos los apasionados del mundo geek, otaku y
                coleccionista.
                Desde
                nuestros inicios hace 5 años en la provincia de Corrientes, hemos trabajado con dedicación para
                ofrecerte
                una experiencia única, donde tus hobbies y pasiones toman vida.
            </bold>
        </p>
    </div>

    <!-- Sección de Categorías de Productos -->
    <div class="product-container">
        <h1 class="text-center mt-4">Categorías de Productos</h1>
        <div class="product-row">

            <!-- Categoría: Cómics -->
            <div class="product-col">
                <div class="product-card">
                    <img src=<?= base_url("assets/img/Comics/spiderman1.jpg") ?> alt="Cómic" class="product-image">
                    <div class="product-info">
                        <h2 class="product-title">
                            <a href="comics.html">Cómics</a>
                        </h2>
                        <p class="product-description">Explora una gran variedad de cómics de tus superhéroes y villanos
                            favoritos.</p>
                    </div>
                </div>
            </div>

            <!-- Categoría: Mangas -->
            <div class="product-col">
                <div class="product-card">
                    <img src=<?= base_url("assets/img/Mangas/deathnote01.jpg") ?> alt="Manga" class="product-image">
                    <div class="product-info">
                        <h2 class="product-title">
                            <a href="mangas.html">Mangas</a>
                        </h2>
                        <p class="product-description">Descubre los mejores mangas directamente desde Japón.</p>
                    </div>
                </div>
            </div>

            <!-- Categoría: Figuras -->
            <div class="product-col">
                <div class="product-card">
                    <img src=<?= base_url("assets/img/Figuras/figuraflash.jpg") ?> alt="Figura" class="product-image">
                    <div class="product-info">
                        <h2 class="product-title">
                            <a href="figuras.html">Figuras</a>
                        </h2>
                        <p class="product-description">Figuras coleccionables de alta calidad para todos los fanáticos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Categoría: Merchandising -->
            <div class="product-col">
                <div class="product-card">
                    <img src=<?= base_url("assets/img/Merch/remerahellfireclub.jpg") ?> alt="Merchandising"
                        class="product-image">
                    <div class="product-info">
                        <h2 class="product-title">
                            <a href="ropa.html">Merchandising</a>
                        </h2>
                        <p class="product-description">Ropa temática para que muestres tu lado friki con estilo.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>