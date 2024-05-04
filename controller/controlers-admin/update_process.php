<?php 
require_once '../../../FRESAS_ARTURO/controller/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $Nombre = mysqli_real_escape_string($conn,$_POST['Nombre']);
    $Correo = mysqli_real_escape_string($conn,$_POST['Correo']);
    $Contrasena = mysqli_real_escape_string($conn,$_POST['Contrasena']);
    $Rol = mysqli_real_escape_string($conn,$_POST['Rol']);

    $sqlUpdate = "UPDATE usuarios SET  Nombre= '$Nombre', Correo= '$Correo', Contrasena= '$Contrasena', Rol= '$Rol' WHERE Id_cliente=$id";
    
    if ($conn->query($sqlUpdate) == TRUE) {
        echo '<script>alert("Registro actualizado"); window.location.href = "../../../FRESAS_ARTURO/model/interfaz_admin/consult_mysql.php";</script>';
        exit(); 
    }else{
        echo "Error al actualizar el registro: " . $conn->error;
    }
}else{
    echo "Acceso inválido. ";
}
$conn->close();
?>