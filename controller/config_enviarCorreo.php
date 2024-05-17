<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>ENVIO CODIGO</title>
</head>
<body>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../FRESAS_ARTURO/PhpMailer/Exception.php';
require '../../FRESAS_ARTURO/PhpMailer/PHPMailer.php';
require '../../FRESAS_ARTURO/PhpMailer/SMTP.php';

$mail = new PHPMailer(true);

include_once '../../FRESAS_ARTURO/controller/conexion.php';
$correo = $_POST['correo'];

$sql = "SELECT * FROM usuarios WHERE Correo = '$correo'";
$resultado = mysqli_query($conn, $sql);

$token = bin2hex(random_bytes(16));
$fecha_expiracion = time() + (1 * 60 * 60);

$token = $conn->real_escape_string($token);
$fecha_expiracion = $conn->real_escape_string($fecha_expiracion);

$sqlToken = "UPDATE usuarios SET token = '$token' , fecha_expiracion = '$fecha_expiracion' WHERE correo = '$correo'";
$consulta = mysqli_query($conn, $sqlToken);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'fresasarturo@gmail.com';                     //SMTP username
        $mail->Password   = 'opey nmpy clhn ugtu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('fresasarturo@gmail.com', 'Fresas Arturo');
        $mail->addAddress($row['Correo']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperacion de clave';
        $url_recuperacion = "http://localhost/FRESAS_ARTURO/model/guardarClave.php?token=" . urlencode($token); 
        $mail->Body    = 'Para recuperar tu contraseña, haz clic en el siguiente enlace: <br><br>
        <a href="' . $url_recuperacion . '">Click aqui</a> <br><br>
        Este enlace es válido por 1 hora. <br><br>
        Si no has solicitado recuperar tu contraseña, ignora este correo electrónico.
        ';

        $mail->send();

        $msj_exito = 'Código Enviado correctamente. Ingrese a su correo';
        header("Location: ../../FRESAS_ARTURO/model/login_usuarios.php?msj_exito= $msj_exito");
        
    } catch (Exception $e) {

        $msj_error = $mail->ErrorInfo;
        header("Location: ../../FRESAS_ARTURO/model/login_usuarios.php?msj_error_2= $msj_error");
        
    }
} else {

    $msj_inex = 'Correo Inválido. El correo ingresado no se encuentra registrado';
        header("Location: ../../FRESAS_ARTURO/model/enviarCorreo.php?msj_inex= $msj_inex");

}

?>
</body>
</html>
