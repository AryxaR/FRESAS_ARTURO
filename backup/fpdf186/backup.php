<?php
// Conexión a la base de datos (modifica con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto";


// Nombre del archivo de copia de seguridad
$backup_file = 'backup_' . date("Y-m-d_H-i-s") . '.sql';

// Comando para generar la copia de seguridad
$command = "mysqldump --user={$username} --password={$password} --host={$servername} {$database} > {$backup_file}";

// Ejecutar el comando
system($command, $output);

// Verificar si la copia de seguridad se generó correctamente
if ($output === 1) {
    $msj_copia = "Copia de seguridad generada exitosamente como: " . $backup_file;
    header("Location: ../../inicio_admin.php?msj_copia=  $msj_copia");
} else {
    $msj_error_copia = "Error al generar la copia de seguridad";
    header("Location: ../../inicio_admin.php?msj_copia=  $msj_error_copia");

}
?>

