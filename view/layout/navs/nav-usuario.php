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
  align-items: center;
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
  margin: 0 20px;
  font-size: 1.2em;
}

.lista-nav li a {
  text-decoration: none;
  padding: 10px;
  align-items: center;
  color: black;
  border-radius: 6px;
  font-weight: 500;
}

.lista-nav li .fa-arrow-right {
  display: none;
}

.lista-ingreso li a {
  align-items: center;
  font-weight: 500;
  text-decoration: none;
  padding: 10px;
  margin: 0 -5px;
  color: #d40748;
  border: #d40748 solid 1.5px;
  border-radius: 8px;
  transition: background-color 0.6s, color 0.6s;
}

.lista-nav li a:hover {
  background-color: #f8eaef;
}

.lista-ingreso li a:hover {
  background-color: #d22c5d;
  color: white;
}

#check-btn,
.menu {
  display: none;
}

@media screen and (max-width: 830px) {
  .lista-ingreso,
  .lista-nav {
    font-size: 0.8em;
  }

  .lista-nav li {
    margin: 0 5px;
  }
  
}

@media screen and (max-width: 780px) {
  .contenedor {
    position: absolute;
    width: 100vw;
    height: 95vh;
    background-color: #ce2761f5;
    flex-direction: column;
    top: 80px;
    left: -200%;
    padding: 0;
    justify-content: center;
    transition: all 0.5s;
    font-size: 1.3em;
    padding: 0 0 30px 0;
  }

  #lista-nav, #lista-ingreso {
    padding-left: 0;
  }

  .contenedor-logo .logo {
    display: none;  
  }

  .nav {
    height: 50%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .btn-ingreso {
    width: 100%;
    height: 50%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }

  .nav .lista-nav {
    flex-direction: column;
    flex-wrap: wrap;
    display: flex;
    align-items: center;
    width: 100%;
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

  .lista-ingreso {
    margin-top: 200px;
    display: flex;
    flex-wrap: wrap;
  }

  .lista-nav li a {
    color: white;
    width: 100%;
  }

  .lista-ingreso li {
    margin: 15px;
  }

  .lista-ingreso li a {
    color: white;
    border: white solid 1.5px;
  }

  .lista-ingreso li a:hover {
    background-color: white;
    color: #d40748;
  }

  .menu {
    display: block;
    float: right;
    font-size: 2rem;
    color: red;
    margin: 20px 20px 0 0;
  }

  #check-btn:checked ~ .contenedor {
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

@media screen and (max-width: 340px) {
  .lista-ingreso li {
      justify-content: center;
      display: flex;
      margin: 15px;
      width: 100%;
    }
}

    </style>
</head>

<body>
    <header class="header" style='z-index:9999;'>
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
                <ul id="lista-nav" class="lista-nav">
                    <li><a href="../FRESAS_ARTURO/index_usuarios.php">Inicio</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="../FRESAS_ARTURO/catalogo.php">Catálogo</a><i class="fa-solid fa-arrow-right"></i></li>
                    <li><a href="#section-contacto">Contacto</a><i class="fa-solid fa-arrow-right"></i></li>
                </ul>
            </nav>
            <div class="btn-ingreso">
                <ul id="lista-ingreso" class="lista-ingreso">
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