<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/c90742bd6c.js" crossorigin="anonymous"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,200;1,300;1,500&display=swap");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

        .header {
            background-color: rgb(255, 255, 255);
            height: 80px;
            width: 100vw;
            position: fixed;
            z-index: 100;
            display: inline;
            /* position: relative; */
        }

        .contenedor {
            display: flex;
            justify-content: space-between;
            background-color: rgb(255, 255, 255);
            align-items: center;
            height: 100%;
            padding: 0 20px;
            /* position: absolute; */
            z-index: 999;
        }

        .logo-responsive,
        .logo-dos {
            display: none;
        }

        .logo {
            width: 130px;
        }

        .lista-nav,
        .lista-ingreso {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .lista-nav li {
            margin: 0 20px;
            font-size: 1.2em;
        }

        .lista-ingreso li {
            display: flex;
            align-items: center;
            margin: 0 20px;
            font-size: 1.2em;
        }

        .lista-nav li a {
            align-items: center;
            text-decoration: none;
            padding: 10px;
            color: black;
            display: flex;
            border-radius: 6px;
            font-weight: 500;
        }

        .lista-nav li a:hover {
            background-color: #f8eaef;
        }


        .fa-arrow-right-to-bracket {
            transform: translate(0, 2px);
        }

        .lista-ingreso li a {
            align-items: center;
            font-weight: 500;
            text-decoration: none;
            padding: 10px;
            /* margin: 0 -5px; */
            color: #d40748;
            border: #d40748 solid 1.5px;
            border-radius: 8px;
            transition: background-color 0.6s, color 0.6s;
        }

        .lista-nav li .fa-arrow-right {
            display: none;
        }

        .lista-ingreso li a:hover {
            background-color: #d22c5d;
            color: white;
        }

        #check-btn,
        .menu {
            display: none;
        }

        #ingreso,
        #nav-lista {
            margin-bottom: 0rem;
        }

        @media screen and (max-width: 1510px) {

            .lista-nav li {
                margin: 0 10px;
                font-size: 1em;
            }
            
            .lista-ingreso li {
                font-size: 1em;
            }
        }


        @media screen and (max-width: 1200px) {
            .lista-ingreso li {
                margin: 0 10px;
            }

            .lista-ingreso {
                padding-left: 10px;
            }

            .lista-nav li {
                margin: 0 10px;

            }
        }

        @media screen and (max-width: 1140px) {

            .lista-ingreso,
            .lista-nav {
                font-size: 0.8em;
            }

        }

        @media screen and (max-width: 1030px) {

            .sesion {
                display: none;
            }
        }

        @media screen and (max-width: 990px) {
            .contenedor {
                position: absolute;
                width: 100vw;
                height: 95vh;
                background-color: #ce2761f5;
                /* background-color: #4ece27f5; */
                flex-direction: column;
                display: flex;
                top: 80px;
                left: -200%;
                padding: 0;
                justify-content: center;
                transition: all 0.5s;
                font-size: 1.3em;
            }

            .contenedor-logo .logo {
                display: none;
            }

            .nav {
                height: 90%;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .btn-ingreso {
                width: 100%;
                height: 20%;
                display: flex;
                flex-wrap: wrap;
                align-items: flex-start;
                justify-content: center;
            }

            .nav .lista-nav {
                flex-direction: column;
                /* text-align: center; */
                flex-wrap: wrap;
                display: flex;
                align-items: center;
                width: 100%;
            }

            #nav-lista {
                padding-left: 0;
            }

            .lista-nav li {
                border-bottom: #f8eaef solid 1px;
                margin: 20px 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                padding: 0 30px 0 10px;
                transition: border 0.5s ease-in-out;
                width: 100%;
            }

            .lista-nav li a:hover {
                background-color: transparent;
            }

            .lista-nav li:hover {
                width: 100%;
                border-bottom: #f8eaef solid 2px;
                cursor: pointer;
            }

            .lista-nav li .fa-arrow-right {
                color: white;
                display: inline;
            }

            .lista-nav li a {
                color: white;
                width: 100%;
            }

            .lista-ingreso li a {
                color: white;
                border: white solid 1.5px;
            }

            .lista-ingreso li a:hover {
                background-color: white;
                color: #d40748;
            }

            .lista-ingreso {
                /* margin-top: 200px; */
                display: flex;
                flex-wrap: wrap;
            }

            .lista-ingreso li {
                margin: 15px;
            }

            .menu {
                display: block;
                float: right;
                font-size: 2rem;
                color: red;
                margin: 20px 20px 0 0;
            }

            #check-btn:checked~.contenedor {
                left: 0;
            }

            .logo-responsive,
            .logo-dos {
                display: block;
            }

            .logo-dos {
                width: 130px;
            }

            .header {
                padding: 5px 0 0 5px;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <input type="checkbox" id="check-btn">
        <label for="check-btn" class="menu">
            <i id="icono" class="fa-solid fa-bars"></i>
        </label>
        <div class="logo-resopnsive">
            <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.jpeg" alt="logo don ramiro" class="logo-dos" />
        </div>
        <div class="contenedor">
            <div class="contenedor-logo">
                <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.jpeg" alt="logo don ramiro" class="logo" />
            </div>
            <nav class="nav">
                <ul class="lista-nav" id="nav-lista">
                    <li><a href="../../../FRESAS_ARTURO/model/interfaz_admin/consult_mysql.php">Usuarios</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../FRESAS_ARTURO/Catalogo-admin.php">Catálogo</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../FRESAS_ARTURO/model/interfaz_admin/Proveedores.php">Proveedores</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../../FRESAS_ARTURO/model/interfaz_admin/Cosechas.php">Cosechas</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../../FRESAS_ARTURO/model/interfaz_admin/Perdidas.php">Perdidas</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../../FRESAS_ARTURO/model/interfaz_admin/Pedidos.php">Pedidos</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../../../../FRESAS_ARTURO/model/interfaz_admin/Guia_admin.php">Ayuda</a><i class="fa-solid fa-arrow-right"></i></li>
                </ul>
            </nav>
            <div class="btn-ingreso">
                <ul class="lista-ingreso" id="ingreso">
                    <li>
                        <a class="registro" href="../../../FRESAS_ARTURO/inicio_admin.php">Inicio <i class="fa-solid fa-house"></i></a>
                    </li>
                    <li>
                        <a class="ingresar" href="../../../FRESAS_ARTURO/controller/logout.php">Cerrar <span class="sesion">Sesion </span><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <script>
        var menu = document.querySelector('.menu');
        var i = document.querySelector('#icono');
        var check = document.getElementById('check-btn');

        check.addEventListener('click', function() {

            if (check.checked) {
                i.classList.remove('fa-bars');
                i.classList.add('fa-xmark');
            } else {
                i.classList.remove('fa-xmark');
                i.classList.add('fa-bars');
            }
        });
    </script>
</body>

</html>