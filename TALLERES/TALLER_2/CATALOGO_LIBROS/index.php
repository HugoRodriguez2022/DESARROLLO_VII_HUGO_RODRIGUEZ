<?php
require 'includes/funciones.php';
include 'includes/header.php';

$libros = obtenerLibros();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Catálogo de Libros</h1>
    <ul>
        <?php foreach ($libros as $libro): ?>
            <li><?php echo mostrarDetallesLibro($libro); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
<?php include 'includes/footer.php'; ?>
</html>
