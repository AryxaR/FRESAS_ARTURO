<?php
// Recibir los datos del carrito
$itemsFactura = json_decode(file_get_contents('php://input'), true);

// Calcular el total
$total = 0;
$html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Factura</title>
    <style>
        /* Estilos para la factura */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Factura de Compra</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        
        <tbody>";

foreach ($itemsFactura as $item) {
    $subtotal = $item['cantidad'] * $item['precioUnitario'];
    $total += $subtotal;
    $html .= "<tr>
                <td>{$item['titulo']}</td>
                <td>{$item['cantidad']}</td>
                <td>{$item['precioUnitario']}</td>
                <td>{$subtotal}</td>
            </tr>";
}

$html .= "</tbody>
    </table>
    <p>Total a Pagar: {$total}</p>
</body>
</html>";

// Devolver la factura en HTML
echo $html;
?>
