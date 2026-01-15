<?php
require_once("db.php");
$id_mantenimiento = $_REQUEST["id_mantenimiento"];
echo "<br>id_mantenimiento:$id_mantenimiento";

$sql = "DELETE FROM  mantenimiento WHERE id_mantenimiento=:id_mantenimiento;";
$pdo_statement = $pdo_conn->prepare($sql);
$result = $pdo_statement->execute(array(':id_mantenimiento' => $id_mantenimiento));
if (!empty($result)) {
    echo "Registro eliminado correctamente";
    header('location:asignar_mantenimiento_add.php');
    exit;
}
