<?php
$servidor = "localhost";
$usuario = "sonnak";
$password = "sonnak2024";
$base_datos = "proyecto";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar datos POST
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
        $estado = $_POST['estado'];

        // Preparar la consulta SQL
        $sqlUpdate = "UPDATE usuarios SET Estado = ? WHERE Id_cliente = ?";

        // Preparar la declaración
        $stmt = $conexion->prepare($sqlUpdate);

        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            http_response_code(500); // Internal Server Error
            echo "Error en la preparación de la consulta: " . $conexion->error;
            exit();
        }

        // Vincular parámetros
        $stmt->bind_param("si", $estado, $id);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            http_response_code(200); // OK
            exit();
        } else {
            // Error en la ejecución de la consulta SQL
            http_response_code(500); // Internal Server Error
            echo "Error en la ejecución de la consulta: " . $stmt->error;
            exit();
        }
    } else {
        // Datos POST incorrectos
        http_response_code(400); // Bad Request
        echo "Datos POST incorrectos";
        exit();
    }
} else {
    // Método de solicitud incorrecto
    http_response_code(405); // Method Not Allowed
    echo "Método de solicitud no permitido";
    exit();
}
?>
