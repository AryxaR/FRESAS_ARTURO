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
        // Verificar el stock antes de realizar la operación
        $sql_verificar_stock = "SELECT Stock FROM productos WHERE id_producto IN (SELECT id_producto FROM lotes WHERE id = ?) AND categoria_producto = ?";
        $stmt_verificar_stock = $conexion->prepare($sql_verificar_stock);
        $stmt_verificar_stock->bind_param("is", $id_cosecha, $categoria_fresa);

        if (!$stmt_verificar_stock->execute()) {
            throw new Exception("Error al verificar el stock: " . $stmt_verificar_stock->error);
        }

        $resultado_verificar_stock = $stmt_verificar_stock->get_result();
        if ($resultado_verificar_stock->num_rows > 0) {
            $fila = $resultado_verificar_stock->fetch_assoc();
            $stock_actual = $fila['Stock'];

            if ($stock_actual <= 0) {
                header('Location: ../../model/interfaz_admin/Perdidas.php?msj_stock=' . urlencode('El stock del producto ya está en cero. No se puede registrar más pérdidas.'));
                exit;
            }
        
            if ($cantidad_perdida > $stock_actual) {
                header('Location: ../../model/interfaz_admin/Perdidas.php?msj_stock_sup=' . urlencode('La cantidad de pérdida supera el stock actual del producto.'));
                exit;
            }
        } else {
            header('Location: ../../model/interfaz_admin/Perdidas.php?error=' . urlencode('No se encontró el producto correspondiente en el stock.'));
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
        $sql_update_productos = "UPDATE productos SET Stock = Stock - ? WHERE id_producto IN (SELECT id_producto FROM lotes WHERE id = ?) AND categoria_producto = ?";
        $stmt_update_productos = $conexion->prepare($sql_update_productos);
        $stmt_update_productos->bind_param("dis", $cantidad_perdida, $id_cosecha, $categoria_fresa);

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
        if (isset($stmt_verificar_stock)) {
            $stmt_verificar_stock->close();
        }
        $conexion->close();
    }
} else {
    echo "Error: Método de solicitud no válido.";
}
?>
