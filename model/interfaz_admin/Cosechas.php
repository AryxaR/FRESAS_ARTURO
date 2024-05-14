<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOTES</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/consult.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <!-- Agregar CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.min.css">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");


        body {
            /* Establecer la imagen de fondo */
            background-image: url(../FRESAS_ARTURO/resource/img/index/fondonitido.png);
            /* Centrar y estirar la imagen para cubrir toda la página */
            background-size: cover;
            /* Fijar la imagen de fondo para que no se desplace con el contenido */
            background-attachment: fixed;
            /* Centrar la imagen de fondo */
            background-position: center;
            font-family: 'Poppins', sans-serif;

        }


        .TITULO {
            margin-top: 60px;
            text-align: center;
            /* Centra el texto horizontalmente */
            font-size: 24px;
            /* Tamaño de la fuente */
            font-weight: bold;
            /* Negrita */
            text-shadow: 2px 2px 4px #888888;
            /* Aplica relieve al texto */
        }


        .dataTables_wrapper {
            margin-top: -2%;
        }

        .dataTables_length {
            margin-left: -51.5%;
        }

        .dataTables_filter {
            margin-right: 11.5%;
            margin-bottom: 1%;
        }

        .dataTables_info {
            margin-left: 1%;
        }

        .dataTables_paginate {
            margin-top: 0.8%;
            margin-right: 11%;
        }


        div.dt-buttons {
            margin-top: 3%;
            margin-left: 12%;
            border: none;
            margin-bottom: -1.5%;

        }

        #proveedores-table_wrapper .btn-pdf {
            background-color: #F44336;
            color: #ffffff;
            padding: 8px 12px;
            font-size: 18px;
            border-radius: 7%;
            border: 0.01px solid black;
        }

        #proveedores-table_wrapper .btn-print {
            background-color: #448AFF;
            color: #ffffff;
            padding: 8px 12px;
            font-size: 18px;
            border-radius: 7%;
            border: 0.01px solid black;
        }

        #proveedores-table_wrapper .btn-pdf:hover,
        #proveedores-table_wrapper .btn-print:hover {
            color: black;
            cursor: pointer;
        }

        .usuarios-table {
            width: 95%;
            max-width: 1200px;
            border-collapse: collapse;
        }

        .usuarios-table th,
        .usuarios-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #666666;
        }

        .usuarios-table th {
            background-color: #f2f2f2;
        }

        .btn-icon {
            background-color: #f8eaef;
            color: black;
            border-radius: 5%;
            border: 1px solid #d22c5d;
            padding: 2px 8px;
            /* Espaciado interno */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-icon:hover {
            background-color: #d22c5d;
            color: #f8eaef;
        }


        .acciones-container {
            display: flex;
            justify-content: space-evenly;
        }

        .btn-icon-container {
            padding: 12px;
            display: flex;
            justify-content: space-between;
            /* height: 100%; */
            font-size: 0.5em;
        }

        .contenedor-cosechas {
            border: #666666 solid 1px;
            background-color: while;
            z-index: -1000;
        }

        .btn-subtitle {
            display: none;
            margin-left: 5px;
        }

    
        .btn-icon:hover .btn-subtitle {
            display: inline-block;
        }

        td:nth-child(8){
            width: 300px;
            height: 100%;
        }

        @media screen and (max-width: 1024px) {
            .TITULO {
                font-size: 20px;
                margin-top: 50px;
            }
        }

        @media screen and (max-width: 768px) {


            .usuarios-table th,
            .usuarios-table td {
                padding: 5px;
            }
        }

        @media screen and (max-width: 768px) {
            .btn-icon {
                font-size: 12px;
                padding: 6px 10px;
                /* Reducir el relleno para dispositivos más pequeños */
                margin-bottom: 5px;
                /* Agregar un margen inferior para separar los botones */
                display: inline-block;
                /* Mostrar los botones en línea para evitar que se apilen verticalmente */
            }
        }
    </style>
</head>

<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<body>

    <?php
    require_once '../../controller/conexion.php';
    include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br>";
    ?>
<div class="contenedor-cosechas">
    <div class="TITULO">COSECHAS</div>
    <?php

    $sqselect = "SELECT id, fecha, cantidad_extra, cantidad_primera, cantidad_segunda, cantidad_riche  FROM lotes";
    $result = $conexion->query($sqselect);

    if ($result->num_rows > 0) {
        echo "<br><br>";
        echo "<table id='proveedores-table' class='usuarios-table'>";
        echo "<thead>
            <tr>
                <th><i class='bi bi-person-badge-fill'></i>Id </th>
                <th><i class='bi bi-person-check-fill'></i>Fecha recogida </th>
                <th><i class='bi bi-telephone-fill'></i>Cantidad recogida extra  </th>
                <th><i class='bi bi-telephone-fill'></i>Cantidad recogida primera </th>
                <th><i class='bi bi-telephone-fill'></i>Cantidad recogida segunda </th>
                <th><i class='bi bi-telephone-fill'></i>Cantidad recogida riche </th>
                <th style='text-align: center;'><i class='bi bi-shield-lock'></i>Acciones</th>
            </tr>
        </thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "<td>" . $row["cantidad_extra"] . "</td>";
            echo "<td>" . $row["cantidad_primera"] . "</td>";
            echo "<td>" . $row["cantidad_segunda"] . "</td>";
            echo "<td>" . $row["cantidad_riche"] . "</td>";  
         
            echo "<td class='acciones-container'>";
            echo "<div class='btn-icon-container'><a href='Editar_Cosechas.php?id=" . $row["id"] . "' class='btn-icon' title=' Editar'><i class='bi bi-pencil-square'></i><span class='btn-subtitle'>Editar</span></a></div>";
            echo "<div class='btn-icon-container'><form method='post' style='display: inline;'>
                  <input type='hidden' name='eliminar_cosecha' value='" . $row["id"] . "'>
                  <button type='submit' class='btn-icon eliminar-cosecha' title=' Eliminar'><i class='bi bi-trash3-fill'></i><span class='btn-subtitle'>Eliminar</span></button>
                  </form></div>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        echo "<div class='text-center mt-4'>
        <a href='../interfaz_admin/Lotes.php' title='Añadir'><i class='fa-solid fa-plus-minus'></i>Añadir cosecha</a>
    </div>";
    
    } else {
        echo "No se encontraron resultados";
    }

    

    $conexion->close();
    ?>
</div>
    <?php
    echo "<br><br><br><br>";
    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
    ?>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            $('#proveedores-table').DataTable({
                dom: 'Blfrtip',
                buttons: [

                    {
                        extend: 'excelHtml5', // Cambiado a 'excelHtml5' para usar la extensión de Excel
                        text: '<i class="bi bi-file-excel"></i>', // Cambiado a icono de Excel
                        titleAttr: 'Excel', // Cambiado a 'Excel' para el atributo del título
                        className: 'btn-excel', // Clase personalizada para el botón de Excel
                    },

                    {
                        extend: 'pdfHtml5',
                        text: '<i class="bi bi-file-pdf"></i>',
                        titleAttr: 'PDF',
                        className: 'btn-pdf',
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn-print',
                    }
                ],
                "language": {
                    "buttons": {
                        "excel": "Excel",
                        "pdf": "PDF",
                        "print": "Imprimir",
                    }
                },
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "pagingType": "simple",
                "lengthChange": false,
                "info": false,
                "paging": true,
                "searching": true,
                "ordering": true,
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla"
                }

            });
        });
    </script>

</body>

</html>