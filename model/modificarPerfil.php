<?php
session_start();
include('../controller/conexion.php');

//* Obtener la información del usuario
$id_cliente = $_SESSION['Id_cliente'];
//* Se hace la consulta con el id_cliente para obtener sus datos
$query = "SELECT * FROM usuarios WHERE Id_cliente = $id_cliente";
$resultado = mysqli_query($conn, $query);

//* Se valida si hay resultados de la consulta 
if ($resultado->num_rows == 1) {
    //* Obtenemos la información para guardarlo en un array
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
        // Manejo de la subida de imagen
        $imagePath = $info['imagen']; // Ruta actual de la imagen

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileName = $_FILES['imagen']['name'];
            $fileSize = $_FILES['imagen']['size'];
            $fileType = $_FILES['imagen']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Lista de tipos MIME permitidos para imágenes
            $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg'];

            // Verificar si la extensión y el tipo MIME son permitidos
            if (in_array($fileExtension, ['jpg', 'gif', 'png', 'jpeg']) && in_array($fileType, $allowedMimeTypes)) {
                $uploadFileDir = '../Resource/Img/';
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $imagePath = $dest_path;
                } else {
                    echo 'Hubo un problema moviendo el archivo al directorio de destino.';
                    exit();
                }
            } else {
                echo 'Tipo de archivo no permitido.';
                $msj_img = "Por favor, sube solo archivos de imagen (JPEG o PNG).";
                header("Location: modificarPerfil.php?msj_img=$msj_img");
                exit();
            }
        }

        $sql = "UPDATE usuarios SET Nombre='$newNombre', Rol='$newRol', Correo='$newCorreo', imagen='$imagePath' WHERE Id_cliente='$id_cliente'";
        if (mysqli_query($conn, $sql)) {
            $msj_actualizado = 'Informacion actualizada';
            header("Location: perfil.php?msj_actualizado=$msj_actualizado");
        } else {
            echo "Error actualizando los datos: " . mysqli_error($conn);
        }
    } else {
        $msj_dominio = 'Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com';
        header("Location: modificarPerfil.php?msj_dominio=$msj_dominio");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Perfil</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" href="../resource/img/icons/strawberry.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .breadcrumbs-container {
            position: absolute;
            margin-left: 130px;
            margin-top: 48px;
            width: 80%;
            font-size: larger;
        }

        .breadcrumb {
            list-style: none;
            display: flex;
            font-weight: 600;
            color: white;
            display: flex;
            flex-wrap: wrap;
        }

        .breadcrumb li {
            margin: 0 20px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: white;
        }

        .listaBread {
            display: flex;
            flex-wrap: wrap;
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

        .card img {
            width: 100px;
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

        .contenedor-input .cedula {
            font-size: 0.8rem;
            padding-left: 0.5rem;
        }

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

        .select {
            border-radius: 6px;
            border: solid 1px rgba(220, 86, 86, 0.733);
            width: 70%;
            padding: 10px;
            color: black;
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

        .contenedor-input input {
            padding: 0.5rem;
            border-radius: 20px;
            border: solid 1px rgba(220, 86, 86, 0.733);
            width: 19rem;
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
                margin-top: 35px;

            }
        }
    </style>
</head>

<body>
    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb listaBread">
                <li class="breadcrumb-item"><a href="../index_usuarios.php">Inicio</a></li>/
                <li class="breadcrumb-item active" aria-current="page"><a href="perfil.php">Perfil</a></li>/
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="modificarPerfil.php">Modificar Perfil</a>
                </li>
            </ol>
        </nav>
    </div>
    <a class="volver" href="perfil.php"><span class="material-symbols-outlined"> arrow_circle_left</span></a>
    <span class="f-roja"></span>
    <div class="contenedor">
        <h3 class="titulo">Modificar Informacion</h3>
        <div class="card">
            <img class="imagen_perfil" src="<?php echo $info['imagen']; ?>" alt="Perfil" />
            <form id="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <ul class="informacion">
                    <li>
                        <span class="material-symbols-outlined"> account_circle </span><span class="descripcion">Nombre</span>
                        <div class="contenedor-input"><input type="text" name="nombre" value="<?php echo $info["Nombre"]; ?>" maxlength="30">
                    </li>
                    <li>
                        <span class="material-symbols-outlined">
                            badge
                        </span><span class="descripcion">Cedula</span>
                        <div class="contenedor-input"><span class="cedula"><?php echo $info["Cedula"]; ?></span>
                    </li>
                    <li><span class="material-symbols-outlined">
                            supervisor_account
                        </span><span class="descripcion">Rol</span>
                        <select class="select" class="text" name="rol" required>
                            <option value="Mayorista" <?php echo $info['Rol'] === 'Mayorista' ? 'selected' : ''; ?>>Mayorista</option>
                            <option value="Minorista" <?php echo $info['Rol'] === 'Minorista' ? 'selected' : ''; ?>>Minorista</option>
                        </select><br><br>
                    </li>
                    <li><span class="material-symbols-outlined"> Email </span><span class="descripcion">Correo</span>
                        <div class="contenedor-input"><input type="email" name="correo" value="<?php echo $info["Correo"]; ?>" maxlength="30">
                    </li>
                    <li>
                        <span class="material-symbols-outlined"> image </span>
                        <span class="descripcion">Nueva Imagen</span>
                        <div class="contenedor-input">
                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                        </div>
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
    if (isset($_GET['msj_img'])) {
        $msj_img = $_GET['msj_img'];
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
        if (window.location.search.includes('msj_img')) {
            // Prevenir el envío del formulario
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Por favor, sube solo archivos de imagen (JPEG o PNG).",
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
            // alert('Por favor, use un correo electrónico con dominio @gmail.com o @hotmail.com');
        }
    </script>
</body>

</html>