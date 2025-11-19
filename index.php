<?php

session_start();

require_once 'config/conexion.php';

//Al inicio

$controller = isset($_GET['c']) ? $_GET['c'] : 'inicio';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

// 4. Construimos el nombre del archivo y la clase
// Ejemplo: si c=articulo, buscamos ArticuloController
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';

// 5. Comprobamos si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Instanciamos el controlador (ej: $controlador = new ArticuloController())
    if (class_exists($controllerName)) {
        $object = new $controllerName();

        // Comprobamos si la acción (método) existe y la ejecutamos
        if (method_exists($object, $action)) {
            $object->$action();
        } else {
            // Error 404 simple: Método no encontrado
            echo "Error: La acción '$action' no existe en el controlador '$controllerName'.";
        }
    } else {
        echo "Error: La clase '$controllerName' no está definida.";
    }
} else {
    // Error 404 simple: Controlador no encontrado
    echo "Error: La página que buscas no existe (Controlador '$controllerName' no encontrado).";
}
?>