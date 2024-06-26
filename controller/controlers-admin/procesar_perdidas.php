<?php
$conexion = new mysqli("localhost", "sonnak", "sonnak2024", "proyecto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cosecha = $_POST['fecha_cosecha']; 
    $categoria_fresa = $_POST['categoria_fresa'];
    $cantidad_perdida = $_POST['cantidad_perdida'];

    if (empty($id_cosecha) || empty($categoria_fresa) || empty($cantidad_perdida)) {
        die("Error: Todos los campos son obligatorios.");
    }

    $conexion->begin_transaction();

    try {
        // Verificar la cantidad disponible en la tabla lotes antes de registrar la pérdida
        $sql_verificar_cantidad = "";
        switch ($categoria_fresa) {
            case 'extra':
                $sql_verificar_cantidad = "SELECT cantidad_extra AS cantidad_disponible FROM lotes WHERE id = ?";
                break;
            case 'primera':
                $sql_verificar_cantidad = "SELECT cantidad_primera AS cantidad_disponible FROM lotes WHERE id = ?";
                break;
            case 'segunda':
                $sql_verificar_cantidad = "SELECT cantidad_segunda AS cantidad_disponible FROM lotes WHERE id = ?";
                break;
            case 'riche':
                $sql_verificar_cantidad = "SELECT cantidad_riche AS cantidad_disponible FROM lotes WHERE id = ?";
                break;
            default:
                throw new Exception("Categoría de fresa no válida.");
        }

        $stmt_verificar_cantidad = $conexion->prepare($sql_verificar_cantidad);
        $stmt_verificar_cantidad->bind_param("i", $id_cosecha);

        if (!$stmt_verificar_cantidad->execute()) {
            throw new Exception("Error al verificar la cantidad disponible: " . $stmt_verificar_cantidad->error);
        }

        $resultado_verificar_cantidad = $stmt_verificar_cantidad->get_result();
        if ($resultado_verificar_cantidad->num_rows > 0) {
            $fila = $resultado_verificar_cantidad->fetch_assoc();
            $cantidad_disponible = $fila['cantidad_disponible'];

            if ($cantidad_disponible <= 0) {
                header('Location: ../../model/interfaz_admin/Perdidas.php?msj_stock=' . urlencode('No hay cantidad disponible en la cosecha seleccionada. No se puede registrar más pérdidas.'));
                exit;
            }

            if ($cantidad_perdida > $cantidad_disponible) {
                header('Location: ../../model/interfaz_admin/Perdidas.php?msj_stock_sup=' . urlencode('La cantidad de pérdida supera la cantidad disponible en la cosecha seleccionada.'));
                exit;
            }
        } else {
            header('Location: ../../model/interfaz_admin/Perdidas.php?error=' . urlencode('No se encontró el registro de la cosecha seleccionada.'));
            exit;
        }

        // Insertar la pérdida
        $sql_registrar_perdida = "INSERT INTO perdidas (id_cosecha, categoria_fresa, cantidad_perdida) VALUES (?, ?, ?)";
        $stmt_registrar_perdida = $conexion->prepare($sql_registrar_perdida);
        $stmt_registrar_perdida->bind_param("isi", $id_cosecha, $categoria_fresa, $cantidad_perdida);

        if (!$stmt_registrar_perdida->execute()) {
            throw new Exception("Error al registrar la pérdida: " . $stmt_registrar_perdida->error);
        }

        // Actualizar la cantidad en lotes según la categoría de fresa
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

        // Actualizar el stock en productos
        $sql_update_productos = "UPDATE productos SET Stock = Stock - ? WHERE categoria_producto = ?";
        $stmt_update_productos = $conexion->prepare($sql_update_productos);
        $stmt_update_productos->bind_param("is", $cantidad_perdida, $categoria_fresa);

        if (!$stmt_update_productos->execute()) {
            throw new Exception("Error al actualizar el stock en productos: " . $stmt_update_productos->error);
        }

        $conexion->commit();
        $msj_exito = "Pérdida registrada, cantidad actualizada en lotes y stock actualizado en productos exitosamente.";
        header("Location: ../../model/interfaz_admin/Perdidas.php?msj_exito=" . urlencode($msj_exito));
        exit;
    } catch (Exception $e) {
        $conexion->rollback();
        echo $e->getMessage();
    } finally {
        // Cerrar todas las declaraciones preparadas si están inicializadas
        if (isset($stmt_registrar_perdida)) {
            $stmt_registrar_perdida->close();
        }
        if (isset($stmt_update_lotes)) {
            $stmt_update_lotes->close();
        }
        if (isset($stmt_update_productos)) {
            $stmt_update_productos->close();
        }
        if (isset($stmt_verificar_cantidad)) {
            $stmt_verificar_cantidad->close();
        }
        $conexion->close();
    }
} else {
    echo "Error: Método de solicitud no válido.";
}
?>
