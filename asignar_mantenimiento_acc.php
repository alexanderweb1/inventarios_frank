<?php
require_once("db.php");

/* =========================
   DATOS DEL FORMULARIO
   ========================= */
$id_articulo = $_POST["id_articulo"];
$fecha_mantenimiento = $_POST["fecha_mantenimiento"];
$descripcion_mantenimiento = $_POST["descripcion_mantenimiento"];
$estado_ingresa = $_POST["estado_ingresa"];

/* =========================
   DEFINIMOS LA ACCIÓN
   ========================= */
if (isset($_POST["actualizar"])) {
    $action = "EDITAR";
} else {
    $action = "INSERTAR";
}

/* =========================
   EDITAR REGISTRO
   ========================= */
if ($action == "EDITAR") {

    // FALTABA ESTO
    $id_mantenimiento = $_POST["id_mantenimiento"];

    $sql = "UPDATE mantenimiento 
            SET id_articulo = :id_articulo,
                fecha_mantenimiento = :fecha_mantenimiento,
                descripcion_mantenimiento = :descripcion_mantenimiento,
                estado_ingresa = :estado_ingresa
            WHERE id_mantenimiento = :id_mantenimiento";

    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':id_articulo' => $id_articulo,
        ':fecha_mantenimiento' => $fecha_mantenimiento,
        ':descripcion_mantenimiento' => $descripcion_mantenimiento,
        ':estado_ingresa' => $estado_ingresa,
        ':id_mantenimiento' => $id_mantenimiento
    ));

    if ($result) {
        header('Location: asignar_mantenimiento_add.php?res=editado');
        exit;
    }
} else {

    /* =========================
       INSERTAR REGISTRO
       ========================= */
    $sql = "INSERT INTO mantenimiento 
            (id_articulo, fecha_mantenimiento, descripcion_mantenimiento, estado_ingresa) 
            VALUES 
            (:id_articulo, :fecha_mantenimiento, :descripcion_mantenimiento, :estado_ingresa)";

    $pdo_statement = $pdo_conn->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':id_articulo' => $id_articulo,
        ':fecha_mantenimiento' => $fecha_mantenimiento,
        ':descripcion_mantenimiento' => $descripcion_mantenimiento,
        ':estado_ingresa' => $estado_ingresa
    ));

    if ($result) {
        header('Location: asignar_mantenimiento_add.php?res=guardado');
        exit;
    }
}
