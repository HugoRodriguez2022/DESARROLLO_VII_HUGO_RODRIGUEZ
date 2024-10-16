<?php
require_once "config_mysqli.php";

$id = 1; 
$nombre = "New Name";
$email = "newemail@example.com";

$sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "Usuario actualizado con éxito.";
} else{
    echo "No se pudo actualizar el usuario.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>