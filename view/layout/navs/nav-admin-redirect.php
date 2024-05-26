<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../FRESAS_ARTURO/resource/css/nav-adminRedirect.css">
    <script src="https://kit.fontawesome.com/c90742bd6c.js" crossorigin="anonymous"></script>
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