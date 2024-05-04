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
include_once '../../view/layout/Catalogo/nav-volver.html';
?>
<br><br><br><br><br>

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
            margin-top: 3%;
            text-align: center;
            /* Centra el texto horizontalmente */
            font-size: 24px;
            /* Tamaño de la fuente */
            font-weight: bold;
            /* Negrita */
            text-shadow: 2px 2px 4px #888888;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            /* Hace que el formulario ocupe todo el espacio disponible verticalmente */
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            margin: 0 auto;
            /* Centra el formulario horizontalmente */
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

        .back-button {
            position: absolute;
            top: 130px;
            left: 120px;
            font-size: 24px;
            padding: 5px;
            height: 7%;
            border: none;
            border-radius: 5px;
            background-color: #d22c5d;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button:hover {
            background-color: white;
            /* Color de fondo blanco al pasar el mouse */
            color: #d22c5d;
            /* Color de la letra rojo al pasar el mouse */
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
    </style>

<body>

    <a href="javascript:history.go(-1)" class="back-button">&#8592;</a>

    <div class="title-container">
        <h2>PROVEEDORES</h2>
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
include_once '../../view/layout/footer-admin.html';
?>

</html>