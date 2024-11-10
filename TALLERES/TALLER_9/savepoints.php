<?php
require_once "config_pdo.php";

class InventoryManager {
    private $pdo;
    private $maxRetries = 3;
    private $retryDelay = 1; // segundos
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function actualizarInventarioConRetry($producto_id, $cantidad) {
        $attempts = 0;
        
        while ($attempts < $this->maxRetries) {
            try {
                $this->pdo->beginTransaction();
                
                // Verificar y actualizar stock
                $stmt = $this->pdo->prepare("SELECT stock FROM productos WHERE id = ? FOR UPDATE");
                $stmt->execute([$producto_id]);
                $stock_actual = $stmt->fetchColumn();
                
                if ($stock_actual < $cantidad) {
                    throw new Exception("Stock insuficiente para actualizar");
                }

                $stmt = $this->pdo->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
                $stmt->execute([$cantidad, $producto_id]);
                
                $this->pdo->commit();
                echo "Inventario actualizado con éxito<br>";
                return;
                
            } catch (PDOException $e) {
                $this->pdo->rollBack();
                
                if ($this->isDeadlock($e) && $attempts < $this->maxRetries - 1) {
                    $attempts++;
                    echo "Deadlock detectado, reintentando (intento $attempts)...<br>";
                    sleep($this->retryDelay);
                    continue;
                }
                
                throw $e;
            }
        }
    }

    private function isDeadlock(PDOException $e) {
        return $e->errorInfo[1] === 1213;
    }
}

// Ejemplo de uso
$im = new InventoryManager($pdo);

try {
    $im->actualizarInventarioConRetry(1, 2);
} catch (Exception $e) {
    echo "Error al actualizar el inventario: " . $e->getMessage();
}
?>