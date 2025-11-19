<?php
class Articulo {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerRandom($cantidad = 3) {
        try {
            // 1. Aseguramos que cantidad sea un número entero (Seguridad)
            $limit = (int)$cantidad;

            // 2. Preparamos la consulta SQL
            // Nota: Fíjate que inyectamos $limit directamente al final
            $query = "SELECT a.id_articulo, a.titulo, a.descripcion, c.nombre AS categoria
            FROM articulos a
            JOIN categorias c ON a.id_categoria = c.id_categoria
            ORDER BY RAND()
            LIMIT $limit";

            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            // Mantenemos el modo "chivato" por si hay otro error,
            // luego lo quitaremos cuando funcione.
            die("ERROR EN LA CONSULTA SQL: " . $e->getMessage());
        }
    }
}
?>
