<?php
// Procesar los datos del formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nuevo_precio = $_POST['nuevo_precio'];

    // Procesar la nueva imagen, si se proporcionó una
    if ($_FILES['nueva_imagen']['size'] > 0) {
        $nombre_imagen = $_FILES['nueva_imagen']['name'];
        $temporal_imagen = $_FILES['nueva_imagen']['tmp_name'];
        $ruta_guardada = '../../../FRESAS_ARTURO/model/uploads/' . $nombre_imagen;
        // Mover la imagen del directorio temporal al directorio de destino
        if (move_uploaded_file($temporal_imagen, $ruta_guardada)) {

            echo "Ruta de la imagen guardada: " . $ruta_guardada . "<br>";

            $conexion = new mysqli("localhost", "root", "", "proyecto");

            // Verifica si hay error en la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $sql = "UPDATE productos SET precio_producto = $nuevo_precio, imagen = '$ruta_guardada' WHERE id_producto = $id_producto";

            if ($conexion->query($sql) === TRUE) {
                echo "<script>alert('El producto se ha actualizado correctamente.');</script>";
                echo "<script>window.close();</script>";
                echo "<script>window.opener.location.reload();</script>";
            } else {
                echo "Error al actualizar el producto: " . $conexion->error;
            }

            $conexion->close();
        } else {
            echo "Error al mover la imagen al directorio de destino.";
        }
    } else {
        // Si no se proporciona una nueva imagen, actualizar solo el precio del producto
        $conexion = new mysqli("localhost", "root", "", "proyecto");

        // Verifica si hay error en la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        
        $sql = "UPDATE productos SET precio_producto = $nuevo_precio WHERE id_producto = $id_producto";

        if ($conexion->query($sql) === TRUE) {
            echo "<script>alert('El producto se ha actualizado correctamente.');</script>";
            echo "<script>window.close();</script>";
            echo "<script>window.opener.location.reload();</script>";
        } else {
            echo "Error al actualizar el producto: " . $conexion->error;
        }

        $conexion->close();
    }
}
