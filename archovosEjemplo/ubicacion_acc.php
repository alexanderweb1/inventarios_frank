<?php
require_once("db.php");
$id_ubicacion = $_REQUEST["id_ubicacion"];
echo "id_ubicacion=$id_ubicacion<br>";
$accion = $_REQUEST["accion"];
echo "accion=$accion<br>";
$nombre = $_REQUEST["nombre"];
echo "nombre=$nombre<br>";
$descripcion = $_REQUEST["descripcion"];
echo "descripcion=$descripcion<br>";

if ($accion == "EDITAR") {
    $sql = "UPDATE ubicacion SET nombre=:nombre,descripcion=:descripcion where id_ubicacion=:id_ubicacion;";
    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(':nombre' => $nombre, ':descripcion' => $descripcion, ':id_ubicacion' => $id_ubicacion));
    if (!empty($result)) {
        echo "Registro actualizado correctamente";
        header('location:add_ubicacion.php');
        exit;
    }
} else {
    $sql = "INSERT INTO ubicacion ( nombre, descripcion) VALUES ( :nombre, :descripcion);";
    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(':nombre' => $nombre, ':descripcion' => $descripcion));
    if (!empty($result)) {
        echo "Registro almacenado correctamente";
        header('location:add_ubicacion.php');
        exit;
    }
}
