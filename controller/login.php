<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERROR</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php

    session_start();

    include '../../FRESAS_ARTURO/controller/conexion.php';

    $Cedula = $_POST['Cedula'];
    $Contrasena = $_POST['Contrasena'];

    $validar = mysqli_query($conn, "SELECT * FROM usuarios WHERE Cedula='$Cedula'");

    if (mysqli_num_rows($validar) > 0) {
        $fila = mysqli_fetch_assoc($validar);

        $_SESSION['Id_cliente'] = $fila['Id_cliente'];

        if (password_verify($Contrasena, $fila['contrasena'])) {
            $_SESSION['Id_cliente'] = $fila['Id_cliente'];

            if ($fila['cargos'] == 1) {

                header("location: ../inicio_admin.php");
                exit();
            } else if ($fila['cargos'] == 2) {
                if ($fila['Estado'] == 'ACTIVO') {
                    header("location: ../index_usuarios.php");
                    exit();
                } else {
    ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Usuario Inhabilitado',
                            text: 'El usuario ha sido desactivado, para más información comuníquese con nosotros'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "../model/login_usuarios.php";
                            }
                        });
                    </script>
            <?php
                    exit();
                }
            } else {
                echo "Error: Base de datos.";
                exit();
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Credenciales incorrectas',
                    text: 'Revise los datos ingresados. Intente nuevamente'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "../model/login_usuarios.php";
                    }
                });
            </script>
        <?php
            exit();
        }
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'No se encuentra registrado',
                text: 'Revise los datos ingresados. Intente nuevamente'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "../model/login_usuarios.php";
                }
            });
        </script>
</body>

</html>
<?php

    }

    // Cerrar la sesión
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión
    header("location: ../model/login_usuarios.php");
    exit();
?>