<?php
// 1. Crear un arreglo de estudiantes con sus calificaciones
$estudiantes = [
    ["nombre" => "Ana", "calificaciones" => [85, 92, 78, 96, 88]],
    ["nombre" => "Juan", "calificaciones" => [75, 84, 91, 79, 86]],
    ["nombre" => "María", "calificaciones" => [92, 95, 89, 97, 93]],
    ["nombre" => "Pedro", "calificaciones" => [70, 72, 78, 75, 77]],
    ["nombre" => "Laura", "calificaciones" => [88, 86, 90, 85, 89]]
];

// 2. Función para calcular el promedio de calificaciones
function calcularPromedio($calificaciones) {
    return array_sum($calificaciones) / count($calificaciones);
}

// 3. Función para asignar una letra de calificación basada en el promedio
function asignarLetraCalificacion($promedio) {
    if ($promedio >= 90) return 'A';
    if ($promedio >= 80) return 'B';
    if ($promedio >= 70) return 'C';
    if ($promedio >= 60) return 'D';
    return 'F';
}

// 4. Procesar y mostrar información de estudiantes
echo "Información de estudiantes:\n";
foreach ($estudiantes as &$estudiante) {
    $promedio = calcularPromedio($estudiante["calificaciones"]);
    $estudiante["promedio"] = $promedio;
    $estudiante["letra_calificacion"] = asignarLetraCalificacion($promedio);
    
    echo "{$estudiante['nombre']}:\n";
    echo "  Calificaciones: " . implode(", ", $estudiante["calificaciones"]) . "\n";
    echo "  Promedio: " . number_format($promedio, 2) . "\n";
    echo "  Calificación: {$estudiante['letra_calificacion']}\n\n";
}

// 5. Encontrar al estudiante con el promedio más alto
$mejorEstudiante = array_reduce($estudiantes, function($mejor, $actual) {
    return (!$mejor || $actual["promedio"] > $mejor["promedio"]) ? $actual : $mejor;
});

echo "Estudiante con el promedio más alto: {$mejorEstudiante['nombre']} ({$mejorEstudiante['promedio']})\n";

// 6. Calcular y mostrar el promedio general de la clase
$promedioGeneral = array_sum(array_column($estudiantes, "promedio")) / count($estudiantes);
echo "Promedio general de la clase: " . number_format($promedioGeneral, 2) . "\n";

// 7. Contar estudiantes por letra de calificación
$conteoCalificaciones = array_count_values(array_column($estudiantes, "letra_calificacion"));
echo "Distribución de calificaciones:\n";
foreach ($conteoCalificaciones as $letra => $cantidad) {
    echo "$letra: $cantidad estudiante(s)\n";
}

// 8. Función para identificar estudiantes que necesitan tutoría
function estudiantesNecesitanTutoria($estudiantes) {
    $necesitanTutoria = [];
    foreach ($estudiantes as $estudiante) {
        if ($estudiante["promedio"] < 75) {
            $necesitanTutoria[] = $estudiante["nombre"];
        }
    }
    return $necesitanTutoria;
}

// 9. Función para listar estudiantes de honor
function estudiantesDeHonor($estudiantes) {
    $deHonor = [];
    foreach ($estudiantes as $estudiante) {
        if ($estudiante["promedio"] >= 90) {
            $deHonor[] = $estudiante["nombre"];
        }
    }
    return $deHonor;
}

// Mostrar estudiantes que necesitan tutoría
echo "\nEstudiantes que necesitan tutoría:\n";
$necesitanTutoria = estudiantesNecesitanTutoria($estudiantes);
echo implode(", ", $necesitanTutoria) . "\n";

// Mostrar estudiantes de honor
echo "\nEstudiantes de honor:\n";
$deHonor = estudiantesDeHonor($estudiantes);
echo implode(", ", $deHonor) . "\n";
?>
   