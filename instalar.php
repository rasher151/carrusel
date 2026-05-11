<?php
$host = "127.0.0.1";
$port = 3306;
$user = "rsolache";
$pass = "201987";

$conexion_inicial = @mysqli_connect($host, $user, $pass, "", $port);

if (!$conexion_inicial) {
    die("<h2 style='color:red'>Error de conexión:</h2>" . mysqli_connect_error());
}

$sql_db = "CREATE DATABASE IF NOT EXISTS carrusel_mariadb";
if (mysqli_query($conexion_inicial, $sql_db)) {
    echo "<p style='color:blue'>✔ Base de datos verificada.</p>";
}

mysqli_select_db($conexion_inicial, "carrusel_mariadb");

$tabla_fotos = "CREATE TABLE IF NOT EXISTS imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    ruta VARCHAR(255)
)";

$tabla_user = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255)
)";

mysqli_query($conexion_inicial, $tabla_fotos);
mysqli_query($conexion_inicial, $tabla_user);

mysqli_query($conexion_inicial, "INSERT IGNORE INTO usuarios (id, username, password) VALUES (1, 'admin', '1234')");

echo "<div style='padding:20px; background-color:#d4edda; color:#155724; border:1px solid #c3e6cb;'>
        <h2>¡INSTALACIÓN EXITOSA!</h2>
        <p>Ya puedes entrar al panel con el usuario <b>admin</b> y clave <b>1234</b>.</p>
        <a href='login.php' style='font-weight:bold; font-size:1.2em;'>Ir al Login</a>
      </div>";
?>
