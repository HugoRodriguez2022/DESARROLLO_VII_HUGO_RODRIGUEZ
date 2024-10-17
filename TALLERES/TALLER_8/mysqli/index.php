<?php
include 'config.php';
include 'libros.php';
include 'usuarios.php';
include 'prestamos.php';

// Ejemplo de uso de las funciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Añadir libro
    if (isset($_POST['add_book'])) {
        agregarLibro($_POST['titulo'], $_POST['autor'], $_POST['isbn'], $_POST['anio_publicacion'], $_POST['cantidad_disponible']);
    }

    // Registrar usuario
    if (isset($_POST['register_user'])) {
        registrarUsuario($_POST['nombre'], $_POST['email'], $_POST['contrasena']);
    }

    // Registrar préstamo
    if (isset($_POST['register_loan'])) {
        registrarPrestamo($_POST['usuario_id'], $_POST['libro_id']);
    }
}

// Listar libros
$libros = listarLibros();
// Listar usuarios
$usuarios = listarUsuarios();
// Listar préstamos activos
$prestamos = listarPrestamosActivos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
</head>
<body>
    <h1>Sistema de Gestión de Biblioteca</h1>

    <h2>Añadir Libro</h2>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="text" name="isbn" placeholder="ISBN" required>
        <input type="number" name="anio_publicacion" placeholder="Año de publicación" required>
        <input type="number" name="cantidad_disponible" placeholder="Cantidad disponible" required>
        <button type="submit" name="add_book">Añadir Libro</button>
    </form>

    <h2>Registrar Usuario</h2>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit" name="register_user">Registrar Usuario</button>
    </form>

    <h2>Registrar Préstamo</h2>
    <form method="POST">
        <input type="number" name="usuario_id" placeholder="ID Usuario" required>
        <input type="number" name="libro_id" placeholder="ID Libro" required>
        <button type="submit" name="register_loan">Registrar Préstamo</button>
    </form>

    <h2>Libros Disponibles</h2>
    <ul>
        <?php foreach ($libros as $libro): ?>
            <li><?php echo $libro['titulo'] . " por " . $libro['autor']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Usuarios Registrados</h2>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li><?php echo $usuario['nombre'] . " (" . $usuario['email'] . ")"; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Préstamos Activos</h2>
    <ul>
        <?php foreach ($prestamos as $prestamo): ?>
            <li>Usuario ID: <?php echo $prestamo['usuario_id']; ?>, Libro ID: <?php echo $prestamo['libro_id']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>