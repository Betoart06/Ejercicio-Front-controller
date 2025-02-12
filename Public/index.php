<?php
// Front Controller - index.php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AboutController.php';

// Obtener la ruta solicitada
$request = $_GET['url'] ?? 'home';

// Rutas disponibles
$routes = [
    'home'  => 'HomeController',
    'about' => 'AboutController',
];

// Verificar si la ruta existe en el arreglo de rutas
if (array_key_exists($request, $routes)) {
    $controllerName = $routes[$request];

    // Verificar si la clase existe antes de instanciarla
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        $controller->index();
    } else {
        http_response_code(500);
        die("Error interno: La clase <strong>$controllerName</strong> no está definida.");
    }
} else {
    http_response_code(404);
    die("Error 404: Página <strong>$request</strong> no encontrada.");
}
