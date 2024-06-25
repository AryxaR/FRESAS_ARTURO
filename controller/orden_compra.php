<?php
session_start();
require_once('conexion.php');

if ($conn === null) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_cliente = $_SESSION['Id_cliente'];
    $total_pedido = 0;

    
    $sql_insert_factura = "INSERT INTO ventas (id_cliente, total) VALUES (?, 0)";
    $stmt = $conn->prepare($sql_insert_factura);
    $stmt->bind_param("i", $id_cliente);
    if ($stmt->execute()) {
        
        $id_factura = $conn->insert_id;

        
        $sql_insert_detalle = "INSERT INTO detalle_venta (id_factura, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt_detalle = $conn->prepare($sql_insert_detalle);

        
        $sql_update_stock = "UPDATE productos SET Stock = Stock - ? WHERE id_producto = ?";
        $stmt_stock = $conn->prepare($sql_update_stock);

        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $cantidad = $producto['cantidad'];
            $precio_unitario = $producto['precio'];
        
            // Calcular el subtotal
            $subtotal = $cantidad * $precio_unitario;
        
            // Ahora puedes vincular $subtotal a la consulta preparada
            $stmt_detalle->bind_param("iiiid", $id_factura, $id_producto, $cantidad, $precio_unitario, $subtotal);
            $stmt_detalle->execute();
        
            $total_pedido += $subtotal;
        
            // Restar la cantidad del stock
            $stmt_stock->bind_param("ii", $cantidad, $id_producto);
            $stmt_stock->execute();
        }
        

        $sql_update_factura = "UPDATE ventas SET total = ? WHERE id_factura = ?";
        $stmt_update_factura = $conn->prepare($sql_update_factura);
        $stmt_update_factura->bind_param("di", $total_pedido, $id_factura);
        $stmt_update_factura->execute();

        unset($_SESSION['carrito']);

        header("Location: ../model/factura.php?id_factura=$id_factura");
        exit();
    } else {
        echo "Error al procesar el pedido: " . $conn->error;
    }
}

$conn->close();
?>
