<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FRESAS_ARTURO/resource/css/catUsuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CATALOGO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
</head>

<body>
    <?php
    require_once('../FRESAS_ARTURO/controller/conexion.php');
    if ($conn === null) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    include_once('../FRESAS_ARTURO/view/layout/navs/nav-usuario.php') ?>

    <div class="TITULO">
        <h1>CATÁLOGO</h1>
    </div>
    <section class="contenedor-general">
        <div class="contenedor-items">
            <?php
            session_start();
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
            $sql = "SELECT id_producto, nombre_producto, categoria_producto, precio_producto FROM productos";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nombre_imagen = 'FRESA_' . strtoupper($row['categoria_producto']) . '.jpeg';
                    $ruta_imagen = './model/uploads/' . $nombre_imagen;
            ?>
                    <div class="item">
                        <span class="titulo-item"><?php echo $row['categoria_producto']; ?></span>
                        <?php if (file_exists($ruta_imagen)) { ?>
                            <img src="<?php echo $ruta_imagen; ?>" alt="<?php echo $row['categoria_producto']; ?>" class="img-item">
                        <?php } else { ?>
                            <img src="ruta/imagen/por/defecto.jpg" alt="Imagen por defecto" class="img-item">
                        <?php } ?>
                        <h6>*EL PRECIO DE VENTA ES POR "CANASTILLA = 8KG"</h6>
                        <span class="precio-item">$<?php echo $row['precio_producto']; ?></span>
                        <button class="boton-item">Agregar al carrito</button>
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

    <div class="carrito">
        <div class="header-carrito">
            <h2>Tu carrito</h2>
        </div>
        <div class="carrito-items">
        </div>
        <div class="carrito-total">
            <div class="fila">
                Total: <span id="total-carrito">$0.00</span>
                <span class="carrito-precio-total">
                </span>
            </div>

            <a id="btn-generar-factura" href="#" onclick="generarFactura()">Generar Factura</a>

        </div>
    </div>
    <div id="section-contacto">

        <?php include_once('../FRESAS_ARTURO/view/layout/footers/footer-usuarios.php') ?>
    </div>

    <script src="../FRESAS_ARTURO/resource/js/catalogo.js" async></script>



</body>

</html>