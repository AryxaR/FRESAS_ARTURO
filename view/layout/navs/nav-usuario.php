<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../FRESAS_ARTURO/resource/css/navUsuario.css">
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
                    <li><a href="../FRESAS_ARTURO/index_usuarios.php">Inicio</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../FRESAS_ARTURO/catalogo.php">Catálogo</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="#section-contacto">Contacto</a><i class="fa-solid fa-arrow-right"></i></li>
                </ul>
            </nav>
            <div class="btn-ingreso">
                <ul class="lista-ingreso">
                    <li>
                        <a class="perfil" href="../FRESAS_ARTURO/model/perfil.php">Perfil <i class="fa-solid fa-circle-user"></i></a>
                    </li>
                    <li>
                    <li>
                        <a class="salir" href="../FRESAS_ARTURO/controller/logout.php">Salir <i class="fa-solid fa-right-from-bracket"></i></a>
                    </li>

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