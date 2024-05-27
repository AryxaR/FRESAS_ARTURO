<?php
session_start();
require_once '../../controller/conexion.php';
include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';

// Actualiza el estado de los pedidos si se reciben datos POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_pedido']) && isset($_POST['accion'])) {
        $idPedido = $_POST['id_pedido'];
        $accion = $_POST['accion'];

        if ($accion == 'finalizar') {
            $nuevoEstado = 'finalizado';
        } elseif ($accion == 'activar') {
            $nuevoEstado = 'activo';
        }

        $sql = "UPDATE ventas SET estado = '$nuevoEstado' WHERE id_factura = $idPedido";
        $conn->query($sql);
    }
}

// Selecciona todos los pedidos
$sql = "SELECT v.*, u.Nombre as nombre_cliente FROM ventas v INNER JOIN usuarios u ON v.id_cliente = u.id_cliente";
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Array para almacenar los pedidos
    $pedidos = array();

    // Iterar sobre los resultados y guardarlos en el array
    while ($fila = $resultado->fetch_assoc()) {
        $pedidos[] = $fila;
    }
} else {
    echo "No se encontraron pedidos.";
}
echo "<br><br><br>";
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEDIDOS | FRESAS DON ARTURO</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(../../resource/img/index/fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        .pedido {
            position: relative;
            width: 90%;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: box-shadow 0.3s ease-in-out;
        }

        .pedido:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .TITULO {
            margin-top: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
            font-family: 'Poppins', sans-serif;
        }

        .btn-group {
            position: absolute; 
            top: 50%; 
            right: 20px; 
            transform: translateY(-50%); 
            display: flex;
            flex-direction: column;
        }

        .btn-group .btn {
            margin-bottom: 10px;
        }

        .pedido.finalizado {
            opacity: 0.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="TITULO">ORDENES DE COMPRA</div>
        <br><br><br><br>
        <div class="row">
            <?php foreach ($pedidos as $pedido) : ?>
                <div class="col-md-6">
                    <div class="pedido <?php echo ($pedido['estado'] == 'finalizado') ? 'finalizado' : ''; ?>">
                        <h3 class="mb-3">Pedido #<?php echo $pedido['id_factura']; ?></h3>
                        <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
                        <p><strong>Cliente:</strong> <?php echo $pedido['nombre_cliente']; ?></p>
                        <p><strong>Total:</strong> <?php echo $pedido['total']; ?></p>
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <?php if ($pedido['estado'] == 'activo') : ?>
                                <a href="detalle_pedido.php?id=<?php echo $pedido['id_factura']; ?>" class="btn btn-primary">Ver Detalles</a>
                                <a href="generar_pdf.php?id=<?php echo $pedido['id_factura']; ?>" class="btn btn-success">PDF</a>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_factura']; ?>">
                                    <input type="hidden" name="accion" value="finalizar">
                                    <button type="submit" class="btn btn-danger">Finalizar</button>
                                </form>
                            <?php elseif ($pedido['estado'] == 'finalizado') : ?>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_factura']; ?>">
                                    <input type="hidden" name="accion" value="activar">
                                    <button type="submit" class="btn btn-success">Activar</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
