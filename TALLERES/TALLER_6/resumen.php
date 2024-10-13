<?php
$datos = json_decode(file_get_contents('datos.json'), true);

if (empty($datos)) {
    echo "<h2>No hay registros procesados.</h2>";
} else {
    echo "<h2>Resumen de Registros:</h2>";
    echo "<table border='1'>";
    foreach ($datos as $registro) {
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<td>" . $registro['nombre'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Email</th>";
        echo "<td>" . $registro['email'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Fecha de Nacimiento</th>";
        echo "<td>" . $registro['fecha_nacimiento'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th >Edad</th>";
        echo "<td>" . $registro['edad'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Sitio Web</th>";
        echo "<td>" . $registro['sitio_web'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Género</th>";
        echo "<td>" . $registro['genero'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Intereses</th>";
        echo "<td>" . implode(", ", $registro['intereses']) . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Comentarios</th>";
        echo "<td>" . $registro['comentarios'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Foto de Perfil</th>";
        echo "<td><img src='" . $registro['foto_perfil'] . "' width='100'></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
