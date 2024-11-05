<?php
require_once "config_pdo.php";

// Función para registrar una venta
function registrarVenta($pdo, $cliente_id, $producto_id, $cantidad) {
    try {
        $stmt = $pdo->prepare("CALL sp_registrar_venta(:cliente_id, :producto_id, :cantidad, @venta_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        
        // Obtener el ID de la venta
        $result = $pdo->query("SELECT @venta_id as venta_id")->fetch(PDO::FETCH_ASSOC);
        
        echo "Venta registrada con éxito. ID de venta: " . $result['venta_id'];
    } catch (PDOException $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($pdo, $cliente_id) {
    try {
        $stmt = $pdo->prepare("CALL sp_estadisticas_cliente(:cliente_id)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function procesarDevolucion($pdo, $venta_id, $producto_id, $cantidad) {
    try {
        $stmt = $pdo->prepare("CALL sp_procesar_devolucion(:venta_id, :producto_id, :cantidad, @estado_devolucion)");
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
        $stmt->execute();
        
        // Obtener el estado de la devolución
        $result = $pdo->query("SELECT @estado_devolucion as estado_devolucion")->fetch(PDO::FETCH_ASSOC);
        
        echo "Estado de la devolución: " . $result['estado_devolucion']. "<br>";
    } catch (PDOException $e) {
        echo "Error al procesar la devolución: " . $e->getMessage(). "<br>";
    }
}

// Función para aplicar descuento
function aplicarDescuento($pdo, $cliente_id, $descuento) {
    try {
        $stmt = $pdo->prepare("CALL sp_aplicar_descuento(:cliente_id, :descuento, @total_descuento)");
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':descuento', $descuento, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtener el total con descuento
        $result = $pdo->query("SELECT @total_descuento as total_descuento")->fetch(PDO::FETCH_ASSOC);
        
        echo "Total con descuento: $" . $result['total_descuento']. "<br>";
    } catch (PDOException $e) {
        echo "Error al aplicar el descuento: " . $e->getMessage();
    }
}

// Función para generar reporte de ventas
function generarReporteVentas($pdo, $fecha_inicio, $fecha_fin) {
    try {
        $stmt = $pdo->prepare("CALL sp_reporte_ventas_periodo(:fecha_inicio, :fecha_fin, @total_ventas, @ingresos_totales)");
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtener el reporte
        $result = $pdo->query("SELECT @total_ventas as total_ventas, @ingresos_totales as ingresos_totales")->fetch(PDO::FETCH_ASSOC);
        
        echo "Total de ventas: " . $result['total_ventas'] . "<br>";
        echo "Ingresos totales: $" . $result['ingresos_totales']. "<br>";
    } catch (PDOException $e) {
        echo "Error al generar el reporte: " . $e->getMessage();
    }
}

// Función para calcular comisiones
function calcularComisiones($pdo, $venta_id) {
    try {
        $stmt = $pdo->prepare("CALL sp_calcular_comisiones(:venta_id, @comision)");
        $stmt->bindParam(':venta_id', $venta_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Obtener la comisión
        $result = $pdo->query("SELECT @comision as comision")->fetch(PDO::FETCH_ASSOC);
        
        echo "Comisión de la venta: $" . $result['comision'];
    } catch (PDOException $e) {
        echo "Error al calcular la comisión: " . $e->getMessage();
    }
}

// Ejemplos de uso
registrarVenta($pdo, 1, 1, 2);
obtenerEstadisticasCliente($pdo, 1);
procesarDevolucion($pdo, 1, 1, 2);
aplicarDescuento($pdo, 1, 10); // 10% de descuento
generarReporteVentas($pdo, '2024-01-01', '2024-12-31');
calcularComisiones($pdo, 1);

$pdo = null;
?>
        