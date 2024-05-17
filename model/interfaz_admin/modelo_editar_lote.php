<?php 
include_once("../../../FRESAS_ARTURO/controller/conexion.php");
// Verifica si se han enviado los datos del formulario
if (isset($_POST['id'])){
    // Recupera los datos del formulario
    $id = $_POST['id'];
    $cantidad_extra = $_POST['cantidad_extra'];
    $cantidad_primera = $_POST['cantidad_primera'];
    $cantidad_segunda = $_POST['cantidad_segunda'];
    $cantidad_riche = $_POST['cantidad_riche'];

    // Prepara la consulta SQL para actualizar los datos en la base de datos
    $sql = "UPDATE lotes SET cantidad_extra = ?, cantidad_primera = ?, cantidad_segunda = ?, cantidad_riche = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // Vincula los parámetros
    $stmt->bind_param("iiiii", $cantidad_extra, $cantidad_primera, $cantidad_segunda, $cantidad_riche, $id);
    // Ejecuta la consulta
    $stmt->execute();
    
    // Cierra la sentencia
    $stmt->close();

    // Redirecciona a la página de la tabla inicial
    header("Location: Cosechas.php");
    exit();
}
?>

