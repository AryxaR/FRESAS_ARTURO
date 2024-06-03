<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/lotess.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="icon" href="../../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <title>COSECHA | REGISTRO</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        .TITULO {
            margin-top: -10%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
            z-index: 1;
        }

        .btn-volver {
            
            margin-left: -480%;
            color: white;
            background-color: #d22c5d;
            border: none;
            font-size: 24px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
        }


        .btn-volver:hover {
            border: 1px solid #d22c5d;
            color: #d22c5d;
            background-color: white;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: -2%;
            margin-left: -77%;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            display: flex;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "/";
            margin: 0 10px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

    </style>


</head>

    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/Cosechas.php">Cosechas</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Nueva Cosecha</li>
            </ol>
        </nav>
    </div>
<body>
<div class="TITULO">REGISTRO DE COSECHAS</div>
    <form class="contenedor" action="../../../FRESAS_ARTURO/controller/controlers-admin/procesar_lotes.php" method="post">
    <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <label for="cantidad_extra">Fresas Extra: </label>
        <input type="number" id="cantidad_extra" name="cantidad_extra" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_primera">Fresas Primera:</label>
        <input type="number" id="cantidad_primera" name="cantidad_primera" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_segunda">Fresas Segunda:</label>
        <input type="number" id="cantidad_segunda" name="cantidad_segunda" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_riche">Fresas Riche:</label>
        <input type="number" id="cantidad_riche" name="cantidad_riche" min="0" required placeholder="Kg"><br><br>
        
        <input class="boton" type="submit" value="Enviar">
    </form>
</body>
<?php
    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
    ?>
</html>
