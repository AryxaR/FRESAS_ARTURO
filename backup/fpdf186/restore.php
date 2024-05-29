<?php
// Conexión a la base de datos (modifica con tus datos)
$servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
$username = "root";
$password = "";
$dbname = "proyecto";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar si se ha enviado un archivo para restaurar
if (isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    // Comando para restaurar la copia de seguridad
    $command = "mysql --user={$username} --password={$password} --host={$servername} {$database} < {$file}";

    // Ejecutar el comando
    system($command, $output);

    // Verificar si la restauración se realizó correctamente
    if ($output === 1) {
        $msj_restaurar = "Copia de seguridad restaurada exitosamente.";
        header("Location: ../../inicio_admin.php?msj_restaurar=  $msj_restaurar");
    } else {
        $msj_error_restaurar = "Error al restaurar la copia de seguridad";
        header("Location: ../../inicio_admin.php?msj_error_restaurar=  $msj_error_restaurar");
    }
}
