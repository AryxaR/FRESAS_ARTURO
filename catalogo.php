<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATÁLOGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../FRESAS_ARTURO/resource/css/Style_catalogo.css">
    <script src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>

    <?php
    session_start();
    require_once('../FRESAS_ARTURO/controller/conexion.php');
    include_once('../FRESAS_ARTURO/view/layout/navs/nav-usuario.php');
    if ($conn === null) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    if (isset($_SESSION['Id_cliente'])) {
        $Id_cliente = $_SESSION['Id_cliente'];
        $sql = "SELECT Nombre FROM Usuarios WHERE Id_cliente = $Id_cliente";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nombreCliente = $row['Nombre'];
        } else {
            $nombreCliente = "Nombre no disponible";
        }
    } else {
        $nombreCliente = "Nombre no disponible";
    }

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    function obtenerRutaImagen($categoria)
    {
        $nombre_imagen = 'FRESA_' . strtoupper($categoria) . '.jpeg';
        return './model/uploads/' . $nombre_imagen;
    }

    function mostrarModalCarrito()
    {
        echo '<div class="modal fade" id="modal-carrito" tabindex="-1" aria-labelledby="modal-carrito-label" aria-hidden="true">';
        echo '<div class="modal-dialog modal-dialog-centered modal-lg">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="modal-carrito-label">Carrito de Compras</h5>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '</div>';
        echo '<div class="modal-body">';

        if (!empty($_SESSION['carrito'])) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th></th>';
            echo '<th>Producto</th>';
            echo '<th>Categoría</th>';
            echo '<th>Precio Unitario</th>';
            echo '<th>';
            echo 'Cantidad<br><span style="font-weight: normal; font-size: smaller;">(Canastillas)</span>';
            echo '</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $total = 0;

            foreach ($_SESSION['carrito'] as $id_producto => $producto) {
                echo '<tr>';
                echo '<td><img src="' . obtenerRutaImagen($producto['categoria']) . '" alt="' . $producto['categoria'] . '" class="img-fluid" style="max-width: 60px;"></td>';
                echo '<td>' . $producto['nombre'] . '</td>';
                echo '<td>' . $producto['categoria'] . '</td>';
                echo '<td>$' . $producto['precio'] . '</td>';
                echo '<td>' . $producto['cantidad'] . '</td>';

                echo '<td><form method="post" action="../FRESAS_ARTURO/controller/eliminar_producto.php">';
                echo '<input type="hidden" name="id_producto" value="' . $id_producto . '">';
                echo '<button type="submit" class="btn btn-link"><i class="bi bi-trash"></i></button>';
                echo '</form></td>';
                echo '</tr>';
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
            }

            echo '<tr>';
            echo '<td colspan="3"></td>';
            echo '<td><strong>Total:</strong></td>';
            echo '<td>$' . number_format($total, 2) . '</td>';
            echo '</tr>';

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'El carrito está vacío.';
        }

        echo '</div>';
        echo '<div class="modal-footer">';

        if (!empty($_SESSION['carrito'])) {
            echo '<form id="form-factura" method="post" action="../../FRESAS_ARTURO/controller/orden_compra.php" target="_blank">';
            echo '<button type="submit" class="btn btn-primary">Confirmar</button>';
            echo '</form>';
        }

        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar Compra</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    function verificarStock($id_producto, $cantidad, $conn)
    {
        $sql = "SELECT Stock FROM productos WHERE id_producto = $id_producto";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stock_disponible = $row['Stock'];
            if ($cantidad <= $stock_disponible) {
                return array('suficiente' => true, 'stock_disponible' => $stock_disponible);
            } else {
                return array('suficiente' => false, 'stock_disponible' => $stock_disponible);
            }
        } else {
            return array('suficiente' => false, 'stock_disponible' => 0);
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];

            $verificacion_stock = verificarStock($id_producto, $cantidad, $conn);

            if ($verificacion_stock['suficiente']) {
                $sql = "SELECT nombre_producto, categoria_producto, precio_producto FROM productos WHERE id_producto = $id_producto";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nombre = $row['nombre_producto'];
                    $categoria = $row['categoria_producto'];
                    $precio = $row['precio_producto'];

                    // Verificar si el producto ya está en el carrito
                    if (isset($_SESSION['carrito'][$id_producto])) {
                        // Si ya está en el carrito, sumar la cantidad, verificando el stock
                        $cantidad_actual_carrito = $_SESSION['carrito'][$id_producto]['cantidad'];
                        $cantidad_total = $cantidad_actual_carrito + $cantidad;
                        if ($cantidad_total <= $verificacion_stock['stock_disponible']) {
                            $_SESSION['carrito'][$id_producto]['cantidad'] = $cantidad_total;
                        } else {
                            // No se puede agregar más de lo disponible en stock
                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                            echo '<script>';
                            echo "Swal.fire({
                                icon: 'error',
                                title: '¡No se puede agregar más cantidad!',
                                html: 'No hay suficiente stock disponible para continuar con este pedido.',
                                confirmButtonText: 'OK'
                            });";
                            echo '</script>';
                        }
                    } else {
                        // Si no está en el carrito, agregarlo normalmente
                        $_SESSION['carrito'][$id_producto] = array(
                            'nombre' => $nombre,
                            'categoria' => $categoria,
                            'precio' => $precio,
                            'cantidad' => $cantidad
                        );
                    }
                } else {
                    // No se encontró el producto en la base de datos
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                    echo '<script>';
                    echo "Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: 'El producto seleccionado no está disponible actualmente.',
                        confirmButtonText: 'OK'
                    });";
                    echo '</script>';
                }
            } else {
                $stock_disponible = $verificacion_stock['stock_disponible'] . " Kg";
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>';
                echo "Swal.fire({
                    icon: 'error',
                    title: '¡No se puede agregar el producto!',
                    html: 'Stock insuficiente en la bodega.<br>Cantidad disponible: $stock_disponible',
                    confirmButtonText: 'OK'
                });";
                echo '</script>';
            }
        }
    }
    ?>



    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top: 250px;
        }

        .input-cantidad {
            width: 190px;
        }

        .breadcrumbs-container {
            position: absolute;
            margin-top: 3%;
            margin-left: 10%;
        }

        .breadcrumbs-container .breadcrumb {
            margin-bottom: 0;
        }

        .breadcrumbs-container .breadcrumb-item a {
            text-decoration: none;
        }

        .item.agotado {
            position: relative;
            opacity: 0.5;
        }

        .item.agotado .btn,
        .item.agotado .input-cantidad {
            pointer-events: none;
        }

        .item.agotado .precio-item {
            display: none;
        }

        .item.agotado::after {
            content: "AGOTADO";
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-55deg);
            background: rgba(255, 0, 0, 0.8);
            color: white;
            font-size: 4em;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 10;
        }

        .item .stock-agotado {
            color: red;
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        .item img {
            background-color: aqua;
            width: 100%;
            height: 450px;
            border-radius: 1px;
        }

    </style>
</head>

<body>
    <br><br><br><br>

    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_usuarios.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
            </ol>
        </nav>
    </div>

    <br>

    <button type="button" class="btn btn-primary ms-4 position-relative" id="carritoBtn" data-bs-toggle="modal" data-bs-target="#modal-carrito" style="z-index: 1;">
        <i class="bi bi-cart"></i>
        <?php
        $numArticulosCarrito = count($_SESSION['carrito']);
        ?>
        <?php if ($numArticulosCarrito > 0) : ?>
            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"><?php echo $numArticulosCarrito; ?></span>
        <?php endif; ?>
    </button>

    <section class="contenedor-general">
        <div class="contenedor-items">
            <?php
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $agotado = $row['Stock'] <= 0;
            ?>
                    <div class="item <?php echo $agotado ? 'agotado' : ''; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                        <span class="titulo-item"><?php echo $row['categoria_producto']; ?></span>

                        <img class="img-item" src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['categoria_producto']; ?>">

                        <h5>*EL PRECIO DE VENTA ES POR CANASTILLA*</h5>
                        <h6>UNA CANASTILLA = "8KG"</h6>
                        <span class="precio-item">$<?php echo $row['precio_producto']; ?></span>

                        <?php if ($agotado) { ?>
                            <div class="stock-agotado">LAMENTAMOS INFORMARLE QUE NO HAY DISPONIBILIDAD DE ESTE PRODUCTO </div>
                        <?php } else { ?>
                            <form method="post" action="">
                                <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                                <input type="number" name="cantidad" placeholder="Cantidad (Canastilla)" required class="ms-2 mb-3 input-cantidad" min="1" max="99" oninput="this.value = this.value.slice(0, 2)">
                                <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                            </form>
                        <?php } ?>
                    </div>
            <?php
                }
            } else {
                echo "No se encontraron productos.";
            }
            $conn->close();
            ?>
        </div>
    </section>

    <?php mostrarModalCarrito(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#modal-carrito').modal('show');
        });
    </script>
    <section id="section-contacto">
        <br><br><br><br><br><br>
        <?php include_once('../FRESAS_ARTURO/view/layout/footers/footer-usuarios.php') ?>
    </section>
</body>

</html>