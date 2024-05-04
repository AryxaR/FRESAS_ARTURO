<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verifica si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado un ID de producto válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtener el ID del producto de la URL
    $id_producto = $_GET['id'];

    // Consultar la base de datos para obtener los detalles del producto
    // Consultar la base de datos para obtener los detalles del producto
    $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
    $result = $conexion->query($sql);


    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "No se encontró el producto.";
        exit; // Salir del script si no se encuentra el producto
    }
} else {
    echo "ID de producto inválido.";
    exit; // Salir del script si no se proporciona un ID de producto válido
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Producto</title>
</head>

<body>
    <h2>Actualizar Producto</h2>
    <form action="../../../FRESAS_ARTURO/controller/controlers-admin/update_processcata.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <label for="precio">Precio Actual: <?php echo $producto['precio_producto']; ?></label><br>
        <label for="nuevo_precio">Nuevo Precio:</label>
        <input type="text" id="nuevo_precio" name="nuevo_precio"><br><br>
        <label for="imagen">Imagen Actual:</label><br>
        <img src="<?php echo $producto['imagen']; ?>" alt="Imagen Actual"><br>
        <label for="nueva_imagen">Nueva Imagen:</label>
        <input type="file" id="nueva_imagen" name="nueva_imagen"><br><br>
        <input type="submit" value="Actualizar">
    </form>
</body>

</html>