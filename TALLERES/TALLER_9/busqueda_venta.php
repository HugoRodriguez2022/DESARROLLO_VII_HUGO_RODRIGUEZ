<?php
function buscarVentas(PDO $pdo, $criterios) {
    $qb = new QueryBuilder($pdo);
    $qb->table('ventas v')
       ->select('v.id', 'v.fecha_venta', 'v.total', 'c.nombre AS cliente', 'p.nombre AS producto')
       ->join('clientes c', 'v.cliente_id', '=', 'c.id')
       ->join('detalles_venta dv', 'v.id', '=', 'dv.venta_id')
       ->join('productos p', 'dv.producto_id', '=', 'p.id');

    // Filtros dinámicos
    if (isset($criterios['fecha_inicio'])) {
        $qb->where('v.fecha_venta', '>=', $criterios['fecha_inicio']);
    }

    if (isset($criterios['fecha_fin'])) {
        $qb->where('v.fecha_venta', '<=', $criterios['fecha_fin']);
    }

    if (isset($criterios['cliente_id'])) {
        $qb->where('v.cliente_id', '=', $criterios['cliente_id']);
    }

    if (isset($criterios['producto_id'])) {
        $qb->where('p.id', '=', $criterios['producto_id']);
    }

    if (isset($criterios['monto_min'])) {
        $qb->where('v.total', '>=', $criterios['monto_min']);
    }

    if (isset($criterios['monto_max'])) {
        $qb->where('v.total', '<=', $criterios['monto_max']);
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
