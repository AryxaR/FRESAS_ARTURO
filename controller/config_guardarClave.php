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

include 'conexion.php';

if ($_POST['contrasena'] == $_POST['confirmar_contrasena']) {

    $nueva_contrasena = $_POST['confirmar_contrasena'];

    // Función para validar la contraseña
    function validarContrasena($nueva_contrasena)
    {
        // Expresión regular para validar la presencia de al menos:
        // - Un carácter especial [@#$%^&*(),.?":{}|<>]
        // - Una letra mayúscula [A-Z]
        // - Un número \d
        $expresionCompleta = '/^(?=.*[@#$%^&*(),.?":{}|<>])(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$%*?&#.$($)$-$_]{8,}$/';
        if (preg_match($expresionCompleta, $nueva_contrasena)) {
            return true; // Cumple con todos los requisitos
        } else {
            return false; // No cumple con alguno de los requisitos
        }
    }

    // Validación de la contraseña
    if (!validarContrasena($nueva_contrasena)) {
        $msj_error_caracter_olvido = 'La contraseña debe contener al menos un carácter especial, una letra mayúscula y un número.';
        header("Location: ../model/login_usuarios.php?msj_error_caracter_olvido= $msj_error_caracter_olvido");
        exit();
    }

    $nueva_pass_segura = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    $fecha_actual = time();

    $fecha = "SELECT * FROM usuarios WHERE token = '$confirmarToken' AND fecha_expiracion > $fecha_actual";
    $expiracion = mysqli_query($conn, $fecha);

    if ($expiracion->num_rows > 0) {
        $sqlClave = "UPDATE usuarios SET Contrasena = '$nueva_pass_segura' WHERE token = '$confirmarToken'";
        $respuesta = mysqli_query($conn, $sqlClave);

        if (mysqli_affected_rows($conn) > 0) {

            $msj_clave = 'Contraseña modificada. La contraseña ha sido actualizada';
            header("Location: ../model/login_usuarios.php?msj_clave= $msj_clave");
        } else {
            
            $msj_error_clave = 'No se pudo realizar el cambio de contraseña';
            header("Location: ../model/login_usuarios.php?msj_error_clave= $msj_error_clave");
            
        }
    } else {
        $msj_tiempo_clave = 'Su tiempo para cambio de contraseña ya ha expirado';
        header("Location: ../model/login_usuarios.php?msj_tiempo_clave= $msj_tiempo_clave");
    }

} else {
    $msj_validar_clave = 'Las contraseñas ingresadas no coinciden';
    header("Location: ../model/login_usuarios.php?msj_validar_clave= $msj_validar_clave");
  
}

?>
</body>
</html>
