<?php
function actualizarProductosMasivos(PDO $pdo, $criterios, $valores) {
    $qb = new UpdateBuilder($pdo);
    $qb->table('productos');

    // Aplicar los valores de actualización
    foreach ($valores as $campo => $valor) {
        $qb->set([$campo => $valor]);
    }

    // Aplicar filtros de actualización
    if (isset($criterios['categoria_id'])) {
        $qb->where('categoria_id', '=', $criterios['categoria_id']);
    }

    if (isset($criterios['precio_min'])) {
        $qb->where('precio', '>=', $criterios['precio_min']);
    }

    if (isset($criterios['precio_max'])) {
        $qb->where('precio', '<=', $criterios['precio_max']);
    }

    if (isset($criterios['disponibilidad'])) {
        $qb->where('stock', '>', $criterios['disponibilidad'] ? 0 : -1);
    }

    return $qb->execute();
}
?>
