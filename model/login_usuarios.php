<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | FRESAS DON ARTURO</title>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Font google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- JS de Bootstrap -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="icon" href="../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle,
                    rgb(242, 207, 207) 0%,
                    rgb(255, 247, 247) 110%);
        }

        main {
            width: 100vw;
            height: 100vh;
            padding: 20px;
            margin: auto;
            display: flex;
            align-items: center;
            /* margin-top: 100px; */
        }

        .contenedor__todo {
            width: 100%;
            max-width: 800px;
            margin: auto;
            position: relative;
        }

        .caja__trasera {
            width: 100%;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            background-color: #e43a64;
            border-radius: 10px;

        }

        .caja__trasera div {
            margin: 100px 40px;
            color: white;
            transition: all 500ms;
        }


        .caja__trasera div p,
        .caja__trasera button {
            margin-top: 30px;
            font-family: 'Poppins', sans-serif;
        }

        .caja__trasera div h3 {
            font-weight: 400;
            font-size: 26px;
            font-family: 'Poppins', sans-serif;
        }

        .caja__trasera div p {
            font-size: 16px;
            font-weight: 300;
            font-family: 'Poppins', sans-serif;
        }

        .caja__trasera button {
            padding: 10px 40px;
            border: 2px solid #fff;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            background: transparent;
            font-weight: 600;
            cursor: pointer;
            color: white;
            outline: none;
            transition: all 300ms;
        }

        .caja__trasera button:hover {
            background: #fff;
            color: #e43a64;
        }

        /* ver contraseña */



        span#ojo-inicio {
            cursor: pointer;
            transform: translate(150px, -35px);
        }

        span#ojo-registro,
        span#ojo-confirm {
            transform: translate(303px, -35px);
            cursor: pointer;
        }

        /*Formularios*/

        .contenedor__login-register {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 380px;
            position: relative;
            top: -185px;
            left: 10px;

            /*La transicion va despues del codigo JS*/
            transition: left 500ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
        }

        .contenedor__login-register form {
            width: 100%;
            padding: 60px 20px 30px 20px;
            background: white;
            position: absolute;
            border-radius: 20px;
        }

        .contenedor__login-register form h2 {
            font-size: 30px;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            margin-bottom: 20px;
            color: #e43a64;
        }

        .contenedor__login-register form input {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            background: #F2F2F2;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            border: solid 1px black;
            border-radius: 10px;
        }

        .contenedor__login-register form button {
            border-radius: 10px;
            padding: 10px 40px;
            margin-top: 30px;
            border: none;
            font-size: 14px;
            background: #e43a64;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            color: white;
            outline: none;
        }

        .text {
            padding: 10px 10px;
            margin-top: 20px;
            width: 100%;
            font-size: 14px;
            background: #F2F2F2;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            color: rgb(118, 115, 115);
            outline: none;
            border: solid 1px rgba(0, 0, 0, 0.834);
        }

        .formulario__login .olvidar {
            color: rgb(209, 34, 34);
        }


        .formulario__login {
            text-align: center;
            opacity: 1;
            display: block;
        }

        .formulario__register {
            display: none;
        }

        .select {
            border-radius: 6px;
            border: solid 1px black;
            width: 100%;
            padding: 10px;
            color: black;
        }

        #btn-volver {
            font-size: 50px;
            color: #e43a64;
        }

        .contenedor-btn-registro {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .contenedor-volver {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .contenedor-olvidar {
            width: 100%;
        }

        @media screen and (max-width: 850px) {

            main {
                margin-top: 50px;
            }

            .caja__trasera {
                max-width: 350px;
                height: 300px;
                flex-direction: column;
                margin: auto;
            }

            .caja__trasera div {
                margin: 0px;
                position: absolute;
            }


            /*Formularios*/

            .contenedor__login-register {
                top: -10px;
                left: -5px;
                margin: auto;
            }

            .contenedor__login-register form {
                position: relative;
            }
        }

        @media screen and (max-width: 420px) {
            span#ojo-inicio {
                transform: translate(125px, -35px);
            }

            span#ojo-registro,
            span#ojo-confirm {
                transform: translate(290px, -35px);
            }
        }

        @media screen and (max-width: 395px) {
            span#ojo-inicio {
                transform: translate(110px, -35px);
            }

            span#ojo-registro,
            span#ojo-confirm {
                transform: translate(270px, -35px);
            }
        }

        @media screen and (max-width: 375px) {

            span#ojo-registro,
            span#ojo-confirm {
                transform: translate(240px, -35px);
            }
        }

        @media screen and (max-width: 345px) {
            span#ojo-inicio {
                transform: translate(90px, -35px);
            }

            span#ojo-registro,
            span#ojo-confirm {
                transform: translate(220px, -35px);
            }
        }


        @media screen and (max-width: 335px) {

            span#ojo-registro,
            span#ojo-confirm {
                transform: translate(200px, -35px);
            }
        }
    </style>
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
                    <!-- LOGICA PARA MOSTRAR UNA ALERTA CON BOOTSTRAP-->
                    <?php
                    if (isset($_GET['msj_error'])) {
                        $msj_error = $_GET['msj_error'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_error . '</div>';
                        echo $mostrar;
                        // header("refresh:2;url=login_usuarios.php");
                    }
                    ?>
                    <input type="number" id="cedulaIni" placeholder="Cedula" name="Cedula" required>
                    <input id="pass-inicio" class="visible" type="password" placeholder="Contraseña" name="Contrasena" maxlength="16" required>
                    <span class="material-symbols-outlined" id="ojo-inicio">
                        visibility
                    </span>
                    <div class="contenedor-olvidar">
                        <a class="olvidar" href="../../FRESAS_ARTURO/model/enviarCorreo.php">¿Has olvidado tu contraseña?</a>
                    </div>
                    <button>Entrar</button>
                    <div class="contenedor-volver">
                        <a class="volver" href="../Index.php">Volver al Inicio</a>
                    </div>
                </form>

                <!--Register-->
                <form id="emailForm" action="../controller/registro.php" method="POST" class="formulario__register">
                    <h2>Regístrarse</h2>
                    <!-- LOGICA PARA MOSTRAR UNA ALERTA CON BOOTSTRAP -->
                    <?php
                    if (isset($_GET['msj_error_2'])) {
                        $msj_error_2 = $_GET['msj_error_2'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_error_2 . '</div>';
                        echo $mostrar;
                    }
                    ?>
                    <?php
                    if (isset($_GET['msj_error_3'])) {
                        $msj_error_3 = $_GET['msj_error_3'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_error_3 . '</div>';
                        echo $mostrar;
                    }
                    ?>
                    <input type="text" placeholder="Nombre completo" name="Nombre" maxlength="30" required>
                    <!-- LOGICA PARA MOSTRAR UNA ALERTA CON BOOTSTRAP -->

                    <?php
                    echo '<br><br>';

                    if (isset($_GET['msj_error_cedula'])) {
                        $msj_error_cedula = $_GET['msj_error_cedula'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_error_cedula . '</div>';
                        echo $mostrar;
                    }
                    ?>

                    <input type="number" id="cedulaReg" placeholder="Cedula" name="Cedula" required>
                    <input id="email" type="email" placeholder="Correo Electronico" name="Correo" maxlength="35" required>

                    <!-- LOGICA PARA MOSTRAR UNA ALERTA CON BOOTSTRAP -->
                    <?php
                    echo '<br><br>';
                    if (isset($_GET['msj_error_caracter'])) {
                        $msj_error_caracter = $_GET['msj_error_caracter'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_error_caracter . '</div>';
                        echo $mostrar;
                    }
                    ?>
                    <input id="pass-registro" class="visible" type="password" placeholder="Contraseña" name="Contrasena" maxlength="16" required>
                    <span class="material-symbols-outlined" id="ojo-registro">
                        visibility
                    </span>
                    <?php
                    // echo '<br><br>';
                    if (isset($_GET['msj_confirm_clave'])) {
                        $msj_confirm_clave = $_GET['msj_confirm_clave'];
                        $mostrar = '<div class= "alert alert-danger" role="alert">' . $msj_confirm_clave . '</div>';
                        echo $mostrar;
                    }
                    ?>
                    <input id="pass-confirm" class="visible" type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar Contraseña" maxlength="16" required>
                    <span class="material-symbols-outlined" id="ojo-confirm">
                        visibility
                    </span>
                    <select class="select" class="text" name="Rol" required>
                        <option value="Mayorista">Mayorista</option>
                        <option value="Minorista">Minorista</option>
                    </select>
                    <div class="contenedor-btn-registro">
                        <button type="submit">Regístrarse</button>
                    </div>
                    <div class="contenedor-volver">
                        <a class="volver" href="../index.php">Volver al Inicio</a>
                    </div>
                </form>
            </div>
        </div>

    </main>
    <script>
        document.getElementById('cedulaReg').addEventListener('input', function(e) {
            var x = e.target.value;
            if (x.length > 10) {
                e.target.value = x.slice(0, 10);
            }
        });
        document.getElementById('cedulaIni').addEventListener('input', function(e) {
            var x = e.target.value;
            if (x.length > 10) {
                e.target.value = x.slice(0, 10);
            }
        });

        document.getElementById('emailForm').addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email');
            const emailValue = emailInput.value;
            const allowedDomains = ['gmail.com', 'hotmail.com'];

            // Extraer el dominio del correo
            const emailDomain = emailValue.substring(emailValue.lastIndexOf('@') + 1);

            // Verificar si el dominio está permitido
            if (!allowedDomains.includes(emailDomain)) {
                event.preventDefault(); // Prevenir el envío del formulario
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com",
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
                // alert('Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com');
            }
        });
    </script>
    <?php
    // RECEPCION DE VARIABLES DE OLVIDO CONTRASEÑA
    if (isset($_GET['msj_clave'])) {
        $msj_clave = $_GET['msj_clave'];
    }
    if (isset($_GET['msj_error_clave'])) {
        $msj_error_clave = $_GET['msj_error_clave'];
    }
    if (isset($_GET['msj_tiempo_clave'])) {
        $msj_tiempo_clave = $_GET['msj_tiempo_clave'];
    }
    if (isset($_GET['msj_validar_clave'])) {
        $msj_validar_clave = $_GET['msj_validar_clave'];
    }
    if (isset($_GET['msj_error_caracter_olvido'])) {
        $msj_error_caracter_olvido = $_GET['msj_error_caracter_olvido'];
    }

    // RECEPCION DE ALERTAS DE INICIO Y REGISTER
    if (isset($_GET['mensaje_inactivo'])) {
        $mensaje_inactivo = $_GET['mensaje_inactivo'];
    }

    if (isset($_GET['msj_registro'])) {
        $msj_registro = $_GET['msj_registro'];
    }

    if (isset($_GET['msj_exito'])) {
        $msj_exito = $_GET['msj_exito'];
    }
    if (isset($_GET['msj_error_mail'])) {
        $msj_exito = $_GET['msj_error_mail'];
    }

    if (isset($_GET['click'])) {
        $msj_exito = $_GET['click'];
    }

    // RECEPCION DE ACTIVACION DE USUARIO

    if (isset($_GET['msj_usuario_activo'])) {
        $msj_usuario_activo = $_GET['msj_usuario_activo'];
    }
    if (isset($_GET['msj_usuario_eliminado'])) {
        $msj_usuario_eliminado = $_GET['msj_usuario_eliminado'];
    }
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var iconInicio = document.getElementById('ojo-inicio');
            var iconRegistro = document.getElementById('ojo-registro');
            var iconConfirm = document.getElementById('ojo-confirm');
            var passInicio = document.getElementById('pass-inicio');
            var passRegistro = document.getElementById('pass-registro');
            var passConfirm = document.getElementById('pass-confirm');
            iconInicio.addEventListener('click', function() {
                if (passInicio.type === "password") {
                    passInicio.type = "text";
                    iconInicio.textContent = 'visibility_off';
                } else {
                    passInicio.type = "password";
                    iconInicio.textContent = 'visibility';
                }
            });
            iconRegistro.addEventListener('click', function() {
                if (passRegistro.type === "password") {
                    passRegistro.type = "text";
                    iconRegistro.textContent = 'visibility_off';
                } else {
                    passRegistro.type = "password";
                    iconRegistro.textContent = 'visibility';
                }
            });
            iconConfirm.addEventListener('click', function() {
                if (passConfirm.type === "password") {
                    passConfirm.type = "text";
                    iconConfirm.textContent = 'visibility_off';
                } else {
                    passConfirm.type = "password";
                    iconConfirm.textContent = 'visibility';
                }
            });
        });

        //SCRIPT PARA CLICK IMAGINARIO DESDE REGISTRO DEL LOGIN
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar si la URL actual contiene el parámetro 'click'
            if (window.location.search.includes('click')) {
                // Simular el evento de clic en el botón de registrarse
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verificar si el botón existe
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            var resetButtons = document.querySelectorAll('.resetear');
            var formulario1 = document.querySelector('.formulario__login');
            var formulario2 = document.querySelector('.formulario__register');

            resetButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    formulario1.reset();
                    formulario2.reset();
                });
            });
        });
        // ALERT DE CORREO Y CEDULA CLICK INVISIBLE PARA VISUALIZAR
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('msj_error_2')) {
                console.log("si reconoce que existe la variable en js");
                // Simula el evento de click en lugar de llamar al método click()
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verifica que el botón exista
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                    console.log("se dio el click");
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });

        //ALERT CARACTER CONTRASEÑA CLICK INVISIBLE PARA VISUALIZAR
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('msj_error_cedula')) {
                console.log("si reconoce que existe la variable en js");
                // Simula el evento de click en lugar de llamar al método click()
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verifica que el botón exista
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                    console.log("se dio el click");
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });

        //ALERT ERROR CEDULA CLICK INVISIBLE PARA VISUALIZAR
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('msj_error_caracter')) {
                console.log("si reconoce que existe la variable en js");
                // Simula el evento de click en lugar de llamar al método click()
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verifica que el botón exista
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                    console.log("se dio el click");
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });
        //ALERT ERROR COINCIDENCIA DE CONTRASEÑAS CLICK INVISIBLE PARA VISUALIZAR
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('msj_confirm_clave')) {
                console.log("si reconoce que existe la variable en js");
                // Simula el evento de click en lugar de llamar al método click()
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verifica que el botón exista
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                    console.log("se dio el click");
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });

        // CLICK IMAGINARIO PARA REGISTRO

        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('click')) {
                console.log("si reconoce que existe la variable en js");
                // Simula el evento de click en lugar de llamar al método click()
                var btnRegistrarse = document.getElementById('btn__registrarse');
                if (btnRegistrarse) { // Verifica que el botón exista
                    btnRegistrarse.dispatchEvent(new MouseEvent('click'));
                    console.log("se dio el click");
                } else {
                    console.error("El botón 'btn__registrarse' no se encontró.");
                }
            }
        });

        // ALERT DE INACTIVAR Y ACTIVAR USUARIO
        if (window.location.search.includes('mensaje_inactivo')) {
            Swal.fire({
                icon: 'error',
                title: 'Su usuario no esta activo',
                text: 'Comuniquese con nosotros',
                footer: '<a href="../index.php#section-contacto">Donde encontrarnos?</a>'
            })
        }
        // ALERT DE REGISTRO DE NUEVO USUARRIO
        if (window.location.search.includes('msj_registro')) {
            Swal.fire({
                title: "Genial!",
                text: "Revisa tu correo para activar tu cuenta",
                icon: "success"
            });
        }

        // ALERT RECUPERAR CONTRASEÑA ENVIADO 
        if (window.location.search.includes('msj_exito')) {
            Swal.fire({
                title: "Ingrese a su correo",
                text: "Código Enviado correctamente.",
                icon: "success"
            });
        }
        // ALERT ERROR AL ENVIAR CORREO

        if (window.location.search.includes('msj_error_mail')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Hubo un error al enviar el correo",
            });
        }

        // ALERTA DE MODIFICACION DE CONTRASEÑA

        if (window.location.search.includes('msj_clave')) {
            Swal.fire({
                title: "Contraseña modificada.",
                text: "Su nueva contraseña ha sido guardada con exito",
                icon: "success"
            });

        }
        // ALERTA DE ERROR AL MOFIFICAR CONTRASEÑA
        if (window.location.search.includes('msj_error_clave')) {
            Swal.fire({
                icon: "error",
                title: "Ha ocurrido un error",
                text: "Intente nuevamente",
            });
        }

        //ALERTA DE CONTRASEÑAS NO COINSIDEN

        if (window.location.search.includes('msj_validar_clave')) {
            Swal.fire({
                icon: "error",
                title: "Oops... Las contraseñas no coinciden",
                text: "Ingrese desde su correo nuevamente",
            });
        }
        // ALERTA DE EXPIRACION DEL TOKEN 
        if (window.location.search.includes('msj_tiempo_clave')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Su tiempo para cambio de contraseña ya ha expirado",
            });
        }
        // CARACTERES ESPECIALES EN RECUPERAR CONTRASEÑA
        if (window.location.search.includes('msj_error_caracter_olvido')) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "La contraseña debe contener al menos un carácter especial, una letra mayúscula y un número.",
            });
        }

        //USUARIO ACTIVO CORRECTAMENTE
        if (window.location.search.includes('msj_usuario_activo')) {
            Swal.fire({
                title: "Genial!",
                text: "Su usario esat activo. Inicie sesion",
                icon: "success"
            });
        }
        //USUARIO ELIMINADO POR NO ACTIVAR EL USUARIO EN EL LIMITE DE TIEMPO
        if (window.location.search.includes('msj_usuario_eliminado')) {
            Swal.fire({
                icon: "error",
                title: "Exedio el limite de tiempo",
                text: "Su activacion de usuario ya expiro, registrese nuevamente",
                footer: '<a href="login_usuarios.php?click">Intenta registrarte nuevamenete</a>'
            });
        }
    </script>

    <script src="../resource/js/script.js"></script>
</body>

</html>