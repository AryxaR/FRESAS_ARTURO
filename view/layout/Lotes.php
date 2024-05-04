<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/lotes.css">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/nav.css" />
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/footer.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <title>Ingreso de Cantidades Recogidas</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

    .footer-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color:	#8B0000; /* Puedes ajustar el color de fondo según tus necesidades */
            color: white; /* Puedes ajustar el color del texto según tus necesidades */
            display: flex;
            justify-content: space-between;
            padding: 16px;
        }
        
        .footer-bottom small {
            font-size: 20px;
            font-weight: 500;
        }
        
        .footer-bottom-info-center {
            display: flex;
            gap: 7px;
        }
        
        @media screen and (max-width: 1000px) {
            .footer-bottom {
                align-items: center;
                gap: 10px;
                text-align: center;
                flex-direction: column;
            }
        }
        
        @media screen and (max-width: 480px) {
            .footer-bottom {
                align-items: center;
                gap: 10px;
                text-align: center;
                flex-direction: column;
            }
        }
</style>

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
                    <li><a href="../../../../FRESAS_ARTURO/view/layout/Lotes.html">Cosechas</a></li>
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

    <h1>REGISTRO DE COSECHA</h1>
    <form class="contenedor" action="../../controller/lotes.php" method="post">
        <label for="categoria_extra">Fresas Extra: </label>
        <input type="number" id="categoria_extra" name="cantidad_recogida_extra" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_primera">Fresas Primera:</label>
        <input type="number" id="categoria_primera" name="cantidad_recogida_primera" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_segunda">Fresas Segunda:</label>
        <input type="number" id="categoria_segunda" name="cantidad_recogida_segunda" min="0" required placeholder="Kg"><br><br>
        
        <label for="categoria_riche">Fresas Riche:</label>
        <input type="number" id="categoria_riche" name="cantidad_recogida_riche" min="0" required placeholder="Kg"><br><br>
        
        <input class="boton" type="submit" value="Enviar">
    </form>
</body>

<div class="footer-bottom">

    <small class="footer-small">@Todos los Derechos Reservados 2024</small>
    <div class="footer-bottom-info-center">
       
        <small class="footer-small">Fresas</small>
        <small class="footer-small">Don</small>
        <small class="footer-small">Arturo</small>
    </div>
</div>
</footer>
</html>
