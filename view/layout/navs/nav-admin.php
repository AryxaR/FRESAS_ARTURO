<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../FRESAS_ARTURO/resource/css/nav-admin.css">
    <script src="https://kit.fontawesome.com/c90742bd6c.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <div class="contenedor">
            <div class="contenedor-logo">
                <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.png" alt="logo don ramiro" class="logo" />
            </div>
            <div class="btn-ingreso">
                <ul class="lista-ingreso">
                    <li>
                        <a class="ingresar" href="../Fresas_Arturo/model/login_usuarios.php"><span class="cerrar">Backup</span></a>
                    </li>
                    <li>
                        <a class="ingresar" href="../Fresas_Arturo/model/login_usuarios.php"><span class="cerrar">Cerrar Sesion</span><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
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