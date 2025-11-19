<?php

session_start();

require_once 'config/conexion.php';

//Al inicio

$controller = isset($_GET['c']) ? $_GET['c'] : 'inicio';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';


$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';


if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Instanciamos el controlador (ej: $controlador = new ArticuloController())
    if (class_exists($controllerName)) {
        $object = new $controllerName();
        if (method_exists($object, $action)) {
            $object->$action();
        } else {
            // Error 404 
            echo "Error: La acción '$action' no existe en el controlador '$controllerName'.";
        }
    } else {
        echo "Error: La clase '$controllerName' no está definida.";
    }
} else {
    // Error 404 
    echo "Error: La página que buscas no existe (Controlador '$controllerName' no encontrado).";
}
?>