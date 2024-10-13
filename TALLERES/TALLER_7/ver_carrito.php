<?php
require_once 'configu_sesion.php';

// Mostrar el contenido del carrito
if (isset($_SESSION['carrito'])) {
    echo "<h2>Carrito</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th><th>Eliminar</th></tr>";

    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($item['nombre']) . "</td>";
        echo "<td>$" . number_format($item['precio'], 2) . "</td>";
        echo "<td>" . $item['cantidad'] . "</td>";
        echo "<td>$" . number_format($item['precio'] * $item['cantidad'], 2) . "</td>";
        echo "<td><a href='eliminar_del_carrito.php?id=" . $item['id'] . "'>Eliminar </a></td>";
        echo "</tr>";
        $total += $item['precio'] * $item['cantidad'];
    }

    echo "<tr><th colspan='4'>Total:</th><td>$" . number_format($total, 2) . "</td></tr>";
    echo "</table>";

    // Enlace para finalizar la compra
    echo "<p><a href='checkout.php'>Finalizar compra</a></p>";
} else {
    echo "Carrito vacío.";
}
?>
