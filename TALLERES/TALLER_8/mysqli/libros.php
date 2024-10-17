<?php
include 'config.php';

// Añadir libro
function agregarLibro($titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad_disponible) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible);

    if ($stmt->execute()) {
        echo "Libro añadido exitosamente.";
    } else {
        echo "Error al añadir libro: " . $stmt->error;
    }

    $stmt->close();
}

// Listar libros
function listarLibros() {
    global $conn;
    $result = $conn->query("SELECT * FROM libros");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Buscar libro
function buscarLibro($campo, $valor) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM libros WHERE $campo = ?");
    $stmt->bind_param("s", $valor);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Actualizar libro
function actualizarLibro($id, $titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible) {
    global $conn;
    $stmt = $conn->prepare("UPDATE libros SET titulo=?, autor=?, isbn=?, anio_publicacion=?, cantidad_disponible=? WHERE id=?");
    $stmt->bind_param("sssiii", $titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible, $id);
    $stmt->execute();
    echo "Libro actualizado exitosamente.";
    $stmt->close();
}

// Eliminar libro
function eliminarLibro($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM libros WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Libro eliminado exitosamente.";
    $stmt->close();
}
?>