<?php 
require_once '../../controller/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $cantidad_recogida_extra = mysqli_real_escape_string($conn,$_POST['cantidad_recogida_extra']);
    $cantidad_recogida_primera = mysqli_real_escape_string($conn,$_POST['cantidad_recogida_primera']);
    $cantidad_recogida_segunda = mysqli_real_escape_string($conn,$_POST['cantidad_recogida_segunda']);
    $cantidad_recogida_riche = mysqli_real_escape_string($conn,$_POST['cantidad_recogida_riche']);

    $sqlUpdate = "UPDATE lotes SET cantidad_recogida_extra = '$cantidad_recogida_extra', cantidad_recogida_primera = '$cantidad_recogida_primera', cantidad_recogida_segunda = '$cantidad_recogida_segunda', cantidad_recogida_riche = '$cantidad_recogida_riche' WHERE id_lote = $id";
    
    if ($conn->query($sqlUpdate) == TRUE) {
        echo '<script>alert("Registro actualizado"); window.location.href = "../../../FRESAS_ARTURO/model/interfaz_admin/Editar_Cosechas.php";</script>';
        exit(); 
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
} else {
    echo "Acceso inválido. ";
}
$conn->close();
?>
