<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
    <title>ACTUALIZACION</title>
    <link rel="icon" href="../../resource/img/icons/strawberry.png" type="image/png">
    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;1,200;1,300;1,500&display=swap");

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-image: url("../../resource/img/index/fondoborroso.png");
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

        .breadcrumb-item+.breadcrumb-item::before {
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
    include_once '../../view/layout/navs/nav-admin-redirect.php';
    echo "<br><br><br><br>";

    if (isset($_GET['msj_exito'])) {
        $msj_exito = $_GET['msj_exito'];
    }
    ?>

    <div class="breadcrumbs-container">
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

            $sql_select = "
            SELECT p.Nombre_proveedor, p.Telefono_proveedor, r.Tipo AS Nombre_recurso, r.Stock, i.Nombre_insumo, i.Costo_producto
            FROM proveedores p
            JOIN recursos r ON p.Id_proveedor = r.Id_proveedor
            JOIN insumos i ON r.Id_Recursos = i.Id_recurso
            WHERE p.Id_proveedor = $id";

            $result = $conn->query($sql_select);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
                <form action="../../controller/controlers-admin/updateprov_process.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="Nombre_proveedor">Nombre del proveedor:</label>
                    <input type="text" name="Nombre_proveedor" value="<?php echo $row['Nombre_proveedor']; ?>" maxlength="30"><br><br>
                    <label for="Telefono_proveedor">Telefono del proveedor:</label>
                    <input type="number" name="Telefono_proveedor" value="<?php echo $row['Telefono_proveedor']; ?>" min="1" max="9999999999" oninput="this.value = this.value.slice(0, 10)"><br><br>
                    <label for="Nombre_recurso">Recurso:</label>
                    <input type="text" name="Nombre_recurso" value="<?php echo $row['Nombre_recurso']; ?>" readonly><br><br>
                    <label for="Stock">Stock:</label>
                    <input type="number" name="Stock" value="<?php echo $row['Stock']; ?>" min="1" max="999" oninput="this.value = this.value.slice(0, 3)"><br><br>
                    <label for="Nombre_insumo">Insumo:</label>
                    <input type="text" name="Nombre_insumo" value="<?php echo $row['Nombre_insumo']; ?>"><br><br>
                    <label for="Costo_producto">Precio del Insumo:</label>
                    <input type="number" name="Costo_producto" value="<?php echo $row['Costo_producto']; ?>" min="1" max="9999999" oninput="this.value = this.value.slice(0, 7)"><br><br>
                    <input type="submit" name="actualizar" value="Actualizar">
                </form>
        <?php
            } else {
                echo "Proveedor no encontrado.";
            }
        }
        $conn->close();
        ?>
    </div>

    <script>
        if (window.location.search.includes('msj_exito')) {
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

<br><br><br><br><br><br>
<?php
include_once '../../view/layout/footers/footer-admin.php';
?>

</html>