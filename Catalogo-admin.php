<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Id_cliente'])) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../FRESAS_ARTURO/model/login_usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="icon" href="../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">


    <!-- sweetAlert2 -->
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
            margin-top: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .tabla-container {
            width: 90%;
            margin: 0 auto;
            font-family: 'Poppins', sans-serif;
        }

        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-productos th,
        .tabla-productos td {
            padding: 8px;
            text-align: left;
            border: 1px solid #666666;
            font-family: 'Poppins', sans-serif;
        }

        .tabla-productos th {

            color: black;
        }

        .tabla-productos img {
            max-width: 100px;
            display: block;
            margin: auto;
        }

        .btn-custom {
            background-color: #f8eaef;
            color: black;
            border-radius: 5%;
            border: 1px solid #d22c5d;
            padding: 2px 2px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .btn-custom a {
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: black;
        }

        .btn-custom:hover {
            color: white;
            background-color: #d22c5d;
            cursor: pointer;
        }

        .btn-custom a:hover {
            color: white;
            background-color: #d22c5d;
            cursor: pointer;
        }

        .btn-custom:active {
            transform: translateY(1px);
        }

        input[type="text"] {
            width: 65px;
        }

        .dataTables_wrapper .dataTables_info {
            display: none;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-bottom: 5%;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: -1%;
            margin-left: 7%;
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
            margin: 0 7px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        #tabla-productos th:nth-child(1),
        #tabla-productos td:nth-child(1),
        #tabla-productos th:nth-child(3),
        #tabla-productos td:nth-child(3),
        #tabla-productos th:nth-child(4),
        #tabla-productos td:nth-child(4) {
            text-align: center;
            font-size: 18px;
            vertical-align: middle;
        }

        #tabla-productos th:nth-child(2) {
            text-align: center;
            font-size: 20px;
            vertical-align: middle;
        }
    </style>
    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top: 150px !important;
        }
    </style>
    <script src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>
    <title>CATALOGO | FRESAS DON ARTURO</title>
</head>

<script class="access" src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>

<body>

    <?php
    require_once '../FRESAS_ARTURO/controller/conexion.php';
    include_once '../FRESAS_ARTURO/View/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br>";

    if (isset($_GET['msj_exito'])) {
        $msj_exito = $_GET['msj_exito'];
    }
    ?>
    <br>

    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
            </ol>
        </nav>
    </div>

    <div class="TITULO">CATÁLOGO</div>
    <br><br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="table-responsive">
                    <div class="tabla-container">

                        <table id="tabla-productos" class="table table-striped tabla-productos">

                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Foto</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexion = new mysqli("localhost", "root", "", "proyecto");

                                if ($conexion->connect_error) {
                                    die("Error de conexión: " . $conexion->connect_error);
                                }

                                $sql = "SELECT id_producto, nombre_producto, categoria_producto, precio_producto, imagen FROM productos";
                                $result = $conn->query($sql);
                                

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row["categoria_producto"] . '</td>';
                                        echo '<td><img src="' . $row["imagen"] . '" alt="' . $row['categoria_producto'] . '" class="img-item"></td>';
                                        echo '<td>$' . $row["precio_producto"] . '</td>';
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-custom"><a href="../../../FRESAS_ARTURO/model/interfaz_admin/Editar_catalogo.php?id_producto=' . $row['id_producto'] . '">Actualizar</a></button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
                                }

                                $conexion->close();
                                ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-productos').DataTable({
                "paging": false,
                "ordering": false,
                "language": {
                    "search": "Buscar:"
                },
                "columnDefs": [{
                        "width": "20%",
                        "targets": 0
                    }, // Ancho de la primera columna (Categoria)
                    {
                        "width": "35%",
                        "targets": 1
                    }, // Ancho de la segunda columna (Foto)
                    {
                        "width": "25%",
                        "targets": 2
                    }, // Ancho de la tercera columna (Precio)
                    {
                        "width": "25%",
                        "targets": 3
                    } // Ancho de la cuarta columna (Acciones)
                ]
            });
        });

        if (window.location.search.includes('msj_exito')) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Producto actualizado exitosamente",
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

    <?php include_once '../FRESAS_ARTURO/view/layout/footers/footer-admin.php'; ?>
</body>

</html>