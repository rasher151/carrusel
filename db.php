<?php
$host = "127.0.0.1";
$user = "rsolache";
$pass = "201987";
$db   = "carrusel_mariadb";
$port = 3306;

$conexion = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");
?>
