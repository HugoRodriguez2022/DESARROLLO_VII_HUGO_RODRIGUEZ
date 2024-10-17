<?php
include 'config.php';

// Registrar préstamo
function registrarPrestamo($usuario_id, $libro_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO prestamos (usuario_id, libro_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $usuario_id, $libro_id);

    if ($stmt->execute()) {
        echo "Préstamo registrado exitosamente.";
    } else {
        echo "Error al registrar préstamo: " . $stmt->error;
    }

    $stmt->close();
}

// Listar préstamos activos
function listarPrestamosActivos() {
    global $conn;
    $result = $conn->query("SELECT * FROM prestamos WHERE fecha_devolucion IS NULL");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Registrar devolución
function registrarDevolucion($prestamo_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE prestamos SET fecha_devolucion=NOW() WHERE id=?");
    $stmt->bind_param("i", $prestamo_id);
    $stmt->execute();
    echo "Devolución registrada exitosamente.";
    $stmt->close();
}

// Mostrar historial de préstamos por usuario
function mostrarHistorialPrestamos($usuario_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, l.titulo, p.fecha_prestamo, p.fecha_devolucion FROM prestamos p JOIN libros l ON p.libro_id=l.id WHERE p.usuario_id=?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>