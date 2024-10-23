<?php
session_start();

// Credenciales predefinidas
$usuarios = [
    'pro' => ['nombre' => 'pro', 'contraseña' => 'adm12'],
    'est' => ['nombre' => 'est', 'contraseña' => 'usr12']
];

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $contraseña = trim($_POST['contraseña']);
    
    // Validaciones básicas
    if (strlen($nombre) !== 3 || !ctype_alnum($nombre)) {
        $error = "El nombre de usuario debe tener exactamente 3 caracteres alfanuméricos.";
    } elseif (strlen($contraseña) !== 5) {
        $error = "La contraseña debe tener exactamente 5 caracteres.";
    } else {
        // Verificar credenciales
        foreach ($usuarios as $rol => $datos) {
            if ($nombre === $datos['nombre'] && $contraseña === $datos['contraseña']) {
                $_SESSION['usuario'] = $nombre;
                $_SESSION['rol'] = $rol;
                header('Location: dashboard_' . $rol . '.php');
                exit;
            }
        }
        $error = "Credenciales inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label>Nombre de Usuario:</label>
        <input type="text" name="nombre" required><br>
        <label>Contraseña:</label>
        <input type="password" name="contraseña" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
