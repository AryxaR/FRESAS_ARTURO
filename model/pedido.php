<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

if (isset($_GET['id_factura'])) {
    $id_factura = $_GET['id_factura'];

    $sql_detalle_factura = "SELECT detalle_factura.*, productos.nombre_producto, productos.categoria_producto
                            FROM detalle_factura 
                            INNER JOIN productos ON detalle_factura.id_producto = productos.id_producto 
                            WHERE detalle_factura.id_factura = $id_factura";
    $result_detalle = $conn->query($sql_detalle_factura);

    $sql_total_factura = "SELECT total FROM facturas WHERE id_factura = $id_factura";
    $result_total = $conn->query($sql_total_factura);
    $total_factura = ($result_total->num_rows > 0) ? $result_total->fetch_assoc()['total'] : 0;
} else {
    header("Location: catalogo.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../FRESAS_ARTURO/resource/css/Style-confirmacion-pedido.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Confirmación de Pedido</h1>

        <h2>Detalles de la Factura</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_detalle->num_rows > 0) {
                        while ($row = $result_detalle->fetch_assoc()) {
                            $subtotal = $row['cantidad'] * $row['precio_unitario'];
                    ?>
                            <tr>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td><?php echo $row['categoria_producto']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td>$<?php echo $row['precio_unitario']; ?></td>
                                <td>$<?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end">Total:</td>
                        <td>$<?php echo number_format($total_factura, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <a href="../../FRESAS_ARTURO/catalogo.php" class="btn btn-primary">Volver al Catálogo</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>