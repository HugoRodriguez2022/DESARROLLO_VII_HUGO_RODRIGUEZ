<?php 
function sanitizarNombre($nombre) {
    return filter_var(trim($nombre), FILTER_SANITIZE_STRING);
}

function sanitizarEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitizarFechaNacimiento($fecha_nacimiento) {
    return date("Y-m-d", strtotime($fecha_nacimiento));
}

function sanitizarSitioWeb($sitioWeb) {
    return filter_var(trim($sitioWeb), FILTER_SANITIZE_URL);
}

function sanitizarGenero($genero) {
    return filter_var(trim($genero), FILTER_SANITIZE_STRING);
}

function sanitizarIntereses($intereses) {
    return array_map(function($interes) {
        return filter_var(trim($interes), FILTER_SANITIZE_STRING);
    }, $intereses);
}

function sanitizarComentarios($comentarios) {
    return filter_var(trim($comentarios), FILTER_SANITIZE_STRING);
}
?>
