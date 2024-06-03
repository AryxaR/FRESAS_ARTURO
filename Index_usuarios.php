<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="resource/css/styles_index.css" />
    <link rel="icon" href="../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="http://localhost/FresasRamiro/resource/css/recomendaciones.css" /> -->
    <!-- <link rel="stylesheet" href="resource/css/recomen.css" /> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="resource/css/catalogo.css">
    <!-- <script src="resource/js/Catalogo.js" async></script> -->

    <title>FRESAS DON ARTURO</title>
    <script src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>
    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top:150px !important;
        }
    </style>
</head>

<body>
    <?php include_once ('../FRESAS_ARTURO/view/layout/navs/nav-usuario.php') ?>
    <section class="section-inicio">
        <div class="contenedor-inicio">
            <h1 class='titulo-inicio'>Fresas Don Arturo</h1>
            <p class="parrafo-inicio">Explora el mundo de las fresas más frescas y deliciosas. En FresasRamiro, cada
                bocado es un festín de sabor natural cultivado con amor. Descubre la frescura en cada momento dulce.</p>
        </div>
    </section>
    <section class="section-carrito">
        <h2 class="titulo-seccion">Catalogo de productos</h2>

        <div class="contenedor-items">

            <div class="item">
                <span class="titulo-item">EXTRA</span>
                <img src="resource/img/catalogo/FRESA_EXTRA.jpeg" alt="" class="img-item">
            </div>

            <div class="item">
                <span class="titulo-item">PRIMERA</span>
                <img src="resource/img/catalogo/FRESA_PRIMERA_PORTADA.jpeg" alt="" class="img-item">
            </div>

            <div class="item">
                <span class="titulo-item">SEGUNDA</span>
                <img src="resource/img/catalogo/FRESA_SEGUNDA.jpeg" alt="" class="img-item">
            </div>

            <div class="item">
                <span class="titulo-item">RICHE</span>
                <img src="resource/img/catalogo/FRESA_RICHE_PORTADA.jpeg" alt="" class="img-item">
            </div>
        </div>
        </div>
    </section>
    <section class="section-recetas">
        <h2 class="titulo-seccion">Recetas que puedes hacer</h2>

        <div class="slick-list" id="slick-list">
            <button class="slick-arrow slick-prev" id="button-prev" data-button="button-prev"
                onclick="app.processingButton(event)">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left"
                    class="svg-inline--fa fa-chevron-left fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z">
                    </path>
                </svg>
            </button>
            <div class="slick-track" id="track">
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/3.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/4.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/5.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/6.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/1.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/8.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/9.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="slick">
                    <div>
                        <a href="#">
                            <picture>
                                <img src="resource/img/index/10.jpeg" alt="Image" />
                            </picture>
                        </a>
                    </div>
                </div>
            </div>
            <button class="slick-arrow slick-next" id="button-next" data-button="button-next"
                onclick="app.processingButton(event)">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                    class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path fill="currentColor"
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                    </path>
                </svg>
            </button>
        </div>
    </section>

    <div id="section-contacto">

        <?php include_once ('../FRESAS_ARTURO/view/layout/footers/footer-usuarios.php') ?>
    </div>


    <script defer src="resource/js/index/main.js"></script>
</body>

</html>