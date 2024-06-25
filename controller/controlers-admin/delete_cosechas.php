<?php

$servidor = "localhost"; // Nombre del servidor de la base de datos
$usuario = "sonnak"; // Nombre de usuario de la base de datos
$password = "sonnak2024"; // Contraseña de la base de datos
$base_datos = "proyecto"; // Nombre de la base de datos

// Crear una nueva conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verifica si se ha enviado el formulario y si se ha proporcionado el parámetro eliminar_cosecha
if(isset($_POST['eliminar_cosecha'])) {
    // Incluye el archivo de conexión a la base de dato

    // Sanitiza el valor del parámetro eliminar_cosecha para evitar inyección de SQL
    $id = intval($_POST['eliminar_cosecha']);

    // Prepara la consulta SQL para eliminar el registro de la base de datos
    $sql = "DELETE FROM lotes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    // Ejecuta la consulta SQL
    if ($stmt->execute()) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }

    // Cierra la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Si no se ha enviado el formulario, redirecciona a alguna página de error o realiza alguna acción adicional.
    echo "No se ha proporcionado el parámetro eliminar_cosecha.";
}
?>
