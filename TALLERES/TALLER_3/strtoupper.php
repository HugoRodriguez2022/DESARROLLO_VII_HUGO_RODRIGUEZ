
<?php
// Ejemplo básico de strtoupper()
$textoMixto = "HoLa MuNdO";
$textoMayusculas = strtoupper($textoMixto);
echo "Texto original: $textoMixto</br>";
echo "Texto en mayúsculas: $textoMayusculas</br>";

// Ejemplo con una frase
$frase = "php es un lenguaje de programación";
$fraseMayusculas = strtoupper($frase);
echo "</br>Frase original: $frase</br>";
echo "Frase en mayúsculas: $fraseMayusculas</br>";

// Ejercicio: Convierte el nombre de tu ciudad y país a mayúsculas
$ciudad = "Ciudad De Panama";
$pais = "Panama";
$ciudadMayusculas = strtoupper($ciudad);
$paisMayusculas = strtoupper($pais);
echo "</br>Tu ciudad en mayúsculas: $ciudadMayusculas</br>";
echo "Tu país en mayúsculas: $paisMayusculas</br>";

// Bonus: Crear un encabezado para un documento
function crearEncabezado($texto) {
    return str_pad(strtoupper($texto), strlen($texto) + 4, "*", STR_PAD_BOTH);
}

$tituloDocumento = "Informe importante";
echo "</br>" . crearEncabezado($tituloDocumento) . "</br>";

function creaEncabezado($texto) {
    return str_pad(strtoupper($texto), strlen($texto) + 4, "*", STR_PAD_BOTH);
}

$tituloDoc = "Titulo de Encabezado";
echo "</br>" . creaEncabezado($tituloDoc) . "</br>";

// Extra: Convertir un array de strings a mayúsculas
$frutas = ["manzana", "banana", "cereza", "dátil"];
$frutasMayusculas = array_map('strtoupper', $frutas);
echo "</br>Frutas originales:</br>";
print_r($frutas);
echo "Frutas en mayúsculas:</br>";
print_r($frutasMayusculas);

$colores = ["amarillo", "azul", "violeta", "anaranjado"];
$coloresMayusculas = array_map('strtoupper', $colores);
echo "</br>Colores originales:</br>";
print_r($colores);
echo "Frutas en mayúsculas:</br>";
print_r($coloresMayusculas);

// Desafío: Crea una función que convierta a mayúsculas solo la primera letra de cada palabra
function primerLetraMayuscula($frase) {
    $palabras = explode(" ", strtolower($frase));
    $palabrasModificadas = array_map(function($palabra) {
        return strtoupper(substr($palabra, 0, 1)) . substr($palabra, 1);
    }, $palabras);
    return implode(" ", $palabrasModificadas);
}

$fraseOriginal = "esta es una frase de prueba";
$fraseModificada = primerLetraMayuscula($fraseOriginal);
echo "</br>Frase original: $fraseOriginal</br>";
echo "Frase modificada: $fraseModificada</br>";

$frase2Original = "mi segunda frase de prueba";
$frase2Modificada = primerLetraMayuscula($frase2Original);
echo "</br>Frase original: $frase2Original</br>";
echo "Frase modificada: $frase2Modificada</br>";
?>
      
