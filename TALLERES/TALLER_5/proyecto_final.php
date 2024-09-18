<?php

class Estudiante {
    private int $id;
    private string $nombre;
    private int $edad;
    private string $carrera;
    private array $materias;
    public string $flag;

    public function __construct(int $id, string $nombre, int $edad, string $carrera, array $materias = []) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->carrera = $carrera;
        $this->materias = $materias;
        $this->flag = 'regular';
    }

    public function agregarMateria(string $materia, float $calificacion): void {
        $this->materias[$materia] = $calificacion;
    }

    public function obtenerPromedio(): float {
        if (empty($this->materias)) {
            return 0.0;
        }
        return array_sum($this->materias) / count($this->materias);
    }

    public function obtenerDetalles(): array {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'carrera' => $this->carrera,
            'materias' => $this->materias,
            'promedio' => $this->obtenerPromedio(),
            'flag' => $this->flag
        ];
    }

    public function __toString(): string {
        return "ID: $this->id, Nombre: $this->nombre, Edad: $this->edad, Carrera: $this->carrera, Promedio: " . $this->obtenerPromedio() . ", Flag: $this->flag";
    }
}

class SistemaGestionEstudiantes {
    private array $estudiantes;
    private array $graduados;

    public function __construct() {
        $this->estudiantes = [];
        $this->graduados = [];
    }

    public function agregarEstudiante(Estudiante $estudiante): void {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    public function obtenerEstudiante(int $id): ?Estudiante {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes(): array {
        return array_map(function($estudiante) {
            return $estudiante->obtenerDetalles();
        }, $this->estudiantes);
    }

    public function calcularPromedioGeneral(): float {
        if (empty($this->estudiantes)) {
            return 0.0;
        }
        $totalPromedio = array_reduce($this->estudiantes, function($carry, $estudiante) {
            return $carry + $estudiante->obtenerPromedio();
        }, 0);
        return $totalPromedio / count($this->estudiantes);
    }

    public function obtenerEstudiantesPorCarrera(string $carrera): array {
        return array_map(function($estudiante) {
            return $estudiante->obtenerDetalles();
        }, array_filter($this->estudiantes, function($estudiante) use ($carrera) {
            return $estudiante->obtenerDetalles()['carrera'] === $carrera;
        }));
    }

    public function obtenerMejorEstudiante(): ?array {
        if (empty($this->estudiantes)) {
            return null;
        }
        $mejorEstudiante = array_reduce($this->estudiantes, function($mejor, $estudiante) {
            return ($mejor === null || $estudiante->obtenerPromedio() > $mejor->obtenerPromedio()) ? $estudiante : $mejor;
        });
        return $mejorEstudiante->obtenerDetalles();
    }

    public function generarReporteRendimiento(): array {
        $reporte = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($reporte[$materia])) {
                    $reporte[$materia] = ['total' => 0, 'count' => 0, 'max' => $calificacion, 'min' => $calificacion];
                }
                $reporte[$materia]['total'] += $calificacion;
                $reporte[$materia]['count']++;
                $reporte[$materia]['max'] = max($reporte[$materia]['max'], $calificacion);
                $reporte[$materia]['min'] = min($reporte[$materia]['min'], $calificacion);
            }
        }
        foreach ($reporte as &$datos) {
            $datos['promedio'] = $datos['total'] / $datos['count'];
        }
        return $reporte;
    }

    public function graduarEstudiante(int $id): void {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking(): array {
        usort($this->estudiantes, function($a, $b) {
            return $b->obtenerPromedio() <=> $a->obtenerPromedio();
        });
        return array_map(function($estudiante) {
            return $estudiante->obtenerDetalles();
        }, $this->estudiantes);
    }

    public function buscarEstudiantes(string $termino): array {
        $termino = strtolower($termino);
        return array_map(function($estudiante) {
            return $estudiante->obtenerDetalles();
        }, array_filter($this->estudiantes, function($estudiante) use ($termino) {
            $detalles = $estudiante->obtenerDetalles();
            return strpos(strtolower($detalles['nombre']), $termino) !== false || strpos(strtolower($detalles['carrera']), $termino) !== false;
        }));
    }

    public function generarEstadisticasPorCarrera(): array {
        $estadisticas = [];
        foreach ($this->estudiantes as $estudiante) {
            $detalles = $estudiante->obtenerDetalles();
            $carrera = $detalles['carrera'];
            if (!isset($estadisticas[$carrera])) {
                $estadisticas[$carrera] = [
                    'total' => 0,
                    'count' => 0,
                    'mejorPromedio' => 0,
                    'mejorEstudiante' => null
                ];
            }
            $promedio = $estudiante->obtenerPromedio();
            $estadisticas[$carrera]['total'] += $promedio;
            $estadisticas[$carrera]['count']++;
            if ($promedio > $estadisticas[$carrera]['mejorPromedio']) {
                $estadisticas[$carrera]['mejorPromedio'] = $promedio;
                $estadisticas[$carrera]['mejorEstudiante'] = $estudiante->obtenerDetalles();
            }
        }
        foreach ($estadisticas as $carrera => &$datos) {
            $datos['promedio'] = $datos['total'] / $datos['count'];
        }
        return $estadisticas;
    }

    public function aplicarFlags(): void {
        foreach ($this->estudiantes as $estudiante) {
            $promedio = $estudiante->obtenerPromedio();
            if ($promedio < 60) {
                $estudiante->flag = 'en riesgo académico';
            } elseif ($promedio >= 90) {
                $estudiante->flag = 'honor roll';
            } else {
                $estudiante->flag = 'regular';
            }
        }
    }
}

// Sección de prueba
$sistema = new SistemaGestionEstudiantes();

// Crear estudiantes
$estudiantes = [
    new Estudiante(1, 'Juan Pérez', 20, 'Ingeniería', ['Matemáticas' => 85, 'Física' => 90]),
    new Estudiante(2, 'Ana Gómez', 22, 'Medicina', ['Biología' => 95, 'Química' => 80]),
    new Estudiante(3, 'Luis Martínez', 21, 'Derecho', ['Derecho Civil' => 75, 'Derecho Penal' => 80]),
    new Estudiante(4, 'María López', 23, 'Arquitectura', ['Diseño' => 88, 'Historia del Arte' => 92]),
    new Estudiante(5, 'Carlos Sánchez', 19, 'Ingeniería', ['Matemáticas' => 70, 'Física' => 65]),
    new Estudiante(6, 'Laura Fernández', 24, 'Medicina', ['Biología' => 85, 'Química' => 90]),
    new Estudiante(7, 'Pedro Ramírez', 22, 'Derecho', ['Derecho Civil' => 80, 'Derecho Penal' => 85]),
    new Estudiante(8, 'Sofía González', 20, 'Arquitectura', ['Diseño' => 90, 'Historia del Arte' => 95]),
    new Estudiante(9, 'Miguel Torres', 21, 'Ingeniería', ['Matemáticas' => 60, 'Física' => 55]),
    new Estudiante(10, 'Elena Ruiz', 23, 'Medicina', ['Biología' => 88, 'Química' => 92])
];

// Agregar estudiantes al sistema
foreach ($estudiantes as $estudiante) {
    $sistema->agregarEstudiante($estudiante);
}

// Demostrar funcionalidades
echo "Listado de estudiantes:\n";
print_r($sistema->listarEstudiantes());

echo "Promedio general:\n";
echo $sistema->calcularPromedioGeneral() . "\n";

echo "Mejor estudiante:\n";
print_r($sistema->obtenerMejorEstudiante());

echo "Reporte de rendimiento:\n";
print_r($sistema->generarReporteRendimiento());

echo "Ranking de estudiantes:\n";
print_r($sistema->generarRanking());

echo "Estadísticas por carrera:\n";
print_r($sistema->generarEstadisticasPorCarrera());

echo "Aplicar flags:\n";
$sistema->aplicarFlags();
print_r($sistema->listarEstudiantes());

?>
