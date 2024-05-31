<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["restoreFile"])) {
    $file = $_FILES["restoreFile"]["tmp_name"];
    $error = false;

    // Verificar si se subió un archivo
    if (!empty($file) && file_exists($file)) {
        // Leer el contenido del archivo SQL
        $sql = file_get_contents($file);

        // Reemplazar valores de fecha vacíos por NULL
        $sql = preg_replace("/'(\d{4}-\d{2}-\d{2})'/", "NULL", $sql);

        // Conexión a la base de datos
        $host = "localhost";
        $root = "root";
        $pass = "";
        $db_name = "proyecto";
        $mysqli = new mysqli($host, $root, $pass, $db_name);

        // Función para dividir el contenido del archivo SQL en consultas individuales
        function splitSqlFile($sqlFile, $delimiter = ';') {
            // Read the SQL file
            $sql = file_get_contents($sqlFile);

            // Reemplazar valores de fecha vacíos por NULL
            $sql = preg_replace("/'(\d{4}-\d{2}-\d{2})'/", "NULL", $sql);

            // Split the SQL file into individual queries
            $queries = explode($delimiter, $sql);

            // Remove any empty queries
            $queries = array_filter($queries, function($query) {
                return trim($query) !== '';
            });

            return $queries;
        }

        // Dividir el contenido del archivo SQL en consultas individuales
        $queries = splitSqlFile($file);

        // Ejecutar cada consulta individualmente
        foreach ($queries as $query) {
            if (!empty(trim($query))) {
                if ($mysqli->query($query) !== TRUE) {
                    // Error
                    echo "Restore Error: " . $mysqli->error;
                    $error = true;
                    break;
                }
            }
        }

        // Verificar si no hubo errores
        if (!$error) {
            // Éxito
            $msj_restaurar = "Restauración exitosa!";
            header("Location: ../inicio_admin.php?msj_restaurar= $msj_restaurar");
            // echo "Restauración exitosa!";
        }

        // Cerrar conexión
        $mysqli->close();

        // Eliminar archivo temporal
        unlink($file);
    } else {
        $msj_file = "Ningun archivo seleccionado";
        header("Location: ../inicio_admin.php?msj_file= $msj_file");
        // echo "No file selected.";
    }
}
?>
