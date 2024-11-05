<?php
require_once "config_pdo.php"; // O usar mysqli según prefieras

// Función para verificar cambios de precio
function verificarCambiosPrecio($pdo, $producto_id, $nuevo_precio) {
    try {
        // Actualizar precio
        $stmt = $pdo->prepare("UPDATE productos SET precio = ? WHERE id = ?");
        $stmt->execute([$nuevo_precio, $producto_id]);
        
        // Verificar log de cambios
        $stmt = $pdo->prepare("SELECT * FROM historial_precios WHERE producto_id = ? ORDER BY fecha_cambio DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $log = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($log) { // Verifica si hay resultados
            echo "<h3>Cambio de Precio Registrado:</h3>";
            echo "Precio anterior: $" . $log['precio_anterior'] . "<br>";
            echo "Precio nuevo: $" . $log['precio_nuevo'] . "<br>";
            echo "Fecha del cambio: " . $log['fecha_cambio'] . "<br>";
        } else {
            echo "<h3>No se encontró un historial de cambios para el producto con ID: " . $producto_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar movimiento de inventario
function verificarMovimientoInventario($pdo, $producto_id, $nueva_cantidad) {
    try {
        // Actualizar stock
        $stmt = $pdo->prepare("UPDATE productos SET stock = ? WHERE id = ?");
        $stmt->execute([$nueva_cantidad, $producto_id]);
        
        // Verificar movimientos de inventario
        $stmt = $pdo->prepare("SELECT * FROM movimientos_inventario WHERE producto_id = ? ORDER BY fecha_movimiento DESC LIMIT 1");
        $stmt->execute([$producto_id]);
        $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($movimiento) { // Verifica si hay resultados
            echo "<h3>Movimiento de Inventario Registrado:</h3>";
            echo "Tipo de movimiento: " . $movimiento['tipo_movimiento'] . "<br>";
            echo "Cantidad: " . $movimiento['cantidad'] . "<br>";
            echo "Stock anterior: " . $movimiento['stock_anterior'] . "<br>";
            echo "Stock nuevo: " . $movimiento['stock_nuevo'] . "<br>";
        } else {
            echo "<h3>No se encontró un movimiento de inventario para el producto con ID: " . $producto_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar el nivel de membresía actualizado de un cliente
function verificarNivelMembresia($pdo, $cliente_id) {
    try {
        // Verificar el nivel de membresía del cliente
        $stmt = $pdo->prepare("SELECT nivel_membresia FROM clientes WHERE id = ?");
        $stmt->execute([$cliente_id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($cliente) { // Verifica si hay resultados
            echo "<h3>Nivel de Membresía Actualizado:</h3>";
            echo "Cliente ID: " . $cliente_id . "<br>";
            echo "Nivel de Membresía: " . $cliente['nivel_membresia'] . "<br>";
        } else {
            echo "<h3>No se encontró el cliente con ID: " . $cliente_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar las estadísticas de ventas por categoría
function verificarEstadisticasCategoria($pdo, $categoria_id) {
    try {
        // Verificar las estadísticas de ventas por categoría
        $stmt = $pdo->prepare("SELECT total_ventas FROM estadisticas_categoria WHERE categoria_id = ?");
        $stmt->execute([$categoria_id]);
        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($estadisticas) { // Verifica si hay resultados
            echo "<h3>Estadísticas de Ventas por Categoría:</h3>";
            echo "Categoría ID: " . $categoria_id . "<br>";
            echo "Total de Ventas: $" . $estadisticas['total_ventas'] . "<br>";
        } else {
            echo "<h3>No se encontraron estadísticas de ventas para la categoría " . $categoria_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar la alerta de stock bajo
function verificarAlertaStock($pdo, $producto_id) {
    try {
        // Verificar alertas de stock bajo
        $stmt = $pdo->prepare("SELECT * FROM alertas_stock WHERE producto_id = ?");
        $stmt->execute([$producto_id]);
        $alerta = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($alerta) { // Verifica si hay resultados
            echo "<h3>Alerta de Stock Bajo:</h3>";
            echo "Producto ID: " . $alerta['producto_id'] . "<br>";
            echo "Mensaje: " . $alerta['mensaje'] . "<br>";
            echo "Fecha de Alerta: " . $alerta['fecha_alerta'] . "<br>";
        } else {
            echo "<h3>No hay alertas de stock bajo para el producto " . $producto_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Función para verificar el historial de cambios de estado de un cliente
function verificarHistorialEstadoCliente($pdo, $cliente_id) {
    try {
        // Verificar historial de cambios de estado
        $stmt = $pdo->prepare("SELECT * FROM historial_estado_cliente WHERE cliente_id = ?");
        $stmt->execute([$cliente_id]);
        $historial = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($historial) { // Verifica si hay resultados
            echo "<h3>Historial de Estado del Cliente:</h3>";
            echo "Cliente ID: " . $historial['cliente_id'] . "<br>";
            echo "Estado Anterior: " . $historial['estado_anterior'] . "<br>";
            echo "Estado Nuevo: " . $historial['estado_nuevo'] . "<br>";
            echo "Fecha de Cambio: " . $historial['fecha_cambio'] . "<br>";
        } else {
            echo "<h3>No hay historial de cambios de estado para el cliente " . $cliente_id . ".</h3>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Probar los triggers
verificarCambiosPrecio($pdo, 1, 999.99);
verificarMovimientoInventario($pdo, 1, 15);
verificarNivelMembresia($pdo, 1); // Verificar el nivel de membresía de un cliente
verificarEstadisticasCategoria($pdo, 1); // Verificar las estadísticas de ventas de una categoría
verificarAlertaStock($pdo, 1); // Verificar alertas de stock bajo
verificarHistorialEstadoCliente($pdo, 1); // Verificar el historial de cambios de estado de un cliente

$pdo = null;
?>
