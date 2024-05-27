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
    <title>Registrar Perdidas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    </style>
</head>
<?php
include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
echo "<br><br><br>";
?>

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
                    <div class="form-group">
                        <label for="categoria_fresa">Categoria de Fresa:</label>
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
                        <input type="number" class="form-control" id="cantidad_perdida" name="cantidad_perdida" min="1" max="99" oninput="this.value = this.value.slice(0, 2)" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Registrar Perdida</button>
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
    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php'; ?>

    <script>
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

    </script>
</body>

</html>