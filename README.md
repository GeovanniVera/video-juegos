# Aplicacion De Videojuegos

Este proyecto Es un catalogo de videojuegos CRUD y Transacciones

## Estructura del Proyecto

* `app/`: directorio principal de la aplicacion.
* `app/Controllers/`: Directorio que contiene los controladores.
* `app/Core/`: Directorio que contiene los la conexion de base de datos y sesiones.
* `app/Models/`: Directorio que contiene los Modelos.
* `app/Repositories/`: Directorio que contiene los Repositorios (La logica de acceso a datos).
* `app/Services/`: Directorio que contiene los Servicios de la app (Logica de negocio Compleja).
* `app/Views/`: Directorio que contiene los Vistas.
* `app/Views/layouts`: Directorio que contiene los Vistas reutilizables.
* `app/Views/auth`: Directorio que contiene los Vistas de inicio de sesion y registro.
* `app/Views/errors`: Directorio que contiene los Vistas de errores 404 y 500.
* `app/Views/`: Directorio que contiene los Vistas reutilizables.
* `public/index.php`: Punto de entrada principal de la aplicación.
* `routes.php`: Definición de rutas.

## Definición de Rutas (routes.php)

El archivo `routes.php` define un arreglo asociativo (`$routes`) que mapea URIs y métodos HTTP a controladores y métodos.

### Estructura de Rutas

```php
$routes = [
    '/uri' => [
        'METODO_HTTP' => ['NombreControlador', 'nombreMetodo'],
    ],
    // ... otras rutas
];