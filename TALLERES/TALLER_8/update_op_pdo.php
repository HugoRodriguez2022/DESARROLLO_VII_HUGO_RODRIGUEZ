<?php
require_once "config_pdo.php";

$id = 1; 
$nombre = "New Name";
$email = "newemail@example.com";

$sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nombre", $nombre);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":id", $id);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo "Usuario actualizado con éxito.";
} else{
    echo "No se pudo actualizar el usuario.";
}

unset($stmt);
unset($pdo);
?>