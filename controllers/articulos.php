<?php
require_once 'conexion.php'; // Importas tu archivo

try {
    // 1. Obtener la instancia de la conexión (gracias a tu Singleton)
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // 2. Preparar la consulta (Traer artículos con su categoría)
    $sql = "SELECT a.titulo, c.nombre as categoria 
            FROM articulos a 
            JOIN categorias c ON a.id_categoria = c.id_categoria 
            WHERE a.activo = 1";

    $stmt = $conn->prepare($sql);

    // 3. Ejecutar
    $stmt->execute();

    // 4. Obtener resultados
    $resultados = $stmt->fetchAll();

    // 5. Mostrar (Ejemplo simple)
    foreach ($resultados as $row) {
        echo "Libro: " . $row['titulo'] . " - Categoría: " . $row['categoria'] . "<br>";
    }

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>