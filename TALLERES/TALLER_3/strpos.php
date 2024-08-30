
<?php
// Ejemplo básico de strpos()
$texto = "Hola, mundo!";
$posicion = strpos($texto, "mundo");
echo "La palabra 'mundo' comienza en la posición: $posicion</br>";

// Búsqueda que no encuentra resultados
$busqueda = strpos($texto, "PHP");
if ($busqueda === false) {
    echo "La palabra 'PHP' no se encontró en el texto.</br>";
}

// Ejercicio: Verificar si un email es válido (contiene @)
function esEmailValido($email) {
    return strpos($email, "@") !== false;
}

$email1 = "usuario@example.com";
$email2 = "usuarioexample.com";
echo "</br>¿'$email1' es un email válido? " . (esEmailValido($email1) ? "Sí" : "No") . "</br>";
echo "¿'$email2' es un email válido? " . (esEmailValido($email2) ? "Sí" : "No") . "</br>";

// Bonus: Encontrar todas las ocurrencias de una letra
function encontrarTodasLasOcurrencias($texto, $letra) {
    $posiciones = [];
    $posicion = 0;
    while (($posicion = strpos($texto, $letra, $posicion)) !== false) {
        $posiciones[] = $posicion;
        $posicion++;
    }
    return $posiciones;
}

$frase = "La programación es divertida y desafiante";
$letra = "a";
$ocurrencias = encontrarTodasLasOcurrencias($frase, $letra);
echo "</br>Posiciones de la letra '$letra' en '$frase': " . implode(", ", $ocurrencias) . "</br>";

// Extra: Extraer el nombre de usuario de una dirección de correo electrónico
function extraerNombreUsuario($email) {
    $posicionArroba = strpos($email, "@");
    if ($posicionArroba === false) {
        return false;
    }
    return substr($email, 0, $posicionArroba);
}

$email = "usuario@example.com";
$nombreUsuario = extraerNombreUsuario($email);
echo "</br>Nombre de usuario extraído de '$email': " . ($nombreUsuario !== false ? $nombreUsuario : "Email no válido") . "</br>";

// Desafío: Censurar palabras en un texto
function censurarPalabras($texto, $palabrasCensuradas) {
    foreach ($palabrasCensuradas as $palabra) {
        $longitud = strlen($palabra);
        $censura = str_repeat("*", $longitud);
        $posicion = 0;
        while (($posicion = stripos($texto, $palabra, $posicion)) !== false) {
            $texto = substr_replace($texto, $censura, $posicion, $longitud);
            $posicion += $longitud;
        }
    }
    return $texto;
}

$textoOriginal = "Este es un texto con algunas palabras que deben ser censuradas.";
$palabrasCensuradas = ["texto", "palabras", "censuradas"];
$textoCensurado = censurarPalabras($textoOriginal, $palabrasCensuradas);
echo "</br>Texto original: $textoOriginal</br>";
echo "Texto censurado: $textoCensurado</br>";

// Ejemplo adicional: Verificar si una URL es segura (comienza con https)
function esUrlSegura($url) {
    return strpos($url, "https://") === 0;
}

$url1 = "https://www.example.com";
$url2 = "http://www.example.com";
echo "</br>¿'$url1' es una URL segura? " . (esUrlSegura($url1) ? "Sí" : "No") . "</br>";
echo "¿'$url2' es una URL segura? " . (esUrlSegura($url2) ? "Sí" : "No") . "</br>";

$texto = "Hola, mundo! ¿Cómo estás hoy?";
$subcadena = "cómo";
$posicion = strpos($texto, $subcadena);
echo "La subcadena '$subcadena' comienza en la posición: $posicion</br>";

// Función personalizada: Contar palabras en un texto
function contarPalabras($texto) {
    $palabras = explode(" ", $texto);
    return count($palabras);
}
$texto = "Este es un ejemplo de un texto con varias palabras.";
echo "El texto tiene " . contarPalabras($texto) . " palabras.</br>";

// CensurarPalabras case-insensitive y solo palabras completas
function censurarPalabrasCompletas($texto, $palabrasCensuradas) {
    foreach ($palabrasCensuradas as $palabra) {
        $patron = "/\b$palabra\b/i"; // Expresión regular para coincidencia exacta y case-insensitive
        $texto = preg_replace($patron, str_repeat("*", strlen($palabra)), $texto);
    }
    return $texto;
}
$textoOriginal = "Este es un TeXto con algunas palabras que deben ser censuradas.";
$palabrasCensuradas = ["texto", "palabras", "censuradas"];
$textoCensurado = censurarPalabrasCompletas($textoOriginal, $palabrasCensuradas);
echo "Texto censurado (case-insensitive y palabras completas): $textoCensurado</br>";

// Usando strpos() con otras funciones: Extraer el dominio de una URL
function extraerDominio($url) {
    $protocolo = strpos($url, "https://") === 0 ? "https://" : "http://";
    $urlSinProtocolo = substr($url, strlen($protocolo));
    $posicionBarra = strpos($urlSinProtocolo, "/");
    if ($posicionBarra === false) {
        return $urlSinProtocolo;
    } else {
        return substr($urlSinProtocolo, 0, $posicionBarra);
    }
}
$url = "https://www.example.com/ruta/a/un/archivo";
echo "Dominio: " . extraerDominio($url) . "</br>";
?>
      
