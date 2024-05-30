<?php
// Establecer el tipo de contenido y el conjunto de caracteres
header("Content-Type: text/html; charset=utf-8");

// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyectoo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// biblioteca fpdf
require('../banckup/fpdf186/fpdf.php');

// Función para generar una tabla PDF
function generarTablaPDF($pdf, $titulo, $headers, $sql, $conn) {

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,$titulo,0,1,'C');

    // Headers
    $pdf->SetFont('Arial','B',5);
    foreach ($headers as $header) {
        $pdf->Cell($header['width'], 10, $header['text'], 1, 0, 'C');
    }
    $pdf->Ln();

    // Datos
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            foreach ($headers as $header) {
                $pdf->Cell($header['width'], 10, $row[$header['column']], 1, 0, 'C');
            }
            $pdf->Ln();
        }
    }
}

// Crear objeto PDF
$pdf = new FPDF();

// Generar tabla 1
generarTablaPDF($pdf, 'Tabla Cargos', [
    ['text' => 'ID Cargo', 'width' => 30, 'column' => 'id_cargo'],
    ['text' => 'Nombre Cargo', 'width' => 50, 'column' => 'nombre_cargo']
], "SELECT * FROM cargos", $conn);

// generar tabla 2
generarTablaPDF($pdf, 'Tabla Detalle Venta', [
    ['text' => 'ID Factura', 'width' => 25, 'column' => 'id_factura'],
    ['text' => 'Nombre Cliente', 'width' => 35, 'column' => 'nombre_cliente'],
    ['text' => 'Telefono', 'width' => 30, 'column' => 'telefono'],
    ['text' => 'Cantidad Productos', 'width' => 35, 'column' => 'cantidad_productos'],
    ['text' => 'Precio Total', 'width' => 30, 'column' => 'precio_total'],
    ['text' => 'Fecha Creacion', 'width' => 40, 'column' => 'fecha_creacion']
], "SELECT * FROM detalleventa", $conn);

// Generar tabla 3: Tabla Historial Precios
generarTablaPDF($pdf, 'Tabla Historial Precios', [
    ['text' => 'ID Historial', 'width' => 30, 'column' => 'id_historial'],
    ['text' => 'ID Producto', 'width' => 30, 'column' => 'id_producto'],
    ['text' => 'Precio Anterior', 'width' => 30, 'column' => 'precio_anterior'],
    ['text' => 'Precio Nuevo', 'width' => 30, 'column' => 'precio_nuevo'],
    ['text' => 'Fecha', 'width' => 40, 'column' => 'fecha']
], "SELECT * FROM historial_precios", $conn);

// Generar tabla 4: Tabla Insumos
generarTablaPDF($pdf, 'Tabla Insumos', [
    ['text' => 'ID Insumo', 'width' => 20, 'column' => 'Id_insumo'],
    ['text' => 'ID Proveedor', 'width' => 22, 'column' => 'Id_proveedor'],
    ['text' => 'ID Recurso', 'width' => 22, 'column' => 'Id_recurso'],
    ['text' => 'Categoria', 'width' => 30, 'column' => 'Categoria'],
    ['text' => 'Nombre Insumo', 'width' => 35, 'column' => 'Nombre_insumo'],
    ['text' => 'Costo Producto', 'width' => 28, 'column' => 'Costo_producto'],
    ['text' => 'Fecha Ingreso', 'width' => 35, 'column' => 'Fecha_ingreso']
], "SELECT * FROM insumos", $conn);

// Generar tabla 5: Tabla Lotes
generarTablaPDF($pdf, 'Tabla Lotes', [
    ['text' => 'ID Lote', 'width' => 15, 'column' => 'id_lote'],
    ['text' => 'Fecha Recogida', 'width' => 40, 'column' => 'fecha_recogida'],
    ['text' => 'ID Producto', 'width' => 20, 'column' => 'id_producto'],
    ['text' => 'Cantidad Extra', 'width' => 20, 'column' => 'cantidad_recogida_extra'],
    ['text' => 'Cantidad Primera', 'width' => 20, 'column' => 'cantidad_recogida_primera'],
    ['text' => 'Cantidad Segunda', 'width' => 20, 'column' => 'cantidad_recogida_segunda'],
    ['text' => 'Cantidad Riche', 'width' => 20, 'column' => 'cantidad_recogida_riche']
], "SELECT * FROM lotes", $conn);

// Generar tabla 6: Tabla Productos
generarTablaPDF($pdf, 'Tabla Productos', [
    ['text' => 'ID Producto', 'width' => 20, 'column' => 'id_producto'],
    ['text' => 'Nombre Producto', 'width' => 50, 'column' => 'nombre_producto'],
    ['text' => 'Categoria Producto', 'width' => 40, 'column' => 'categoria_producto'],
    ['text' => 'Precio Producto', 'width' => 30, 'column' => 'precio_producto'],
    ['text' => 'Stock', 'width' => 20, 'column' => 'Stock']
], "SELECT * FROM productos", $conn);

// Generar tabla 7: Tabla Proveedores
generarTablaPDF($pdf, 'Tabla Proveedores', [
    ['text' => 'ID Proveedor', 'width' => 25, 'column' => 'Id_proveedor'],
    ['text' => 'Nombre Proveedor', 'width' => 60, 'column' => 'Nombre_proveedor'],
    ['text' => 'Telefono Proveedor', 'width' => 40, 'column' => 'Telefono_proveedor']
], "SELECT * FROM proveedores", $conn);

// Generar tabla 8: Tabla Recursos
generarTablaPDF($pdf, 'Tabla Recursos', [
    ['text' => 'Tipo', 'width' => 30, 'column' => 'Tipo'],
    ['text' => 'Stock', 'width' => 20, 'column' => 'Stock'],
    ['text' => 'ID Proveedor', 'width' => 30, 'column' => 'Id_proveedor']
], "SELECT * FROM recursos", $conn);

// Generar tabla 9: Tabla User
generarTablaPDF($pdf, 'Tabla User', [
    ['text' => 'ID', 'width' => 8, 'column' => 'id'],
    ['text' => 'Nombre', 'width' => 30, 'column' => 'nombre'],
    ['text' => 'Correo', 'width' => 40, 'column' => 'correo'],
    ['text' => 'Telefono', 'width' => 30, 'column' => 'telefono'],
    ['text' => 'Password', 'width' => 30, 'column' => 'password'],
    ['text' => 'Fecha', 'width' => 37, 'column' => 'fecha'],
    ['text' => 'Rol', 'width' => 15, 'column' => 'rol']
], "SELECT * FROM user", $conn);

// Generar tabla 10: Tabla Usuarios
generarTablaPDF($pdf, 'Tabla Usuarios', [
    ['text' => 'ID', 'width' => 5, 'column' => 'Id_cliente'],
    ['text' => 'Cedula', 'width' => 15, 'column' => 'Cedula'],
    ['text' => 'Nombre', 'width' => 16, 'column' => 'Nombre'],
    ['text' => 'Correo', 'width' => 30, 'column' => 'Correo'],
    ['text' => 'Contraseña', 'width' => 70, 'column' => 'contrasena'],
], "SELECT * FROM usuarios", $conn);

generarTablaPDF($pdf, 'Tabla Usuarios', [

['text' => 'Rol', 'width' => 16, 'column' => 'Rol'], 
['text' => 'Cargos', 'width' => 10, 'column' => 'cargos'],
['text' => 'Token', 'width' => 40, 'column' => 'token'],
['text' => 'Fecha Expiracion', 'width' => 20, 'column' => 'fecha_expiracion'],
['text' => 'Estado', 'width' => 20, 'column' => 'Estado']
], "SELECT * FROM usuarios", $conn);


// Nombre del archivo PDF
$filename = 'backup_información.pdf';

// Guardar el archivo PDF en el servidor
$pdf->Output('F', $filename);

// Descargar el archivo PDF cuando se haga clic en el botón
header("Content-disposition: attachment; filename=" . $filename);
header("Content-type: application/pdf");
readfile($filename);

// Cerrar conexión
$conn->close();
?>
