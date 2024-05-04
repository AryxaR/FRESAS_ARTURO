<?php

use PHPUnit\Framework\TestCase;

class RegisterTest extends TestCase {
    public function testRegistroExitoso() {
        $_POST['Nombre'] = 'John Doe';
        $_POST['Correo'] = 'Jhondue@outlook.com';
        $_POST['Cedula'] = '128746321';
        $_POST['Contrasena'] = 'password123';
        $_POST['Rol'] = 'Mayorista';
        
        include __DIR__ . '/../controller/Registro.php';

        $this->expectOutputString('<script>alert("Usuario registrado con éxito");window.location="../model/login_usuarios.php";</script>');
    }

}

