<?php
function filtrarProductos(PDO $pdo, $criterios) {
    $qb = new QueryBuilder($pdo);
    $qb->table('productos p')
       ->select('p.id', 'p.nombre', 'p.precio', 'p.stock', 'c.nombre AS categoria')
       ->join('categorias c', 'p.categoria_id', '=', 'c.id');

    // Filtros dinámicos
    if (isset($criterios['nombre'])) {
        $qb->where('p.nombre', 'LIKE', '%' . $criterios['nombre'] . '%');
    }

    if (isset($criterios['precio_min'])) {
        $qb->where('p.precio', '>=', $criterios['precio_min']);
    }

    if (isset($criterios['precio_max'])) {
        $qb->where('p.precio', '<=', $criterios['precio_max']);
    }

    if (isset($criterios['categoria_id'])) {
        $qb->where('p.categoria_id', '=', $criterios['categoria_id']);
    }

    if (isset($criterios['disponibilidad'])) {
        $qb->where('p.stock', '>', $criterios['disponibilidad'] ? 0 : -1);
    }

    if (isset($criterios['ordenar_por'])) {
        $qb->orderBy($criterios['ordenar_por'], $criterios['orden'] ?? 'ASC');
    }

    if (isset($criterios['limite'])) {
        $qb->limit($criterios['limite'], $criterios['offset'] ?? 0);
    }

    return $qb->execute();
}
?>
