<?php
require_once 'configu_sesion.php';

// Vaciar el carrito
unset($_SESSION['carrito']);

// Mostrar un mensaje de confirmación
echo "<h2>Gracias por su compra!</h2>";
echo "<p>Su compra ha sido procesada con éxito.</p>";

// Recordar el nombre del usuario con una cookie
if (isset($_POST['nombre'])) {
    setcookie('nombre_usuario', $_POST['nombre'], time() + 86400);
}

// Enlace para volver a la página de productos
echo "<p><a href='productos.php'>Volver a la tienda</a></p>";
?>
