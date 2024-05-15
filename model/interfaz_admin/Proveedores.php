<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROVEEDORES</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/consult.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <!-- Agregar CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.min.css">

    <!-- Link de sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");


        body {
            /* Establecer la imagen de fondo */
            background-image: url(../../../FRESAS_ARTURO/resource/img/index/fondonitido.png);
            /* Centrar y estirar la imagen para cubrir toda la página */
            background-size: cover;
            /* Fijar la imagen de fondo para que no se desplace con el contenido */
            background-attachment: fixed;
            /* Centrar la imagen de fondo */
            /* background-position: center; */
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
            justify-content: center;
        }

        .btn-icon-container {
            padding: 5px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btn-subtitle {
            display: none;
            margin-left: 5px;
        }

        .btn-icon:hover .btn-subtitle {
            display: inline-block;
        }

        .btn-custom {
            margin-top: -20%;
            margin-left: calc(50% - 600px);
        }

        .btn-custom {
            background-color: #f8eaef;
            color: black;
            border-radius: 10px;
            border: 1px solid #d22c5d;
            padding: 10px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-custom:hover {
            background-color: #d22c5d;
            color: #f8eaef;
        }

        .btn-custom:hover .btn-subtitle {
            display: inline-block;
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

        @media screen and (min-width: 440px)and (max-width: 768px) {
            .btn-custom {
                width: 10%;
                padding: 8px 8px;
                /* Reducir el relleno para dispositivos más pequeños */
                margin-left: 30%;
                margin-top: 10px;
                /* Agregar un margen superior para separar los botones */
                display: block;
                /* Mostrar los botones como bloques para que se apilen verticalmente */
            }
        }

        /* Media query para ajustar el botón "Crear Proveedor" en tamaños de pantalla intermedios */
        @media screen and (min-width: 776px) and (max-width: 1198px) {
            .btn-custom {
                margin-top: 20px;
                /* Aumentar el margen superior para separar el botón de la tabla */
                margin-left: calc(50% - 100px);
                /* Centrar el botón en la pantalla */
                max-width: 100px;
                /* Establecer un ancho máximo para el botón */
            }
        }

        @media screen and (min-width: 1200px) {
            .btn-custom {
                margin-top: 20px;
                /* Aumentar el margen superior para separar el botón de la tabla */
                margin-left: calc(50% - 100px);
                /* Centrar el botón en la pantalla */
                max-width: 200px;
                /* Establecer un ancho máximo para el botón */
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

if (isset($_GET['msj_exito'])) {
    $mensaje_exito = $_GET['msj_exito'];
}
?>

<body>

    <?php
    require_once '../../controller/conexion.php';
    include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br>";
    ?>

    <DIV class="TITULO">PROVEEDORES REGISTRADOS</DIV>
    <?php

    $sqselect = "SELECT Id_proveedor, Nombre_proveedor, Telefono_proveedor FROM proveedores";
    $result = $conexion->query($sqselect);

    if ($result->num_rows > 0) {
        echo "<br><br>";
        echo "<table id='proveedores-table' class='usuarios-table'>";
        echo "<thead>
            <tr>
                <th><i class='bi bi-person-badge-fill'></i>Id </th>
                <th><i class='bi bi-person-check-fill'></i>Nombre </th>
                <th><i class='bi bi-telephone-fill'></i>Telefono </th>
                <th style='text-align: center;'><i class='bi bi-shield-lock'></i>Acciones</th>
            </tr>
        </thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Id_proveedor"] . "</td>";
            echo "<td>" . $row["Nombre_proveedor"] . "</td>";
            echo "<td>" . $row["Telefono_proveedor"] . "</td>";
            echo "<td class='acciones-container'>";
            echo "<div class='btn-icon-container'><a href='Datos.php?id=" . $row["Id_proveedor"] . "' class='btn-icon' title=' Ver detalles'><i class='bi bi-eye-fill'></i><span class='btn-subtitle'>Ver detalles</span></a></div>";
            echo "<div class='btn-icon-container'><a href='update_proveedor.php?id=" . $row["Id_proveedor"] . "' class='btn-icon' title=' Editar'><i class='bi bi-pencil-square'></i><span class='btn-subtitle'>Editar</span></a></div>";
            echo "<div class='btn-icon-container'><form method='post' style='display: inline;'>
                  <input type='hidden' name='eliminar_proveedor' value='" . $row["Id_proveedor"] . "'>
                  <button type='submit' class='btn-icon eliminar-proveedor' title=' Eliminar'><i class='bi bi-trash3-fill'></i><span class='btn-subtitle'>Eliminar</span></button>
                  </form></div>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        echo "<div class='text-center mt-4'>
            <a href='insert_proveedor.php' class='btn btn-success' title='Crear Proveedor'><i class='bi bi-person-plus-fill'></i> Crear Proveedor</a>
        </div>";
    } else {
        echo "No se encontraron resultados";
    }

    $conexion->close();
    ?>

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

        if (window.location.search.includes('msj_exito')) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Registro actualizado",
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

</body>

</html>