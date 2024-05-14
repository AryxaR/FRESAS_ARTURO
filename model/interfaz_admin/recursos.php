<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_SESSION['id_proveedor'])) {
    
    $_SESSION['tipo_recurso'] = $_POST['tipo'];
    $_SESSION['stock'] = $_POST['stock'];
    $id_proveedor = $_SESSION['id_proveedor'];

    require_once('../../controller/conexion.php'); 

    $sql = "INSERT INTO Recursos (Id_proveedor, Tipo, Stock) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_proveedor, $_SESSION['tipo_recurso'], $_SESSION['stock']); 

    if ($stmt->execute()) {
        $id_recurso = $conn->insert_id;

        $_SESSION['id_recurso'] = $id_recurso;
        
        header("Location: insumos.php");
        exit(); 
    } else {
        echo "Error al insertar el tipo de recurso en la base de datos";
    }

    $stmt->close();
    $conn->close();
} 
?>

<?php
// include_once '../../../FRESAS_ARTURO/view/layout/navs/nav-admin-redirect.php';
?>
<br><br><br><br><br>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Recurso</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../FRESAS_ARTURO/resource/css/nav.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>INICIO | FRESAS DON ARTURO</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap");

        body {
        background-image: url('../../resource/img/index/fondonitido.png');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        font-family: 'Poppins', sans-serif;
    }

    form {
            margin-top: 20%;
            align-items: center; /* Centra los elementos horizontalmente */
        }

        select {
            font-size: 1.5rem; /* Aumenta el tamaño del texto */
            margin-bottom: 20px; /* Añade un espacio entre el select y el input */
            padding: 10px; /* Aumenta el espacio interno del select */
        }

        section.container-cards {
            width: 100%;
            margin: 40px auto;
            display: flex;
            justify-content: center; /* Centra los elementos en el eje horizontal */
            align-items: center; /* Centra los elementos en el eje vertical */
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1100px;
        }

        input[type="number"] {
            font-size: 1.5rem; /* Aumenta el tamaño del texto */
            padding: 10px; /* Aumenta el espacio interno del input */
            margin-bottom: 20px; /* Añade un espacio entre el input y el botón */
            font-family: 'Poppins', sans-serif;
        }

        button[type="submit"] {
            font-size: 1.5rem; /* Aumenta el tamaño del texto */
            padding: 10px 20px; /* Aumenta el espacio interno del botón */
            background-color: #4CAF50; /* Cambia el color de fondo del botón */
            color: white; /* Cambia el color del texto del botón */
            border: none; /* Elimina el borde del botón */
            cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
            border-radius: 5px; /* Añade bordes redondeados al botón */
            transition: background-color 0.3s; /* Agrega una transición suave al color de fondo */
            font-family: 'Poppins', sans-serif;
        }

        button[type="submit"]:hover {
            background-color: #d22c5d;
            transition: 0.5s;
        }

        .card{
            padding: 40px;
            width: 400px;
            min-width: 300px;
            display: flex;
            align-items: center;
            height: 210px;
            border-radius:8px ;
            justify-content: space-around;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.3s ease;
            z-index: -1;
        }

        .card:hover::after {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .card-text h3{
            color: rgba(67, 59, 59, 0.868);
            font-size: 1.6rem;
            margin:0;
            padding: 0;
            font-weight: 400;
        }
        .card-text p{
            font-size: 1.4rem;
            margin: 0;
            margin-top: 5px;
            color: rgba(67, 59, 59, 0.768);
        }
        .card .card-img{
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
        }
       
        .card-img svg{
            width: 100%;
            height: 60%;
            border-radius: 60%;
        }
        section.container-cards a{
            text-decoration: none;
        }

        /* Paleta de colores para la primera tarjeta */
        .card:nth-child(1) {
            background-color: rgba(212, 76, 160, 0.25);
            border-bottom: 6px solid rgb(235, 46, 118);
        }
        .card:nth-child(1) .card-img {
            background-color: rgba(206, 86, 112, 0.4);
        }

        /* Paleta de colores para la segunda tarjeta */
        .card:nth-child(2) {
            background-color: rgba(76, 160, 212, 0.25);
            border-bottom: 6px solid rgb(46, 118, 235);
        }
        .card:nth-child(2) .card-img {
            background-color: rgba(86, 112, 206, 0.4);
        }

        /* Paleta de colores para la tercera tarjeta */
        .card:nth-child(3) {
            background-color: rgba(160, 212, 76, 0.25);
            border-bottom: 6px solid rgb(118, 235, 46);
        }
        .card:nth-child(3) .card-img {
            background-color: rgba(112, 206, 86, 0.4);
        }

        /* Paleta de colores para la cuarta tarjeta */
        .card:nth-child(4) {
            background-color: rgba(212, 160, 76, 0.25);
            border-bottom: 6px solid rgb(235, 118, 46);
        }
        .card:nth-child(4) .card-img {
            background-color: rgba(206, 112, 86, 0.4);
        }

        .footer-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color:	#8B0000; /* Puedes ajustar el color de fondo según tus necesidades */
            color: white; /* Puedes ajustar el color del texto según tus necesidades */
            display: flex;
            justify-content: space-between;
            padding: 16px;
        }
        
        .footer-bottom small {
            font-size: 20px;
            font-weight: 500;
        }
        
        .footer-bottom-info-center {
            display: flex;
            gap: 7px;
        }
        
        @media screen and (max-width: 1000px) {
            .footer-bottom {
                align-items: center;
                gap: 10px;
                text-align: center;
                flex-direction: column;
            }
        }
        
        @media screen and (max-width: 480px) {
            .footer-bottom {
                align-items: center;
                gap: 10px;
                text-align: center;
                flex-direction: column;
            }
        }
    </style>

</head>
<body>
    <section class="container-cards">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <input type="hidden" name="id_proveedor" value="<?php echo $_SESSION['id_proveedor']; ?>">
    <select name="tipo" required>
        <option value="Abono">Abono</option>
        <option value="Fertilizantes">Fertilizantes</option>
        <option value="Pesticidas">Pesticidas</option>
    </select>
    <input type="number" name="stock" placeholder="Stock (Kg)" required>
    <button type="submit">Guardar</button>
</form>

    </section>
</body>
<?php
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
    include_once '../../../FRESAS_ARTURO/view/layout/footers/footer-admin.php';
    ?>
    
</html>
