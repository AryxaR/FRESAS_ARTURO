<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_proveedor']) && isset($_POST['telefono_proveedor'])) {
        require_once '../../controller/conexion.php';

        $nombre_proveedor = $_POST['nombre_proveedor'];
        $telefono_proveedor = $_POST['telefono_proveedor'];

        $sql = "INSERT INTO Proveedores (Nombre_proveedor, Telefono_proveedor) VALUES ('$nombre_proveedor', '$telefono_proveedor')";

        if ($conn->query($sql) === TRUE) {
            // Obtener el ID del proveedor recién insertado
            $id_proveedor = $conn->insert_id;

            // Guardar el ID del proveedor en la sesión
            $_SESSION['id_proveedor'] = $id_proveedor;

            header("Location: recursos.php");
            exit();
        } else {
            echo "Error al guardar el proveedor en la base de datos: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Por favor, complete todos los campos del formulario.";
    }
}
?>

<?php
include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
?>
<br><br><br><br><br>

<div class="breadcrumbs-container">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../inicio_admin.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="../../model/interfaz_admin/Proveedores.php">Proveedores</a></li>
                <li class="breadcrumb-item breadcrumb-item-dos" aria-current="page">Nuevo proveedor</li>
            </ol>
        </nav>
    </div>
    
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/nav.css" />
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/footer.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
            font-family: Arial, sans-serif;
            background-image: url(../../../FRESAS_ARTURO/resource/img/index/fondonitido.png);
            color: #d22c5d;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: black;
            margin-top: 1%;
            margin-bottom: 2%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 4px #888888;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
            text-align: center;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #d22c5d;
            border-radius: 4px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;

        }

        input[type="submit"] {

            padding: 0.6rem;
            color: white;
            background-color: #d22c5d;
            border-radius: 0.4rem;
            border: 1px solid #d22c5d;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.6s, color 0.6s;
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="submit"]:hover {
            border: 1px solid #d22c5d;
            color: #d22c5d;
            background-color: white;
        }
        .btn-volver {
            margin: 3% 0 0 8%;
            color: white;
            width: 3.2%;
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

        .footer-bottom {
            position: relative;
            width: 100%;
            background-color: #8B0000;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 16px;
            bottom: 0;
            /* Ajusta la posición del footer al final de la ventana del navegador */
            left: 0;
        }

        .footer-bottom small {
            font-size: 20px;
            font-weight: 500;
        }

        .footer-bottom-info-center {
            display: flex;
            gap: 7px;
        }

        .breadcrumbs-container {
            display: flex;
            margin-top: -2%;
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
            color: black;
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

        .breadcrumb-item-dos{
            color: black;
            display: flex;
            align-items: center;
        }

    </style>

<body>

<button class="btn-volver" onclick="history.back()">&#8592;</button>

    <div class="title-container">
        <h2>REGISTRO DE PROVEEDORES</h2>
    </div>

    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nombre_proveedor">Nombre del Proveedor:</label><br>
            <input type="text" id="nombre_proveedor" name="nombre_proveedor" required><br>

            <label for="telefono_proveedor">Teléfono del Proveedor:</label><br>
            <input type="text" id="telefono_proveedor" name="telefono_proveedor" required><br>

            <input type="submit" value="SIGUIENTE">
        </form>
    </div>
</body>

<?php
echo "<br><br><br><br><br>";
include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
?>

</html>