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
      z-index: 1000;
      top: 0;
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
      z-index: 9999;
    }

    .logo-responsive,
    .logo-dos {
      display: none;
    }

    .logo {
      width: 130px;
    }

    .lista-ingreso {
      list-style: none;
      display: flex;
      align-items: center;
    }

    .lista-ingreso li {
      margin: 0 10px;
      font-size: 1.2em;
    }

    .fa-arrow-right-to-bracket {
      transform: translate(6px, 1px);
    }

    .cerrar {
      margin-right: 9px;
    }

    .lista-ingreso li a {
      align-items: center;
      font-weight: 500;
      text-decoration: none;
      padding: 10px 15px 10px 10px;
      color: #d40748;
      border: #d40748 solid 1.5px;
      border-radius: 8px;
      transition: background-color 0.6s, color 0.6s;
    }

    .lista-ingreso li a:hover {
      background-color: #d22c5d;
      color: white;
    }

    .formContainer {
      display: none;
    }

    @media screen and (max-width: 600px) {
      .cerrar {
        display: none;
      }

      .fa-arrow-right-to-bracket {
        transform: translate(0px, 0px);
      }

      .lista-ingreso li a {
        padding: 10px;
      }

      .contenedor {
        padding: 0 0 0 10px;
      }
    }

    /* ESTILO APRTADO BACKUP */

    .contenedor-copia {
      display: none;
      z-index: 9999;
      background-color: transparent;
      height: 100vh;
      position: fixed;
      padding: auto;
      width: 100vw;
      align-items: center;
    }

    .contenedor-contenido {
      border: solid black 1px;
      height: 50%;
      margin: auto;
      width: 40%;
      border-radius: 13px;
      padding: 30px;
      text-align: center;
      display: flex;
      flex-direction: column;
      background-color: white;
      overflow: auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .generar {
      width: 100%;
    }

    .close {
      align-self: self-end;
      font-size: 2rem;
      font-weight: 700;
      cursor: pointer;
    }

    h2 {
      margin: 20px 0;
    }

    .texto_info {
      text-align: center;
      width: fit-content;
      font-weight: 500;
      width: 70%;
    }

    .form-restaurar {
      display: flex;
      flex-direction: column;
      width: 100%;
    }


    .button {
      border-radius: 13px;
      padding: 9px;
      width: 60%;
      align-self: center;
      margin: 20px 0;
      cursor: pointer;
      background-color: rgba(242, 64, 138, 0.911);
      border: none;
      font-weight: 600;
    }

    .button:hover {
      border: black solid 1px;
    }

    .archivo {
      color: red;
      align-self: center;
      margin: 10px 0;
    }

    @media screen and (max-width: 1200px) {
      .contenedor-contenido {
        width: 60%;
      }
    }

    @media screen and (max-width: 790px) {
      .contenedor-contenido {
        width: 80%;
      }

      .lista-ingreso {
        font-size: 0.8rem;
      }
    }

    @media screen and (max-width: 510px) {
      .contenedor-contenido {
        width: 90%;
        height: 55%;

      }
    }

    @media screen and (max-width: 480px) {
      .contenedor-contenido {
        width: 100%;
        height: 55%;
      }

      .texto_info {
        width: 90%;
      }
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="contenedor">
      <div class="contenedor-logo">
        <img src="../../../../FRESAS_ARTURO/resource/img/logo/logofresas.jpeg" alt="logo don ramiro" class="logo" />
      </div>
      <div class="btn-ingreso">
        <ul class="lista-ingreso">
          <li>
            <a id="openModalBtn" class="ingresar" href="#"><span class="cerrar">Backup</span><i class="fa-regular fa-floppy-disk"></i></a>
          </li>
          <li>
            <a class="ingresar" href="../Fresas_Arturo/model/login_usuarios.php"><span class="cerrar">Cerrar Sesion</span><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
          </li>
          <li><a class="ingresar" href="../../../../FRESAS_ARTURO/model/interfaz_admin/Guia_admin.php"><span class="cerrar">Ayuda</span><i class="fa-regular fa-circle-question"></i></a></i></li>
        </ul>
      </div>
    </div>

  </header>

  <script>
    // var menu = document.querySelector('.menu');
    // var i = document.querySelector('#icono');
    // var check = document.getElementById('check-btn');

    // check.addEventListener('click', function() {

    //     if (check.checked) {
    //         i.classList.remove('fa-bars');
    //         i.classList.add('fa-xmark');
    //     } else {
    //         i.classList.remove('fa-xmark');
    //         i.classList.add('fa-bars');
    //     }
    // });
  </script>
</body>

</html>