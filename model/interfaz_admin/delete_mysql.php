<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELIMINACION USUARIOS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../Resource/IMG/fondonitido.png);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .eliminar-btn {
            background-color: #d22c5d;
            color: white;
            border: 1px solid #d22c5d;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.6s, color 0.6s;
            cursor: pointer;
        }

        .eliminar-btn:hover {
            background-color: white;
            color: #d22c5d;
            border: 1px solid #d22c5d;
        }

        table {
            width: 140%;
            margin-left: -25%;
            border-collapse: collapse;
            border: 2px solid #ddd; /* Borde para la tabla */
        }

        th, td {
            padding: 8px;
            text-align: center;
            border-bottom: 2px solid #ddd;
            border-right: 2px solid #ddd; /* Borde vertical entre celdas */
        }

        th {
            background-color: #f8eaef;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }

        /* Eliminar borde derecho de la última columna */
        th:last-child, td:last-child {
            border-right: none;
        }

        .btn-volver {
            background-color: #d22c5d;
            color: white;
            border: none;
            font-size: 24px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 120px;
            transition: background-color 0.6s, color 0.6s;
        }

        .btn-volver:hover {
            background-color: white;
            color: #d22c5d;
            border: 1px solid #d22c5d;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 100px;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }
    </style>
</head>
<body>
    <button class="btn-volver" onclick="history.back()">&#8592;</button>
    <div class="container">
        <h1>ELIMINACION DE USUARIOS</h1>

        <?php
        require_once '../../../FRESAS_ARTURO/controller/conexion.php';

        $sqlselect = "SELECT Id_cliente, Cedula, Nombre, Correo, Contrasena, Rol FROM usuarios";
        $result = $conn->query($sqlselect);

        if($result->num_rows > 0){
            echo "<table>";
            echo "<tr>
                    <th>Id</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contrasena</th>
                    <th>Rol</th>
                    <th>ACCIÓN</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Id_cliente"] . "</td>";
                echo "<td>" . $row["Cedula"] . "</td>";
                echo "<td>" . $row["Nombre"] . "</td>";
                echo "<td>" . $row["Correo"] . "</td>";
                echo "<td>" . $row["Contrasena"] . "</td>";
                echo "<td>" . $row["Rol"] . "</td>";
                echo "<td>";
                echo "<form action='../../../FRESAS_ARTURO/controller/controlers-admin/delete_process.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["Id_cliente"] . "'>";
                echo "<input type='submit' class='eliminar-btn' value='Eliminar'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron registros";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
