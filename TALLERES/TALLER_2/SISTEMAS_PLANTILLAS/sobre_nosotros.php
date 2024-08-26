<?php
$paginaActual = 'sobre_nosotros';
require_once 'plantillas/funciones.php';
$tituloPagina = obtenerTituloPagina($paginaActual);
include 'plantillas/encabezado.php';
?>

<h2>Sobre Nosotros</h2>
<p>Somos una empresa dedicada a proporcionar soluciones innovadoras y de alta calidad. Nuestro equipo está compuesto por profesionales apasionados y comprometidos con la excelencia.</p>
<p>Nuestra misión es satisfacer las necesidades de nuestros clientes a través de productos y servicios excepcionales. Valoramos la integridad, la innovación y la colaboración.</p>

<?php
include 'plantillas/pie_pagina.php';
?>
