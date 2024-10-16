<?php
require_once "config_mysqli.php";

function log_error($message) {
    $log_file = 'error_log.txt';
    $current_time = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$current_time] $message" . PHP_EOL, FILE_APPEND);
}

try {
    // 1. Mostrar todos los usuarios junto con el número de publicaciones que han hecho
    $sql = "SELECT u.id, u.nombre, COUNT(p.id) as num_publicaciones 
            FROM usuarios u 
            LEFT JOIN publicaciones p ON u.id = p.usuario_id 
            GROUP BY u.id";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    echo "<h3>Usuarios y número de publicaciones:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Usuario: " . $row['nombre'] . ", Publicaciones: " . $row['num_publicaciones'] . "<br>";
    }
    mysqli_free_result($result);

    // 2. Listar todas las publicaciones con el nombre del autor
    $sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
            FROM publicaciones p 
            INNER JOIN usuarios u ON p.usuario_id = u.id 
            ORDER BY p.fecha_publicacion DESC";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    echo "<h3>Publicaciones con nombre del autor:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
    mysqli_free_result($result);

    // 3. Encontrar el usuario con más publicaciones
    $sql = "SELECT u.nombre, COUNT(p.id) as num_publicaciones 
            FROM usuarios u 
            LEFT JOIN publicaciones p ON u.id = p.usuario_id 
            GROUP BY u.id 
            ORDER BY num_publicaciones DESC 
            LIMIT 1";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    echo "<h3>Usuario con más publicaciones:</h3>";
    echo "Nombre: " . $row['nombre'] . ", Número de publicaciones: " . $row['num_publicaciones'];
    mysqli_free_result($result);

    // 4. Mostrar las últimas 5 publicaciones con el nombre del autor y la fecha de publicación
    $sql = "SELECT p.titulo, u.nombre as autor, p.fecha_publicacion 
            FROM publicaciones p 
            INNER JOIN usuarios u ON p.usuario_id = u.id 
            ORDER BY p.fecha_publicacion DESC 
            LIMIT 5";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    echo "<h3>Últimas 5 publicaciones:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Título: " . $row['titulo'] . ", Autor: " . $row['autor'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
    mysqli_free_result($result);

    // 5. Listar los usuarios que no han realizado ninguna publicación
    $sql = "SELECT u.id, u.nombre 
            FROM usuarios u 
            LEFT JOIN publicaciones p ON u.id = p.usuario_id 
            WHERE p.usuario_id IS NULL";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    echo "<h3>Usuarios sin publicaciones:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . ", Nombre: " . $row['nombre'] . "<br>";
    }
    mysqli_free_result($result);

    // 6. Calcular el promedio de publicaciones por usuario
    $sql = "SELECT AVG(num_publicaciones) as promedio_publicaciones 
            FROM (SELECT u.id, COUNT(p.id) as num_publicaciones 
                  FROM usuarios u LEFT JOIN publicaciones p ON u.id = p.usuario_id 
                  GROUP BY u.id) as subquery";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Error en la consulta: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    echo "<h3>Promedio de publicaciones por usuario:</h3>";
    echo "Promedio: " . $row['promedio_publicaciones'];
    mysqli_free_result($result);

    //7. Publicacion mas reciente
    $sql = "SELECT u.nombre, p.titulo, p.fecha_publicacion 
    FROM usuarios u 
    INNER JOIN publicaciones p ON u.id = p.usuario_id 
    WHERE (u.id, p.fecha_publicacion) IN (SELECT usuario_id, MAX(fecha_publicacion) 
                                      FROM publicaciones 
                                      GROUP BY usuario_id)";

    $result = mysqli_query($conn, $sql);

    if ($result) {
    echo "<h3>Publicación más reciente de cada usuario:</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
    echo "Autor: " . $row['nombre'] . ", Título: " . $row['titulo'] . ", Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
    mysqli_free_result($result);
    } else {
    echo "Error: " . mysqli_error($conn);
    }

} catch (Exception $e) {
    log_error($e->getMessage());
    echo "Error en la consulta: " . $e->getMessage();
}

mysqli_close($conn);
?>
        
