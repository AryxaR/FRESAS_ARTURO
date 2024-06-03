<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZACION</title>
    <link rel="icon" href="../../../FRESAS_ARTURO/resource/img/icons/strawberry.png" type="image/png">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif
        }

        body {
            background-image: url(../../../FRESAS_ARTURO//resource//img//index//fondoborroso.png);
            background-size: cover;
            background-attachment: fixed;
            /* background-position: center; */
        }

        .container-usuarios {
            margin-top: -3%;
            display: flex;
            align-items: center;
            text-align: center;
            flex-direction: column;
            background-color: transparent;
            padding: 0 30px;

        }

        .btn-volver {
            margin: 2% 8%;
            color: white;
            background-color: #d22c5d;
            border: none;
            font-size: 24px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
        }


        .btn-volver:hover {
            border: 1px solid #d22c5d;
            color: #d22c5d;
            background-color: white;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            box-sizing: border-box;
            margin-top: 20px;
            width: 50%;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            text-align: center;
        }

        form input[type="text"],
        form input[type="email"] {
            width: 70%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
            font-family: 'Poppins', sans-serif;

        }

        form input[type="submit"] {
            padding: 0.6rem;
            color: white;
            background-color: #d22c5d;
            border-radius: 0.4rem;
            border: 1px solid #d22c5d;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
            font-family: 'Poppins', sans-serif;

        }

        form input[type="submit"]:hover {
            border: 1px solid #d22c5d;
            color: #d22c5d;
            background-color: white;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: 1%;
            margin-left: 7%;
            padding: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .breadcrumb {
            display: flex;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "/";
            margin: 0 10px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .select {
            border-radius: 6px;
            border: solid 1px black;
            width: 70%;
            padding: 10px;
            color: black;
        }

        @media screen and (max-width: 950px) {
            form {
                width: 90%;
            }
        }
        @media screen and (max-width: 450px) {
            form {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br><br>";
    ?>
    <div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/consult_mysql.php">Usuarios</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Editar Usuarios</li>
            </ol>
        </nav>
    </div>

    <button class="btn-volver" onclick="history.back()">&#8592;</button>
    <div class="container-usuarios">
        <h2>MODIFICACIÓN DE USUARIOS</h2>
        <?php
        require_once '../../../FRESAS_ARTURO/controller/conexion.php';

        // Verificar si se ha enviado un formulario para actualizar
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $sql_select = "SELECT * FROM usuarios WHERE Id_cliente= $id";
            $result = $conn->query($sql_select);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
                <form action="../../../FRESAS_ARTURO/controller/controlers-admin/update_process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Id_cliente']; ?>">
                    <label for="Nombre">Nombre:</label>
                    <input type="text" name="Nombre" value="<?php echo $row['Nombre']; ?>" maxlength="30"><br><br>
                    <label for="Correo">Correo:</label>
                    <input type="email" name="Correo" value="<?php echo $row['Correo']; ?>" maxlength="35"><br><br>
                    <label for="Rol">Rol:</label>
                    <select class="select" class="text" name="Rol" required>
                        <option value="Mayorista" <?php echo $row['Rol'] === 'Mayorista' ? 'selected' : ''; ?>>Mayorista</option>
                        <option value="Minorista" <?php echo $row['Rol'] === 'Minorista' ? 'selected' : ''; ?>>Minorista</option>
                    </select><br><br>
                    <input type="submit" name="actualizar" value="Actualizar">
                </form>
        <?php
            } else {
                echo "Usuario no encontrado.";
            }
        }
        $conn->close();
        ?>
    </div>

    <?php
    include_once('../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php')
    ?>
</body>

</html>