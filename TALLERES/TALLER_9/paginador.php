<?php
// Incluir la configuración de la base de datos
require_once 'config_pdo.php'; // Asegúrate de que el archivo contiene la variable $pdo correctamente configurada

// Verificar que la conexión se haya establecido correctamente
if (!$pdo) {
    die('Error de conexión a la base de datos');
}

class Paginator {
    protected $pdo;
    protected $table;
    protected $perPage;
    protected $currentPage;
    protected $totalRecords;
    protected $conditions = [];
    protected $params = [];
    protected $orderBy = '';
    protected $joins = [];
    protected $fields = ['*'];

    public function __construct(PDO $pdo, $table, $perPage = 10) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->perPage = $perPage;
        $this->currentPage = 1;
    }

    public function select($fields) {
        $this->fields = is_array($fields) ? $fields : func_get_args();
        return $this;
    }

    public function where($condition, $params = []) {
        $this->conditions[] = $condition;
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function join($join) {
        $this->joins[] = $join;
        return $this;
    }

    public function orderBy($orderBy) {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function setPage($page) {
        $this->currentPage = max(1, (int)$page);
        return $this;
    }

    public function setPerPage($perPage) {
        $this->perPage = max(1, (int)$perPage);
        return $this;
    }

    public function getTotalRecords() {
        $sql = "SELECT COUNT(*) FROM {$this->table}";
        
        if (!empty($this->joins)) {
            $sql .= " " . implode(" ", $this->joins);
        }
        
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(" AND ", $this->conditions);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetchColumn();
    }

    public function getResults() {
        $offset = ($this->currentPage - 1) * $this->perPage;
        
        $sql = "SELECT " . implode(", ", $this->fields) . " FROM {$this->table}";
        
        if (!empty($this->joins)) {
            $sql .= " " . implode(" ", $this->joins);
        }
        
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(" AND ", $this->conditions);
        }
        
        if ($this->orderBy) {
            $sql .= " ORDER BY {$this->orderBy}";
        }
        
        $sql .= " LIMIT {$this->perPage} OFFSET {$offset}";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPageInfo() {
        $totalRecords = $this->getTotalRecords();
        $totalPages = ceil($totalRecords / $this->perPage);

        return [
            'current_page' => $this->currentPage,
            'per_page' => $this->perPage,
            'total_records' => $totalRecords,
            'total_pages' => $totalPages,
            'has_previous' => $this->currentPage > 1,
            'has_next' => $this->currentPage < $totalPages,
            'previous_page' => $this->currentPage - 1,
            'next_page' => $this->currentPage + 1,
            'first_page' => 1,
            'last_page' => $totalPages,
        ];
    }

    // Función para exportar a CSV
    public function exportToCSV($filename = 'export.csv') {
        $results = $this->getResults();
        $output = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        if ($results) {
            fputcsv($output, array_keys($results[0])); // Escribe los encabezados
            foreach ($results as $row) {
                fputcsv($output, $row);
            }
        }
        fclose($output);
        exit;
    }
}

// Implementación de caché básica
function cacheResults($key, $data) {
    $file = 'cache/' . md5($key) . '.json';
    file_put_contents($file, json_encode($data));
}

function getCache($key) {
    $file = 'cache/' . md5($key) . '.json';
    if (file_exists($file) && filemtime($file) > time() - 3600) { // Cache válido por 1 hora
        return json_decode(file_get_contents($file), true);
    }
    return false;
}

// Ejemplo de uso
$paginator = new Paginator($pdo, 'productos');
$paginator->select('*')
         ->join('LEFT JOIN categorias ON productos.categoria_id = categorias.id')
         ->where('productos.precio >= ?', [100])
         ->orderBy('productos.nombre ASC');

// Obtener el número de elementos por página, si es seleccionado por el usuario
$perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;
$paginator->setPerPage($perPage);

// Usamos caché si está disponible
$cacheKey = 'productos_' . $perPage . '_' . $_GET['page'];
$cachedResults = getCache($cacheKey);

if ($cachedResults) {
    $results = $cachedResults;
} else {
    $results = $paginator->getResults();
    cacheResults($cacheKey, $results);
}

$pageInfo = $paginator->getPageInfo();

// Para exportar a CSV
if (isset($_GET['export'])) {
    $paginator->exportToCSV();
}

if (!$pdo) {
    die('Error de conexión a la base de datos');
}

// Asegúrate de que el directorio 'cache' existe o se puede crear
if (!is_dir('cache')) {
    mkdir('cache', 0777, true); // Crea el directorio si no existe
}

// Verifica que 'page' esté definido en la URL, si no, asigna un valor predeterminado
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Define las variables por defecto
$perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10; // Valor predeterminado de 10 por página

// Crea el objeto Paginator
$paginator = new Paginator($pdo, 'productos');
$paginator->select('*')
         ->join('LEFT JOIN categorias ON productos.categoria_id = categorias.id')
         ->where('productos.precio >= ?', [100])
         ->orderBy('productos.nombre ASC');

// Usamos caché si está disponible
$cacheKey = 'productos_' . $perPage . '_' . $currentPage;
$cachedResults = getCache($cacheKey);

if ($cachedResults) {
    $results = $cachedResults;
} else {
    $results = $paginator->getResults();
    cacheResults($cacheKey, $results);
}

// Información de la página
$pageInfo = $paginator->getPageInfo();

// Función para evitar pasar null a htmlspecialchars()
function safeHtml($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8'); // Usamos un valor vacío si es null
}

// Función para exportar a CSV
if (isset($_GET['export'])) {
    $paginator->exportToCSV();
}

// HTML para mostrar productos y paginación
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos Paginados</title>
    <style>
        .pagination {
            margin: 20px 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 10px;
        }
        .pagination li {
            padding: 5px 10px;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .pagination li.active {
            background-color: #007bff;
            color: white;
        }
        .pagination li.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <form method="GET">
        <label for="perPage">Elementos por página:</label>
        <select name="perPage" id="perPage" onchange="this.form.submit()">
            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
            <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20</option>
            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </form>

    <div class="results">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($row['categoria']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <ul class="pagination">
        <?php if ($pageInfo['has_previous']): ?>
        <li><a href="?page=1">Primera</a></li>
        <li><a href="?page=<?= $pageInfo['previous_page'] ?>">Anterior</a></li>
        <?php else: ?>
        <li class="disabled">Primera</li>
        <li class="disabled">Anterior</li>
        <?php endif; ?>

        <li class="active"><?= $pageInfo['current_page'] ?></li>

        <?php if ($pageInfo['has_next']): ?>
        <li><a href="?page=<?= $pageInfo['next_page'] ?>">Siguiente</a></li>
        <li><a href="?page=<?= $pageInfo['last_page'] ?>">Última</a></li>
        <?php else: ?>
        <li class="disabled">Siguiente</li>
        <li class="disabled">Última</li>
        <?php endif; ?>
    </ul>

    <a href="?export=1" class="btn btn-success">Exportar a CSV</a>
</body>
</html>
