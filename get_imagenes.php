<?php
include 'db.php';

if (ob_get_length()) ob_clean();

$accion = $_GET['accion'] ?? 'inicio';
$id_actual = intval($_GET['id_actual'] ?? 0);

if ($accion === 'inicio') {
    $stmt = $conexion->query("SELECT id, nombre, ruta FROM imagenes ORDER BY id ASC LIMIT 1");
} elseif ($accion === 'siguiente') {
    $stmt = $conexion->prepare("SELECT id, nombre, ruta FROM imagenes WHERE id > :id ORDER BY id ASC LIMIT 1");
    $stmt->execute([':id' => $id_actual]);
    if ($stmt->rowCount() == 0) {
        $stmt = $conexion->query("SELECT id, nombre, ruta FROM imagenes ORDER BY id ASC LIMIT 1");
    }
} elseif ($accion === 'anterior') {
    $stmt = $conexion->prepare("SELECT id, nombre, ruta FROM imagenes WHERE id < :id ORDER BY id DESC LIMIT 1");
    $stmt->execute([':id' => $id_actual]);
    if ($stmt->rowCount() == 0) {
        $stmt = $conexion->query("SELECT id, nombre, ruta FROM imagenes ORDER BY id DESC LIMIT 1");
    }
}

$imagen = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($imagen);
exit();
?>