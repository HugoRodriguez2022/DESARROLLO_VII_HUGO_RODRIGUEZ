
<?php
define('DB_SERVER', '	sql209.infinityfree.com');
define('DB_USERNAME', 'if0_37745494');
define('DB_PASSWORD', '');
define('DB_NAME', 'if0_37745494_taller8_db');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}
?>