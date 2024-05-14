<?php
// Realiza la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verifica si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id_lotes = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_lotes) {
    $sql = "SELECT 
                cantidad_recogida_extra, 
                cantidad_recogida_primera, 
                cantidad_recogida_segunda, 
                cantidad_recogida_riche,
                fecha_recogida
            FROM lotes 
            WHERE id_lote = " . $conexion->real_escape_string($id_lotes);

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // Si hay resultados, obtener los datos
        $row = $resultado->fetch_assoc();
        $cantidad_recogida_extra = $row['cantidad_recogida_extra'];
        $cantidad_recogida_primera = $row['cantidad_recogida_primera'];
        $cantidad_recogida_segunda = $row['cantidad_recogida_segunda'];
        $cantidad_recogida_riche = $row['cantidad_recogida_riche'];
        $fecha_recogida = $row['fecha_recogida'];
        
        // Calcular el stock total sumando las cantidades de cada producto
        $stock_total = $cantidad_recogida_extra + $cantidad_recogida_primera + $cantidad_recogida_segunda + $cantidad_recogida_riche;

        // Ahora puedes usar estos valores como desees, por ejemplo, mostrarlos en pantalla
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>DATOS | COSECHAS</title>
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
                }

                th {
                    background-color: #f8eaef;
                    color: black;
                }

                td {
                    background-color: #f8eaef;
                }
            </style>
        </head>
        <body>
            <h1 class="TITULO">INFORMACIÓN COSECHAS</h1>
            <?php if ($id_lotes && isset($id_lotes)) : ?>
                <table>
                    <tr>
                        <th>Cantidad extra</th>
                        <td><?php echo $cantidad_recogida_extra; ?></td>
                    </tr>
                    <tr>
                        <th>Cantidad primera</th>
                        <td><?php echo $cantidad_recogida_primera; ?></td>
                    </tr>
                    <tr>
                        <th>Cantidad Segunda</th>
                        <td><?php echo $cantidad_recogida_segunda; ?></td>
                    </tr>
                    <tr>
                        <th>Cantidad riche</th>
                        <td><?php echo $cantidad_recogida_riche; ?></td>
                    </tr>
                    <tr>
                        <th>Cantidad (Stock)</th>
                        <td><?php echo $stock_total; ?> kg</td>
                    </tr>
                    <tr>
                        <th>Fecha recogida</th>
                        <td><?php echo $fecha_recogida; ?></td>
                    </tr>
                </table>
            <?php elseif ($id_lotes) : ?>
                <p>No se encontraron datos para el lote con ID <?php echo $id_lotes; ?>.</p>
            <?php else : ?>
                <p>ID del lote no proporcionado.</p>
            <?php endif; ?>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontraron datos para el lote con ID $id_lotes.";
    }
} else {
    echo "ID de lotes no proporcionado.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
