<?php

// Función para leer el inventario desde el archivo JSON
function leerInventario() {
    $json = file_get_contents('inventario.json');
    return json_decode($json, true);
}

// Función para ordenar el inventario alfabéticamente por nombre de producto
function ordenarInventario($inventario) {
    usort($inventario, function($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
    return $inventario;
}

// Función para mostrar el resumen del inventario
function mostrarResumen($inventario) {
    foreach ($inventario as $producto) {
        echo "Nombre: {$producto['nombre']}, Precio: {$producto['precio']}, Cantidad: {$producto['cantidad']}\n";
    }
}

// Función para calcular el valor total del inventario
function calcularValorTotal($inventario) {
    $total = 0;
    foreach ($inventario as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }
    return $total;
}

// Función para filtrar productos con stock bajo (menos de 5 unidades)
function productosStockBajo($inventario) {
    $productosBajos = array_filter($inventario, function($producto) {
        return $producto['cantidad'] < 5;
    });
    return $productosBajos;
}

// Script principal
$inventario = leerInventario();
$inventarioOrdenado = ordenarInventario($inventario);
echo "Inventario Ordenado:\n";
mostrarResumen($inventarioOrdenado);
echo "Valor Total del Inventario: " . calcularValorTotal($inventario) . "\n";
echo "Productos con Stock Bajo:\n";
$productosBajos = productosStockBajo($inventario);
mostrarResumen($productosBajos);

?>