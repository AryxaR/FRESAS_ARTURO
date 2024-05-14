<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>REGISTRO</title>
</head>
<body>

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
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Usuario Inválido',
            text: 'Esta Cédula ya se encuentra registrada'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../model/login_usuarios.php";
            }
        });
    </script>
    <?php
    exit();
}

$verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE Correo = '$Correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Usuario Inválido',
            text: 'Este correo ya se encuentra registrado con otro usuario'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../model/login_usuarios.php";
            }
        });
    </script>
    <?php
    exit();
}

$ejecutar = mysqli_query($conn, $query);

if ($ejecutar) {
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registro exitoso',
            text: 'Usuario registrado con éxito'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../model/login_usuarios.php";
            }
        });
    </script>
    <?php
}
?>
</body>
</html>
