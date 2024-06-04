<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT id, fecha FROM lotes ORDER BY fecha DESC";
$result = $conexion->query($sql);

if (!$result) {
    die("Error al obtener datos de cosechas: " . $conexion->error);
}

$cosechas = [];
while ($row = $result->fetch_assoc()) {
    $cosechas[] = $row;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERDIDAS | FRESAS DON ARTURO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="../../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">


    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            background-image: url(../../resource/img/index/fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        body .uwy.userway_p1 .userway_buttons_wrapper {
            top: 120px !important;
            right: auto;
            bottom: auto;
            left: calc(100vw - 21px);
            transform: translate(-100%);
        }

        .TITULO {
            margin-top: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            text-transform: uppercase;
            font-family: 'Poppins', sans-serif;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .btn-volver {
            margin-left: 5%;
            margin-top: 5%;
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

        .access {
            margin-top: 10%;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: -2.5%;
            margin-left: 7%;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            background-color: white;
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
    </style>
</head>
<?php
include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
echo "<br><br><br><br><br>";
?>

<div class="breadcrumbs-container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pérdidas</li>
        </ol>
    </nav>
</div>

<body>
    <div class="container">
        <div class="TITULO">REGISTRO DE PÉRDIDAS</div>
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <form action="../../../FRESAS_ARTURO/controller/controlers-admin/procesar_perdidas.php" method="post">
                    <div class="form-group">
                        <label for="fecha_cosecha">Fecha de la Cosecha:</label>
                        <select class="form-control" id="fecha_cosecha" name="fecha_cosecha" required>
                            <option value="">Seleccione una fecha</option>
                            <?php foreach ($cosechas as $cosecha) : ?>
                                <option value="<?php echo $cosecha['id']; ?>">
                                    <?php echo $cosecha['fecha']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Información relacionada con la fecha seleccionada -->
                    <div class="form-group" id="info_cosecha" style="display:none;">
                        <label>Información del Lote:</label>
                        <div class="row">
                            <div class="col">
                                <p>Cosecha N° : <span id="id_lote" class="d-inline-block text-center"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Cantidad_Extra: <span id="cantidad_extra"></span></p>
                            </div>
                            <div class="col">
                                <p>Cantidad_Primera: <span id="cantidad_primera"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Cantidad_Segunda: <span id="cantidad_segunda"></span></p>
                            </div>
                            <div class="col">
                                <p>Cantidad_Riche: <span id="cantidad_riche"></span></p>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la información relacionada -->

                    <div class="form-group">
                        <label for="categoria_fresa">Categoría de Fresa:</label>
                        <select class="form-control" id="categoria_fresa" name="categoria_fresa" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="extra">Extra</option>
                            <option value="primera">Primera</option>
                            <option value="segunda">Segunda</option>
                            <option value="riche">Riche</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_perdida">Cantidad (Kg):</label>
                        <input type="number" class="form-control" id="cantidad_perdida" name="cantidad_perdida" min="1" max="999" oninput="this.value = this.value.slice(0, 3)" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Registrar Pérdida</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.9/dist/sweetalert2.all.min.js"></script>
    <br><br><br><br><br><br><br><br>
    <script class="access" src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>
    <br><br><br><br><br><br><br><br>

    <?php
    if (isset($_GET['msj_exito'])) {
        $msj_exito = $_GET['msj_exito'];
    }
    if (isset($_GET['msj_error_registrar'])) {
        $msj_error_registrar = $_GET['msj_error_registrar'];
    }
    if (isset($_GET['msj_error_categoria'])) {
        $msj_error_categoria = $_GET['msj_error_categoria'];
    }
    if (isset($_GET['msj_error_lotes'])) {
        $msj_error_lotes = $_GET['msj_error_lotes'];
    }
    if (isset($_GET['msj_stock_sup'])) {
        $msj_stock_sup = $_GET['msj_stock_sup'];
    }
    if (isset($_GET['msj_stock'])) {
        $msj_stock = $_GET['msj_stock'];
    }

    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php'; ?>

    <script>
        document.getElementById('fecha_cosecha').addEventListener('change', function() {
            var idCosecha = this.value;
            if (idCosecha) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../../../FRESAS_ARTURO/controller/controlers-admin/obtener_cosecha.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (!response.error) {
                            document.getElementById('id_lote').innerText = response.id;
                            document.getElementById('cantidad_extra').innerText = response.cantidad_extra + " kg";
                            document.getElementById('cantidad_primera').innerText = response.cantidad_primera + " kg";
                            document.getElementById('cantidad_segunda').innerText = response.cantidad_segunda + " kg";
                            document.getElementById('cantidad_riche').innerText = response.cantidad_riche + " kg";
                            document.getElementById('info_cosecha').style.display = 'block';
                        } else {
                            alert(response.error);
                        }
                    }
                };
                xhr.send('fecha_cosecha=' + idCosecha);
            } else {
                document.getElementById('info_cosecha').style.display = 'none';
            }
        });

        if (window.location.search.includes('msj_exito')) {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Pérdida registrada, cantidad actualizada en lotes y stock actualizado en productos exitosamente.",
                showConfirmButton: false,
                timer: 1500
            });
        }

        if (window.location.search.includes('msj_error_registrar')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error al registrar la pérdida",
            });
        }
        if (window.location.search.includes('msj_error_categoria')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Categoría de fresa no válida.",
            });
        }
        if (window.location.search.includes('msj_error_lotes')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error al actualizar la cantidad en lotes",
            });
        }
        if (window.location.search.includes('msj_stock')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El stock del producto ya está en cero. No se puede registrar más pérdidas.s",
            });
        }
        if (window.location.search.includes('msj_stock_sup')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "La cantidad de pérdida supera el stock actual del producto.",
            });
        }
    </script>
</body>

</html>