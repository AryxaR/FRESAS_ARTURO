<?php
// Conexión a la base de datos
require_once('../../FRESAS_ARTURO/controller/conexion.php');

// Verifica si se recibió el ID del producto
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Consulta el stock del producto en la base de datos
    $sql = "SELECT stock FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock_disponible = $row['stock'];
        echo $stock_disponible; // Devuelve el stock disponible como respuesta
    } else {
        echo "0"; // Si no se encuentra el producto, devuelve 0
    }
} else {
    echo "0"; // Si no se recibió el ID del producto, devuelve 0
}

$conn->close();
?>
