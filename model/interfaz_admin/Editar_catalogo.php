<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

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
    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"] {
            width: 100px;
            margin: 0 auto;
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
    </style>
</head>
<body>
    <div class="container">
    <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4">Editar Producto</h2>
                <form action="../../controller/controlers-admin/update_catalogo.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                    <input type="hidden" name="categoria_producto" value="<?php echo $producto['categoria_producto']; ?>">
                    <div class="form-group text-center">
                        <label for="precio_producto">Precio:</label>
                        <input type="text" class="form-control d-inline-block" id="precio_producto" name="precio_producto" value="<?php echo $producto['precio_producto']; ?>" required>
                    </div>

                    <div class="form-group text-center">
                        <label for="imagen_actual">Imagen Actual:</label><br>
                        <?php
                        $ruta_imagen = "../../model/uploads/" . $producto['imagen'];
                        if (file_exists($ruta_imagen) && !empty($producto['imagen'])) {
                            echo '<img src="' . $ruta_imagen . '" alt="' . $producto['categoria_producto'] . '" class="img-thumbnail mb-3">';
                        } else {
                            echo 'No hay imagen disponible.<br>';
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Nueva Imagen:</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<br><br><br><br><br><br><br><br>
<?php include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php'; ?>
</html>
