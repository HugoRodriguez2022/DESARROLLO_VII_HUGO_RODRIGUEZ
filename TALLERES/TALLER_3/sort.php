
<?php
// Ejemplo básico de sort()
$numeros = [5, 2, 8, 1, 9];
echo "Array original: " . implode(", ", $numeros) . "</br>";
sort($numeros);
echo "Array ordenado: " . implode(", ", $numeros) . "</br>";

// Ordenar strings
$frutas = ["naranja", "manzana", "plátano", "uva"];
echo "</br>Frutas originales: " . implode(", ", $frutas) . "</br>";
sort($frutas);
echo "Frutas ordenadas: " . implode(", ", $frutas) . "</br>";

// Ejercicio: Ordenar calificaciones de estudiantes
$calificaciones = [
    "Juan" => 85,
    "María" => 92,
    "Carlos" => 78,
    "Ana" => 95
];
echo "</br>Calificaciones originales:</br>";
print_r($calificaciones);

asort($calificaciones);  // Ordena por valor manteniendo la asociación de índices
echo "Calificaciones ordenadas por nota:</br>";
print_r($calificaciones);

ksort($calificaciones);  // Ordena por clave (nombre del estudiante)
echo "Calificaciones ordenadas por nombre:</br>";
print_r($calificaciones);

// Bonus: Ordenar en orden descendente
$numeros = [5, 2, 8, 1, 9];
rsort($numeros);
echo "</br>Números en orden descendente: " . implode(", ", $numeros) . "</br>";

// Extra: Ordenar array multidimensional
$estudiantes = [
    ["nombre" => "Juan", "edad" => 20, "promedio" => 8.5],
    ["nombre" => "María", "edad" => 22, "promedio" => 9.2],
    ["nombre" => "Carlos", "edad" => 19, "promedio" => 7.8],
    ["nombre" => "Ana", "edad" => 21, "promedio" => 9.5]
];

// Ordenar por promedio
usort($estudiantes, function($a, $b) {
    return $b['promedio'] <=> $a['promedio'];
});

echo "</br>Estudiantes ordenados por promedio (descendente):</br>";
foreach ($estudiantes as $estudiante) {
    echo "{$estudiante['nombre']}: {$estudiante['promedio']}</br>";
}

// Desafío: Implementar ordenamiento personalizado
function ordenarPorLongitud($a, $b) {
    return strlen($a) - strlen($b);
}

$palabras = ["PHP", "JavaScript", "Python", "Java", "C++", "Ruby"];
usort($palabras, 'ordenarPorLongitud');
echo "</br>Palabras ordenadas por longitud (descendente):</br>";
print_r($palabras);

// Ejemplo adicional: Ordenar preservando claves
$datos = [
    "z" => "Último",
    "a" => "Primero",
    "m" => "Medio"
];

ksort($datos);  // Ordena por clave
echo "</br>Datos ordenados por clave:</br>";
print_r($datos);

arsort($datos);  // Ordena por valor en orden descendente
echo "Datos ordenados por valor (descendente):</br>";
print_r($datos);

$ciudades = [
    "Madrid" => "España",
    "París" => "Francia",
    "Londres" => "Inglaterra",
    "Roma" => "Italia"
];

echo "</br>Ciudades originales:</br>";
print_r($ciudades);

asort($ciudades);  // Ordena por valor (país)
echo "Ciudades ordenadas por país:</br>";
print_r($ciudades);

ksort($ciudades);  // Ordena por clave (ciudad)
echo "Ciudades ordenadas por nombre:</br>";
print_r($ciudades);

arsort($ciudades);  // Ordena por valor en orden descendente
echo "Ciudades ordenadas por país (descendente):</br>";
print_r($ciudades);

// Modificando ordenarPorLongitud para orden ascendente

$palabras = ["PHP", "JavaScript", "Python", "Java", "C++", "Ruby"];
usort($palabras, 'ordenarPorLongitud');
echo "</br>Palabras ordenadas por longitud (ascendente):</br>";
print_r($palabras);

// Ordenando por múltiples campos usando usort()
$productos = [
    ["nombre" => "Manzana", "precio" => 1.5, "categoria" => "Frutas"],
    ["nombre" => "Banana", "precio" => 0.9, "categoria" => "Frutas"],
    ["nombre" => "Leche", "precio" => 2.0, "categoria" => "Lácteos"],
    ["nombre" => "Pan", "precio" => 1.2, "categoria" => "Panadería"]
];

usort($productos, function($a, $b) {
    // Primero ordena por categoría, luego por precio
    $cmp = strcmp($a['categoria'], $b['categoria']);
    if ($cmp === 0) {
        return $a['precio'] <=> $b['precio'];
    }
    return $cmp;
});

echo "</br>Productos ordenados por categoría y precio:</br>";
print_r($productos);
?>
      
