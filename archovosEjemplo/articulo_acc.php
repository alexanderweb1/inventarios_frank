<?php
require_once("db.php"); // usa $pdo_conn

if (!isset($_POST['accion'])) {
    die("Acción no definida");
}

$accion = $_POST['accion'];

/* ===========================
   AGREGAR ARTÍCULO
=========================== */
if ($accion === 'AGREGAR') {

    // FOTO
    $foto_nombre = null;
    if (!empty($_FILES['foto']['name'])) {
        $foto_nombre = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto_nombre);
    }

    $sql = "INSERT INTO articulo (
        id_ubicacion, id_inventario, id_marca,
        n_inventario_istms, tipo_articulo, nombre,
        modelo, n_serie, estado, foto,
        descripcion, v_eco_inicial, f_adquisicion,
        baja, descrip_baja, fecha_baja, fecha
    ) VALUES (
        :id_ubicacion, :id_inventario, :id_marca,
        :n_inventario_istms, :tipo_articulo, :nombre,
        :modelo, :n_serie, :estado, :foto,
        :descripcion, :v_eco_inicial, :f_adquisicion,
        :baja, :descrip_baja, :fecha_baja, :fecha
    )";

    $stmt = $pdo_conn->prepare($sql);
    $stmt->execute([
        ':id_ubicacion' => $_POST['id_ubicacion'],
        ':id_inventario' => $_POST['id_inventario'],
        ':id_marca' => $_POST['id_marca'],
        ':n_inventario_istms' => $_POST['n_inventario_istms'],
        ':tipo_articulo' => $_POST['tipo_articulo'],
        ':nombre' => $_POST['nombre'],
        ':modelo' => $_POST['modelo'],
        ':n_serie' => $_POST['n_serie'],
        ':estado' => $_POST['estado'],
        ':foto' => $foto_nombre,
        ':descripcion' => $_POST['descripcion'],
        ':v_eco_inicial' => $_POST['v_eco_initial'],
        ':f_adquisicion' => $_POST['f_adquisicion'],
        ':baja' => $_POST['baja'],
        ':descrip_baja' => $_POST['descrip_baja'],
        ':fecha_baja' => $_POST['fecha_baja'],
        ':fecha' => $_POST['fecha_registro']
    ]);

    header("Location:add_articulo.php?res=add");
    exit;
}

/* ===========================
   EDITAR ARTÍCULO
=========================== */
if ($accion === 'EDITAR') {

    $id_articulo = $_POST['id_articulo'];
    $foto_final = $_POST['foto_actual'];

    if (!empty($_FILES['foto']['name'])) {
        $foto_nueva = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto_nueva);

        if (!empty($foto_final) && file_exists("uploads/" . $foto_final)) {
            unlink("uploads/" . $foto_final);
        }
        $foto_final = $foto_nueva;
    }

    $sql = "UPDATE articulo SET
        id_ubicacion = :id_ubicacion,
        id_inventario = :id_inventario,
        id_marca = :id_marca,
        n_inventario_istms = :n_inventario_istms,
        tipo_articulo = :tipo_articulo,
        nombre = :nombre,
        modelo = :modelo,
        n_serie = :n_serie,
        estado = :estado,
        descripcion = :descripcion,
        v_eco_inicial = :v_eco_inicial,
        f_adquisicion = :f_adquisicion,
        baja = :baja,
        descrip_baja = :descrip_baja,
        fecha_baja = :fecha_baja,
        foto = :foto
    WHERE id_articulo = :id_articulo";

    $stmt = $pdo_conn->prepare($sql);
    $stmt->execute([
        ':id_ubicacion' => $_POST['id_ubicacion'],
        ':id_inventario' => $_POST['id_inventario'],
        ':id_marca' => $_POST['id_marca'],
        ':n_inventario_istms' => $_POST['n_inventario_istms'],
        ':tipo_articulo' => $_POST['tipo_articulo'],
        ':nombre' => $_POST['nombre'],
        ':modelo' => $_POST['modelo'],
        ':n_serie' => $_POST['n_serie'],
        ':estado' => $_POST['estado'],
        ':descripcion' => $_POST['descripcion'],
        ':v_eco_inicial' => $_POST['v_eco_initial'],
        ':f_adquisicion' => $_POST['f_adquisicion'],
        ':baja' => $_POST['baja'],
        ':descrip_baja' => $_POST['descrip_baja'],
        ':fecha_baja' => $_POST['fecha_baja'],
        ':foto' => $foto_final,
        ':id_articulo' => $id_articulo
    ]);

    header("Location:add_articulo.php?res=edit");
    exit;
}
