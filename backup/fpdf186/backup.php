<?php
// Conexión a la base de datos (modifica con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto";

// Nombre del archivo de copia de seguridad
$backup_file = 'C:/Users/USUARIO/Downloads/backup_' . date("Y-m-d_H-i-s") . '.sql';

// Ruta completa a mysqldump (modifica según tu instalación)
$mysqldump = 'C:/Program Files/MySQL/MySQL Server 8.0/bin/mysqldump';

// Comando para generar la copia de seguridad
$command = "{$mysqldump} --user={$username} --password={$password} --host={$servername} {$database} > {$backup_file}";

// Ejecutar el comando y capturar el resultado
exec($command, $output, $return_var);

// Verificar si la copia de seguridad se generó correctamente
if ($return_var === 0) {
    echo "Copia de seguridad generada exitosamente como: " . $backup_file;
} else {
    echo "Error al generar la copia de seguridad. Código de error: " . $return_var;
}
?>
