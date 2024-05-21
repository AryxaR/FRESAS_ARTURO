<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];

    // Obtener datos actuales del producto
    $sql = "SELECT imagen FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    // Manejar la carga de la nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = 'FRESA_' . strtoupper($categoria_producto) . '.jpeg';
        $ruta_destino = '../../model/uploads/' . $nombre_imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
    } else {
        // Si no se subió una nueva imagen, mantener la imagen existente
        $nombre_imagen = $producto['imagen'];
    }

    // Actualizar los datos en la base de datos
    $sql = "UPDATE productos SET precio_producto = ?, imagen = ? WHERE id_producto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("dsi", $precio_producto, $nombre_imagen, $id_producto);

    if ($stmt->execute()) {
        $msj_exito = 'Producto actualizado exitosamente.';
        header("Location: ../../../FRESAS_ARTURO/Catalogo-admin.php?msj_exito= $msj_exito");
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
