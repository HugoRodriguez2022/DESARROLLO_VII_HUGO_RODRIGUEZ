<?php
require_once "config_mysqli.php";

// 1. Productos que tienen un precio mayor al promedio de su categoría
$sql = "SELECT p.nombre, p.precio, c.nombre as categoria,
        (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) as promedio_categoria
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE p.precio > (
            SELECT AVG(precio)
            FROM productos p2
            WHERE p2.categoria_id = p.categoria_id
        )";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: {$row['promedio_categoria']}<br>";
    }
    mysqli_free_result($result);
}

// 2. Clientes con compras superiores al promedio
$sql = "SELECT c.nombre, c.email,
        (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) as total_compras,
        (SELECT AVG(total) FROM ventas) as promedio_ventas
        FROM clientes c
        WHERE (
            SELECT SUM(total)
            FROM ventas
            WHERE cliente_id = c.id
        ) > (
            SELECT AVG(total)
            FROM ventas
        )";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Total compras: {$row['total_compras']}, ";
        echo "Promedio general: {$row['promedio_ventas']}<br>";
    }
    mysqli_free_result($result);
}

// 3. Productos que nunca se han vendido
$sql = "SELECT p.nombre, p.precio, c.nombre as categoria
        FROM productos p
        LEFT JOIN detalles_venta dv ON p.id = dv.producto_id
        LEFT JOIN categorias c ON p.categoria_id = c.id
        WHERE dv.producto_id IS NULL";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Productos que nunca se han vendido:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Precio: {$row['precio']}, Categoría: {$row['categoria']}<br>";
    }
    mysqli_free_result($result);
}

// 4. Listar las categorías con el número de productos y el valor total del inventario.
$sql = "SELECT c.nombre, COUNT(p.id) as total_productos, SUM(p.precio * p.stock) as valor_total_inventario
        FROM categorias c
        LEFT JOIN productos p ON c.id = p.categoria_id
        GROUP BY c.id";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Categorías con número de productos y valor total del inventario:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Categoría: {$row['nombre']}, Total productos: {$row['total_productos']}, ";
        echo "Valor total del inventario: {$row['valor_total_inventario']}<br>";
    }
    mysqli_free_result($result);
}

// 5. Clientes que han comprado todos los productos de una categoría específica{{{}}}
$categoria_id = 1;
$sql = "SELECT c.nombre, c.email
        FROM clientes c
        WHERE NOT EXISTS (
            SELECT 1
            FROM productos p
            WHERE p.categoria_id = $categoria_id
            AND p.id NOT IN (
                SELECT dv.producto_id
                FROM ventas v
                JOIN detalles_venta dv ON v.id = dv.venta_id
                WHERE v.cliente_id = c.id
            )
        )";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Clientes que han comprado todos los productos de la categoría ID $categoria_id:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Cliente: {$row['nombre']}, Email: {$row['email']}<br>";
    }
    mysqli_free_result($result);
}


// 6. Porcentaje de ventas de cada producto respecto al total de ventas
$sql = "SELECT p.nombre, 
        (SUM(dv.cantidad * dv.precio_unitario) / (SELECT SUM(cantidad * precio_unitario) FROM detalles_venta) * 100) as porcentaje_ventas
        FROM productos p
        JOIN detalles_venta dv ON p.id = dv.producto_id
        GROUP BY p.id";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h3>Porcentaje de ventas de cada producto respecto al total de ventas:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Producto: {$row['nombre']}, Porcentaje de ventas: {$row['porcentaje_ventas']}%<br>";
    }
    mysqli_free_result($result);
}

mysqli_close($conn);
?>