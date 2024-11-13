<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require_once 'db_config.php';
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user']['id'])) {
        $user_id = (string)$_SESSION['user']['id'];
    } else {
        die("Error: user_id no encontrado en la sesión.");
    }

    $google_books_id = $_POST['google_books_id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $imagen_portada = $_POST['imagen_portada'];

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO libros_guardados (user_id, google_books_id, titulo, autor, imagen_portada, fecha_guardado) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $user_id, $google_books_id, $titulo, $autor, $imagen_portada);

    if ($stmt->execute()) {
        echo "Libro guardado exitosamente.";
    } else {
        echo "Error al guardar el libro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: buscar_libros.php');
    exit();
}
?>
