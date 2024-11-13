<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $url = "https://www.googleapis.com/books/v1/volumes?q={$query}";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $results = json_decode($response, true)['items'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar Libros</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Buscar Libros</h1>
    <form method="get" action="buscar_libros.php">
        <input type="text" name="query" placeholder="Escribe el título o autor del libro" required>
        <input type="submit" value="Buscar">
        <a href="biblioteca.php">Ir a mis biblioteca</a></p>
    </form>

    <?php if (isset($results)): ?>
        <h2>Resultados de la Búsqueda</h2>
        <ul>
            <?php foreach ($results as $item): ?>
                <li>
                    <h3><?= htmlspecialchars($item['volumeInfo']['title']) ?></h3>
                    <p><?= htmlspecialchars($item['volumeInfo']['authors'][0]) ?></p>
                    <img src="<?= htmlspecialchars($item['volumeInfo']['imageLinks']['thumbnail'] ?? 'sin_imagen.png') ?>" alt="Imagen de portada">
                    <form method="post" action="guardar_libro.php">
                        <input type="hidden" name="google_books_id" value="<?= htmlspecialchars($item['id']) ?>">
                        <input type="hidden" name="titulo" value="<?= htmlspecialchars($item['volumeInfo']['title']) ?>">
                        <input type="hidden" name="autor" value="<?= htmlspecialchars($item['volumeInfo']['authors'][0]) ?>">
                        <input type="hidden" name="imagen_portada" value="<?= htmlspecialchars($item['volumeInfo']['imageLinks']['thumbnail'] ?? '') ?>">
                        <input type="submit" value="Guardar en mi biblioteca">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
