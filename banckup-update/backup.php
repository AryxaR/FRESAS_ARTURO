<?php
// Conexión a la base de datos (modifica con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectoo";


// Nombre del archivo de copia de seguridad
$backup_file = 'C:/Users/hood0/Downloads/backup_' . date("Y-m-d_H-i-s") . '.sql';

// Comando para generar la copia de seguridad
$command = "mysqldump --user={$username} --password={$password} --host={$servername} {$database} > {$backup_file}";

// Ejecutar el comando
system($command, $output);

// Verificar si la copia de seguridad se generó correctamente
if ($output === 0) {
    echo "Copia de seguridad generada exitosamente como: " . $backup_file;
} else {
    echo "Error al generar la copia de seguridad";
}
?>
