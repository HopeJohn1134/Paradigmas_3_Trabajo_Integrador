<?php
require_once 'config/conexion.php';
require_once 'models/Usuario.php';

$modelo = new Usuario();
// Crea un usuario: admin@test.com / contraseña: 1234
if($modelo->registrar('Admin', 'admin@test.com', '1234')){
    echo "Usuario creado correctamente. <br>Email: admin@test.com <br>Pass: 1234";
} else {
    echo "Error o el usuario ya existe.";
}
?>
