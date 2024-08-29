
<?php
// Ejemplo básico de array_merge()
$frutas1 = ["manzana", "pera"];
$frutas2 = ["naranja", "uva"];
$todasLasFrutas = array_merge($frutas1, $frutas2);
echo "Todas las frutas:</br>";
print_r($todasLasFrutas);

// Ejemplo con arrays asociativos
$infoPersona1 = ["nombre" => "Juan", "edad" => 30];
$infoPersona2 = ["ciudad" => "Madrid", "profesion" => "Ingeniero"];
$infoCompleta = array_merge($infoPersona1, $infoPersona2);
echo "</br>Información completa de la persona:</br>";
print_r($infoCompleta);

// Ejercicio: Crea dos arrays, uno con tus comidas favoritas y otro con las de un amigo
// Usa array_merge() para combinarlos en un solo array de comidas favoritas
$misComidas = ["Pizza", "Tallarines", "Hamburguesas"]; // Reemplaza con tus comidas favoritas
$comidasAmigo = ["Spaguetti", "Patacones", "Panqueques"]; // Reemplaza con las comidas favoritas de tu amigo
$todasLasComidas = array_merge($misComidas, $comidasAmigo);
echo "</br>Todas las comidas favoritas:</br>";
print_r($todasLasComidas);

// Bonus: Manejo de claves duplicadas
$array1 = ["a" => "rojo", "b" => "verde"];
$array2 = ["b" => "azul", "c" => "amarillo"];
$resultadoMerge = array_merge($array1, $array2);
echo "</br>Resultado de merge con claves duplicadas:</br>";
print_r($resultadoMerge);

$array1 = ["1" => "abeja", "2" => "avispa"];
$array2 = ["2" => "cucaracha", "3" => "hormiga"];
$resultadoMerge = array_merge($array1, $array2);
echo "</br>Resultado de merge con claves duplicadas:</br>";
print_r($resultadoMerge);

// Extra: Uso de array_merge() con múltiples arrays
$numeros1 = [1, 2, 3];
$numeros2 = [4, 5, 6];
$numeros3 = [7, 8, 9];
$todosLosNumeros = array_merge($numeros1, $numeros2, $numeros3);
echo "</br>Todos los números combinados:</br>";
print_r($todosLosNumeros);

$numeros1 = [10, 11, 12];
$numeros2 = [13, 14, 15];
$numeros3 = [16, 17, 18];
$todosLosNumeros = array_merge($numeros1, $numeros2, $numeros3);
echo "</br>Todos los números combinados:</br>";
print_r($todosLosNumeros);


// Desafío: Usa array_merge() junto con array_unique() para combinar arrays y eliminar duplicados
$colores1 = ["rojo", "verde", "azul"];
$colores2 = ["verde", "amarillo", "rojo"];
$coloresUnicos = array_unique(array_merge($colores1, $colores2));
echo "</br>Colores únicos después de combinar:</br>";
print_r($coloresUnicos);

$felinos1 = ["Leon", "Jaguar", "Tigre"];
$felinos2 = ["Leopardo", "Puma", "Jaguar"];
$ListaFelinos = array_unique(array_merge($felinos1, $felinos2));
echo "</br>Lista de felinos después de combinar:</br>";
print_r($ListaFelinos);
?>
      
