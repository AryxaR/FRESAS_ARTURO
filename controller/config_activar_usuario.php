<?php
include_once ('conexion.php');

if(isset($_GET['correo']) && isset($_GET['tokenActivar'])) {
    $correo = $_GET['correo'];
    $tokenActivar = $_GET['tokenActivar'];

    
    $fecha_actual = time();
    
    $fecha = "SELECT * FROM usuarios WHERE tokenActivar = '$tokenActivar' AND limiteActivar > $fecha_actual";
    $expiracion = mysqli_query($conn, $fecha);
    
    if ($expiracion->num_rows > 0) {
        $sql = "UPDATE usuarios SET Estado = 'ACTIVO' WHERE correo = '$correo' AND tokenActivar = '$tokenActivar' ";
        $respuesta = mysqli_query($conn,$sql);
       
        if ($respuesta) {
            $msj_usuario_activo = 'Su usuario esta activo. Inicie sesion';
            header("Location: ../model/login_usuarios.php?msj_usuario_activo= $msj_usuario_activo");
        } else {
            // Manejar el error en caso de fallo en la consulta
            echo "Error en la consulta: " . mysqli_error($conn);
        }
    } else {
         $dropUser = "DELETE FROM usuarios WHERE correo = '$correo' AND tokenActivar = '$tokenActivar'";
         $res = mysqli_query($conn, $dropUser);

         if ($res) {
            $msj_usuario_eliminado = 'Su usuario se elimino por exeder el limite';
            header("Location: ../model/login_usuarios.php?msj_usuario_eliminado= $msj_usuario_eliminado");
        } else {
            // Manejar el error en caso de fallo en la consulta
            echo "Error en la consulta: " . mysqli_error($conn);
        }
    }


}
?>