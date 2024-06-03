<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRESAS DON ARTURO | GUIA</title>
    <link rel="icon" href="../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <!-- <link rel="stylesheet" href="../../FRESAS_ARTURO/resource/css/style_guia_usuario.css"> -->
    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top: 120px !important;
            right: auto;
            bottom: auto;
            left: calc(100vw - 21px);
            transform: translate(-100%);
        }

        body {
            background-image: url(../../../FRESAS_ARTURO/resource/img/index/fondonitido.png);
            background-size: cover;
            /* background-attachment: fixed; */
            font-family: 'Poppins', sans-serif;
        }

        .section {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* border: solid 1px black; */
            height: 100vh;
        }

        h1 {
            /* margin-top: 60px; */
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 50px;
        }

        .section p {
            color: black;
            font-weight: 500;
            font-size: 1.5em;
            width: 60%;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 100px;
        }

        @media (min-width: 600px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 60px;
            box-shadow: 0 4px 8px #d40748;
            text-align: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            background-color: #f3dde4;
        }

        .card h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }

        .card h4 {
            margin: 0 0 20px;
            font-size: 1em;
            color: #666;
        }

        .card .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d22c5d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .card .btn:hover {
            background-color: #e43a3a;
        }
    </style>


</head>

<body>
    <script class="access" src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>

    <?php
    include_once('../view/layout/navs/nav-usuario.php');
    ?>
    <section class="section">
        <h1>Manuales de Usuario</h1>
        <p class="texto-info">A continuación, encontrarás los manuales de usuario que te guiarán en el manejo de la página. Haz clic en la pregunta para desplegar el botón de descarga del PDF.</p>
        <br>

        <div class="card-grid">
            <div class="card">
                <h2>¿Como registrarme e iniciar sesión?</h2>
                <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor quos laborum necessitatibus rerum.</h4>
                <a href="../../FRESAS_ARTURO/resource/PDF/MANUAL REGISTRO_INICIO.pdf" class="btn" download>Descargar PDF</a>
            </div>
            <div class="card">
                <h2>¿Como modificar mis datos de perfil?</h2>
                <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor quos laborum necessitatibus rerum.</h4>
                <a href="../../FRESAS_ARTURO/resource/PDF/Modificación de datos .pdf" class="btn" download>Descargar PDF</a>
            </div>
            <div class="card">
                <h2>¿Como realizar una compra en el catalogo?</h2>
                <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor quos laborum necessitatibus rerum.</h4>
                <a href="../../FRESAS_ARTURO/resource/PDF/COMPRA Y ELIMINACIÓN .pdf" class="btn" download>Descargar PDF</a>
            </div>
            <div class="card">
                <h2>¿Como recuperar mi contraseña?</h2>
                <h4>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor quos laborum necessitatibus rerum.</h4>
                <a href="../../FRESAS_ARTURO/resource/PDF/Recuperación de contraseña .pdf" class="btn" download>Descargar PDF</a>
            </div>
        </div>
    </section>
    <div id="section-contacto">

        <?php
        include_once('../view/layout/footers/footer-usuarios.php');
        ?>
    </div>

</body>

</html>