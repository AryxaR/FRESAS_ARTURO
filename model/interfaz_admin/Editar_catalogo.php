<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "sonnak", "sonnak2024", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si el parámetro id_producto está presente en la URL
if (!isset($_GET['id_producto']) || empty($_GET['id_producto'])) {
    die("Error: Producto no especificado.");
}

$id_producto = $_GET['id_producto'];

// Obtener datos del producto a editar
$sql = "SELECT * FROM productos WHERE id_producto = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if (!$producto) {
    die("Error: Producto no encontrado.");
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="../../resource/img/icons/strawberry.png" type="image/png">
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

        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"] {
            width: 100px;
            margin: 0 auto;
            font-family: 'Poppins', sans-serif;
        }

        .form-group img {
            display: block;
            margin: 0 auto;
            max-width: 200px;
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

            margin-left: -7%;
            margin-top: 4%;
            color: white;
            background-color: #d22c5d;
            border: none;
            font-size: 20px;
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
            margin-top: -1%;
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
            margin: 0 3px;
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

<body>

    <?php
    include_once '../../view/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br><br>";
    ?>

    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../Catalogo-admin.php">Catálogo</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Actualización</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4">Editar Producto</h2>
                <form action="../../controller/controlers-admin/update_catalogo.php" method="post" enctype="multipart/form-data" onsubmit="return validarImagen()">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                    <input type="hidden" name="categoria_producto" value="<?php echo $producto['categoria_producto']; ?>">
                    <div class="form-group text-center">
                        <label for="precio_producto">Precio:</label>
                        <input type="text" class="form-control d-inline-block" id="precio_producto" name="precio_producto" value="<?php echo $producto['precio_producto']; ?>" required>
                    </div>

                    <div class="form-group text-center">
                        <label for="imagen_actual">Imagen Actual:</label><br>
                        <?php

                        $ruta_imagen = "../../uploads" . $producto['imagen'];
                        if (file_exists($ruta_imagen) && !empty($producto['imagen'])) {
                            echo '<img src="' . $ruta_imagen . '" alt="' . $producto['categoria_producto'] . '" class="img-thumbnail mb-3">';
                        } else {
                            echo 'No hay imagen disponible.<br>';
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Nueva Imagen:</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen" onchange="validarImagen()">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function validarImagen() {
        var fileInput = document.getElementById('imagen');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(filePath)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, sube solo archivos de imagen (JPEG o PNG).',
            });
            fileInput.value = ''; // Limpiar el campo de archivo
            return false; // Impedir el envío del formulario
        }
        return true; // Permitir el envío del formulario
    }
</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<br><br><br><br><br><br><br><br>
<?php include_once '../../view/layout/footers/footer-admin.php'; ?>

</html>