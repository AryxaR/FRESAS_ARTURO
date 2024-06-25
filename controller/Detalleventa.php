<?php
session_start();
require_once('../../FRESAS_ARTURO/controller/conexion.php');

// Verificar si se ha enviado un ID de producto y la cantidad
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Consultar el producto en la base de datos
    $sql = "SELECT id_producto, nombre_producto, precio_producto, categoria_producto FROM productos WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    // Si el producto existe en la base de datos
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $producto = array(
            "id" => $row['id_producto'],
            "nombre" => $row['nombre_producto'],
            "precio" => $row['precio_producto'],
            "categoria" => $row['categoria_producto'],
            "cantidad" => $cantidad // Utilizar la cantidad ingresada
        );

        // Si no existe un carrito en la sesión, crear uno
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        // Verificar si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
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
    // Si no se ha enviado un ID de producto o cantidad, redirigir al catálogo
    header("Location: catalogo.php");
    exit();
}
?>
