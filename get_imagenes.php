<?php
include 'db.php';

if (ob_get_length()) ob_clean();

$stmt = $conexion->query("SELECT nombre, ruta FROM imagenes ORDER BY id DESC");
$imagenes = $stmt->fetchAll();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($imagenes);
exit();
?>
