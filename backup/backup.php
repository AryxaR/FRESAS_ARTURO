<?php
$host = "localhost";
$root = "root";
$pass = "";
$db_name = "proyecto";
$mysqli = new mysqli($host, $root, $pass, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mysqli->select_db($db_name);
$mysqli->query("SET NAMES 'utf8'");

// Array con las tablas en el orden correcto
$correct_order_tables = ['usuarios', 'cargos', 'proveedores', 'productos', 'recursos', 'ventas', 'insumos', 'lotes', 'perdidas', 'detalle_venta', 'historial_precios'];

// Para depuración
$error_log = "";

$content = ""; // Inicializamos la variable $content
foreach ($correct_order_tables as $table) {
    // Verificar si la tabla existe
    $check_table = $mysqli->query("SHOW TABLES LIKE '$table'");
    if ($check_table->num_rows == 0) {
        $error_log .= "Tabla no encontrada: $table\n";
        continue;
    }

    $result = $mysqli->query('SELECT * FROM '. $table);
    if (!$result) {
        $error_log .= "Error al seleccionar datos de la tabla $table: " . $mysqli->error . "\n";
        continue;
    }

    $fields_amount = $result->field_count;
    $rows_num = $mysqli->affected_rows;
    $res = $mysqli->query('SHOW CREATE TABLE '. $table);
    if (!$res) {
        $error_log .= "Error al obtener la estructura de la tabla $table: " . $mysqli->error . "\n";
        continue;
    }

    $TableMLine = $res->fetch_row();
    $content .= "\n\n". $TableMLine[1]. ";\n\n";

    for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
        while ($row = $result->fetch_row()) {
            if ($st_counter % 100 == 0 || $st_counter == 0) {
                $content .= "\nINSERT INTO ". $table. " VALUES";
            }
            $content .= "\n(";
            for ($j = 0; $j < $fields_amount; $j++) {
                if (isset($row[$j]) && $row[$j] !== null) {
                    $content .= '"'. addslashes($row[$j]). '"';
                } else {
                    $content .= 'NULL';
                }
                if ($j < ($fields_amount - 1)) {
                    $content .= ',';
                }
            }
            $content .= ")";
            if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                $content .= ";";
            } else {
                $content .= ",";
            }
            $st_counter++;
        }
    }
    $content .= "\n\n\n";
}

// save as.sql file
$content_ = "\n-- Database Backup --\n";
$content_ .= "-- Ver. : 1.0.1\n";
$content_ .= "-- Host : 127.0.0.1\n";
$content_ .= "-- Generating Time : ". date("M d"). ", ". date("Y"). " at ". date("H:i:s:"). date("A"). "\n\n";
$content_ .= $content;

// Guardar el contenido en un archivo para revisar
// file_put_contents("backup_debug.sql", $content_);
// file_put_contents("backup_error_log.txt", $error_log);

//save the file
$backup_file_name = $db_name. " ". date("Y-m-d H-i-s"). ".sql";
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'. $backup_file_name. '"');
echo $content_;
exit;
?>
