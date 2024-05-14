<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
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
       }

       .btn-volver {
        width: 20px;
        align-self: self-start;
       }

       .formulario-cosechas {
        margin-top: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
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
        if(isset($_GET['id']) && is_numeric($_GET['id'])){
            $id = $_GET['id'];

            $sql_select = "SELECT id,cantidad_extra, cantidad_primera, cantidad_segunda, cantidad_riche FROM lotes WHERE id = $id";

            $result = $conn->query($sql_select);
            
            
            if($result->num_rows == 1) {
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
            <input type="submit" name="actualizar" value="Actualizar">
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
<?php include_once '../../view/layout/footers/footer-admin.php'; ?>
</html>

