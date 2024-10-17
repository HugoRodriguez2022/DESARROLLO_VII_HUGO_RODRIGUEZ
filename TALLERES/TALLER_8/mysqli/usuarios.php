<?php
include 'config.php';

// Registrar usuario
function registrarUsuario($nombre, $email, $contrasena) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, email, contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, password_hash($contrasena, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
}

// Listar usuarios
function listarUsuarios() {
    global $conn;
    $result = $conn->query("SELECT * FROM usuario");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Buscar usuario
function buscarUsuario($campo, $valor) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE $campo = ?");
    $stmt->bind_param("s", $valor);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Actualizar usuario
function actualizarUsuario($id, $nombre, $email) {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $nombre, $email, $id);
    $stmt->execute();
    echo "Usuario actualizado exitosamente.";
    $stmt->close();
}

// Eliminar usuario
function eliminarUsuario($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Usuario eliminado exitosamente.";
    $stmt->close();
}
?>