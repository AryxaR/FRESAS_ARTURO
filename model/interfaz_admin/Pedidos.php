<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEDIDOS | FRESAS DON ARTURO</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<?php
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
echo "<br><br><br><br>";

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

    // Selecciona todos los pedidos o filtra por término de búsqueda
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $sql = "SELECT v.*, u.Nombre as nombre_cliente FROM ventas v INNER JOIN usuarios u ON v.id_cliente = u.id_cliente WHERE id_cliente LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT v.*, u.Nombre as nombre_cliente FROM ventas v INNER JOIN usuarios u ON v.id_cliente = u.id_cliente";
    }

    function getTotalPedidos()
    {
        global $conn;
        $sql = "SELECT COUNT(*) as total_pedidos FROM ventas";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_pedidos'];
    }

    // Número máximo de tarjetas por página
    $tarjetasPorPagina = 4;

    // Calcula el número total de páginas
    $totalPedidos = getTotalPedidos();
    $totalPaginas = ceil($totalPedidos / $tarjetasPorPagina);

    // Obtiene el número de página actual
    $paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calcula el desplazamiento para la consulta SQL
    $offset = ($paginaActual - 1) * $tarjetasPorPagina;

    // Consulta para obtener los pedidos de la página actual
    $sql = "SELECT v.*, u.Nombre as nombre_cliente 
        FROM ventas v INNER JOIN usuarios u ON v.id_cliente = u.id_cliente 
        LIMIT $offset, $tarjetasPorPagina";
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

    echo "<br><br><br><br>";
    $conn->close();
    ?>

    <style>
        body {
            background-image: url(../../resource/img/index/fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        .pedido {
            margin-top: -10%;
            position: relative;
            width: 90%;
            border: 1px solid #ccc; 
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 17%;
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

        .breadcrumbs-container {
            display: flex;
            margin-top: -1%;
            margin-left: 7%;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            background-color: white;
            display: flex;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "/";
            margin: 0 7px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .search-form {
            margin-top: -5%;
            margin-right: 5%;
        }

        .pagination-container {
            position: relative;
            z-index: 0;
        }

    </style>
</head>

<body>
    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="TITULO">ORDENES DE COMPRA</div>
        <br><br><br><br>

        <!-- Formulario de búsqueda -->
        <form action="" method="GET" class="form-inline float-right search-form">
            <div class="form-group mx-sm-3 mb-2">
                <label for="searchTerm" class="sr-only">Buscar</label>
                <input type="text" class="form-control" id="searchTerm" name="search" placeholder="Buscar">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>

        <br><br><br>

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
                                <a href="detalle_pedido.php?id_factura=<?php echo $pedido['id_factura']; ?>" class="btn btn-primary">Ver Detalles</a>

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

        <nav aria-label="Page navigation example" class="pagination-container">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                    <li class="page-item <?php echo ($paginaActual == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

    </div>
    <br><br><br><br><br>
    <?php include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>