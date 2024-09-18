# Sistema de Gestión de Estudiantes

Este proyecto es un sistema de gestión de estudiantes que permite agregar, listar, buscar, y generar reportes de rendimiento de estudiantes. El sistema está implementado en PHP y utiliza clases y objetos para representar a los estudiantes y sus datos.

## Clases y Métodos

### Clase `Estudiante`

La clase `Estudiante` representa a un estudiante y contiene la siguiente información:

- `id`: Identificador único del estudiante.
- `nombre`: Nombre del estudiante.
- `edad`: Edad del estudiante.
- `carrera`: Carrera que está cursando el estudiante.
- `materias`: Array asociativo de materias y sus calificaciones.
- `flag`: Indicador del estado académico del estudiante.

#### Métodos de la clase `Estudiante`

- `__construct(int $id, string $nombre, int $edad, string $carrera, array $materias = [])`: Constructor de la clase.
- `agregarMateria(string $materia, float $calificacion)`: Agrega una materia y su calificación al estudiante.
- `obtenerPromedio()`: Calcula y devuelve el promedio de las calificaciones del estudiante.
- `obtenerDetalles()`: Devuelve un array con los detalles del estudiante.
- `__toString()`: Devuelve una representación en cadena del estudiante.

### Clase `SistemaGestionEstudiantes`

La clase `SistemaGestionEstudiantes` gestiona una colección de estudiantes y proporciona varias funcionalidades para interactuar con ellos.

#### Métodos de la clase `SistemaGestionEstudiantes`

- `__construct()`: Constructor de la clase.
- `agregarEstudiante(Estudiante $estudiante)`: Agrega un estudiante al sistema.
- `obtenerEstudiante(int $id)`: Devuelve un estudiante por su ID.
- `listarEstudiantes()`: Devuelve un array con los detalles de todos los estudiantes.
- `calcularPromedioGeneral()`: Calcula y devuelve el promedio general de todos los estudiantes.
- `obtenerEstudiantesPorCarrera(string $carrera)`: Devuelve un array con los estudiantes de una carrera específica.
- `obtenerMejorEstudiante()`: Devuelve los detalles del mejor estudiante basado en su promedio.
- `generarReporteRendimiento()`: Genera un reporte de rendimiento por materia.
- `graduarEstudiante(int $id)`: Marca a un estudiante como graduado y lo elimina de la lista de estudiantes activos.
- `generarRanking()`: Genera un ranking de estudiantes basado en sus promedios.
- `buscarEstudiantes(string $termino)`: Busca estudiantes por nombre o carrera.
- `generarEstadisticasPorCarrera()`: Genera estadísticas por carrera.
- `aplicarFlags()`: Aplica indicadores de estado académico a los estudiantes.

## Ejemplo de Uso

```php
// Crear instancia del sistema de gestión de estudiantes
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

// Listar estudiantes
echo "Listado de estudiantes:\n";
print_r($sistema->listarEstudiantes());

// Calcular promedio general
echo "Promedio general:\n";
echo $sistema->calcularPromedioGeneral() . "\n";

// Obtener mejor estudiante
echo "Mejor estudiante:\n";
print_r($sistema->obtenerMejorEstudiante());

// Generar reporte de rendimiento
echo "Reporte de rendimiento:\n";
print_r($sistema->generarReporteRendimiento());

// Generar ranking de estudiantes
echo "Ranking de estudiantes:\n";
print_r($sistema->generarRanking());

// Generar estadísticas por carrera
echo "Estadísticas por carrera:\n";
print_r($sistema->generarEstadisticasPorCarrera());

// Aplicar flags
echo "Aplicar flags:\n";
$sistema->aplicarFlags();
print_r($sistema->listarEstudiantes());
