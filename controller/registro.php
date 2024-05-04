<?php
include '../../FRESAS_ARTURO/controller/conexion.php';

$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Cedula = $_POST['Cedula'];
$Contrasena = $_POST['Contrasena'];
$Rol = $_POST['Rol'];

$pass_segura = password_hash($Contrasena, PASSWORD_DEFAULT);

$query = "INSERT INTO usuarios (Cedula, Nombre, Correo, Contrasena, Rol) 
    VALUES('$Cedula', '$Nombre', '$Correo', '$pass_segura', '$Rol')";

$verificar_cedula = mysqli_query($conn, "SELECT * FROM usuarios WHERE Cedula = '$Cedula'");

if (mysqli_num_rows($verificar_cedula) > 0) {
    echo '<script>alert("Esta Cédula ya se encuentra registrada");window.location="../model/login_usuarios.php";</script>';
    exit();
}

$verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE Correo = '$Correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '<script>alert("Este correo ya se encuentra registrado con otro usuario");window.location="../model/login_usuarios.php";</script>';
    exit();
}

$ejecutar = mysqli_query($conn, $query);

if ($ejecutar) {
    echo '<script>alert("Usuario registrado con éxito");window.location="../model/login_usuarios.php";</script>';
}
?>
