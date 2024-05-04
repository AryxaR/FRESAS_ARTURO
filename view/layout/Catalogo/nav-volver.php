<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Document</title>
</head>

<body>
    <header class="header-nav">
        <img src="../../../../FRESAS_ARTURO/resource/img/logo/FONDO_LOGO.jpeg" alt="logo don ramiro" class="logo" />
        <button class="abrir-menu" id="abrir-menu">
            <i class="bi bi-list">  </i>
        </button>

        <nav class="nav">
            <ul class="nav-list">
                <button class="cerrar-menu" id="cerrar-menu">
                    <i class="bi bi-x-lg"></i>
                </button>
                <div class="nav-items-left">
                    <li><a href="../../../FRESAS_ARTURO/model/interfaz_admin/consult_mysql.php">Clientes</a></li>
                    <li><a href="../../../FRESAS_ARTURO/Catalogo-admin.php">Catálogo</a></li>
                    <li><a href="../../../FRESAS_ARTURO/model/interfaz_admin/Proveedores.php">Proveedores</a></li>
                </div>

                <div class="nav-buttons">
                    <li>
                        <a href="../../../FRESAS_ARTURO/inicio_admin.php">Inicio <i class="bbi bi-house-door"></i></a>
                    </li>
                    <li>
                        <a href="../../../FRESAS_ARTURO/controller/logout.php">Cerrar Sesión <i class="bi bi-box-arrow-in-right"></i></a>
                    </li>
                </div>
            </ul>
        </nav>
    </header>
    <script src="../js/nav.js"></script>
</body>

</html>