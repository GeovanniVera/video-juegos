<?php
/**
 * Definición de rutas de la aplicación.
 * 
 * Este archivo retorna un arreglo asociativo que mapea las URIs
 * y los métodos HTTP a sus respectivos controladores y métodos.
 * 
 * - `/`: Página de inicio (GET) ejecuta `loginForm` de `LoginController`.
 * - `/login`: 
 *     - (GET) muestra el formulario de login usando `loginForm` de `LoginController`.
 *     - (POST) procesa el login usando `loginProcess` de `LoginController`.
 */

// Definición del arreglo de rutas.
$routes = [
    // Página principal que muestra el formulario de login (GET).
    '/' => [
        'GET' => ['LoginController', 'loginForm'],
    ],

    // Ruta para el formulario de login (GET) y el procesamiento del login (POST).
    '/login' => [
        'GET' => ['LoginController', 'loginForm'],      // Mostrar formulario de login
        'POST' => ['LoginController', 'loginProcess'],   // Procesar formulario de login
    ],
];

// Devolver el arreglo de rutas.
return $routes;
