<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <?php
    if (isset($header) && $header === 1) {
        include __DIR__ . '/header.php';
    }
    ?>

    <?php
    // Lógica para determinar qué navegación incluir
    if (isset($tipo_navegacion) && $tipo_navegacion === 'lateral') {
        include __DIR__ . '/nav_lateral.php';
    }
    ?>

    <main>
        <?php echo $contenido; ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>

</html>
<?php
/**
 * master.php - Página maestra para el sitio web.
 *
 * Esta página define la estructura común de todas las páginas del sitio,
 * incluyendo el encabezado, el pie de página y el contenido principal.
 *
 * Recibe:
 * - $titulo: El título de la página (string).
 * - $contenido: El contenido específico de la página (string).
 *
 * Devuelve:
 * - HTML completo de la página.
 */
?>