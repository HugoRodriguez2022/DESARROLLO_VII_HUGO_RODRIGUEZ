<?php
require_once 'configu_sesion.php';

// Lista de productos
$productos = [
    ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 10.99],
    ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 9.99],
    ['id' => 3, 'nombre' => 'Producto 3', 'precio' => 12.99],
    ['id' => 4, 'nombre' => 'Producto 4', 'precio' => 8.99],
    ['id' => 5, 'nombre' => 'Producto 5', 'precio' => 11.99],
];

// Mostrar lista de productos
echo "<h2>Productos</h2>";
echo "<ul>";
foreach ($productos as $producto) {
    echo "<li>";
    echo "<a href='agregar_al_carrito.php?id=" . $producto['id'] . "'>" . htmlspecialchars($producto['nombre']) . "</a> - $" . number_format($producto['precio'], 2);
    echo "</li>";
}
echo "</ul>";

// Enlace para ver el carrito
echo "<p><a href='ver_carrito.php'>Ver carrito</a></p>";
?>
