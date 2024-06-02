
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <title>ACTUALIZACION</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,200;1,300;1,500&display=swap");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-image: url("../../../FRESAS_ARTURO/resource/img/index/fondoborroso.png");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .container-proveedor {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* height: 100vh; */
            padding-top: 5%;

        }

        .btn-volver {
            margin: 3% 0 0 8%;
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
            width: 40%;
            /* margin: auto; */
        }

        form label {
            display: block;
            margin-bottom: 5px;
            text-align: center;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="number"] {
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
            margin-top: -5%;
            margin-bottom: 40px;
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
            background-color: white;
            display: flex;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            margin: 0 7px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            color: #007bff;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
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
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/Proveedores.php">Proveedores</a></li>
                <li class="breadcrumb-item dos" aria-current="page">Editar Proveedores</li>
            </ol>
        </nav>
    </div>

    <button class="btn-volver" onclick="history.back()">&#8592;</button>
    <div class="container-proveedor">
        <h2>MODIFICACIÓN DE PROVEEDORES</h2>
        <?php
        require_once '../../controller/conexion.php';

        // Verificar si se ha enviado un formulario para actualizar
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            $sql_select = "SELECT * FROM proveedores WHERE Id_proveedor= $id";
            $result = $conn->query($sql_select);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
                <form action="../../controller/controlers-admin/updateprov_process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['Id_proveedor']; ?>">
                    <label for="Nombre_proveedor">Nombre_provedor:</label>
                    <input type="text" name="Nombre_proveedor" value="<?php echo $row['Nombre_proveedor']; ?>"><br><br>
                    <label for="Telefono_proveedor">Telefono_proveedor:</label>
                    <input type="number" name="Telefono_proveedor" value="<?php echo $row['Telefono_proveedor']; ?>"><br><br>
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
</body>
<?php
include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
?>
</html>
