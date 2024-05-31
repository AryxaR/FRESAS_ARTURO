<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETALLES DEL PEDIDO</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <?php
    // Verificar si se recibió un ID de pedido válido
    if (isset($_GET['id_factura'])) {
        // Obtener el ID del pedido de la URL
        $id_pedido = $_GET['id_factura'];
        session_start();
        require_once '../../controller/conexion.php';
        include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';

        // Consulta para obtener los detalles del pedido con el ID proporcionado
        $sql = "
        SELECT dv.*, p.categoria_producto AS nombre_producto, v.fecha, v.total, u.nombre AS nombre_cliente
        FROM detalle_venta dv
        INNER JOIN productos p ON dv.id_producto = p.id_producto
        INNER JOIN ventas v ON dv.id_factura = v.id_factura
        INNER JOIN usuarios u ON v.id_cliente = u.id_cliente
        WHERE dv.id_factura = $id_pedido
    ";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $detalles_pedido = array();
            $fila = $resultado->fetch_assoc();
            // Información adicional del pedido
            $fecha_compra = $fila['fecha'];
            $total_pagar = $fila['total'];
            $nombre_cliente = $fila['nombre_cliente'];

            // Obtener el resto de los detalles
            do {
                $detalles_pedido[] = $fila;
            } while ($fila = $resultado->fetch_assoc());
        } else {
            echo "No se encontraron detalles para este pedido.";
        }

        $conn->close();
    } else {
        echo "ID de pedido inválido";
    }
    ?>

    <style>
        body {
            background-image: url(../../resource/img/index/fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .TITULO {
            margin-top: -1%;
            margin-bottom: 5%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .btn-volver {
            margin: 3% 0 0 -7%;
            color: white;
            background-color: #d22c5d;
            border: none;
            font-size: 24px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
        }


        .btn-volver:hover {
            border: 1px solid #d22c5d;
            color: #d22c5d;
            background-color: white;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-radius: 10px 10px 0 0;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .breadcrumb {
            margin-left: -10%;
            background-color: white;
            border-radius: 0.25rem;
        }



    </style>
</head>

<body>
    <br>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="pedidos.php">Pedidos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles del Pedido</li>
            </ol>
        </nav>

        <button class="btn-volver" onclick="history.back()">&#8592;</button>

        <div class="TITULO">DETALLES DEL PEDIDO #<?php echo $id_pedido; ?></div>

            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Información del Pedido</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha de la compra:</strong> <?php echo $fecha_compra; ?></p>
                            <p><strong>Nombre del cliente:</strong> <?php echo $nombre_cliente; ?></p>
                            <p><strong>Total a pagar:</strong> $<?php echo $total_pagar; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Lista de Productos -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detalles de Productos</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID Producto</th>
                                            <th>Nombre Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detalles_pedido as $detalle) : ?>
                                            <tr>
                                                <td><?php echo $detalle['id_producto']; ?></td>
                                                <td><?php echo $detalle['nombre_producto']; ?></td>
                                                <td><?php echo $detalle['cantidad']; ?></td>
                                                <td>$<?php echo $detalle['precio_unitario']; ?></td>
                                                <td>$<?php echo number_format($detalle['cantidad'] * $detalle['precio_unitario'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                            <td>$<?php echo number_format($total_pagar, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


    <script>
        function generarPDF() {
            // Selecciona el elemento que contiene el contenido a convertir en PDF
            const elemento = document.getElementById('contenido-pdf');

            const opciones = {
                margin: 1,
                filename: 'documento.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 1 // Ajusta la escala aquí
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf()
                .from(elemento)
                .set(opciones)
                .save();
        }
    </script>
</body>

</html>