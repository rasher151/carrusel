<?php
$host = "127.0.0.1";
$port = 5432;
$user = "rsolache";
$pass = "201987"; // Cambia esto por tu contraseña de PostgreSQL

try {
    // 1. Conectar a PostgreSQL (sin especificar DB todavía)
    $dsn = "pgsql:host=$host;port=$port;dbname=postgres";
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // 2. Crear la base de datos si no existe
    $resultado = $pdo->query("SELECT 1 FROM pg_database WHERE datname = 'carrusel'");
    if (!$resultado->fetch()) {
        $pdo->exec("CREATE DATABASE carrusel");
        echo "<p style='color:blue'>✔ Base de datos 'carrusel' creada.</p>";
    } else {
        echo "<p style='color:gray'>ℹ Base de datos 'carrusel' ya existía.</p>";
    }

    // 3. Conectar ahora SÍ a 'carrusel'
    $dsn2 = "pgsql:host=$host;port=$port;dbname=carrusel";
    $pdo2 = new PDO($dsn2, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // 4. Crear tabla de imágenes
    $pdo2->exec("
        CREATE TABLE IF NOT EXISTS imagenes (
            id SERIAL PRIMARY KEY,
            nombre VARCHAR(100),
            ruta VARCHAR(255)
        )
    ");

    // 5. Crear tabla de usuarios
    $pdo2->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id SERIAL PRIMARY KEY,
            username VARCHAR(50) UNIQUE,
            password VARCHAR(255)
        )
    ");

    // 6. Insertar usuario admin si no existe
    $stmt = $pdo2->prepare("INSERT INTO usuarios (username, password) VALUES (:u, :p) ON CONFLICT (username) DO NOTHING");
    $stmt->execute([':u' => 'admin', ':p' => '1234']);

    echo "<div style='padding:20px; background-color:#d4edda; color:#155724; border:1px solid #c3e6cb;'>
            <h2>¡INSTALACIÓN EXITOSA!</h2>
            <p>Ya puedes entrar al panel con el usuario <b>admin</b> y clave <b>1234</b>.</p>
            <a href='login.php' style='font-weight:bold; font-size:1.2em;'>Ir al Login</a>
          </div>";

} catch (PDOException $e) {
    echo "<h2 style='color:red'>Error:</h2><p>" . $e->getMessage() . "</p>";
    echo "<p>Revisa que PostgreSQL esté corriendo y que la contraseña en este archivo sea correcta.</p>";
}
?>
