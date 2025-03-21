<?php
/**
 * productos/index.php - Página de productos.
 *
 * Esta página muestra una lista de productos.
 * Utiliza la página maestra master.php para mantener la consistencia.
 *
 * Recibe:
 * - Ninguna entrada directa.
 *
 * Devuelve:
 * - HTML completo de la página de productos.
 */

// Define el título de la página.
$titulo = "Error Interno del Servidor";

// Inicia el almacenamiento en búfer de salida.
ob_start();
?>
<!-- Aqui va el codigo de la pagina este se guardara en la variable $contenido -->
<h1>500 - Error Interno del Servidor</h1>
<p>Algo salió mal en el servidor. Por favor, intenta más tarde.</p>
<!-- Aqui termina el codigo de la pagina-->

<?php
// Obtiene el contenido del búfer y lo asigna a la variable $contenido.
$contenido = ob_get_clean();
//tipo de navegacion que usara esta vista
$tipo_navegacion = 'lateral';
//Define si agregar el header 1 si $header = 1 si no es necesario solo no la agregues por ejemplo en el dashboard


// Incluye la página maestra.
include __DIR__."/../layouts/master.php";
?>