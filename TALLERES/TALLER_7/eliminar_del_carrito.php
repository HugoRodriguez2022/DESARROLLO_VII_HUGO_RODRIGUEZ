<?php
require_once 'configu_sesion.php';

// Obtener el ID del producto
$id_producto = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Eliminar el producto del carrito
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $key => $item) {
        if ($item['id'] == $id_producto) {
            unset($_SESSION['carrito'][$key]);
            break;
        }
    }
}

// Redireccionar a la página de carrito
header('Location: ver_carrito.php');
exit;
?>
