<?php
require_once 'configu_sesion.php';

// Obtener el ID del producto
$id_producto = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Verificar si el producto existe
$productos = [
    ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10.99],
    ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 9.99],
    ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 12.99],
    ['id' => 4, 'nombre' => 'Producto 4', 'precio' => 8.99],
    ['id' => 5, 'nombre' => 'Producto 5', 'precio' => 11.99],
];

$producto = null;
foreach ($productos as $p) {
    if ($p['id'] == $id_producto) {
        $producto = $p;
        break;
    }
}

if ($producto) {
    // Añadir el producto al carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['id'] == $id_producto) {
            $item['cantidad']++;
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $_SESSION['carrito'][] = ['id' => $id_producto, 'nombre' => $producto['nombre'], 'precio' => $producto['precio'], 'cantidad' => 1];
    }

    // Redireccionar a la página de productos
    header('Location: productos.php');
    exit;
} else {
    // Mostrar un mensaje de error
    echo "Producto no encontrado.";
}
?>
