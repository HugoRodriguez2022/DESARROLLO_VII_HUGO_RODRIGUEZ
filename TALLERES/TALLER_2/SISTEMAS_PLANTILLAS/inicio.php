<?php
$paginaActual = 'inicio';
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Bienvenido a Nuestra Página de Inicio</h2>
<p>En nuestra página de inicio, encontrarás las últimas noticias y actualizaciones sobre nuestros servicios. Nos esforzamos por ofrecerte la mejor experiencia posible.</p>
<p>Explora nuestro sitio para conocer más sobre nosotros y lo que ofrecemos. ¡Gracias por visitarnos!</p>

<?php
include 'plantillas/pie_pagina.php';
?>
