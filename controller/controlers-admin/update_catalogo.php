<?php 
require_once '../../../FRESAS_ARTURO/controller/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_producto'];
    $nuevo_precio = $_POST['precio_producto'];

    // Consulta para obtener el precio actual del producto
    $sqlPrecioActual = "SELECT precio_producto FROM productos WHERE id_producto = ?";
    $stmtPrecioActual = $conn->prepare($sqlPrecioActual);
    $stmtPrecioActual->bind_param("i", $id);
    $stmtPrecioActual->execute();
    $stmtPrecioActual->bind_result($precio_actual);
    $stmtPrecioActual->fetch();
    $stmtPrecioActual->close();

    // Verificar si el precio ha cambiado antes de actualizar
    if ($precio_actual != $nuevo_precio) {
        // Preparar una sentencia SQL para insertar el historial de precios
        $sqlInsertHistorial = "INSERT INTO Historial_precios (id_producto, precio_anterior, precio_nuevo) VALUES (?, ?, ?)";
        $stmtInsertHistorial = $conn->prepare($sqlInsertHistorial);
        $stmtInsertHistorial->bind_param("idd", $id, $precio_actual, $nuevo_precio);
        $stmtInsertHistorial->execute();
        $stmtInsertHistorial->close();
    }

    // Preparar una sentencia SQL preparada para actualizar el precio del producto
    $sqlUpdate = "UPDATE productos SET precio_producto = ? WHERE id_producto = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    
    if ($stmtUpdate) {
        // Vincular los parámetros y ejecutar la consulta preparada
        $stmtUpdate->bind_param("di", $nuevo_precio, $id);
        $stmtUpdate->execute();

        // Verificar si la actualización fue exitosa
        if ($stmtUpdate->affected_rows > 0) {
            echo '<script>alert("Precio actualizado"); window.location.href = "../../../FRESAS_ARTURO/Catalogo-admin.php";</script>';
            exit(); 
        } else {
            echo "No se realizó ninguna actualización. El registro no existe o el precio no ha cambiado.";
        }

        // Cerrar la sentencia preparada
        $stmtUpdate->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "Acceso inválido.";
}

// Cerrar la conexión
$conn->close();
?>

