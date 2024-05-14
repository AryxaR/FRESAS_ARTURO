<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../FRESAS_ARTURO/resource/css/nav-inicio.css">
    <script src="https://kit.fontawesome.com/c90742bd6c.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header" style='z-index:9999;'>
        <input type="checkbox" id="check-btn">
        <label for="check-btn" class="menu">
            <i id="icono" class="fa-solid fa-bars"></i>
        </label>
        <div class="logo-resopnsive">
            <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.png" alt="logo don ramiro" class="logo-dos" />
        </div>
        <div class="contenedor">
            <div class="contenedor-logo">
                <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.png" alt="logo don ramiro" class="logo" />
            </div>
            <nav class="nav">
                <ul class="lista-nav">
                    <li><a href="../FRESAS_ARTURO/index_usuarios.php">Inicio</a></li>
                    <li><a href="#section-carrito">Catálogo</a></li>
                    <li><a href="#section-contacto">Contacto</a></li>
                </ul>
            </nav>
            <div class="btn-ingreso">
                <ul class="lista-ingreso">
                    <li>
                        <a class="registro" href="../Fresas_Arturo/model/login_usuarios.php">Registro </a>
                    </li>
                    <li>
                        <a class="ingresar" href="../Fresas_Arturo/model/login_usuarios.php">Ingresar <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>

    </header>
    <script>
        var menu = document.querySelector('.menu');
        var i = document.querySelector('#icono');
        var check = document.getElementById('check-btn');

    check.addEventListener('click', function(){

        if (check.checked) {
            i.classList.remove('fa-bars');
            i.classList.add('fa-xmark');
        }else {
            i.classList.remove('fa-xmark');
            i.classList.add('fa-bars');
        }
    });

    </script>
</body>
</html>