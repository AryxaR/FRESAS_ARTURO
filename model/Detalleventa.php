<?php
// Recuperar los datos de la URL
$nombreCliente = urldecode($_GET['nombreCliente']);
$total = urldecode($_GET['total']);

// Mostrar los datos en la página de facturación
echo "Nombre del Cliente: " . $nombreCliente . "<br>";
echo "Total: $" . $total . "<br>";
// Resto del contenido de la página de facturación...
?>
