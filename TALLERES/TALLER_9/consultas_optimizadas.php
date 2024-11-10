<?php
require_once "config_pdo.php";

class ConsultasOptimizadas {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscarProductos($categoria_id, $precio_min, $precio_max) {
        $sql = "SELECT p.id, p.nombre, p.precio, p.stock
                FROM productos p
                WHERE p.categoria_id = :categoria_id
                AND p.precio BETWEEN :precio_min AND :precio_max
                AND p.stock > 0";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':categoria_id' => $categoria_id,
            ':precio_min' => $precio_min,
            ':precio_max' => $precio_max
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarVentas($pagina = 1, $por_pagina = 10) {
        $offset = ($pagina - 1) * $por_pagina;
        
        $sql = "SELECT v.id, v.fecha_venta, v.total, c.nombre as cliente
                FROM ventas v
                JOIN clientes c ON v.cliente_id = c.id
                ORDER BY v.fecha_venta DESC
                LIMIT :offset, :limit";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Ejemplo de uso
$consultas = new ConsultasOptimizadas($pdo);

// Monitoreo del tiempo de ejecución
echo "<h2>Monitoreo de Consultas Optimizadas</h2>";
echo "<table border='1'>";
echo "<tr><th>Consulta</th><th>Resultados</th><th>Tiempo de Ejecución</th></tr>";

$start_time = microtime(true);
$productos = $consultas->buscarProductos(1, 100, 500);
$execution_time = microtime(true) - $start_time;
echo "<tr><td>Búsqueda de productos</td><td>" . count($productos) . " productos encontrados</td><td>" . number_format($execution_time, 4) . " segundos</td></tr>";

$start_time = microtime(true);
$ventas = $consultas->listarVentas(1, 10);
$execution_time = microtime(true) - $start_time;
echo "<tr><td>Listado de ventas</td><td>" . count($ventas) . " ventas listadas</td><td>" . number_format($execution_time, 4) . " segundos</td></tr>";

echo "</table>";

$pdo = null;
?>

