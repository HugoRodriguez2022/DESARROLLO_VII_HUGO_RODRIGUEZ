
<?php
// Ejemplo básico de preg_match() - Modificación
$texto = "Mi número de identificación es ABC-1234.";
$patron = "/[A-Z]{3}-\d{4}/"; // Busca tres letras seguidas de un guión y cuatro dígitos
if (preg_match($patron, $texto, $coincidencias)) {
    echo "Número de identificación encontrado: {$coincidencias[0]}</br>";
} else {
    echo "No se encontró un número de identificación válido.</br>";
}

// Ejemplo de validación de email
function validarEmail($email) {
    $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($patron, $email);
}

$email1 = "usuario@example.com";
$email2 = "usuario@.com";
echo "¿'{$email1}' es un email válido? " . (validarEmail($email1) ? "Sí" : "No") . "</br>";
echo "¿'{$email2}' es un email válido? " . (validarEmail($email2) ? "Sí" : "No") . "</br>";

function validarCodigoPostal($codigoPostal) {
    $patron = "/^\d{5}$/";
    return preg_match($patron, $codigoPostal);
}

$codigoPostal1 = "28080";
$codigoPostal2 = "123";
echo "</br>¿'{$codigoPostal1}' es un código postal válido? " . (validarCodigoPostal($codigoPostal1) ? "Sí" : "No") . "</br>";
echo "¿'{$codigoPostal2}' es un código postal válido? " . (validarCodigoPostal($codigoPostal2) ? "Sí" : "No") . "</br>";


// Ejercicio: Extraer el nombre de usuario de una dirección de Twitter
function extraerUsuarioTwitter($tweet) {
    $patron = "/@([a-zA-Z0-9_]+)/";
    if (preg_match($patron, $tweet, $coincidencias)) {
        return $coincidencias[1];
    }
    return null;
}

$tweet = "Sígueme en @usuario_ejemplo para más contenido!";
$usuario = extraerUsuarioTwitter($tweet);
echo "</br>Usuario de Twitter extraído: " . ($usuario ? "@$usuario" : "No se encontró usuario") . "</br>";

// Bonus: Extraer información de una cadena con formato específico
$info = "Nombre: Juan, Edad: 30, Ciudad: Madrid";
$patron = "/Nombre: ([^,]+), Edad: (\d+), Ciudad: ([^,]+)/";
if (preg_match($patron, $info, $coincidencias)) {
    echo "</br>Información extraída:</br>";
    echo "Nombre: {$coincidencias[1]}</br>";
    echo "Edad: {$coincidencias[2]}</br>";
    echo "Ciudad: {$coincidencias[3]}</br>";
}

// Extra: Validar formato de número de teléfono
function validarTelefono($telefono) {
    $patron = "/^(\+\d{1,3}[- ]?)?\d{9,10}$/";
    return preg_match($patron, $telefono);
}

$telefono1 = "+34 123456789";
$telefono2 = "123-456-7890";
echo "</br>¿'{$telefono1}' es un teléfono válido? " . (validarTelefono($telefono1) ? "Sí" : "No") . "</br>";
echo "¿'{$telefono2}' es un teléfono válido? " . (validarTelefono($telefono2) ? "Sí" : "No") . "</br>";

// Extraer números de identificación de un texto
function extraerNumeroIdentificacion($texto) {
    $patron = "/\b[A-Z]{3}-\d{4}\b/";
    if (preg_match($patron, $texto, $coincidencias)) {
        return $coincidencias[0];
    }
    return null;
}

$textoIdentificacion = "Mi número de identificación es ABC-1234.";
$numeroIdentificacion = extraerNumeroIdentificacion($textoIdentificacion);
echo "</br>Número de identificación extraído: " . ($numeroIdentificacion ? $numeroIdentificacion : "No se encontró número de identificación") . "</br>";

// Desafío: Extraer todas las etiquetas HTML de un string// Modificar la función para capturar etiquetas HTML y sus atributos
function extraerEtiquetasHTML($html) {
    $patron = "/<(\w+)([^>]*)>/";
    preg_match_all($patron, $html, $coincidencias);
    
    $resultados = [];
    foreach ($coincidencias[1] as $key => $etiqueta) {
        $resultados[] = [
            'etiqueta' => $etiqueta,
            'atributos' => trim($coincidencias[2][$key])
        ];
    }
    
    return $resultados;
}

$html = '<a href="https://www.example.com" class="enlace">Este es un enlace</a> en un <p class="parrafo">párrafo</p>.';
$etiquetas = extraerEtiquetasHTML($html);
echo "</br>Etiquetas HTML encontradas:</br>";
foreach ($etiquetas as $etiqueta) {
    echo "Etiqueta: <b>{$etiqueta['etiqueta']}</b>, Atributos: <i>{$etiqueta['atributos']}</i></br>";
}

      
