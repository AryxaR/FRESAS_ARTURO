<?php
// Conexión a la base de datos (modifica con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectoo";


// Verificar si se ha enviado un archivo para restaurar
if(isset($_FILES['file'])){
    $file = $_FILES['file']['tmp_name'];

    // Comando para restaurar la copia de seguridad
    $command = "mysql --user={$username} --password={$password} --host={$servername} {$database} < {$file}";

    // Ejecutar el comando
    system($command, $output);

    // Verificar si la restauración se realizó correctamente
    if ($output === 0) {
        echo "Copia de seguridad restaurada exitosamente.";
    } else {
        echo "Error al restaurar la copia de seguridad";
    }
}
?>
