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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h2>Editar Producto</h2>
    <form action="../../controller/controlers-admin/update_catalogo.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <input type="hidden" name="categoria_producto" value="<?php echo $producto['categoria_producto']; ?>">

        <label for="precio_producto">Precio:</label>
        <input type="text" name="precio_producto" value="<?php echo $producto['precio_producto']; ?>"><br><br>

        <label for="imagen_actual">Imagen Actual:</label><br>
        <?php
        $ruta_imagen = "../../model/uploads/" . $producto['imagen'];
        if (file_exists($ruta_imagen) && !empty($producto['imagen'])) {
            echo '<img src="' . $ruta_imagen . '" alt="' . $producto['categoria_producto'] . '" style="max-width: 200px;"><br><br>';
        } else {
            echo 'No hay imagen disponible.<br><br>';
        }
        ?>

        <label for="imagen">Nueva Imagen:</label>
        <input type="file" name="imagen"><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
