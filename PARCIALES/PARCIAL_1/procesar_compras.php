<?php
include 'funciones_tienda.php';

$productos = [
    'camisa' => 50,
    'pantalon' => 70,
    'zapatos' => 80,
    'calcetines' => 10,
    'gorra' => 25
];

$carrito = [
    'camisa' => 2,
    'pantalon' => 1,
    'zapatos' => 1,
    'calcetines' => 3,
    'gorra' => 0
];

$subtotal = 0;
foreach ($carrito as $producto => $cantidad) {
    $subtotal += $productos[$producto] * $cantidad;
}


$descuento = calcular_descuento($subtotal);
$impuesto = aplicar_impuesto($subtotal);
$total = calcular_total($subtotal, $descuento, $impuesto);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Compra</title>
</head>
<body>
    <h1>Procesar Compras</h1>
    <ul>
        <?php foreach ($carrito as $producto => $cantidad): ?>
            <?php if ($cantidad > 0): ?>
                <li><?php echo ucfirst($producto) . " x $cantidad: $" . $productos[$producto] * $cantidad; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <p><strong>Subtotal:</strong> $<?php echo number_format($subtotal, 2); ?></p>
    <p><strong>Descuento:</strong> $<?php echo number_format($descuento, 2); ?></p>
    <p><strong>Impuesto:</strong> $<?php echo number_format($impuesto, 2); ?></p>
    <p><strong>Total a pagar:</strong> $<?php echo number_format($total, 2); ?></p>
</body>
</html>
