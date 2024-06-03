<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUIA | FRESAS DON ARTURO</title>
    <!-- <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/styles_guia_admin.css"> -->
    <style>
        /* styles.css */

        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,200;1,300;1,500&display=swap");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

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
            /* margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh; */
        }

        h1 {
            margin-top: 90px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .section {
            margin-top: 60px;
            text-align: center;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* border: solid 1px black; */
            /* height: 100vh; */
        }

        .section p {
            margin-top: 50px;
            color: black;
            font-weight: 500;
            font-size: 1.3em;
            width: 60%;
        }

        .pdf-viewer {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .pdf-viewer:hover {
            transform: scale(1.02);
            background-color: #f0f0f0;
        }

        .pdf-viewer embed {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
        }

        .btn-descargar {
            margin: 30px 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .btn {
            /* display: inline-block; */
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .contenedor-manual {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
            flex-direction: column;
            padding: 20px 0;
            margin: 50px 0 50px 0;
        }

        @media screen and (max-width: 890px) {
            
            .pdf-viewer embed {
                width: 600px;
            }
        }
        @media screen and (max-width: 670px) {
            .pdf-viewer embed {
                width: 400px;
            }

            .contenedor-manual {
            margin: 100px 0 150px 0;
        }


        }
        @media screen and (max-width: 550px) {
            
            .pdf-viewer embed {
                width: 300px;
            }
        }
    </style>
</head>

<body>
<script class="access" src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>

    <br>
    <?php
    include_once('../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php');
    ?>
    <div class="contenedor-manual">

        <section class="section">
            <h1> Manual de Administrador</h1>
            <p>A continuación, podrá visualizar el manual de usuario que lo guiará en la administración de la página. Haga clic en el enlace para descargar el manual completo.</p>
        </section>
        <br>

        <div class="pdf-viewer">
            <embed src="../../resource/PDF/MANUAL ADMINISTRADOR.pdf" type="application/pdf" width="800" height="600">
        </div>

        <section class="btn-descargar">
            <a href="../../resource/PDF/MANUAL ADMINISTRADOR.pdf" class="btn" download>Descargar PDF</a>
        </section>

    </div>
    <br>
    <br>
    <br>
    <br>
    <?php
    include_once('../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php');
    ?>
</body>

</html>