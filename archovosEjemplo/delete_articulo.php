<?php
require_once "conexion.php";

$pdo = Db::conectar();

$id_articulo = $_REQUEST['id'] ?? null;

if (!$id_articulo) {
    die("ID de artículo no válido");
}

/* Obtener foto */
$stmt = $pdo->prepare("SELECT foto FROM articulo WHERE id_articulo = :id");
$stmt->execute([':id' => $id_articulo]);
$art = $stmt->fetch(PDO::FETCH_OBJ);

/* Eliminar artículo */
$stmt = $pdo->prepare("DELETE FROM articulo WHERE id_articulo = :id");
$result = $stmt->execute([':id' => $id_articulo]);

/* Eliminar imagen */
if ($result && $art && !empty($art->foto)) {
    $ruta = "uploads/" . $art->foto;
    if (file_exists($ruta)) {
        unlink($ruta);
    }
}

header("Location: add_articulo.php");
exit;
