<?php

session_start();
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
  <link rel="stylesheet" href="../../FRESAS_ARTURO/resource/css/informacion-usuario.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
  
  <a class="volver" href="../Index_usuarios.php"><span class="material-symbols-outlined"> arrow_circle_left</span></a>
  <span class="f-roja"></span>
  <div class="contenedor">
    <h3 class="titulo">Informacion usuario</h3>
    <div class="card">
      <img src="../resource/img/blank-profile-picture-973460_960_720.webp" alt="Perfil" />
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