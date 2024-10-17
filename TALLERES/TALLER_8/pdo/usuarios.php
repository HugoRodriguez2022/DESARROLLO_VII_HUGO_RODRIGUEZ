<?php
include 'config.php';

// Registrar usuario
function registrarUsuario($nombre, $email, $contrasena) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contras ena) VALUES (:nombre, :email, :contrasena)");
    $stmt->execute(['nombre' => $nombre, 'email' => $email, 'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT)]);
    echo "Usuario registrado exitosamente.";
}

// Listar usuarios
function listarUsuarios() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Buscar usuario
function buscarUsuario($campo, $valor) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE $campo = :valor");
    $stmt->execute(['valor' => $valor]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Actualizar usuario
function actualizarUsuario($id, $nombre, $email) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET nombre=:nombre, email=:email WHERE id=:id");
    $stmt->execute(['nombre' => $nombre, 'email' => $email, 'id' => $id]);
    echo "Usuario actualizado exitosamente.";
}

// Eliminar usuario
function eliminarUsuario($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=:id");
    $stmt->execute(['id' => $id]);
    echo "Usuario eliminado exitosamente.";
}
?>