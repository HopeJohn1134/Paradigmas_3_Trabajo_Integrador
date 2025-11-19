<?php
class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Función para verificar credenciales (LOGIN)
    public function login($email, $password) {
        try {
            // 1. Buscamos al usuario por su email
            $query = "SELECT * FROM usuarios WHERE email = :email AND activo = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            $usuario = $stmt->fetch();

            // 2. Si el usuario existe, verificamos la contraseña
            if ($usuario) {
                // password_verify compara el texto plano con el hash encriptado de la BD
                if (password_verify($password, $usuario['password'])) {
                    return $usuario; // ¡Éxito! Devolvemos los datos del usuario
                }
            }

            return false; // Falló usuario o contraseña

        } catch (PDOException $e) {
            return false;
        }
    }

    // Función para registrar usuario nuevo
    public function registrar($username, $email, $password) {
        try {
            // 1. Encriptamos la contraseña (NUNCA guardar en texto plano)
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :pass)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":pass", $hash);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false; // Probablemente el email ya existe
        }
    }
}
?>
