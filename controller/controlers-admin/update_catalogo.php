<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];

    
    $sql = "SELECT precio_producto, imagen FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $precio_anterior = $producto['precio_producto'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = 'FRESA_' . strtoupper($categoria_producto) . '.jpeg';
        $ruta_destino = '../../model/uploads/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
    } else {
       
        $nombre_imagen = $producto['imagen'];
    }

    $sql = "UPDATE productos SET precio_producto = ?, imagen = ? WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("dsi", $precio_producto, $nombre_imagen, $id_producto);

    if ($stmt->execute()) {
        // Insertar en historial_precios
        $sql_historial = "INSERT INTO historial_precios (id_producto, precio_anterior, precio_nuevo) VALUES (?, ?, ?)";
        $stmt_historial = $conexion->prepare($sql_historial);
        $stmt_historial->bind_param("idd", $id_producto, $precio_anterior, $precio_producto);
        $stmt_historial->execute();

        echo "Producto actualizado exitosamente.";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
