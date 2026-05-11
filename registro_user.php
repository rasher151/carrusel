<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevo_user = $_POST['username'];
    $nueva_pass = $_POST['password'];

    try {
        $stmt = $conexion->prepare("INSERT INTO usuarios (username, password) VALUES (:u, :p)");
        $stmt->execute([':u' => $nuevo_user, ':p' => $nueva_pass]);
        echo "<script>alert('Usuario registrado correctamente'); window.location='admin.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container mt-5" style="max-width: 400px;">
        <h3>Nuevo Usuario</h3>
        <form method="POST">
            <input type="text" name="username" class="form-control mb-2" placeholder="Usuario" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Contraseña" required>
            <button type="submit" class="btn btn-success w-100">Guardar Usuario</button>
            <a href="admin.php" class="btn btn-link w-100">Volver</a>
        </form>
    </div>
</body>
</html>
