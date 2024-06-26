<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover pasword</title>
    <link rel="stylesheet" href="../resource/css/envioCorreo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="../resource/img/icons/strawberry.png" type="image/png">


    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <span class="f-roja"></span>
    <section class="contenedor">
        <div class="icons">
            <span class="material-symbols-outlined">
                lock
            </span>
            <span class="material-symbols-outlined">
          password
            </span>
        </div>
        <div class="form-clave">
            <h1 class="titulo">Recuperación de Contraseña</h1>
            <form class="formulario-clave" method="POST" action="../controller/config_enviarCorreo.php">
                <input class="input-correo" type="email" name="correo" maxlength="35" required>
                <label class="label-correo" for="correo">Ingrese su correo</label>
                <input type="submit" value="Enviar" name="enviar" class="btn-enviar">
                <a href="../../FRESAS_ARTURO/model/login_usuarios.php" class="regresar">Regresar al inicio de sesion</a>
            </form>
        </div>

    </section>
    <?php
    if (isset($_GET['msj_inex'])) {
        $msj_exito = $_GET['msj_inex'];
    }
    ?>
    <script>
        // ALERT CORREO INEXISTENTE

        if (window.location.search.includes('msj_inex')) {
            Swal.fire({
                icon: "error",
                title: "Correo Inválido.",
                text: "El correo ingresado no se encuentra registrado",
                footer: '<a href="login_usuarios.php?click">Registrarse</a>'
            });
        }
    </script>
</body>

</html>