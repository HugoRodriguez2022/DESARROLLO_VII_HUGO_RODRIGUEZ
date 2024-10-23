<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'pro') {
    header('Location: index.php');
    exit;
}

// Calificaciones precargadas de ejemplo
$calificaciones = [
    ['nombre' => 'Est', 'calificacion' => 88],
    ['nombre' => 'Leo', 'calificacion' => 92],
    ['nombre' => 'Max', 'calificacion' => 78]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard del Profesor</title>
</head>
<body>
    <h2>Bienvenido, Profesor</h2>
    <h3>Listado de Calificaciones de los Estudiantes</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($calificaciones as $estudiante): ?>
                <tr>
                    <td><?= htmlspecialchars($estudiante['nombre']) ?></td>
                    <td><?= htmlspecialchars($estudiante['calificacion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>
