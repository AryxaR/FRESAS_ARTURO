<?php
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['fecha_cosecha'])) {
    $id_cosecha = $_POST['fecha_cosecha'];
    $sql = "SELECT id, cantidad_extra, cantidad_primera, cantidad_segunda, cantidad_riche FROM lotes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_cosecha);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "No se encontraron datos"]);
    }
    
    $stmt->close();
}

$conexion->close();
?>
