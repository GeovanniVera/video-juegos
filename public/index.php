<?php

/**
 * Punto de entrada principal de la aplicación.
 *
 * Recibe:
 * - Solicitud HTTP con URI y método.
 *
 * Devuelve:
 * - Ejecución del método del controlador correspondiente o
 * - Mensaje de error 404.
 * - Mensaje de error 500.
 */

// Incluye el autoloader de Composer.
require_once __DIR__ . '/../vendor/autoload.php';

// Incluye las rutas definidas en routes.php.
$routes = require_once __DIR__ . '/../routes.php';

// Obtiene la URI solicitada y el método HTTP.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Si la URI o el método no existen, muestra un error 404.
if (!isset($routes[$uri][$method])) {
    // Usamos el controlador de errores para mostrar el error 404
    (new \App\Controllers\ErrorController())->pageNotFound();
    exit;
}

// Obtiene el controlador y el método correspondientes.
list($controllerName, $methodName) = $routes[$uri][$method];

// Asegura que el controlador tenga el namespace adecuado.
$controllerName = "App\\Controllers\\" . $controllerName;

// Verifica si la clase existe.
if (!class_exists($controllerName)) {
    // Usamos el controlador de errores para mostrar el error 404 (clase no encontrada)
    (new \App\Controllers\ErrorController())->pageNotFound();
    exit;
}

// Crea una instancia del controlador.
$controllerInstance = new $controllerName();

// Verifica si el método existe en el controlador.
if (!method_exists($controllerInstance, $methodName)) {
    // Usamos el controlador de errores para mostrar el error 404 (método no encontrado)
    (new \App\Controllers\ErrorController())->methodNotFound();
    exit;
}

try {
    // Llama al método del controlador.
    $controllerInstance->$methodName();
} catch (Exception $e) {
    // Si ocurre un error, usamos el controlador de errores para mostrar el error 500
    (new \App\Controllers\ErrorController())->internalError();
    error_log($e->getMessage());
}
