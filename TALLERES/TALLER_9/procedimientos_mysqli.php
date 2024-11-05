<?php
require_once "config_mysqli.php";

// Función para registrar una venta
function registrarVenta($conn, $cliente_id, $producto_id, $cantidad) {
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $cliente_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el ID de la venta
        $result = mysqli_query($conn, "SELECT @venta_id as venta_id");
        $row = mysqli_fetch_assoc($result);
        
        echo "Venta registrada con éxito. ID de venta: " . $row['venta_id'];
    } catch (Exception $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Función para obtener estadísticas de cliente
function obtenerEstadisticasCliente($conn, $cliente_id) {
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $cliente_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $estadisticas = mysqli_fetch_assoc($result);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    }
    
    mysqli_stmt_close($stmt);
}


// Función para procesar devoluciones
function procesarDevolucion($conn, $venta_id, $producto_id, $cantidad) {
    $query = "CALL sp_procesar_devolucion(?, ?, ?, @estado_devolucion)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iii", $venta_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el estado de la devolución
        $result = mysqli_query($conn, "SELECT @estado_devolucion as estado_devolucion");
        $row = mysqli_fetch_assoc($result);
        
        echo "Estado de la devolución: " . $row['estado_devolucion']. "<br>";
    } catch (Exception $e) {
        echo "Error al procesar la devolución: " . $e->getMessage(). "<br>";
    }
    
    mysqli_stmt_close($stmt);
}

// Función para aplicar descuento
function aplicarDescuento($conn, $cliente_id, $descuento) {
    $query = "CALL sp_aplicar_descuento(?, ?, @total_descuento)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "id", $cliente_id, $descuento);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el total con descuento
        $result = mysqli_query($conn, "SELECT @total_descuento as total_descuento");
        $row = mysqli_fetch_assoc($result);
        
        echo "Total con descuento: $" . $row['total_descuento']. "<br>";
    } catch (Exception $e) {
        echo "Error al aplicar el descuento: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Función para generar reporte de ventas
function generarReporteVentas($conn, $fecha_inicio, $fecha_fin) {
    $query = "CALL sp_reporte_ventas_periodo(?, ?, @total_ventas, @ingresos_totales)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $fecha_inicio, $fecha_fin);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener el reporte
        $result = mysqli_query($conn, "SELECT @total_ventas as total_ventas, @ingresos_totales as ingresos_totales");
        $row = mysqli_fetch_assoc($result);
        
        echo "Total de ventas: " . $row['total_ventas'] . "<br>";
        echo "Ingresos totales: $" . $row['ingresos_totales']. "<br>";
    } catch (Exception $e) {
        echo "Error al generar el reporte: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}

// Función para calcular comisiones
function calcularComisiones($conn, $venta_id) {
    $query = "CALL sp_calcular_comisiones(?, @comision)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $venta_id);
    
    try {
        mysqli_stmt_execute($stmt);
        
        // Obtener la comisión
        $result = mysqli_query($conn, "SELECT @comision as comision");
        $row = mysqli_fetch_assoc($result);
        
        echo "Comisión de la venta: $" . $row['comision']. "<br>";
    } catch (Exception $e) {
        echo "Error al calcular la comisión: " . $e->getMessage();
    }
    
    mysqli_stmt_close($stmt);
}


// Ejemplos de uso
registrarVenta($conn, 1, 1, 2);
obtenerEstadisticasCliente($conn, 1);
procesarDevolucion($conn, 1, 1, 2);
aplicarDescuento($conn, 1, 10); // 10% de descuento
generarReporteVentas($conn, '2024-01-01', '2024-12-31');
calcularComisiones($conn, 1);

mysqli_close($conn);
?>