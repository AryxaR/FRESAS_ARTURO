<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Register - MagtimusPro</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../FRESAS_ARTURO/resource/css/login.css">
</head>

<body>

    <main>

        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion" class="resetear">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse" class="resetear">Regístrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="../controller/login.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="Cedula" name="Cedula" required>
                    <input class="visible" type="password" placeholder="Contraseña" name="Contrasena" required>
                    <span class="material-symbols-outlined">
                        visibility
                    </span>
                    <a class="olvidar" href="../../FRESAS_ARTURO/model/enviarCorreo.php">¿Has olvidado tu
                        contraseña?</a>
                    <button>Entrar</button>
                </form>

                <!--Register-->
                <form action="../controller/registro.php" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre completo" name="Nombre" required>
                    <input type="number" placeholder="Cedula" name="Cedula" required>
                    <input type="email" placeholder="Correo Electronico" name="Correo" required>
                    <input class="visible" type="password" placeholder="Contraseña" name="Contrasena" required>
                    <span class="material-symbols-outlined" id="ojo">
                        visibility
                    </span>
                    <select class="text" name="Rol" required>
                        <option value="Mayorista">Mayorista</option>
                        <option value="Minorista">Minorista</option>
                    </select>
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>

    </main>
    <script>

        var icons = document.querySelectorAll('.material-symbols-outlined');
        var password = document.querySelectorAll('.visible');

        icons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                password.forEach(function (pass) {
                    if (pass.type === "password") {
                        pass.type = "text";
                        icon.textContent = 'visibility_off';
                    } else {
                        pass.type = "password";
                        icon.textContent = 'visibility';

                    }
                });
            });

        });

        document.addEventListener('DOMContentLoaded', function () {
            var resetButtons = document.querySelectorAll('.resetear');
            var formulario1 = document.querySelector('.formulario__login');
            var formulario2 = document.querySelector('.formulario__register');

            resetButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    formulario1.reset();
                    formulario2.reset();
                });
            });
        });

    </script>

    <script src="../resource/js/script.js"></script>
</body>

</html>