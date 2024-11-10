<?php
require_once "config_pdo.php";

// Función para obtener estadísticas de una tabla
function obtenerEstadisticasTabla($pdo, $tabla) {
    $sql = "SHOW TABLE STATUS LIKE :tabla";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':tabla' => $tabla]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para obtener estadísticas de los índices de una tabla
function obtenerEstadisticasIndices($pdo, $tabla) {
    $sql = "SHOW INDEX FROM " . $tabla;
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para mostrar variables de rendimiento
function mostrarVariablesRendimiento($pdo) {
    $variables = [
        'innodb_buffer_pool_size', 'key_buffer_size', 
        'max_connections', 'query_cache_size', 
        'tmp_table_size', 'max_heap_table_size'
    ];
    $sql = "SHOW VARIABLES WHERE Variable_name IN ('" . implode("','", $variables) . "')";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Mostrar estadísticas en tablas HTML
$tablas = ['productos', 'ventas', 'detalles_venta', 'clientes'];

echo "<h2>Estadísticas de Tablas</h2>";
foreach ($tablas as $tabla) {
    echo "<h3>Tabla: $tabla</h3>";
    $tablaInfo = obtenerEstadisticasTabla($pdo, $tabla);
    echo "<table border='1'>";
    echo "<tr><th>Campo</th><th>Valor</th></tr>";
    foreach ($tablaInfo as $campo => $valor) {
        echo "<tr><td>$campo</td><td>$valor</td></tr>";
    }
    echo "</table>";

    echo "<h4>Índices:</h4>";
    $indices = obtenerEstadisticasIndices($pdo, $tabla);
    echo "<table border='1'>";
    echo "<tr><th>Nombre del Índice</th><th>Columna</th><th>Único</th><th>Tipo de Índice</th></tr>";
    foreach ($indices as $indice) {
        echo "<tr><td>{$indice['Key_name']}</td><td>{$indice['Column_name']}</td><td>{$indice['Non_unique']}</td><td>{$indice['Index_type']}</td></tr>";
    }
    echo "</table><br>";
}

echo "<h2>Variables de Rendimiento</h2>";
$variables = mostrarVariablesRendimiento($pdo);
echo "<table border='1'>";
echo "<tr><th>Variable</th><th>Valor</th></tr>";
foreach ($variables as $variable) {
    echo "<tr><td>{$variable['Variable_name']}</td><td>{$variable['Value']}</td></tr>";
}
echo "</table>";

// Cerrar la conexión PDO
$pdo = null;
?>
