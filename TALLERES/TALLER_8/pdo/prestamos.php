<?php
include 'config.php';

// Registrar préstamo
function registrarPrestamo($usuario_id, $libro_id) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO prestamos (usuario_id, libro_id) VALUES (:usuario_id, :libro_id)");
    $stmt->execute(['usuario_id' => $usuario_id, 'libro_id' => $libro_id]);
    echo "Préstamo registrado exitosamente.";
}

// Listar préstamos activos
function listarPrestamosActivos() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM prestamos WHERE fecha_devolucion IS NULL");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Registrar devolución
function registrarDevolucion($prestamo_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE prestamos SET fecha_devolucion=NOW() WHERE id=:id");
    $stmt->execute(['id' => $prestamo_id]);
    echo "Devolución registrada exitosamente.";
}

// Mostrar historial de préstamos por usuario
function mostrarHistorialPrestamos($usuario_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT p.id, l.titulo, p.fecha_prestamo, p.fecha_devolucion FROM prestamos p JOIN libros l ON p.libro_id=l.id WHERE p.usuario_id=:usuario_id");
    $stmt->execute(['usuario_id' => $usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>