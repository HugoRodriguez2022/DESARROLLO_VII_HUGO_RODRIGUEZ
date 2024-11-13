<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

require_once 'db_config.php';
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['resena'])) {
        $libro_id = $_POST['id'];
        $resena = $_POST['resena'];
    } else {
        die("Error: Datos incompletos proporcionados.");
    }

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE libros_guardados SET resena_personal = ? WHERE id = ?");
    $stmt->bind_param("si", $resena, $libro_id);

    if ($stmt->execute()) {
        echo "Reseña guardada exitosamente.";
    } else {
        echo "Error al guardar la reseña: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header('Location: biblioteca.php');
    exit();
}
?>
