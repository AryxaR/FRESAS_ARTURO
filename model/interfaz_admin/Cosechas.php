<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table de Cosechas de Fresas</title>
    <link rel="stylesheet" href="./r">
</head>
<body>
    <div class="container">
        <h1>Data Table de Cosechas de Fresas</h1>
        <table id="datatable">
            <thead>
                <tr>
                    <th>ID Lote</th>
                    <th>Fecha de Recogida</th>
                    <th>ID Producto</th>
                    <th>Cantidad Recogida Extra</th>
                    <th>Cantidad Recogida Primera</th>
                    <th>Cantidad Recogida Segunda</th>
                    <th>Cantidad Recogida Riche</th>
                </tr>
            </thead>
            <tbody id="datatable-body">
                <!-- Aquí se agregarán las filas con datos de la base de datos -->
            </tbody>
        </table>
    </div>
    <script src="Cosechas.js"></script>
</body>
</html>
