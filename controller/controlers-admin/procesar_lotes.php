<?php
include_once("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cantidad_extra = $_POST['cantidad_extra'];
    $cantidad_primera = $_POST['cantidad_primera'];
    $cantidad_segunda = $_POST['cantidad_segunda'];
    $cantidad_riche = $_POST['cantidad_riche'];
;
    $sql_insert_recoleccion = "INSERT INTO lotes (cantidad_extra, cantidad_primera, cantidad_segunda, cantidad_riche) VALUES ";
    $sql_insert_recoleccion .= "(";
    $sql_insert_recoleccion .= intval($cantidad_extra) . ", ";
    $sql_insert_recoleccion .= intval($cantidad_primera) . ", ";
    $sql_insert_recoleccion .= intval($cantidad_segunda) . ", ";
    $sql_insert_recoleccion .= intval($cantidad_riche) . ")";
    if ($conn->query($sql_insert_recoleccion) === TRUE) {
        echo "Datos de recolección insertados correctamente.";
        $msj_cosecha = 'Datos de recolección insertados correctamente.';
        header("Location: ../../model/interfaz_admin/Cosechas.php?msj_cosecha= $msj_cosecha");

        if ($cantidad_extra > 0) {
            $sql_update_extra = "UPDATE productos SET Stock = Stock + " . intval($cantidad_extra) . " WHERE categoria_producto = 'Extra'";
            if ($conn->query($sql_update_extra) !== TRUE) {
                echo "Error al actualizar el stock de Fresas Extra: " . $conn->error;
            }
        }
        if ($cantidad_primera > 0) {
            $sql_update_primera = "UPDATE productos SET Stock = Stock + " . intval($cantidad_primera) . " WHERE categoria_producto = 'Primera'";
            if ($conn->query($sql_update_primera) !== TRUE) {
                echo "Error al actualizar el stock de Fresas Primera: " . $conn->error;
            }
        }
        if ($cantidad_segunda > 0) {
            $sql_update_segunda = "UPDATE productos SET Stock = Stock + " . intval($cantidad_segunda) . " WHERE categoria_producto = 'Segunda'";
            if ($conn->query($sql_update_segunda) !== TRUE) {
                echo "Error al actualizar el stock de Fresas Segunda: " . $conn->error;
            }
        }
        if ($cantidad_riche > 0) {
            $sql_update_riche = "UPDATE productos SET Stock = Stock + " . intval($cantidad_riche) . " WHERE categoria_producto = 'Riche'";
            if ($conn->query($sql_update_riche) !== TRUE) {
                echo "Error al actualizar el stock de Fresas Riche: " . $conn->error;
            }
        }
    } else {
        echo "Error al insertar datos de recolección: " . $conn->error;
    }
}

$conn->close();
?>
