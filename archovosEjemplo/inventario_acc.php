<?php
require_once("db.php");
$id_inventario = $_REQUEST["id_inventario"];
echo "id_inventario=$id_inventario<br>";
$accion = $_REQUEST["accion"];
echo "accion=$accion<br>";
$nombre = $_REQUEST["nombre"];
echo "nombre=$nombre<br>";
$prefijo = $_REQUEST["prefijo"];
echo "prefijo=$prefijo<br>";
$descripcion = $_REQUEST["descripcion"];
echo "descripcion=$descripcion<br>";

if ($accion == "EDITAR") {
    $sql = "UPDATE inventario SET nombre=:nombre,prefijo=:prefijo,descripcion=:descripcion where id_inventario=:id_inventario;";
    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':nombre' => $nombre,
        ':prefijo' => $prefijo,
        ':descripcion' => $descripcion,
        ':id_inventario' => $id_inventario
    ));
    if (!empty($result)) {
        echo "Registro actualizado correctamente";
        header('location:add_inventario.php');
        exit;
    }
} else {
    $sql = "INSERT INTO inventario ( nombre, prefijo, descripcion) VALUES ( :nombre, :prefijo, :descripcion);";
    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':nombre' => $nombre,
        ':prefijo' => $prefijo,
        ':descripcion' => $descripcion,
    ));
    if (!empty($result)) {
        echo "Registro actualizado correctamente";
        header('location:add_inventario.php');
        exit;
    }
}
