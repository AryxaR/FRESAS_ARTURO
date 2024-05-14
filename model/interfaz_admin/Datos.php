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
 include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
?>
<br><br><br><br><br>

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
            padding: 20px;
        }

        .TITULO {
            text-align: center; /* Centra el texto horizontalmente */
            font-size: 24px; /* Tamaño de la fuente */
            font-weight: bold; /* Negrita */
            text-shadow: 2px 2px 4px #888888; /* Aplica relieve al texto */
        }

        .back-button {
            position: absolute;
            display: flex;
            align-items: center;
            left: 20px;
            font-size: 26px;
            padding: 3px 3px 9px 3px;
            border-radius: 5px;
            background-color: #d22c5d;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button:hover {
            background-color: white;
            /* Color de fondo blanco al pasar el mouse */
            color: #d22c5d;
            /* Color de la letra rojo al pasar el mouse */
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

        .footer-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            margin-left: -1.5%;
            background-color: #8B0000;
            /* Puedes ajustar el color de fondo según tus necesidades */
            color: white;
            /* Puedes ajustar el color del texto según tus necesidades */
            display: flex;
            justify-content: space-between;
            padding: 16px;
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

    <a href="javascript:history.go(-1)" class="back-button">&#8592;</a>

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
</body>
<?php
echo "<br><br><br><br><br>";
include_once '../../view/layout/footer-admin.html';
?>

</html>