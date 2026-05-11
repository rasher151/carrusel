<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // 1. Buscar la ruta para borrar el archivo físico
    $stmt = $conexion->prepare("SELECT ruta FROM imagenes WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $datos = $stmt->fetch();

    if ($datos) {
        if (file_exists($datos['ruta'])) {
            unlink($datos['ruta']);
        }
    }

    // 2. Borrar el registro de la BD
    $stmt2 = $conexion->prepare("DELETE FROM imagenes WHERE id = :id");
    $stmt2->execute([':id' => $id]);
}

header("Location: admin.php");
exit();
?>
