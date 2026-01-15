<?php
require_once("db.php");
$id_inventario = $_REQUEST["id_inventario"];
echo "id_inventario=$id_inventario<br>";
$id_docente = $_REQUEST["id_docente"];
echo "id_docente=$id_docente<br>";
$descripcion = $_REQUEST["descripcion"];
echo "descripcion=$descripcion<br>";



$sql = "INSERT INTO docente_inventario ( id_inventario, id_docente, descripcion) VALUES (:id_inventario, :id_docente, :descripcion);";
$pdo_statement = $pdo_conn->prepare($sql);
$result = $pdo_statement->execute(array(':id_inventario' => $id_inventario, ':id_docente' => $id_docente, ':descripcion' => $descripcion));
if (!empty($result)) {
    echo "Registro almacenado correctamente";
    header('location:asignar_inventario_add.php');
    exit;
}
