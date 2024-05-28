<?php
// Realiza la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verifica si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id_proveedor = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_proveedor) {
    $sql = "SELECT p.Id_proveedor, p.Nombre_proveedor, p.Telefono_proveedor, 
    r.Tipo AS Tipo_recurso, 
    i.Nombre_insumo, r.Stock, i.Fecha_ingreso
        FROM proveedores p
        INNER JOIN recursos r ON p.Id_proveedor = r.Id_proveedor
        INNER JOIN insumos i ON r.Id_recursos = i.Id_recurso
        WHERE p.Id_proveedor = " . $conexion->real_escape_string($id_proveedor);


    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // Si hay resultados, obtener los datos del primer registro
        $row = $resultado->fetch_assoc();
        $nombre_proveedor = $row['Nombre_proveedor'];
        $telefono_proveedor = $row['Telefono_proveedor'];
        $tipo_recurso = $row['Tipo_recurso'];
        $nombre_insumo = $row['Nombre_insumo'];
        $stock = $row['Stock'];
        $fecha_ingreso = $row['Fecha_ingreso'];
    } else {
        echo "No se encontraron datos para el proveedor con ID $id_proveedor.";
    }
} else {
    echo "ID de proveedor no proporcionado.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>

<?php
// include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
 include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
?>
<br><br><br>

<div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/Proveedores.php">Proveedores</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Información</li>
            </ol>
        </nav>
    </div>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/nav.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <title>DATOS | PROVEEDOR</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(../../../FRESAS_ARTURO//resource//img/index//fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
        }

        .TITULO {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }

        .contenedor-datos {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2% 6%;
        }

        
        .breadcrumbs-container {
            display: flex;
            margin-top: 1%;
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
        
        .btn-volver {
            
            margin-left: -92%;
            margin-top: 1%;
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

        table {
            width: 50%;
            margin: 100px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f8eaef;
            /* Color de fondo para todas las celdas */
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #d22c5d;
            text-align: left;
            transition: background-color 0.3s;
            /* Transición para el cambio de color al pasar el mouse */
        }

        th {
            background-color: #f8eaef;
            color: black;
        }

        th:hover {
            background-color: #d22c5d;
        }

        td {
            background-color: #f8eaef;
            /* Color de fondo inicial para las celdas */
        }

        td:hover {
            background-color: #d22c5d;
            /* Cambio de color al pasar el mouse */
        }
    </style>
</head>

<body>
    <div class="contenedor-datos">


    <button class="btn-volver" onclick="history.back()">&#8592;</button>

        <h1 class="TITULO">INFORMACIÓN PROVEEDOR</h1>
        <?php if ($id_proveedor && isset($nombre_proveedor)) : ?>
            <table>
                <tr>
                    <th>Nombre del Proveedor</th>
                    <td><?php echo $nombre_proveedor; ?></td>
                </tr>
                <tr>
                    <th>Teléfono del Proveedor</th>
                    <td><?php echo $telefono_proveedor; ?></td>
                </tr>
                <tr>
                    <th>Recurso Registrado</th>
                    <td><?php echo $tipo_recurso; ?></td>
                </tr>
                <tr>
                    <th>Insumo Ingresado</th>
                    <td><?php echo $nombre_insumo; ?></td>
                </tr>
                <tr>
                    <th>Cantidad (Stock)</th>
                    <td><?php echo $stock; ?> kg</td>
                </tr>
                <tr>
                    <th>Fecha de Ingreso</th>
                    <td><?php echo $fecha_ingreso; ?></td>
                </tr>
            </table>
        <?php elseif ($id_proveedor) : ?>
            <p>No se encontraron datos para el proveedor con ID <?php echo $id_proveedor; ?>.</p>
        <?php else : ?>
            <p>ID de proveedor no proporcionado.</p>
        <?php endif; ?>
    </div>
</body>
<?php
echo "<br><br>";
include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
?>

</html>