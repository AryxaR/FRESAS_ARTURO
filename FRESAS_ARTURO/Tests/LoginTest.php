<?php

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testLoginExitoso() {
        session_start();

        $_POST['Cedula'] = '1002740932';
        $_POST['Contrasena'] = 'Nicolas2005';
        include __DIR__ . '/../controller/login.php';
       
        $this->assertEquals($_SESSION['Id_cliente'], '29');
        
        $this->expectOutputString('');
    }

    public function testLoginFallido() {
        session_start();

        $_POST['Cedula'] = '46354455';
        $_POST['Contrasena'] = 'Diana1981';
        include __DIR__ . '/../controller/login.php';

        $this->assertFalse(isset($_SESSION['Id_cliente']));
        
        $this->expectOutputString('<script>alert("Revise los datos ingresados. Intente nuevamente");window.location = "../model/login_usuarios.php";</script>');
    }
}



   


