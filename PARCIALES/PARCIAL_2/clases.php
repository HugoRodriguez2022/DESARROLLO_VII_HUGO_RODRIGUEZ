
<?php
class Tarea implements Detalle {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    public function obtenerDetallesEspecificos(): string {
        return "Detalles generales de la tarea.";
    }

    // Implementar estos getters
    // public function getEstado() { }
    public function getEstado() {
        return $this->estado;
    }
    
    // public function getPrioridad() { }
    public function getPrioridad() {
        return $this->prioridad;
    }
}

// Implementar:
// 1. La interfaz Detalle
interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}


// 2. Modificar la clase Tarea para implementar la interfaz Detalle
class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        foreach ($data as $tareaData) {
            switch ($tareaData['tipo']) {
                case 'desarrollo':
                    $tarea = new TareaDesarrollo($tareaData);
                    break;
                case 'diseno':
                    $tarea = new TareaDiseno($tareaData);
                    break;
                case 'testing':
                    $tarea = new TareaTesting($tareaData);
                    break;
                default:
                    $tarea = new Tarea($tareaData);
                    break;
            }
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }

    public function agregarTarea($tarea) {
        $this->tareas[] = $tarea;
    }

    public function eliminarTarea($id) {
        foreach ($this->tareas as $key => $tarea) {
            if ($tarea->id == $id) {
                unset($this->tareas[$key]);
                break;
            }
        }
    }

    public function actualizarTarea($tareaActualizada) {
        foreach ($this->tareas as $key => $tarea) {
            if ($tarea->id == $tareaActualizada->id) {
                $this->tareas[$key] = $tareaActualizada;
                break;
            }
        }
    }

    public function actualizarEstadoTarea($id, $nuevoEstado) {
        foreach ($this->tareas as $tarea) {
            if ($tarea->id == $id) {
                $tarea->estado = $nuevoEstado;
                break;
            }
        }
    }

    public function buscarTareasPorEstado($estado) {
        $result = [];
        foreach ($this->tareas as $tarea) {
            if ($tarea->estado == $estado) {
                $result[] = $tarea;
            }
        }
        return $result;
    }

    public function listarTareas($filtroEstado = '') {
        if ($filtroEstado) {
            return $this->buscarTareasPorEstado($filtroEstado);
        }
        return $this->tareas;
    }
}


// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea
class TareaDesarrollo extends Tarea {
    public $lenguajeProgramacion;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->lenguajeProgramacion = $datos['lenguajeProgramacion'];
    }

    public function obtenerDetallesEspecificos(): string {
        return "Lenguaje de programación: " . $this->lenguajeProgramacion;
    }
}

class TareaDiseno extends Tarea {
    public $herramientaDiseno;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->herramientaDiseno = $datos['herramientaDiseno'];
    }

    public function obtenerDetallesEspecificos(): string {
        return "Herramienta de diseño: " . $this->herramientaDiseno;
    }
}

class TareaTesting extends Tarea {
    public $tipoTest;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->tipoTest = $datos['tipoTest'];
    }

    public function obtenerDetallesEspecificos(): string {
        return "Tipo de test: " . $this->tipoTest;
    }
}
?>




