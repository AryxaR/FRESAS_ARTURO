<?php
// Verificar si se reciben datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar si se recibió el ID del producto y el nuevo precio
    if (isset($_POST["id_producto"]) && isset($_POST["precio"])) {

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "proyecto");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Obtener el ID del producto y el nuevo precio del formulario
        $id_producto = $_POST["id_producto"];
        $nuevo_precio = $_POST["precio"];

        // Actualizar el precio en la base de datos
        $sql = "UPDATE productos SET precio_producto='$nuevo_precio' WHERE id_producto='$id_producto'";
        if ($conexion->query($sql) === TRUE) {
            echo "Precio actualizado correctamente.";
        } else {
            echo "Error al actualizar el precio: " . $conexion->error;
        }

        // Verificar si se recibió una nueva imagen
        if ($_FILES["imagen"]["name"]) {

            // Ruta donde se guardarán las imágenes
            $ruta_imagen = 'model/uploads/' . $_FILES["imagen"]["name"];

            // Mover la imagen subida al directorio de imágenes
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen)) {

                // Actualizar la ruta de la imagen en la base de datos
                $sql = "UPDATE productos SET imagen='$ruta_imagen' WHERE id_producto='$id_producto'";
                if ($conexion->query($sql) === TRUE) {
                    echo "Imagen actualizada correctamente.";
                } else {
                    echo "Error al actualizar la imagen: " . $conexion->error;
                }
            } else {
                echo "Error al subir la imagen.";
            }
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "ID del producto o precio no especificado.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
