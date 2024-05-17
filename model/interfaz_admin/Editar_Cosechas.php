<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>ACTUALIZACION</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        .container-editar-cosechas {
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 60px;
            border: solid black 1px;
            margin-top: 50px;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        h2{
            margin-top: -2%;
            font-family: 'Poppins', sans-serif;
        }

        .btn-volver {
            
            margin-left: -58%;
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

        .formulario-cosechas {
            margin-top: 2%;
            background-color: #f2f2f2;
            padding: 20px;
            border: solid 2px black;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-height: 600px;
            text-align: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>

<body>

    <?php

    use SebastianBergmann\Environment\Console;

    include_once '../../view/layout/navs/nav-admin-redirect.php'; ?>
    <h1>Pruebaaaaaa</h1>
    <div class="container-editar-cosechas">
    <button class="btn-volver" onclick="history.back()">&#8592;</button>
        <h2>MODIFICAR COSECHAS</h2>
        <?php
        require_once '../../../FRESAS_ARTURO/controller/conexion.php';

        // Verificar si se ha enviado un formulario para actualizar
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $sql_select = "SELECT id,cantidad_extra, cantidad_primera, cantidad_segunda, cantidad_riche FROM lotes WHERE id = $id";

            $result = $conn->query($sql_select);


            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
                <form class="formulario-cosechas" action="../../../FRESAS_ARTURO/model/interfaz_admin/modelo_editar_lote.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="cantidad_extra">Cantidad Extra:</label>
                    <input type="text" name="cantidad_extra" value="<?php echo $row['cantidad_extra']; ?>"><br><br>
                    <label for="cantidad_primera">Cantidas Primera:</label>
                    <input type="number" name="cantidad_primera" value="<?php echo $row['cantidad_primera']; ?>"><br><br>
                    <label for="cantidad_segunda">Cantidad segunda:</label>
                    <input type="text" name="cantidad_segunda" value="<?php echo $row['cantidad_segunda']; ?>"><br><br>
                    <label for="cantidad_riche">Cantidad riche:</label>
                    <input type="text" name="cantidad_riche" value="<?php echo $row['cantidad_riche']; ?>"><br><br>
                    <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>


                </form>
        <?php
            } else {
                echo "Registro no encontrado.";
            }
        }
        $conn->close();
        ?>
    </div>
</body>
<br><br><br><br>
<?php include_once '../../view/layout/footers/footer-admin.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>