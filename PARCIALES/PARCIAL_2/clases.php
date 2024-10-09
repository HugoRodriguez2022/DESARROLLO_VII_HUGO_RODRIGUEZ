<?php

interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}

abstract class Entrada implements Detalle {
    protected $id;
    protected $fecha_creacion;
    protected $tipo;

    public function __construct($datos = []) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFechaCreacion(): string {
        return $this->fecha_creacion;
    }

    public function getTipo(): int {
        return $this->tipo;
    }
}

class EntradaUnaColumna extends Entrada {
    public $titulo;
    public $descripcion;

    public function __construct($datos = []) {
        parent::__construct($datos);
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: " . $this->titulo;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }
}

class EntradaDosColumnas extends Entrada {
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;

    public function __construct($datos = []) {
        parent::__construct($datos);
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de dos columnas: " . $this->titulo1 . " | " . $this->titulo2;
    }

    public function getTitulo1(): string {
        return $this->titulo1;
    }

    public function getDescripcion1(): string {
        return $this->descripcion1;
    }

    public function getTitulo2(): string {
        return $this->titulo2;
    }

    public function getDescripcion2(): string {
        return $this->descripcion2;
    }
}

class EntradaTresColumnas extends Entrada {
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;
    public $titulo3;
    public $descripcion3;

    public function __construct($datos = []) {
        parent::__construct($datos);
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function obtenerDetallesEspecificos(): string {
        return "Entrada de tres columnas: " . $this->titulo1 . " | " . $this->titulo2 . " | " . $this->titulo3;
    }

    public function getTitulo1(): string {
        return $this->titulo1;
    }

    public function getDescripcion1(): string {
        return $this->descripcion1;
    }

    public function getTitulo2(): string {
        return $this->titulo2;
    }

    public function getDescripcion2(): string {
        return $this->descripcion2;
    }

    public function getTitulo3(): string {
        return $this->titulo3;
    }

    public function getDescripcion3(): string {
        return $this->descripcion3;
    }
}

class GestorBlog {
    private $entradas = [];

    public function cargarEntradas() {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                $tipo = $entradaData['tipo'] ?? null;
                if ($tipo !== null) {
                    switch ($tipo) {
                        case 1:
                            $this->entradas[] = new EntradaUnaColumna($entradaData);
                            break;
                        case 2:
                            $this->entradas[] = new EntradaDosColumnas($entradaData);
                            break;
                        case 3:
                            $this->entradas[] = new EntradaTresColumnas($entradaData);
                            break;
                    }
                }
            }
        }
    }

    public function guardarEntradas() {
        $data = array_map(function($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public function agregarEntrada(Entrada $entrada) {
        $this->entradas[] = $entrada;
        $this->guardarEntradas();
    }

    public function editarEntrada(Entrada $entrada) {
        foreach ($this->entradas as $key => $entradaExistente) {
            if ($entradaExistente->getId() == $entrada->getId()) {
                $this->entradas[$key] = $entrada;
                break;
            }
        }
        $this->guardarEntradas();
    }

    public function eliminarEntrada($id) {
        foreach ($this->entradas as $key => $entradaExistente) {
            if ($entradaExistente->getId() == $id) {
                unset($this->entradas[$key]);
                break;
            }
        }
        $this->guardarEntradas();
    }

    public function obtenerEntrada($id) {
        foreach ($this->entradas as $entradaExistente) {
            if ($entradaExistente->getId() == $id) {
                return $entradaExistente;
            }
        }
        return null;
    }

    public function moverEntrada($id, $direccion) {
        foreach ($this->entradas as $key => $entradaExistente) {
            if ($entradaExistente->getId() == $id) {
                $entrada = $this->entradas[$key];
                unset($this->entradas[$key]);
                if ($direccion == 'up') {
                    array_splice($this->entradas, $key - 1, 0, [$entrada]);
                } else {
                    array_splice($this->entradas, $key + 1, 0, [$entrada]);
                }
                break;
            }
        }
        $this->guardarEntradas();
    }

    public function obtenerEntradas() {
        return $this->entradas;
    }
}
?>
















