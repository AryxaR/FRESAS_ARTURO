<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

if ($conn === null) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_cliente = $_SESSION['Id_cliente'];
   
    $total_pedido = 0;
    
    $sql_insert_factura = "INSERT INTO facturas (id_cliente, total) VALUES ($id_cliente, $total_pedido)";
    if ($conn->query($sql_insert_factura) === TRUE) {
        
        $id_factura = $conn->insert_id;

        foreach ($_SESSION['carrito'] as $id_producto => $producto) {
            $cantidad = $producto['cantidad'];
            $precio_unitario = $producto['precio'];
            
            $sql_insert_detalle = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad, precio_unitario) VALUES ($id_factura, $id_producto, $cantidad, $precio_unitario)";
            $conn->query($sql_insert_detalle);

            $subtotal = $cantidad * $precio_unitario;
            $total_pedido += $subtotal;
        }

        $sql_update_factura = "UPDATE facturas SET total = $total_pedido WHERE id_factura = $id_factura";
        $conn->query($sql_update_factura);

        unset($_SESSION['carrito']);

        header("Location: ../../FRESAS_ARTURO/model/pedido.php?id_factura=$id_factura");
        exit();
    } else {
        echo "Error al procesar el pedido: " . $conn->error;
    }
}


$conn->close();
?>
