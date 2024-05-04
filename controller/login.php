<?php

session_start();

include '../../FRESAS_ARTURO/controller/conexion.php';

$Cedula = $_POST['Cedula'];
$Contrasena = $_POST['Contrasena'];

$validar = mysqli_query($conn, "SELECT * FROM usuarios WHERE Cedula='$Cedula'");


if (mysqli_num_rows($validar) > 0) {
    $fila = mysqli_fetch_assoc($validar);
    
    $_SESSION['Id_cliente'] = $fila['Id_cliente'];

    if (password_verify($Contrasena, $fila['contrasena'])) {
        $_SESSION['Id_cliente'] = $fila['Id_cliente'];

    if($fila['cargos'] == 1) {

        header("location: ../inicio_admin.php");
        exit();
    } else if ($fila['cargos'] == 2) {
        if($fila['Estado'] == 'ACTIVO'){
            header("location: ../index_usuarios.php");
         exit();
         } else {
             ?>
         <script>
 
             alert("El usuario a sido desactivado, para mas infomacion comuniquese con nosotros");
             window.location = "../../FRESAS_ARTURO/index.php";
 
         </script>
         <?php
         }
     
         ;
    } else {
        echo "Error: Base de datos.";
        exit();
    }
    }else {
        ?>
         <script>
                alert("Revise los datos ingresados. Intente nuevamente");
                window.location = "../model/login_usuarios.php";
            </script>   
        <?php
        exit();
    }

} else {
        ?> 
            <script>
                alert("Revise los datos ingresados. Intente nuevamente");
                window.location = "../model/login_usuarios.php";
            </script>    
        <?php
        exit();
}

mysqli_close ($conn);
