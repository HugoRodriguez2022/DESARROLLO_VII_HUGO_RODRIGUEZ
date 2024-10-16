<?php
require_once "config_mysqli.php";

$id = 1; 
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

if(mysqli_stmt_affected_rows($stmt) > 0){
    echo "Usuario eliminado con éxito.";
} else{
    echo "No se pudo eliminar el usuario.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>