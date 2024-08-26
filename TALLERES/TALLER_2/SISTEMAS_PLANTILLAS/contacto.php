<?php
$paginaActual = 'contacto';
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Contáctanos</h2>
<p>Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.</p>
<p>Puedes enviarnos un correo electrónico a <a href="">info@misitioweb.com</a> o llamarnos al .</p>
<p>También puedes visitarnos en nuestra oficina ubicada en Calle</p>

<?php
include 'plantillas/pie_pagina.php';
?>
