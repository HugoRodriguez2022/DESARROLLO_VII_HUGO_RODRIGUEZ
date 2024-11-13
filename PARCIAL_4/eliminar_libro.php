<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require_once 'db_config.php'; // Incluye la configuración de la base de datos
require_once 'config.php'; // Incluye cualquier otra configuración que necesites

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $libro_id = $_POST['id'];
    } else {
        die("Error: ID del libro no proporcionado.");
    }

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM libros_guardados WHERE id = ?");
    $stmt->bind_param("i", $libro_id);

    if ($stmt->execute()) {
        echo "Libro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el libro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: biblioteca.php');
    exit();
}
?>

