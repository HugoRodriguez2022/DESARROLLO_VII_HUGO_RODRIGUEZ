<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electronica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electronica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electronica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electronica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electronica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana Lopez", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gomez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "Maria Rodriguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    foreach ($productos as $producto) {
        echo "{$producto['nombre']} - {$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "\n";
    }
}

echo "Productos de {$tiendaData['tienda']}:\n";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], function($total, $producto) {
    return $total + $producto['precio'];
}, 0);

echo "\nValor total del inventario: $$valorTotal\n";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], function($max, $producto) {
    return ($producto['precio'] > $max['precio']) ? $producto : $max;
}, $tiendaData['productos'][0]);

echo "\nProducto más caro: {$productoMasCaro['nombre']} ({$productoMasCaro['precio']})\n";

// 6. Filtrar productos por categoría
// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, function($producto) use ($categoria) {
        return in_array($categoria, $producto['categorias']);
    });
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "\nProductos en la categoría 'computadoras':\n";
imprimirProductos($productosDeComputadoras);


// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electronica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "\nDatos actualizados de la tienda (JSON):\n$jsonActualizado\n";

$ventas = [
    ["producto_id" => 1, "cliente_id" => 101, "cantidad" => 2, "fecha" => "2024-09-01"],
    ["producto_id" => 2, "cliente_id" => 102, "cantidad" => 1, "fecha" => "2024-09-02"],
    ["producto_id" => 1, "cliente_id" => 103, "cantidad" => 1, "fecha" => "2024-09-03"],
    ["producto_id" => 3, "cliente_id" => 101, "cantidad" => 3, "fecha" => "2024-09-04"],
    ["producto_id" => 2, "cliente_id" => 103, "cantidad" => 2, "fecha" => "2024-09-05"]
];

// Función para generar el resumen de ventas
function generarResumenVentas($ventas) {
    $totalVentas = 0;
    $productosVendidos = [];
    $clientesCompras = [];

    foreach ($ventas as $venta) {
        $totalVentas += $venta['cantidad'];

        if (!isset($productosVendidos[$venta['producto_id']])) {
            $productosVendidos[$venta['producto_id']] = 0;
        }
        $productosVendidos[$venta['producto_id']] += $venta['cantidad'];

        if (!isset($clientesCompras[$venta['cliente_id']])) {
            $clientesCompras[$venta['cliente_id']] = 0;
        }
        $clientesCompras[$venta['cliente_id']] += $venta['cantidad'];
    }

    $productoMasVendido = array_search(max($productosVendidos), $productosVendidos);
    $clienteQueMasCompro = array_search(max($clientesCompras), $clientesCompras);

    return [
        "totalVentas" => $totalVentas,
        "productoMasVendido" => $productoMasVendido,
        "clienteQueMasCompro" => $clienteQueMasCompro
    ];
}

// Generar el resumen de ventas
$resumen = generarResumenVentas($ventas);

echo "Total de ventas: " . $resumen['totalVentas'] . "\n";
echo "Producto más vendido (ID): " . $resumen['productoMasVendido'] . "\n";
echo "Cliente que más ha comprado (ID): " . $resumen['clienteQueMasCompro'] . "\n";
?>