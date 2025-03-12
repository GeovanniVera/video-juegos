# Aplicacion De Videojuegos

Este proyecto Es un catalogo de videojuegos CRUD y Transacciones

## Instrucciones de instalacion

* Instala NodeJs: https://nodejs.org/es/download
* Instala Composer: https://getcomposer.org/download/
* Clona el repositorio
* Abre tu Terminal ubicandote en la raiz del proyecto 
* Ejectua el comando npm i
* Ejecuta el comando composer install
* para ejecutar scss y darle estilos a la aplicacion usa el comando npm run dev
* para ejecutar el servidor de php el comando es php -S localhost:3000 -t public 


## Estructura del Proyecto

* `app/`: directorio principal de la aplicacion.
* `app/Controllers/`: Directorio que contiene los controladores.
* `app/Core/`: Directorio que contiene los la conexion de base de datos, Logs, Sesiones.
* `app/Exceptions/`: Directorio que contiene las Excepciones personalizadas.
* `app/Models/`: Directorio que contiene los Modelos.
* `app/Repositories/`: Directorio que contiene los Repositorios (La logica de acceso a datos).
* `app/Services/`: Directorio que contiene los Servicios de la app (Logica de negocio Compleja).
* `app/Validators/`: Directorio que contiene las validaciones reutilizables.
* `app/Views/`: Directorio que contiene los Vistas.
* `app/Views/layouts`: Directorio que contiene los Vistas reutilizables.
* `app/Views/auth`: Directorio que contiene los Vistas de inicio de sesion y registro.
* `app/Views/errors`: Directorio que contiene los Vistas de errores 404 y 500.
* `app/Views/videojuegos`: Directorio que contiene los Vistas para los videojuegos.
* `public/index.php`: Punto de entrada principal de la aplicación.
* `routes.php`: Definición de rutas.
* `resources/`: Directorio que contiene los archivos scss y js sin procesar.
* `resources/scss/`: Directorio que contiene los archivos scss utiliza npm run dev para ejecutar.
* `resources/scss/app.scss`: Archivo que funciona como punto de entrada para los estilos scss.
* `resources/scss/base`: Directorio que contiene los archivos scss base variables, mixins etc.
* `resources/scss/base/index.scss`: Archivo que sirve como punto de entrada para los archivos definidos en base.
* `resources/scss/layouts`: Directorio que contiene los archivos scss por vista.
* `resources/scss/layouts/index.scss`: Archivo que sirve como punto de entrada para los archivos definidos en base.
* `gulpfile.js`: Archivo de configuracion para el uso de gulp y sass.


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