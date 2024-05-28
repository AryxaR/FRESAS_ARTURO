<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_insumo']) && isset($_POST['Costo_producto'])) {

    require_once '../../controller/conexion.php';

    $nombre_insumo = $_POST['nombre_insumo'];
    $costo_producto = $_POST['Costo_producto'];
    $categoria = $_POST['Categoria'];

    $id_proveedor = $_SESSION['id_proveedor'];
    $id_recurso = $_SESSION['id_recurso'];

    $sql = "INSERT INTO Insumos (Id_proveedor, Id_recurso, Categoria, Nombre_insumo, Costo_producto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param("iisss", $id_proveedor, $id_recurso, $_SESSION['tipo_recurso'], $nombre_insumo, $costo_producto);

        if ($stmt->execute()) {

            $msj_proveedor = 'Proveedor e Insumo registrado correctamente';
            header("Location: Proveedores.php?msj_proveedor= $msj_proveedor");
            exit();
        } else {
            echo "Error al guardar el insumo en la base de datos: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }


    $stmt->close();
    $conn->close();
} 
?>

<?php
include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
?>
<br><br><br>
<div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/Proveedores.php">Proveedores</a></li>
                <li class="breadcrumb-item"><a href="../../model/interfaz_admin/insert_proveedor.php">Nuevo proveedor</a></li>
                <li class="breadcrumb-item dos" aria-current="page"><a href="insert_proveedor.php">Recurso proveedor</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Insumo proveedor</li>
            </ol>
        </nav>
    </div>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/nav.css" />
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/footer.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <style>
     @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
        font-family: Arial, sans-serif;
        background-image: url(../../../FRESAS_ARTURO/resource/img/index/fondonitido.png);
        color: #d22c5d;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: black;
            margin-top: 3%;
            text-align: center; /* Centra el texto horizontalmente */
            font-size: 24px; /* Tamaño de la fuente */
            font-weight: bold; /* Negrita */
            text-shadow: 2px 2px 4px #888888;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: 1%;
            margin-left: 4.5%;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
            
        }

        .breadcrumb {
            display: flex;
            padding: 0;
            margin: 0;

        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            color: black;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            margin: 0 7px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Hace que el formulario ocupe todo el espacio disponible verticalmente */
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            margin: 0 auto; /* Centra el formulario horizontalmente */
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
            text-align: center;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #d22c5d;
            border-radius: 4px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"] {
           
            padding: 0.6rem;
            color: white;
            background-color: #d22c5d;
            border-radius: 0.4rem;
            border: 1px solid #d22c5d;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
            margin-top: 10px; /* Añade un margen superior al botón */
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"]:hover {
            border: 1px solid #d22c5d;
            color:#d22c5d;
            background-color: white;
        }

        .footer-bottom {
                    position: relative;
                    width: 100%;
                    background-color: #8B0000;
                    color: white;
                    display: flex;
                    justify-content: space-between;
                    padding: 16px;
                    bottom: 0; /* Ajusta la posición del footer al final de la ventana del navegador */
                left: 0;
                }
                
                .footer-bottom small {
                    font-size: 20px;
                    font-weight: 500;
                }
                
                .footer-bottom-info-center {
                    display: flex;
                    gap: 7px;
                }


    </style>

</head>
<body>
    <div class="title-container">
        <h2>INSUMOS</h2>
    </div>

    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nombre_insumo">Nombre del Insumo:</label><br>
            <input type="text" id="nombre_insumo" name="nombre_insumo" required><br>

            <label for="Categoria">Categoría:</label><br>
            <input type="text" id="Categoria" name="Categoria" value="<?php echo $_SESSION['tipo_recurso']; ?>" readonly><br>

            <label for="Costo_producto">Costo del Producto:</label><br>
            <input type="number" id="Costo_producto" name="Costo_producto" required><br>

<input type="submit" value="Registrar Insumo">
</form>
</div>
</body>
<?php
    echo "<br><br><br>";
    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
    ?>
</html>
