<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]); 
    }

    header("Location: ../../catalogo.php");
    exit();
} else {
    header("Location: ../../catalogo.php");
    exit();
}
?>
