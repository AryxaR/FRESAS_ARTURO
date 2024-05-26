<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si los datos del formulario han sido enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cosecha = $_POST['fecha_cosecha']; // Aquí obtenemos el id de la cosecha
    $categoria_fresa = $_POST['categoria_fresa'];
    $cantidad_perdida = $_POST['cantidad_perdida'];

    // Validar datos
    if (empty($id_cosecha) || empty($categoria_fresa) || empty($cantidad_perdida)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Comenzar una transacción
    $conexion->begin_transaction();

    try {

        // Registrar la pérdida en la tabla de pérdidas
        $sql_registrar_perdida = "INSERT INTO perdidas (id_cosecha, categoria_fresa, cantidad_perdida) VALUES (?, ?, ?)";
        $stmt_registrar_perdida = $conexion->prepare($sql_registrar_perdida);
        $stmt_registrar_perdida->bind_param("isi", $id_cosecha, $categoria_fresa, $cantidad_perdida);

        if (!$stmt_registrar_perdida->execute()) {
            throw new Exception("Error al registrar la pérdida: " . $stmt_registrar_perdida->error);
        }

        // Actualizar la cantidad en la tabla de lotes
        switch ($categoria_fresa) {
            case 'extra':
                $sql_update_lotes = "UPDATE lotes SET cantidad_extra = cantidad_extra - ? WHERE id = ?";
                break;
            case 'primera':
                $sql_update_lotes = "UPDATE lotes SET cantidad_primera = cantidad_primera - ? WHERE id = ?";
                break;
            case 'segunda':
                $sql_update_lotes = "UPDATE lotes SET cantidad_segunda = cantidad_segunda - ? WHERE id = ?";
                break;
            case 'riche':
                $sql_update_lotes = "UPDATE lotes SET cantidad_riche = cantidad_riche - ? WHERE id = ?";
                break;
            default:
                throw new Exception("Categoría de fresa no válida.");
        }

        $stmt_update_lotes = $conexion->prepare($sql_update_lotes);
        $stmt_update_lotes->bind_param("di", $cantidad_perdida, $id_cosecha);

        if (!$stmt_update_lotes->execute()) {
            throw new Exception("Error al actualizar la cantidad en lotes: " . $stmt_update_lotes->error);
        }

        // Actualizar el stock en la tabla de productos
        $sql_update_productos = "UPDATE productos SET Stock = Stock - ? WHERE id_producto IN (SELECT id_producto FROM lotes WHERE id = ?) AND categoria_producto = ?";
        $stmt_update_productos = $conexion->prepare($sql_update_productos);
        $stmt_update_productos->bind_param("dis", $cantidad_perdida, $id_cosecha, $categoria_fresa);

        if (!$stmt_update_productos->execute()) {
            throw new Exception("Error al actualizar el stock en productos: " . $stmt_update_productos->error);
        }

        // Si todo está bien, commit la transacción
        $conexion->commit();
        echo "Pérdida registrada, cantidad actualizada en lotes y stock actualizado en productos exitosamente.";
    } catch (Exception $e) {
        // Si ocurre un error, rollback la transacción
        $conexion->rollback();
        echo $e->getMessage();
    }

    // Cerrar las declaraciones y la conexión
    $stmt_registrar_perdida->close();
    $stmt_update_lotes->close();
    $stmt_update_productos->close();
    $conexion->close();
} else {
    echo "Error: Método de solicitud no válido.";
}
