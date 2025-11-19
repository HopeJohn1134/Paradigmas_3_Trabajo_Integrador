<?php
require_once 'models/Usuario.php';

class UsuarioController {

    // Muestra el formulario de Login
    public function login() {
        require_once 'views/auth/login.php';
    }

    // Procesa los datos del Login (cuando dan click a "Entrar")
    public function autenticar() {
        // Verificamos que vengan datos por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $modelo = new Usuario();
            $usuario = $modelo->login($email, $password);

            if ($usuario) {
                // ¡Login correcto! Guardamos info en la sesión
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nombre'] = $usuario['username'];

                // Redirigimos al inicio
                header("Location: index.php");
            } else {
                // Falló: Volvemos al login con error
                $error = "Email o contraseña incorrectos";
                require_once 'views/auth/login.php';
            }
        }
    }

    // Cerrar sesión
    public function logout() {
        session_destroy();
        header("Location: index.php");
    }
}
?>
