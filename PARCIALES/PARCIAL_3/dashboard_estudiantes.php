<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'est') {
    header('Location: index.php');
    exit;
}

// Calificaciones precargadas de ejemplo
$calificaciones = [
    'est' => ['nombre' => 'Est', 'calificacion' => 88]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard del Estudiante</title>
</head>
<body>
    <h2>Bienvenido, Estudiante</h2>
    <h3>Tu Calificación</h3>
    <p>Nombre: <?= htmlspecialchars($calificaciones['est']['nombre']) ?></p>
    <p>Calificación: <?= htmlspecialchars($calificaciones['est']['calificacion']) ?></p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>

