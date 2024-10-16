<?php
require_once "config_pdo.php";

$id = 1; 

$sql = "DELETE FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo "Usuario eliminado con éxito.";
} else{
    echo "No se pudo eliminar el usuario.";
}

unset($stmt);
unset($pdo);
?>