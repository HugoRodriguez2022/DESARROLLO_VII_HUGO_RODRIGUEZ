<?php
function obtenerLibros() {
    return [
        [
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'anio_publicacion' => 1605,
            'genero' => 'Novela',
            'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
        ],
        [
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'anio_publicacion' => 1967,
            'genero' => 'Realismo Mágico',
            'descripcion' => 'La historia de la familia Buendía en el pueblo de Macondo.'
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'anio_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Una visión sombría del futuro bajo un régimen totalitario.'
        ],
        [
            'titulo' => 'Orgullo y Prejuicio',
            'autor' => 'Jane Austen',
            'anio_publicacion' => 1813,
            'genero' => 'Romance',
            'descripcion' => 'La historia de Elizabeth Bennet y su relación con el Sr. Darcy.'
        ],
        [
            'titulo' => 'El Gran Gatsby',
            'autor' => 'F. Scott Fitzgerald',
            'anio_publicacion' => 1925,
            'genero' => 'Tragedia',
            'descripcion' => 'La vida y los tiempos de Jay Gatsby y su obsesión con Daisy Buchanan.'
        ]
    ];
}

function mostrarDetallesLibro($libro) {
    return "<h2>{$libro['titulo']}</h2>
            <p><strong>Autor:</strong> {$libro['autor']}</p>
            <p><strong>Año de Publicación:</strong> {$libro['anio_publicacion']}</p>
            <p><strong>Género:</strong> {$libro['genero']}</p>
            <p><strong>Descripción:</strong> {$libro['descripcion']}</p>";
}
?>
