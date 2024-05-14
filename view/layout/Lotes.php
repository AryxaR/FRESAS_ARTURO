<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/lotes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
   <!-- accesibiliad -->
    <script src="https://cdn.userway.org/widget.js" data-account="BD1vuC76ZG"></script>
    <style>
        body .uwy.userway_p1 .userway_buttons_wrapper {
            top:150px !important;
        }
    </style>
    <title>Ingreso de Cantidades Recogidas</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

</style>

<body>

<?php include_once('../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php') ?>


    <h1>REGISTRO DE COSECHA</h1>
    <form class="contenedor" action="../../controller/lotes.php" method="post">
        <label for="categoria_extra">Fresas Extra: </label>
        <input type="number" id="categoria_extra" name="cantidad_recogida_extra" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_primera">Fresas Primera:</label>
        <input type="number" id="categoria_primera" name="cantidad_recogida_primera" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_segunda">Fresas Segunda:</label>
        <input type="number" id="categoria_segunda" name="cantidad_recogida_segunda" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_riche">Fresas Riche:</label>
        <input type="number" id="categoria_riche" name="cantidad_recogida_riche" min="0" required placeholder="Kg"><br><br>
        
        <input class="boton" type="submit" value="Enviar">
    </form>

    <?php include_once('../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php') ?>
</body>
</html>
