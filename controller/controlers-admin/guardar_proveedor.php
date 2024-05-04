<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include '../../controller/conexion.php';

    // Obtener los datos del formulario
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $telefono_proveedor = $_POST['telefono_proveedor'];

    // Preparar la consulta SQL para insertar los datos en la tabla proveedores
    $sql = "INSERT INTO proveedores (Nombre_proveedor, Telefono_proveedor)
            VALUES ('$nombre_proveedor', '$telefono_proveedor')";

    // Ejecutar la consulta y verificar si se realizó con éxito
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Proveedor Registrado"); window.location.href = "../../model/interfaz_admin/Proveedores.php";</script>';
        exit(); 
    } else {
        echo "Error al guardar el proveedor: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
} else {
    // Si se intenta acceder directamente a este archivo sin enviar el formulario, redirigir a otra página
    header("Location: ../index.php");
    exit(); // Finalizar la ejecución del script
}
?>
