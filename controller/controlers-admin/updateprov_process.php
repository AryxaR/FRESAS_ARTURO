<?php
require_once '../../controller/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre_proveedor = $_POST['Nombre_proveedor'];
    $telefono_proveedor = $_POST['Telefono_proveedor'];
    $nombre_insumo = $_POST['Nombre_insumo'];
    $costo_producto = $_POST['Costo_producto'];
    $stock = $_POST['Stock'];

    // Actualizar datos en la tabla Proveedores
    $sql_update_proveedor = "UPDATE proveedores SET Nombre_proveedor = '$nombre_proveedor', Telefono_proveedor = '$telefono_proveedor' WHERE Id_proveedor = $id";
    if ($conn->query($sql_update_proveedor) === TRUE) {
        // Actualizar datos en la tabla Insumos
        $sql_update_insumo = "UPDATE insumos SET Nombre_insumo = '$nombre_insumo', Costo_producto = $costo_producto WHERE Id_proveedor = $id";
        if ($conn->query($sql_update_insumo) === TRUE) {
            // Actualizar datos en la tabla Recursos
            $sql_update_recurso = "UPDATE recursos SET Stock = $stock WHERE Id_proveedor = $id";
            if ($conn->query($sql_update_recurso) === TRUE) {
                $msj_exito = "Actualizar";
                header("Location: ../../model/interfaz_admin/update_proveedor.php?msj_exito= $msj_exito");
            } else {
                echo "Error al actualizar datos en la tabla Recursos: " . $conn->error;
            }
        } else {
            echo "Error al actualizar datos en la tabla Insumos: " . $conn->error;
        }
    } else {
        echo "Error al actualizar datos en la tabla Proveedores: " . $conn->error;
    }

    $conn->close();
}
?>
