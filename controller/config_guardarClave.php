<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>CLAVE NUEVA</title>
</head>
<body>

<?php

$confirmarToken = $_POST['token'];

include '../../FRESAS_ARTURO/controller/conexion.php';

if ($_POST['contrasena'] == $_POST['confirmar_contrasena']) {

    $nueva_contrasena = $_POST['confirmar_contrasena'];

    $nueva_pass_segura = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    $fecha_actual = time();

    $fecha = "SELECT * FROM usuarios WHERE token = '$confirmarToken' AND fecha_expiracion > $fecha_actual";
    $expiracion = mysqli_query($conn, $fecha);

    if ($expiracion->num_rows > 0) {
        $sqlClave = "UPDATE usuarios SET Contrasena = '$nueva_pass_segura' WHERE token = '$confirmarToken'";
        $respuesta = mysqli_query($conn, $sqlClave);

        if (mysqli_affected_rows($conn) > 0) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña modificada',
                    text: 'La contraseña ha sido actualizada'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "../../FRESAS_ARTURO/model/login_usuarios.php";
                    }
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo realizar el cambio',
                    text: 'Ha habido un error al intentar cambiar la contraseña'
                });
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Se agotó el tiempo de espera',
                text: 'Su cambio de contraseña ya ha expirado'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "../../FRESAS_ARTURO/model/login_usuarios.php"; 
                }
            });
        </script>
        <?php
    }

} else {
    ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Contraseña Inválida',
            text: 'Las contraseñas ingresadas no coinciden'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../../FRESAS_ARTURO/controller/config_guardarClave.php"; 
            }
        });
    </script>
    <?php
}

?>
</body>
</html>
