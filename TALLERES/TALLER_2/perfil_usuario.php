<?php
// Definición de variables
$nombre_completo = "Hugo Rodríguez";
$edad = 22;
$correo = "hugoarmandorc2002@gmail.com";
$telefono = 62914621;

// Definición de constante
define("OCUPACION", "Estudiante");

// Impresión de información utilizando diferentes métodos
echo "<p>Nombre Completo: " . $nombre_completo . "</p>";
print "<p>Edad: " . $edad . " años</p>";
printf("<p>Correo: %s</p>", $correo);
echo "<p>Teléfono: " . $telefono . "</p>";
echo "<p>Ocupación: " . OCUPACION . "</p>";

// Uso de var_dump para mostrar el tipo y valor de cada variable y la constante
echo "<pre>";
var_dump($nombre_completo);
var_dump($edad);
var_dump($correo);
var_dump($telefono);
var_dump(OCUPACION);
echo "</pre>";
?>
