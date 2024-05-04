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
                alert("La contraseña ha sido actualizada");
            </script>
            <?php
        } else {
            ?>
            <script>
              $m=  alert("Ha habido un error al intentar combiar la contraseña");  
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Su cambio de contraseña ya ha expirado");  
        </script>
        <?php
    }

} else {
    ?>
    <script>
        alert("Las contraseñas ingresadas no coinciden");
    </script>
    <?php
}

?>