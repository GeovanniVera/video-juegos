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
$titulo = "Login";

// Inicia el almacenamiento en búfer de salida.
ob_start();
?>
<!-- Aqui va el codigo de la pagina este se guardara en la variable $contenido -->
<div class="container-form">
    <?php if (isset($exitos) && !empty($exitos)): ?>
        <?php foreach ($exitos as $exito): ?>
            <div class="alert alert-success">
                <?php echo $exito ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($errores) && !empty($errores)): ?>
        <?php foreach ($errores as $error): ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="/login" method="post" class="form" id="loginForm">
        <h1 class="text-center">Inicia sesión</h1>
        <div class="row">
            <label for="email" class="form-label">Correo Electronico:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="row">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="row">
            <input type="submit" value="Iniciar Sesion" class="submit">
        </div>
        <a href="">¿olvidaste tu Contraseña?</a>
    </form>
    
</div>
<script src="/js/login.js"></script>
<!-- Aqui termina el codigo de la pagina-->

<?php
// Obtiene el contenido del búfer y lo asigna a la variable $contenido.
$contenido = ob_get_clean();
//tipo de navegacion que usara esta vista
//Define si agregar el header 1 si $header = 1 si no es necesario solo no la agregues por ejemplo en el dashboard
$header = 1;

// Incluye la página maestra.
include __DIR__ . "/../layouts/master.php";
?>