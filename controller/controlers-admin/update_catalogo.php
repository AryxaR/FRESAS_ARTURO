<?php
$conexion = new mysqli("localhost", "sonnak", "sonnak2024", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $precio_producto = $_POST['precio_producto'];
    $categoria_producto = $_POST['categoria_producto'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $fileType = mime_content_type($_FILES['imagen']['tmp_name']);
        $allowedTypes = ['image/jpeg', 'image/png'];

        if (in_array($fileType, $allowedTypes)) {
            // Generar un nombre de archivo único para la imagen
            $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombre_imagen = uniqid('FRESA_' . strtoupper($categoria_producto)) . '.' . $extension;
            $ruta_destino = '../../model/uploads/' . $nombre_imagen;

            // Mover la imagen cargada al directorio de destino
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                // Guardar solo el nombre de la imagen en la base de datos
                $sql_update_imagen = "UPDATE productos SET imagen = ? WHERE id_producto = ?";
                $stmt_update_imagen = $conexion->prepare($sql_update_imagen);
                $stmt_update_imagen->bind_param("si", $nombre_imagen, $id_producto);
                $stmt_update_imagen->execute();
                $stmt_update_imagen->close();
            } else {
                echo "Error al mover la imagen al directorio de destino.";
            }
        } else {
            echo "El archivo subido no es una imagen válida.";
            exit;
        }
    }

    $sql_update_precio = "UPDATE productos SET precio_producto = ? WHERE id_producto = ?";
    $stmt_update_precio = $conexion->prepare($sql_update_precio);
    $stmt_update_precio->bind_param("di", $precio_producto, $id_producto);

    if ($stmt_update_precio->execute()) {
        $msj_exito = 'Producto actualizado exitosamente.';
        header("Location: ../../../Catalogo-admin.php?msj_exito=$msj_exito");
    } else {
        echo "Error al actualizar el producto: " . $stmt_update_precio->error;
    }

    $stmt_update_precio->close();
}

$conexion->close();
?>
