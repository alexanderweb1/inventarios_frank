<?php
require_once("db.php");

if (isset($_GET['id_inventario'])) {
    $id_inv = $_GET['id_inventario'];

    // 1. Buscamos el prefijo de esa categoría
    $stmt = $pdo_conn->prepare("SELECT prefijo FROM inventario WHERE id_inventario = :id");
    $stmt->execute([':id' => $id_inv]);
    $inv = $stmt->fetch(PDO::FETCH_OBJ);
    $prefijo = $inv->prefijo;

    // 2. Contamos cuántos artículos existen ya en esa categoría
    $stmt = $pdo_conn->prepare("SELECT COUNT(*) as total FROM articulo WHERE id_inventario = :id");
    $stmt->execute([':id' => $id_inv]);
    $conteo = $stmt->fetch(PDO::FETCH_OBJ);

    // 3. El siguiente número es el total + 1
    $siguiente = $conteo->total + 1;

    // Formateamos a 3 dígitos (ej: 001, 002)
    $numero_formateado = str_pad($siguiente, 3, "0", STR_PAD_LEFT);

    echo $prefijo . "-" . $numero_formateado;
}
