<?php
// controllers/InicioController.php

// Importamos el modelo para poder usarlo
require_once 'models/Articulo.php';

class InicioController {

    public function index() {
        // 1. Instanciamos el modelo
        $modelo = new Articulo();

        // 2. Le pedimos los datos (3 artículos al azar)
        $articulos = $modelo->obtenerRandom(3);

        // 3. Cargamos la vista (y le pasamos la variable $articulos automáticamente)
        require_once 'views/inicio.php';
    }
}
?>
