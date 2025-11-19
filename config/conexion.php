<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'resena_bd');
define('DB_USER', 'admin01');
define('DB_PASS', 'admin01');
define('DB_CHARSET', 'utf8mb4');
date_default_timezone_set('America/Argentina/Buenos_Aires');
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
            ];
            
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
            
        } catch(PDOException $e) {
            if (DEBUG_MODE) {
                die("Error de conexión: " . $e->getMessage());
            } else {
                die("Error al conectar con la base de datos. Por favor, contacte al administrador.");
            }
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("No se puede deserializar un singleton.");
    }
}

