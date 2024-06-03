<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../../FRESAS_ARTURO/resource/css/guardarClave.css">
    <link rel="icon" href="../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <!-- sweeralert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
    <span class="fondo"></span>
    <section class="contenedor">
        <div class="icons">
            <span class="material-symbols-outlined">
                encrypted
            </span>
        </div>
        <div class="form-guardar">
            <h1>Crear contraseña</h1>
            <form class="formulario-guardar" action="../../../FRESAS_ARTURO/controller/config_guardarClave.php"
                method="post">
                <input class="visible" type="password" name="contrasena" id="contrasena" required>
                <label class="contrasena" for="contrasena">Nueva contraseña</label>
                <span id="ojo" class="material-symbols-outlined" >
                    visibility
                </span>
                <span class="mostrar">Mostrar contraseñas</span>
                <input class="visible" type="password" name="confirmar_contrasena" id="confirmar_contrasena" required>
                <label class="confirmar-contrasena" for="confirmar_contrasena">Confirmar contraseña</label>
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <button class="btn-guardar" type="submit">Guardar contraseña</button>
            </form>
            <a href="../../FRESAS_ARTURO/model/login_usuarios.php" class="regresar">Inicio de sesion</a>
        </div>
    </section>

    <script>
        var icon = document.getElementById('ojo');
        var password = document.querySelectorAll('.visible');
        var mostrar  = document.querySelector('.mostrar');

            icon.addEventListener('click', function () {
                password.forEach(function (pass) {
                    if (pass.type === "password") {
                        pass.type = "text";
                        icon.textContent = 'visibility_off';
                        mostrar.textContent = 'Ocultar contraseñas';
                    } else {
                        pass.type = "password";
                        icon.textContent = 'visibility';
                        mostrar.textContent = 'Mostrar contraseñas';

                    }
                });
            });

    </script>
</body>

</html>