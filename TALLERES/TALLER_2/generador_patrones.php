<?php

echo "Patrón de triángulo rectángulo:\n";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n";
}

echo "\nNúmeros impares del 1 al 20:\n";
$num = 1;
while ($num <= 20) {
    if ($num % 2 != 0) {
        echo $num . " ";
    }
    $num++;
}
echo "\n";

echo "\nContador regresivo desde 10 hasta 1 (saltando el número 5):\n";
$count = 10;
do {
    if ($count != 5) {
        echo $count . " ";
    }
    $count--;
} while ($count >= 1);
echo "\n";
?>
