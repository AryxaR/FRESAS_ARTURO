<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['Id_cliente'])) {
    // Si no ha iniciado sesión, redirigir al usuario a la página de inicio de sesión
    header("Location: login_usuarios.php");
    exit();
}
?>

<?php

include '../controller/conexion.php';

//* Obtener la informacion del usuario
$id_cliente = $_SESSION['Id_cliente'];
//* Se hace la consulta con el id_cliente para obtener sus datos
$query = "SELECT * FROM usuarios WHERE Id_cliente = '$id_cliente'";
$resultado = mysqli_query($conn, $query);

//*Se valida si hay resultados de la consulta 
if ($resultado->num_rows == 1) {
  //* Obtenemos la informacion para guardarlo en un array
  $info = $resultado->fetch_assoc();
} else {
  //* Manejar el caso en el que no se encuentra el usuario
  //* (podría ser un intento de manipulación de la URL)
  header("Location: index.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perfil</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <style>
    .breadcrumbs-container {
      position: absolute;
      margin-left: 130px;
      margin-top: 48px;
      width: max-content;
      font-size: larger;
    }

    .breadcrumb {
      list-style: none;
      display: flex;
      font-weight: 600;
      color: white;
    }

    .breadcrumb li {
      margin: 0 20px;
    }

    .breadcrumb-item a {
      text-decoration: none;
      color: white;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url("../resource/img/index/fondoborroso.png");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
    }

    .volver {
      position: absolute;
      margin: 2em 0 0 2em;
      text-decoration: none;
    }

    .volver span {
      font-size: 3rem;
      color: white;
    }

    .contenedor {
      display: flex;
      width: 100%;
      justify-content: center;
      position: relative;
    }

    .f-roja {
      display: flex;
      width: 100%;
      height: 300px;
      background-color: #e43a3a;
      z-index: -1;
      border-radius: 0 0 80% 80%;
    }

    .titulo {
      position: absolute;
      margin-top: -190px;
      text-align: center;
      color: black;
      font-size: 2.5rem;
      font-weight: bold;
      font-family: "Poppins", sans-serif;
    }

    .card {
      margin-top: -60px;
      position: absolute;
      /* La card se sobrepone */
      /* border: solid black 2px; */
      width: 500px;
      height: max-content;
      padding: 30px;
      border-radius: 30px;
      background-color: white;
      box-shadow: 6px 6px 10px rgb(43, 41, 41);
      display: flex;
      flex-direction: column;
    }

    .card p {
      font-weight: bold;
      font-family: "Poppins", sans-serif;
      font-size: larger;
    }

    .imagen_perfil {
      border-radius: 50% ;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      align-self: center;
    }

    .modificar {
      border-radius: 20px;
      padding: 15px;
      text-transform: capitalize;
      background-color: transparent;
      border: solid 2px rgba(220, 86, 86, 0.733);
      margin: 30px auto 0;
      width: 80%;
      text-align: center;
    }

    .contenedor-modificar {
      display: flex;
      /* justify-content: center; */
    }

    .modificar:hover {
      background-color: rgba(109, 197, 109, 0.83);
      color: white;
      border: none;
    }

    .card a {
      margin: auto;
      width: 100%;
      display: flex;
      text-decoration: none;
    }

    .informacion {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .informacion li {
      display: flex;
      font-size: 15px;
      margin: 20px 20px 0 20px;
      list-style: none;
      border-bottom: solid rgb(104, 104, 104) 2px;
      width: 80%;
      padding: 10px;
      font-family: "Poppins", sans-serif;
      /* border-radius: 20px; */
    }

    .informacion li p {
      margin-left: 9px;
      font-size: 1em;
      font-weight: 500;
      font-family: "Poppins", sans-serif;
    }

    /*Informacion referencia usuarios*/

    .descripcion {
      position: absolute;
      color: rgba(34, 32, 32, 0.691);
      margin: -1.5em 0 0 3em;
      font-size: 0.9em;
      font-family: "Poppins", sans-serif;
    }

    .material-symbols-outlined {
      color: #e43a64;
      position: relative;
      display: flex;
      padding-right: 10px;
    }

    /* Responsive */

    @media screen and (max-width: 400px) {
      .card {
        width: 340px;
        padding: 10px;
        box-shadow: 6px 6px 10px rgb(43, 41, 41), -6px -6px 10px rgb(43, 41, 41);
      }

      .info {
        margin-top: -230px;
      }
    }

    /*Label*/

    .contenedor-input input {
      padding: 0.5rem;
      border-radius: 20px;
      border: solid 1px rgba(220, 86, 86, 0.733);
    }

    .contenedor-input input:focus {
      border-color: rgba(220, 86, 86, 0.733);
    }


    @media screen and (max-width: 360px) {
      .contenedor-input input {
        width: 13rem;
      }

      .breadcrumbs-container {
        margin-left: 90px;
        margin-top: 45px;

      }
    }
  </style>
</head>

<body>
  <div class="breadcrumbs-container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index_usuarios.php">Inicio</a></li>/
        <li class="breadcrumb-item active" aria-current="page"><a href="perfil.php">Perfil</a></li>
      </ol>
    </nav>
  </div>

  <a class="volver" href="../Index_usuarios.php"><span class="material-symbols-outlined"> arrow_circle_left</span></a>
  <span class="f-roja"></span>
  <div class="contenedor">
    <h3 class="titulo">Informacion usuario</h3>
    <div class="card">
    <img class="imagen_perfil" src="<?php echo $info['imagen']; ?>" alt="Perfil" />
      <ul class="informacion">
        <li>
          <span class="material-symbols-outlined"> account_circle </span> <span class="descripcion">Nombre</span>
          <p><?php echo $info["Nombre"]; ?></p>
        </li>
        <li>
          <span class="material-symbols-outlined">
            badge
          </span><span class="descripcion">Cedula</span>
          <p><?php echo $info["Cedula"]; ?></p>
        </li>
        <li><span class="material-symbols-outlined">
            supervisor_account
          </span><span class="descripcion">Rol</span>
          <p><?php echo $info["Rol"]; ?></p>
        </li>
        <li><span class="material-symbols-outlined"> mail </span><span class="descripcion">Correo</span>
          <p><?php echo $info["Correo"]; ?></p>
        </li>
      </ul>

      <a href="../model/modificarPerfil.php"><button class="modificar">Modificar datos</button></a>
      <div class="exit">
        <!-- <a href="./settings/logout.php">Salir</a> -->
      </div>
    </div>
  </div>

  <?php
  if (isset($_GET['msj_actualizado'])) {
    $msj_exito = $_GET['msj_actualizado'];
  }
  ?>

  <script>
    if (window.location.search.includes('msj_actualizado')) {
      Swal.fire({
        position: "center",
        icon: "success",
        title: "Informacion Actualizada",
        showConfirmButton: false,
        timer: 1500
      });
    }
  </script>
</body>

</html>