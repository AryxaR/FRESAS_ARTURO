<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- sweetalert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title>INICIO | FRESAS DON ARTURO</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
        }

        section.container-cards {
            width: 100%;
            margin: 10px auto;
            display: flex;
            max-width: 1100px;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-around;
            padding-top: 200px;
        }

        .card {
            padding: 40px;
            width: 400px;
            min-width: 300px;
            display: flex;
            align-items: center;
            height: 210px;
            border-radius: 8px;
            justify-content: space-around;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.3s ease;
            z-index: -1;
        }

        .card:hover::after {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .card-text h3 {
            color: rgba(67, 59, 59, 0.868);
            font-size: 1.6rem;
            margin: 0;
            padding: 0;
            font-weight: 400;
        }

        .card-text p {
            font-size: 1.4rem;
            margin: 0;
            margin-top: 5px;
            color: rgba(67, 59, 59, 0.768);
        }

        .card .card-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
        }

        .card-img svg {
            width: 100%;
            height: 60%;
            border-radius: 60%;
        }

        section.container-cards a {
            text-decoration: none;
        }

        /* Paleta de colores para la primera tarjeta */
        .card:nth-child(1) {
            background-color: rgba(212, 76, 160, 0.25);
            border-bottom: 6px solid rgb(235, 46, 118);
        }

        .card:nth-child(1) .card-img {
            background-color: rgba(206, 86, 112, 0.4);
        }

        /* Paleta de colores para la segunda tarjeta */
        .card:nth-child(2) {
            background-color: rgba(76, 160, 212, 0.25);
            border-bottom: 6px solid rgb(46, 118, 235);
        }

        .card:nth-child(2) .card-img {
            background-color: rgba(86, 112, 206, 0.4);
        }

        /* Paleta de colores para la tercera tarjeta */
        .card:nth-child(3) {
            background-color: rgba(160, 212, 76, 0.25);
            border-bottom: 6px solid rgb(118, 235, 46);
        }

        .card:nth-child(3) .card-img {
            background-color: rgba(112, 206, 86, 0.4);
        }

        /* Paleta de colores para la cuarta tarjeta */
        .card:nth-child(4) {
            background-color: rgba(212, 160, 76, 0.25);
            border-bottom: 6px solid rgb(235, 118, 46);
        }

        .card:nth-child(4) .card-img {
            background-color: rgba(206, 112, 86, 0.4);
        }
    </style>
    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top: 150px !important;
        }
    </style>
    <script src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>
</head>

<body>
    <div id="myModal" class="contenedor-copia">
        <div class="contenedor-contenido">
            <span class="close">&times;</span>
            <h2>Generar Copia de seguridad</h2>
            <form action="../FRESAS_ARTURO/backup/fpdf186/backup.php" method="post">
                <button class="button" type="submit" name="backup">Generar</button>
            </form>

            <h2>Restaurar Copia de seguridad</h2>
            <form class="form-restaurar" action="../FRESAS_ARTURO/backup/fpdf186/restore.php" method="post" enctype="multipart/form-data">
                <input class="archivo" type="file" name="file" />
                <button class="button" type="submit" name="restore">Restaurar</button>
            </form>

            <h2>Eliminar Copia de seguridad</h2>
            <form class="form-restaurar" action="" method="post" enctype="multipart/form-data">
                <input class="archivo" type="file" id="myFile">
                <button class="button" onclick="eliminarArchivo()">Eliminar archivo</button>
            </form>

        </div>
    </div>
    <?php

    use PhpParser\Node\Expr\Include_;

    if (isset($_GET['msj_copia'])) {
        $msj_copia = $_GET['msj_copia'];
    }
    if (isset($_GET['msj_error_copia'])) {
        $msj_error_copia = $_GET['msj_error_copia'];
    }
    if (isset($_GET['msj_restaurar'])) {
        $msj_restaurar = $_GET['msj_restaurar'];
    }
    if (isset($_GET['msj_error_restaurar'])) {
        $msj_error_restaurar = $_GET['msj_error_restaurar'];
    }



    include_once('../FRESAS_ARTURO/view/layout/navs/nav-admin.php');
    require_once('./controller/conexion.php');
    ?>

    <section class="container-cards">
        <a class="card" href="../FRESAS_ARTURO/model/interfaz_admin/consult_mysql.php">
            <div class="card-text">
                <h3> USUARIOS </h3>
                <p>Clientes registrados</p>
            </div>
            <div class="card-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                </svg>
            </div>
        </a>

        <a class="card" href="../FRESAS_ARTURO/model/interfaz_admin/Cosechas.php">
            <div class="card-text">
                <h3> COSECHAS </h3>
                <p>Registro de recolección por lote</p>
            </div>
            <div class="card-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z" />
                </svg>
            </div>
        </a>

        <a class="card" href="./Catalogo-admin.php">
            <div class="card-text">
                <h3> CATALOGO</h3>
                <p>Tipos de fresas, precios</p>
            </div>
            <div class="card-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-hdd-rack-fill" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1v2H2a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1a2 2 0 0 0-2-2h-1V7h1a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm.5 3a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m-2 7a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m2 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1M12 7v2H4V7z" />
                </svg>
            </div>
        </a>

        <a class="card" href="./model/interfaz_admin/Proveedores.php">
            <div class="card-text">
                <h3> PROVEEDORES</h3>
                <p>Lista de proveedores</p>
            </div>
            <div class="card-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-clipboard-data-fill" viewBox="0 0 16 16">
                    <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1" />
                </svg>
            </div>
        </a>

    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("openModalBtn");
            var span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "flex";
            };

            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });

        function eliminarArchivo() {
            document.getElementById('myFile').value = '';
        }
    </script>
    <script src="../FRESAS_ARTURO/resource/js/adminAlerts.js"></script>
    <?php
    $conn->close();
    echo "<br><br><br><br>";
    include_once '../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
    ?>
</body>

</html>