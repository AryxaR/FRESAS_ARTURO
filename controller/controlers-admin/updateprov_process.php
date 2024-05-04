<?php 
require_once '../../controller/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nombre_proveedor = mysqli_real_escape_string($conn,$_POST['Nombre_proveedor']);
    $telefono_proveedor = mysqli_real_escape_string($conn,$_POST['Telefono_proveedor']);

    $sqlUpdate = "UPDATE proveedores SET Nombre_proveedor= '$nombre_proveedor', Telefono_proveedor= '$telefono_proveedor' WHERE Id_proveedor=$id";
    
    if ($conn->query($sqlUpdate) == TRUE) {
        echo '<script>alert("Registro actualizado"); window.location.href = "../../../FRESAS_ARTURO/model/interfaz_admin/Proveedores.php";</script>';
        exit(); 
    }else{
        echo "Error al actualizar el registro: " . $conn->error;
    }
}else{
    echo "Acceso inválido. ";
}
$conn->close();
?>