<?php

namespace App\Controllers;

class ErrorController
{
    public function pageNotFound()
    {
        // Cargar la vista para el error 404
        $message = "Pagina no encontrada";
        include __DIR__ . '/../View/errors/404.php';
    }

    public function methodNotFound()
    {
        // Cargar la vista para el error 404 de método no encontrado
        $message = "Metodo no encontrado";
        include __DIR__ . '/../View/errors/404.php';
    }

    public function internalError()
    {
        // Cargar la vista para el error 500
        include __DIR__ . '/../View/errors/500.php';
    }
}
