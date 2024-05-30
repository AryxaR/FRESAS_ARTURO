<?php

session_start();
include('../controller/conexion.php');

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
    $newRol = $_POST['rol'];
    $newCorreo = $_POST['correo'];

    // Validación del dominio del correo
    $allowedDomains = ['gmail.com', 'hotmail.com'];
    $emailDomain = substr(strrchr($newCorreo, "@"), 1);

    if (in_array($emailDomain, $allowedDomains)) {
        $sql = "UPDATE usuarios SET nombre='$newNombre', rol='$newRol', correo='$newCorreo' WHERE id_cliente='$id_cliente'";
        if (mysqli_query($conn, $sql)) {
            $msj_actualizado = 'Informacion actualizada';
            header("Location: ../model/perfil.php?msj_actualizado=$msj_actualizado");
        } else {
            echo "Error actualizando los datos: " . mysqli_error($conn);
        }
    } else {
        $msj_dominio = 'Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com';
        header("Location: ../model/modificarPerfil.php?msj_dominio=$msj_dominio");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil</title>
    <link rel="stylesheet" href="../../FRESAS_ARTURO/resource/css/mod-usuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    </style>
</head>

<body>
    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index_usuarios.php">Inicio</a></li>/
                <li class="breadcrumb-item active" aria-current="page"><a href="perfil.php">Perfil</a></li>/
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="modificarPerfil.php">Modificar Perfil</a>
                </li>
            </ol>
        </nav>
    </div>
    <a class="volver" href="../model/perfil.php"><span class="material-symbols-outlined"> arrow_circle_left</span></a>
    <span class="f-roja"></span>
    <div class="contenedor">
        <h3 class="titulo">Modificar Informacion</h3>
        <div class="card">
            <img src="../resource/img/blank-profile-picture-973460_960_720.webp" alt="Perfil" />
            <form id="" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <ul class="informacion">
                    <li>
                        <span class="material-symbols-outlined"> account_circle </span><span class="descripcion">Nombre</span>
                        <div class="contenedor-input"><input type="text" name="nombre" value="<?php echo $info["Nombre"]; ?>">
                    </li>
                    <li>
                        <span class="material-symbols-outlined">
                            badge
                        </span><span class="descripcion">Cedula</span>
                        <div class="contenedor-input"><span class="cedula"><?php echo $info["Cedula"]; ?></span>
                    </li>
                    </li>
                    <li><span class="material-symbols-outlined">
                            supervisor_account
                        </span><span class="descripcion">Rol</span>
                        <div class="contenedor-input"><input type="text" name="rol" value="<?php echo $info["Rol"]; ?>">
                    </li>
                    </li>
                    <li><span class="material-symbols-outlined"> mail </span><span class="descripcion">Correo</span>
                        <div class="contenedor-input"><input type="email" name="correo" value="<?php echo $info["Correo"]; ?>">
                    </li>
                    </li>
                </ul>
                <div class="contenedor-modificar">
                    <input class="modificar" type="submit" name="save" value="Actualizar datos"></input>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php
if (isset($_GET['msj_dominio'])) {
    $msj_dominio = $_GET['msj_dominio'];
}
?>
    <script>
        // ALERT DE INACTIVAR Y ACTIVAR USUARIO
        if (window.location.search.includes('msj_dominio')) {
            // Prevenir el envío del formulario
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com",
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
            // alert('Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com');
        }
    </script>
</body>

</html>