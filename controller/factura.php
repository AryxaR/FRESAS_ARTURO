<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

if ($conn === null) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_cliente = $_SESSION['Id_cliente'];
    $total_pedido = 0;

    
    $sql_insert_factura = "INSERT INTO facturas (id_cliente, total) VALUES (?, 0)";
    $stmt = $conn->prepare($sql_insert_factura);
    $stmt->bind_param("i", $id_cliente);
    if ($stmt->execute()) {
        
        $id_factura = $conn->insert_id;

        
        $sql_insert_detalle = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt_detalle = $conn->prepare($sql_insert_detalle);

        
        $sql_update_stock = "UPDATE productos SET Stock = Stock - ? WHERE id_producto = ?";
        $stmt_stock = $conn->prepare($sql_update_stock);

        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $cantidad = $producto['cantidad'];
            $precio_unitario = $producto['precio'];
            
            
            $stmt_detalle->bind_param("iiid", $id_factura, $id_producto, $cantidad, $precio_unitario);
            $stmt_detalle->execute();

            $subtotal = $cantidad * $precio_unitario;
            $total_pedido += $subtotal;

            $stmt_stock->bind_param("ii", $cantidad, $id_producto);
            $stmt_stock->execute();
        }

        $sql_update_factura = "UPDATE facturas SET total = ? WHERE id_factura = ?";
        $stmt_update_factura = $conn->prepare($sql_update_factura);
        $stmt_update_factura->bind_param("di", $total_pedido, $id_factura);
        $stmt_update_factura->execute();

        unset($_SESSION['carrito']);

        header("Location: ../../FRESAS_ARTURO/model/pedido.php?id_factura=$id_factura");
        exit();
    } else {
        echo "Error al procesar el pedido: " . $conn->error;
    }
}

$conn->close();
?>
