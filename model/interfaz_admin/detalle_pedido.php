<?php
// Verificar si se recibió un ID de pedido válido
if(isset($_GET['id_factura'])) {
    // Obtener el ID del pedido de la URL
    $id_pedido = $_GET['id_factura'];
    session_start();
    require_once '../../controller/conexion.php';
    include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
    // Consulta para obtener los detalles del pedido con el ID proporcionado
    $sql = "
        SELECT dv.*, p.categoria_producto AS nombre_producto
        FROM detalle_venta dv
        INNER JOIN productos p ON dv.id_producto = p.id_producto
        WHERE dv.id_factura = $id_pedido
    ";

    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
        $detalles_pedido = array();
        while ($fila = $resultado->fetch_assoc()) {
            $detalles_pedido[] = $fila;
        }
    } else {
        echo "No se encontraron detalles para este pedido.";
    }
    var_dump($detalles_pedido);
    $conn->close();
} else {
    echo "ID de pedido inválido";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Detalles del Pedido #<?php echo $id_pedido; ?></h1>

        <!-- Lista de Productos -->
        <div class="detalles-pedido">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles_pedido as $detalle): ?>
                        <tr>
                           <td><?php echo $detalle['nombre_producto']; ?> (ID: <?php echo $detalle['id_producto']; ?>)</td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td><?php echo $detalle['precio_unitario']; ?></td>
                            <td><?php echo $detalle['subtotal']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
