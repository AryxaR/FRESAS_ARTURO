<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

if (isset($_GET['id_factura'])) {
    $id_factura = $_GET['id_factura'];

    $sql_detalle_venta = "SELECT Detalle_venta.*, productos.nombre_producto, productos.categoria_producto
                            FROM Detalle_venta 
                            INNER JOIN productos ON Detalle_venta.id_producto = productos.id_producto 
                            WHERE Detalle_venta.id_factura = $id_factura";
    $result_detalle = $conn->query($sql_detalle_venta);

    $sql_total_factura = "SELECT total FROM ventas WHERE id_factura = $id_factura";
    $result_total = $conn->query($sql_total_factura);
    $total_factura = ($result_total->num_rows > 0) ? $result_total->fetch_assoc()['total'] : 0;

    // Obtener los datos del cliente desde la tabla "usuarios"
    $sql_cliente = "SELECT cedula, nombre, correo FROM usuarios WHERE Id_cliente = (SELECT id_cliente FROM ventas WHERE id_factura = $id_factura)";
    $result_cliente = $conn->query($sql_cliente);
    if ($result_cliente->num_rows > 0) {
        $row_cliente = $result_cliente->fetch_assoc();
        $cedula_cliente = $row_cliente['cedula'];
        $nombre_cliente = $row_cliente['nombre'];
        $correo_cliente = $row_cliente['correo'];
    } else {
        // Cliente no encontrado, manejar el error como mejor convenga
        $cedula_cliente = '';
        $nombre_cliente = '';
        $correo_cliente = '';
    }
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
    <link rel="icon" href="../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">



    <script>
        function closeAndReload() {
            window.opener.location.reload();
            
            window.close();
            
            return false;
        }
    </script>


    <style>
        .invoice-card {
            background-image: url("../../FRESAS_ARTURO/resource/img/index/fondonitido.png");
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #ccc;
        }

        .invoice-content {
            background-color: rgba(255, 255, 255, 0.9);
            border: 2px solid black;
            padding: 20px;
            border-radius: 10px;
            margin: auto;
            margin-top: 20px;
        }

        .logo-container {
            display: inline-block;
            vertical-align: top;
        }

        .logo-img {
            max-width: 150px;
        }

        .factura{
            margin-top: 5%;
        }

        .float-right {
            float: right;
            font-size: 1.2rem;
        }

        #id {
            transform: translate(0, -120px);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card invoice-card">
            <div class="card-body">
                <section class="content">
                    <div class="container-fluid">

                        <!-- Contenido del modal -->
                        <div class="invoice p-3 mb-3 col-md-8 invoice-content">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="id">
                                        <div class="logo-container">
                                            <img src="../../FRESAS_ARTURO/resource/img/logo/FONDO_LOGO.jpeg" alt="Logo de Kepler S.A.S." class="logo-img">
                                        </div>
                                        <small class="float-right">Fecha: <?php echo date('d/m/Y'); ?></small>
                                        <br>
                                        <small id="id" class="float-right">Id Factura: <?php echo $id_factura; ?></small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <address>
                                        <strong>FRESAS DON ARTURO</strong><br>
                                        Cuitiva-Boyacá <br>
                                        Vereda llano de Alarcón<br>
                                        Teléfono: 3118226066<br>
                                       
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    <address>
                                        <strong>Cliente:</strong><br>
                                        <?php echo $nombre_cliente; ?><br>
                                        Cédula: <?php echo $cedula_cliente; ?><br>
                                        Correo: <?php echo $correo_cliente; ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12">
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
                                                    <td colspan="4" class="text-end">Total:</td>
                                                    <td>$<?php echo number_format($total_factura, 2); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <a href="../../FRESAS_ARTURO/catalogo.php" id="btnVolverCatalogo" class="btn btn-primary" onclick="return closeAndReload();">Volver al Catálogo</a>

                            <button onclick="exportToPdf()" id="btnExportarPdf" class="btn btn-success float-end me-2">Exportar a PDF</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        function exportToPdf() {
            // Ocultar botones antes de generar el PDF
            document.getElementById('btnExportarPdf').style.display = 'none';
            document.getElementById('btnVolverCatalogo').style.display = 'none';

            var element = document.querySelector('.invoice-content');
            html2pdf()
                .from(element)
                .save('orden_pedido.pdf')
                .then(function() {
                    // Volver a mostrar botones después de guardar el PDF
                    document.getElementById('btnExportarPdf').style.display = 'inline-block';
                    document.getElementById('btnVolverCatalogo').style.display = 'inline-block';
                });
        }
    </script>


</body>

</html>