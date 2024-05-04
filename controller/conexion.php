<?php
    // Establecer la conexión a la base de datos
    $servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
?>