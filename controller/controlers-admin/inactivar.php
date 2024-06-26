<?php 
require_once '../conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['id']) && is_numeric($_POST['id'])){
        $id = $_POST['id'];
        $estado = $_POST['estado'];

        $sqlDelete = "UPDATE USUARIOS SET Estado = '$estado' WHERE Id_cliente = $id";

        if($conn->query($sqlDelete) === TRUE){
            http_response_code(200); // OK
            exit(); 
        } else {
            http_response_code(500); // Internal Server Error
            exit();
        }
    } else {
        http_response_code(400); // Bad Request
        exit();
    }
} else {
    http_response_code(405); // Method Not Allowed
    exit();
}

?>