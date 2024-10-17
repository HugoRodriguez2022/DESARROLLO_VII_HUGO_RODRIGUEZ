<?php
include 'config.php';

// Añadir libro
function agregarLibro($titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad_disponible) VALUES (:titulo, :autor, :isbn, :anio_publicacion, :cantidad_disponible)");
    $stmt->execute(['titulo' => $titulo, 'autor' => $autor, 'isbn' => $isbn, 'anio_publicacion' => $anio_publicacion, 'cantidad_disponible' => $cantidad_disponible]);
    echo "Libro añadido exitosamente.";
}

// Listar libros
function listarLibros() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM libros");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Buscar libro
function buscarLibro($campo, $valor) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM libros WHERE $campo = :valor");
    $stmt->execute(['valor' => $valor]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Actualizar libro
function actualizarLibro($id, $titulo, $autor, $isbn, $anio_publicacion, $cantidad_disponible) {
    global $conn;
    $stmt = $conn->prepare("UPDATE libros SET titulo=:titulo, autor=:autor, isbn=:isbn, anio_publicacion=:anio_publicacion, cantidad_disponible=:cantidad_disponible WHERE id=:id");
    $stmt->execute(['titulo' => $titulo, 'autor' => $autor, 'isbn' => $isbn, 'anio_publicacion' => $anio_publicacion, 'cantidad_disponible' => $cantidad_disponible, 'id' => $id]);
    echo "Libro actualizado exitosamente.";
}

// Eliminar libro
function eliminarLibro($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM libros WHERE id=:id");
    $stmt->execute(['id' => $id]);
    echo "Libro eliminado exitosamente.";
}
?>