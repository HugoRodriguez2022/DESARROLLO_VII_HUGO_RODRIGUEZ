<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require_once 'db_config.php';
require_once 'config.php';

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$user_id = $_SESSION['user']['id'];
$sql = "SELECT * FROM libros_guardados WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$libros = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mi Biblioteca</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Mi Biblioteca</h1>
    <a href="buscar_libros.php">Buscar más libros</a></p>
    <a href="index.php">Regresar al Logout</a>

    <?php if (count($libros) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Imagen de Portada</th>
                    <th>Reseña Personal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= htmlspecialchars($libro['titulo']) ?></td>
                        <td><?= htmlspecialchars($libro['autor']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($libro['imagen_portada'] ?? 'sin_imagen.png') ?>" alt="Imagen de portada" style="width:100px;">
                        </td>
                        <td>
                            <form method="post" action="guardar_resena.php">
                                <textarea name="resena" placeholder="Escribe tu reseña personal..."><?= htmlspecialchars($libro['resena_personal'] ?? '') ?></textarea></p>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($libro['id']) ?>">
                                <input type="submit" value="Guardar Reseña">
                            </form>
                        </td>
                        <td>
                            <form method="post" action="eliminar_libro.php">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($libro['id']) ?>">
                                <input type="submit" value="Eliminar de mi biblioteca">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No has guardado ningún libro aún.</p>
    <?php endif; ?>
</body>
</html>