
<?php
// Ejemplo de uso de count()
$frutas = ["Manzana", "Naranja", "Plátano", "Uva", "Pera"];
$numFrutas = count($frutas);

echo "Array de frutas:
";
print_r($frutas);
echo "Número de frutas: $numFrutas
";

// Ejercicio: Crea un array con los nombres de tus 5 canciones favoritas
// y usa count() para mostrar cuántas canciones hay en tu lista
$misCanciones = ["Don't stop me now","It's my life","Starman","Heroes","Hey Jude"]; // Reemplaza esto con tu array de canciones
$numCanciones = count($misCanciones);

echo "
Número de canciones en mi lista: $numCanciones
";

// Bonus: Usa count() con un array multidimensional
$playlist = [
    "Rock" => ["Bohemian Rhapsody", "Stairway to Heaven",],
    "Pop" => ["Thriller", "Billie Jean", "Beat It"],
    "Jazz" => ["Take Five", "So What"]
];

$totalCanciones = 0;
foreach ($playlist as $genero => $canciones) {
    $numCancionesGenero = count($canciones);
    $totalCanciones += $numCancionesGenero;
    echo "Canciones de $genero: $numCancionesGenero
";
}

echo "Total de canciones en la playlist: $totalCanciones
";

$teamlist = [
    "España" => ["FC Barcelona", "Real Madrid", "Atletico de Madrid"],
    "Inglaterra" => ["Manchester City", "Liverpool FC", "Arsenal FC"],
    "Italia" => ["Inter Milan CF", "AC Milan", "Juventus FC"]
];

$totalCanciones = 0;
foreach ($teamlist as $pais => $equipos) {
    $numEquiposPais = count($equipos);
    $totalEquipos += $numEquiposPais;
    echo "Numero de equipos de $pais: $numEquiposPais
";
}

echo "Total de equipos en la Champions: $totalEquipos
";

?>
      
