<?php
// Ejemplo de uso de json_encode() con un array simple
$frutas = ["manzana", "banana", "naranja"];
$jsonFrutas = json_encode($frutas);
echo "Array de frutas en JSON:</br>$jsonFrutas</br>";

// Ejemplo con un array asociativo
$persona = [
    "nombre" => "Juan",
    "edad" => 30,
    "ciudad" => "Madrid"
];
$jsonPersona = json_encode($persona);
echo "</br>Array asociativo de persona en JSON:</br>$jsonPersona</br>";

// Ejercicio: Crea un array con información sobre tu película favorita
// Aquí se crea un array con detalles sobre la película (título, director, año, actores principales)
$peliculaFavorita = [
    "titulo" => "Salvar al Soldado Ryan",
    "director" => "Steven Spielberg",
    "año" => 1998,
    "actores" => ["Tom Hanks ", "Matt Damon", "Vin Diesel"]
];
$jsonPelicula = json_encode($peliculaFavorita);
echo "</br>Información de tu película favorita en JSON:</br>$jsonPelicula</br>";

// Bonus: Usa json_encode() con un objeto de clase personalizada
// Se define una clase personalizada "Libro" con propiedades y un constructor
class Libro {
    public $titulo;
    public $autor;
    public $año;
    
    public function __construct($titulo, $autor, $año) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->año = $año;
    }
}

// Se crea una instancia de la clase "Libro" y se convierte a JSON
$miLibro = new Libro("Cien años de soledad", "Gabriel García Márquez", 1967);
$jsonLibro = json_encode($miLibro);
echo "</br>Objeto Libro en JSON:</br>$jsonLibro</br>";

class Auto {
    public $marca;
    public $modelo;
    public $año;
    
    public function __construct($marca, $modelo, $año) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año = $año;
    }
}

// Se crea una instancia de la clase "Libro" y se convierte a JSON
$miAuto = new Auto("Toyota", "4Runner", 2018);
$jsonAuto = json_encode($miAuto);
echo "</br>Objeto Auto en JSON:</br>$jsonAuto</br>";

// Extra: Uso de opciones en json_encode()
// Aquí se muestra cómo usar opciones adicionales en json_encode(), como mantener caracteres Unicode y formatear el JSON
$datosConCaracteresEspeciales = [
    "nombre" => "María José",
    "descripción" => "Le gusta el café y el té"
];
$jsonConOpciones = json_encode($datosConCaracteresEspeciales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo "</br>JSON con opciones (caracteres Unicode y formato bonito):</br>$jsonConOpciones</br>";

$FraseConCaracteresEspeciales = [
    "Sujeto" => "Andrés ",
    "Predicado" => "entrena para un maratón"
];
$jsonConOpciones = json_encode($FraseConCaracteresEspeciales, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo "</br>JSON con opciones (caracteres Unicode y formato bonito):</br>$jsonConOpciones</br>";
?>