<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

// Verificar si se ha enviado un ID de producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Consultar el producto en la base de datos
    $sql = "SELECT id_producto, nombre_producto, precio_producto FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    // Si el producto existe en la base de datos
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $producto = array(
            "id" => $row['id_producto'],
            "nombre" => $row['nombre_producto'],
            "precio" => $row['precio_producto'],
            "cantidad" => 1 // Puedes permitir que el usuario seleccione la cantidad
        );

        // Si no existe un carrito en la sesión, crear uno
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        // Verificar si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += 1;
        } else {
            $_SESSION['carrito'][$id_producto] = $producto;
        }

        // Redirigir de vuelta al catálogo
        header("Location: ../../FRESAS_ARTURO/catalogo.php");
        exit();
    } else {
        echo "Producto no encontrado.";
    }
} else {
    // Si no se ha enviado un ID de producto, redirigir al catálogo
    header("Location: catalogo.php");
    exit();
}
?>
