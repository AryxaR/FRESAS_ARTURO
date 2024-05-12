<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENTES</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            background-image: url(../FRESAS_ARTURO/resource/img/index/fondonitido.png);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        .TITULO {
            margin-top: 80px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }

        .dataTables_wrapper {
            margin-top: -2%;
        }

        .dataTables_length {
            margin-left: -51.5%;

        }

        .dataTables_filter {
            margin-right: 1.5%;
        }

        .dataTables_info {
            margin-left: 1%;
        }

        .dataTables_paginate {
            margin-top: 0.8%;
            margin-right: 1%;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            height: 20%;
        }

        div.dt-buttons {
            margin-left: 2%;
            margin-bottom: 1%;

        }

        #miTabla_wrapper .btn-pdf {
            background-color: #F44336;
            color: #ffffff;

        }

        #miTabla_wrapper .btn-print {
            background-color: #448AFF;
            color: #ffffff;
        }

        #miTabla_wrapper .btn-pdf:hover,
        #miTabla_wrapper .btn-print:hover {
            color: black;
        }


        .usuarios-table {
            width: 95%;
            /* Ancho de la tabla ajustado */
            max-width: 1490px;
            /* Ancho máximo de la tabla */
            margin: 20px auto;
            /* Centrar la tabla */
            border-collapse: collapse;
            /* Colapsar bordes de las celdas */
        }

        .usuarios-table th,
        .usuarios-table td {
            padding: 8px;
            /* Espaciado interno */
            text-align: left;
            /* Alineación del texto */
            border: 1px solid #666666;
            /* Borde de las celdas */
        }

        .usuarios-table th {
            background-color: #f2f2f2;
            /* Color de fondo de las celdas de encabezado */
        }

        .btn-custom {
            background-color: #f8eaef;
            color: black;
            border-radius: 5%;
            border: 1px solid #d22c5d;
            padding: 2px 6px;
            /* Espaciado interno */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #d22c5d;
            color: #f8eaef;
        }

        .btn-custom:active {
            transform: translateY(1px);
        }

        /* Estilo adicional para el subtítulo */
        .btn-subtitle {
            display: none;
            margin-left: 5px;
            /* Espaciado entre el icono y el subtítulo */
        }

        .btn-custom:hover .btn-subtitle {
            display: inline;
        }

    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var botonesToggle = document.querySelectorAll('.toggle-usuario');
            botonesToggle.forEach(function(boton) {
                boton.addEventListener('click', function() {
                    var idCliente = this.getAttribute('data-id');
                    var nuevoEstado = this.getAttribute('data-estado');
                    if (true) {
                        toggleUsuario(idCliente, nuevoEstado);
                    }
                });
            });

            function toggleUsuario(idCliente, nuevoEstado) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../../controller/controlers-admin/inactivar.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Acción Realizada',
                            text: ' Estado de usuario actualizado con éxito'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "consult_mysql.php";
                            }
                        });
                    } else {
                        alert('Error al actualizar el estado del usuario');
                    }
                };
                xhr.onerror = function() {
                    alert('Error de red, no se pudo comunicar con el servidor');
                };
                xhr.send('id=' + idCliente + '&estado=' + nuevoEstado);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var tabla = document.getElementById('miTabla');
            var filas = tabla.querySelectorAll('tr');

            filas.forEach(function(fila) {
                var estado = fila.querySelector('td:nth-child(6)').textContent.trim();
                if (estado === 'INACTIVO') {
                    fila.classList.add('fila-inactiva');
                }
            });
        });
    </script>

</head>

<body>

    <?php
    include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
    echo "<br><br>";
    ?>
    <div class="container">
        <div class="TITULO">USUARIOS REGISTRADOS</div>
        <div class="table-responsive">
            <?php
            include_once '../../../FRESAS_ARTURO/controller/conexion.php';

            $sqselect = "SELECT Id_cliente, Cedula, Nombre, Correo, Rol, Estado FROM usuarios";
            $result = $conn->query($sqselect);

            if ($result->num_rows > 0) {
                echo "<br><br><br>";
                echo "<table id='miTabla' class='usuarios-table'>";
                echo "<thead>";
                echo "<tr>
                <th><i class='bi bi-person'></i> Id</th>
                <th><i class='bi bi-card-list'></i> Cedula</th>
                <th><i class='bi bi-person-circle'></i> Nombre</th>
                <th><i class='bi bi-envelope'></i> Correo</th>
                <th><i class='bi bi-person-badge'></i> Rol</th>
                <th><i class='bi bi-shield'></i> Estado</th>
                <th style='text-align: center;'><i class='bi bi-shield-lock'>Acciones</i></th>
              </tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='" . ($row["Estado"] == 'INACTIVO' ? 'inactivo' : 'activo') . "'>";
                    echo "<td>" . $row["Id_cliente"] . "</td>";
                    echo "<td>" . $row["Cedula"] . "</td>";
                    echo "<td>" . $row["Nombre"] . "</td>";
                    echo "<td>" . $row["Correo"] . "</td>";
                    echo "<td>" . $row["Rol"] . "</td>";
                    echo "<td>" . $row["Estado"] . "</td>";
                    echo "<td style='text-align: center;'>";
                    if ($row["Estado"] == 'INACTIVO') {
                        echo "<a href='' class='btn-custom' style='margin-right: 10px;'><i class='bi bi-pencil-square'></i><span class='btn-subtitle'>Editar</span></a>";
                    } else {
                        echo "<a href='update_mysql.php?id=" . $row["Id_cliente"] . "' class='btn-custom btn-actualizar' style='margin-right: 10px;'><i class='bi bi-pencil-square'></i><span class='btn-subtitle'>Editar</span></a>";
                    }
                    if ($row["Estado"] == 'ACTIVO') {
                        echo "<a class='btn-custom toggle-usuario' data-id='" . ($row["Id_cliente"]) . "' data-estado='INACTIVO'><i class='bi bi-check-circle-fill'></i><span class='btn-subtitle'>Inactivar</span></a>";
                    } else {
                        echo "<a class='btn-custom toggle-usuario' data-id='" . ($row["Id_cliente"]) . "' data-estado='ACTIVO'><i class='bi bi-x-circle-fill'></i><span class='btn-subtitle'>Activar</span></a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No se encontraron resultados";
            }


            $conn->close();
            ?>
        </div>
    </div>
    <?php
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
    include_once('../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php');
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
            $('#miTabla').DataTable({
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

            tabla.buttons.add({
                text: '<i class="bi bi-file-excel"></i>',
                titleAttr: 'Excel',
                className: 'btn-excel',
                extend: 'excelHtml5',
            });
        });
    </script>

</body>

</html>