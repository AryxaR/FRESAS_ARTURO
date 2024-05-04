<?php

session_start();
include '../../controller/conexion.php';

//* Obtener la informacion del usuario
$id_cliente = $_SESSION['Id_cliente'];
//* Se hace la consulta con el id_cliente para obtener sus datos
$query = "SELECT * FROM usuarios WHERE id_cliente = $id_cliente";
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

if (isset($_POST['save'])) {
    $newNombre = $_POST['nombre'];
    $newCorreo = $_POST['correo'];

    $sql = "UPDATE usuarios SET nombre='$newNombre', correo='$newCorreo' WHERE Id_cliente='$id_cliente'";

    mysqli_query($conn, $sql);

    header('location: ../../model/perfil_admin/perfil-admin.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil</title>
    <link rel="stylesheet" href="../../resource/css/modificar-admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <a class="volver" href="../../../FRESAS_ARTURO/model/perfil_admin/perfil-admin.php"><span class="material-symbols-outlined"> arrow_circle_left</span></a>
    <span class="f-roja"></span>
    <div class="contenedor">
        <h3 class="titulo">Modificar Informacion</h3>
        <div class="card">
            <img src="../../../FRESAS_ARTURO/resource/img/blank-profile-picture-973460_960_720.webp" alt="Perfil" />
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <ul class="informacion">
                    <li>
                        <span class="material-symbols-outlined"> account_circle </span><span class="descripcion">Nombre</span>
                        <div class="contenedor-input"><input type="text" name="nombre" value="<?php echo $info["Nombre"]; ?>">
                    </li>
                    <li>
                        <span class="material-symbols-outlined">
                            badge
                        </span><span class="descripcion">Cedula</span>
                        <div class="contenedor-input"><input type="number" name="cedula" value="<?php echo $info["Cedula"]; ?>">
                    </li>
                    </li>
                    </li>
                    <li><span class="material-symbols-outlined"> mail </span><span class="descripcion">Correo</span>
                        <div class="contenedor-input"><input type="email" name="correo" value="<?php echo $info["Correo"]; ?>">
                    </li>
                    </li>
                </ul>
                <div class="contenedor-modificar">
                    <input class="modificar" type="submit" name="save" value="modificar datos"></input>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>