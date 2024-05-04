<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conexion = new mysqli("localhost", "root", "", "proyecto");


// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
// Recibir datos del formulario
$cantidad_recogida_extra = $_POST['cantidad_recogida_extra'];
$cantidad_recogida_primera = $_POST['cantidad_recogida_primera'];
$cantidad_recogida_segunda = $_POST['cantidad_recogida_segunda'];
$cantidad_recogida_riche = $_POST['cantidad_recogida_riche'];

// Insertar datos en la tabla "lotes"
$sql = "INSERT INTO lotes (fecha_recogida, id_producto, cantidad_recogida_extra, cantidad_recogida_primera, cantidad_recogida_segunda, cantidad_recogida_riche) VALUES (CURRENT_TIMESTAMP, 1, $cantidad_recogida_extra, 0, 0, 0),
                                                                                                                                             (CURRENT_TIMESTAMP, 2, 0, $cantidad_recogida_primera, 0, 0),
                                                                                                                                             (CURRENT_TIMESTAMP, 3, 0, 0, $cantidad_recogida_segunda, 0),
                                                                                                                                             (CURRENT_TIMESTAMP, 4, 0, 0, 0, $cantidad_recogida_riche)";

if ($conexion->multi_query($sql) === TRUE) {
    echo "Datos ingresados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
