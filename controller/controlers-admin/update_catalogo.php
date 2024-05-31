<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];

    // Verificar si se proporcionó una imagen y si no hubo errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // Generar un nombre de archivo único para la imagen
        $nombre_imagen = uniqid('FRESA_' . strtoupper($categoria_producto)) . '.jpeg';
        $ruta_destino = '../../model/uploads/' . $nombre_imagen;

        // Mover la imagen cargada al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
            // Actualizar la ruta de la imagen en la base de datos
            $ruta_imagen_actualizada = '../../../FRESAS_ARTURO/model/uploads/' . $nombre_imagen;
            $sql_update_imagen = "UPDATE productos SET imagen = ? WHERE id_producto = ?";
            $stmt_update_imagen = $conexion->prepare($sql_update_imagen);
            $stmt_update_imagen->bind_param("si", $ruta_imagen_actualizada, $id_producto);
            $stmt_update_imagen->execute();
            $stmt_update_imagen->close();
        } else {
            echo "Error al mover la imagen al directorio de destino.";
        }
    }

    $sql_update_precio = "UPDATE productos SET precio_producto = ? WHERE id_producto = ?";
    $stmt_update_precio = $conexion->prepare($sql_update_precio);
    $stmt_update_precio->bind_param("di", $precio_producto, $id_producto);

    if ($stmt_update_precio->execute()) {
        $msj_exito = 'Producto actualizado exitosamente.';
        header("Location: ../../../FRESAS_ARTURO/Catalogo-admin.php?msj_exito=$msj_exito");
    } else {
        echo "Error al actualizar el producto: " . $stmt_update_precio->error;
    }

    $stmt_update_precio->close();
}

$conexion->close();
