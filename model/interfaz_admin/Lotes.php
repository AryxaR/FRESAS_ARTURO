<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/lotess.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <title>Ingreso de Cantidades Recogidas</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");
        .btn-volver {
            
            margin-left: -480%;
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
    </style>
</head>

<body>
    <h1>REGISTRO DE COSECHA</h1>
    <form class="contenedor" action="../../../FRESAS_ARTURO/controller/lotes.php" method="post">
    <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <label for="cantidad_extra">Fresas Extra: </label>
        <input type="number" id="cantidad_extra" name="cantidad_extra" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_primera">Fresas Primera:</label>
        <input type="number" id="cantidad_primera" name="cantidad_primera" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_segunda">Fresas Segunda:</label>
        <input type="number" id="cantidad_segunda" name="cantidad_segunda" min="0" required placeholder="Kg"><br><br>
        
        <label for="cantidad_riche">Fresas Riche:</label>
        <input type="number" id="cantidad_riche" name="cantidad_riche" min="0" required placeholder="Kg"><br><br>
        
        <input class="boton" type="submit" value="Enviar">
    </form>
</body>
</html>
