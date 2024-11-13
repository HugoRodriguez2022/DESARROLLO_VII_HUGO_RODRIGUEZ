<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['user']['name']) ?></h1>
        <p>Email: <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
        <a href="logout.php">Cerrar sesión</a></p>
        <a href="buscar_libros.php">Buscar libros</a></p>
        <a href="biblioteca.php">Ir a mis biblioteca</a>
    <?php else: ?>
        <h1>Inicia sesión con Google</h1>
        <a href="login.php">Login con Google</a>
    <?php endif; ?>
</body>
</html>