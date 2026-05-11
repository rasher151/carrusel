<?php
$host = "127.0.0.1";
$port = 5432;
$db   = "carrusel";
$user = "rsolache";
$pass = "201987";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $conexion = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
