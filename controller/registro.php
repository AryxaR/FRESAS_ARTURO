<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" href="../../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <title>REGISTRO</title>
</head>

<body>

    <?php
    include '../../FRESAS_ARTURO/controller/conexion.php';

    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Cedula = $_POST['Cedula'];
    $Contrasena = $_POST['Contrasena'];
    $contraseña_confirmada = $_POST['confirmar_contrasena'];
    $Rol = $_POST['Rol'];

    // Verificación de la longitud de la cédula
    if (strlen($Cedula) < 8 || strlen($Cedula) > 10) {
        $msj_error_cedula = 'La cédula debe tener entre 8 y 10 dígitos.';
        header("Location:../model/login_usuarios.php?msj_error_cedula=$msj_error_cedula");
        exit();
    }

    // Función para validar la contraseña
    function validarContrasena($contrasena)
    {
        // Expresión regular para validar la presencia de al menos:
        // - Un carácter especial [@#$%^&*(),.?":{}|<>]
        // - Una letra mayúscula [A-Z]
        // - Un número \d
        $expresionCompleta = '/^(?=.*[@#$%^&*(),.?":{}|<>])(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$%*?&#.$($)$-$_]{8,}$/';
        if (preg_match($expresionCompleta, $contrasena)) {
            return true; // Cumple con todos los requisitos
        } else {
            return false; // No cumple con alguno de los requisitos
        }
    }

    // Validación de la contraseña
    if (!validarContrasena($Contrasena)) {
        $mensaje_error_caracter = 'La contraseña debe contener al menos un carácter especial, una letra mayúscula y un número.';
        header("Location:../model/login_usuarios.php?msj_error_caracter= $mensaje_error_caracter");
        exit();
    }
    ?>
    <script>
        document.getElementById('emailForm').addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email');
            const emailValue = emailInput.value;
            const allowedDomains = ['gmail.com', 'hotmail.com'];

            // Extraer el dominio del correo
            const emailDomain = emailValue.substring(emailValue.lastIndexOf('@') + 1);

            // Verificar si el dominio está permitido
            if (!allowedDomains.includes(emailDomain)) {
                event.preventDefault(); // Prevenir el envío del formulario

                <?php
                $msj_error_mail = 'Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com';
                header("Location:../model/login_usuarios.php?msj_error_mail= $msj_error_mail");
                ?>
            }
        });
    </script>
    <?php
    if ($_POST['Contrasena'] == $_POST['confirmar_contrasena']) {

        $contraseña_confirmada = $_POST['confirmar_contrasena'];
        $pass_segura = password_hash($Contrasena, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (Cedula, Nombre, Correo, Contrasena, Rol) 
        VALUES('$Cedula', '$Nombre', '$Correo', '$pass_segura', '$Rol')";

        $verificar_cedula = mysqli_query($conn, "SELECT * FROM usuarios WHERE Cedula = '$Cedula'");



        if (mysqli_num_rows($verificar_cedula) > 0) {

            $mensaje_error_2 = 'Usuario Inválido. Esta Cédula ya se encuentra registrada';
            header("Location: ../model/login_usuarios.php?msj_error_2= $mensaje_error_2");
            exit();
        }

        $verificar_correo = mysqli_query($conn, "SELECT * FROM usuarios WHERE Correo = '$Correo' ");

        if (mysqli_num_rows($verificar_correo) > 0) {

            $mensaje_error_2 = 'Usuario Inválido. Este correo ya se encuentra registrado con otro usuario';
            header("Location: ../model/login_usuarios.php?msj_error_2= $mensaje_error_2");
            exit();
        }

        $ejecutar = mysqli_query($conn, $query);

        if ($ejecutar) {

            $msj_registro = 'Usuario registrado con éxito';
            header("Location: ../model/login_usuarios.php?msj_registro= $msj_registro");
        }
    } else {
        $msj_confirm_clave = 'Las contraseñas ingresadas no coinciden';
        header("Location: ../model/login_usuarios.php?msj_confirm_clave= $msj_confirm_clave");
    }


    ?>

</body>

</html>