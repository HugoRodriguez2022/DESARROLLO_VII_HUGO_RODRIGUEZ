<?php
require_once "config_pdo.php";

function analizarConsulta($pdo, $sql) {
    try {
        // Ejecutar EXPLAIN y obtener resultados en formato JSON
        $stmt = $pdo->prepare("EXPLAIN FORMAT=JSON " . $sql);
        $stmt->execute();
        $explain = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Ejecutar la consulta y medir el tiempo
        $inicio = microtime(true);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $fin = microtime(true);
        
        // Mostrar resultados en tabla
        echo "<h3>Análisis de la consulta</h3>";
        echo "<table border='1'>";
        echo "<tr><th>EXPLAIN (JSON)</th><th>Tiempo de ejecución</th><th>Filas afectadas</th></tr>";
        echo "<tr>";
        echo "<td><pre>" . print_r(json_decode($explain['EXPLAIN'], true), true) . "</pre></td>";
        echo "<td>" . number_format($fin - $inicio, 4) . " segundos</td>";
        echo "<td>" . $stmt->rowCount() . "</td>";
        echo "</tr>";
        echo "</table><br>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Consultas para analizar
$consultas = [
    "Búsqueda por categoría" => "
        SELECT p.* 
        FROM productos p 
        WHERE p.categoria_id = 1
    ",
    "Búsqueda por rango de precios" => "
        SELECT p.* 
        FROM productos p 
        WHERE p.precio BETWEEN 100 AND 500
    ",
    "Ventas por período" => "
        SELECT v.*, c.nombre 
        FROM ventas v 
        JOIN clientes c ON v.cliente_id = c.id 
        WHERE v.fecha_venta BETWEEN '2023-01-01' AND '2023-12-31'
    "
];

foreach ($consultas as $descripcion => $sql) {
    echo "<h2>$descripcion</h2>";
    analizarConsulta($pdo, $sql);
}

$pdo = null;
?>
