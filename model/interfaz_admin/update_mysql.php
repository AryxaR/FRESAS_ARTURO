<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZACION</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            font-family: Arial, sans-serif;
            background-image: url();
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;

        }

        .container {
            text-align: center;
            max-width: 500px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            position: relative;
        }

        .btn-volver {
            position: left;
            top: 20px;
            margin-left: -250%;
            color: white;
            background-color: #d22c5d;
            border: none;
            font-size: 24px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
        }


        .btn-volver:hover{
            border: 1px solid #d22c5d;
            color:#d22c5d;
            background-color: white;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            box-sizing: border-box;
            margin-top: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            text-align: center; 
        }

        form input[type="text"],
        form input[type="email"] {
            width: 70%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
            font-family: 'Poppins', sans-serif;

        }

        form input[type="submit"] {
            padding: 0.6rem;
            color: white;
            background-color: #d22c5d;
            border-radius: 0.4rem;
            border: 1px solid #d22c5d;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
            font-family: 'Poppins', sans-serif;

        }

        form input[type="submit"]:hover {
            border: 1px solid #d22c5d;
            color:#d22c5d;
            background-color: white;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <h2>MODIFICACIÓN DE USUARIOS</h2>
        <?php
        require_once '../../../FRESAS_ARTURO/controller/conexion.php';

        // Verificar si se ha enviado un formulario para actualizar
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];

        $sql_select = "SELECT * FROM usuarios WHERE Id_cliente= $id";
        $result = $conn->query($sql_select);

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        ?>
        <form action="../../../FRESAS_ARTURO/controller/controlers-admin/update_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['Id_cliente']; ?>">
            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" value="<?php echo $row['Nombre']; ?>"><br><br>
            <label for="Correo">Correo:</label>
            <input type="email" name="Correo" value="<?php echo $row['Correo']; ?>"><br><br>
            <label for="Rol">Rol:</label>
            <input type="text" name="Rol" value="<?php echo $row['Rol']; ?>"><br><br>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
        <?php
        } else {
            echo "Usuario no encontrado.";
        }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>

