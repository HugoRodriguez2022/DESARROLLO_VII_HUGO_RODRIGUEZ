<?php
// Configuración de sesión
session_start([
    'cookie_lifetime' => 86400, // 24 horas
    'cookie_httponly' => true,
    'use_strict_mode' => true,
]);

// Configuración de seguridad
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
?>
