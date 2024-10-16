<?php
include 'utilidades_texto.php';

$frases = [
    "Tenia un cachorro gris",
    "Comprare un helado de fresa",
    "Mi hermana tiene dos tortugas"
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Análisis de Texto</title>
</head>
<body>
    <h1>Análisis de Texto</h1>
    <table border="1">
        <tr>
            <th>Frase</th>
            <th>Número de Palabras</th>
            <th>Número de Vocales</th>
            <th>Frase Invertida</th>
        </tr>
        <?php foreach ($frases as $frase): ?>
            <tr>
                <td><?php echo $frase; ?></td>
                <td><?php echo contar_palabras($frase); ?></td>
                <td><?php echo contar_vocales($frase); ?></td>
                <td><?php echo invertir_palabras($frase); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
