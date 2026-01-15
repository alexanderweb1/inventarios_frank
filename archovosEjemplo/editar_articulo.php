<?php
require_once('usuario.php');
session_start();
require_once("db.php");
include_once('config.php');
$id_articulo = $_REQUEST["id"];

$sql = "SELECT * FROM articulo WHERE id_articulo = $id_articulo";
$art = $pdo_conn->query($sql)->fetch(PDO::FETCH_OBJ);

$ubicaciones = $pdo_conn->query("SELECT id_ubicacion, nombre FROM ubicacion")->fetchAll(PDO::FETCH_OBJ);
$marcas = $pdo_conn->query("SELECT id_marca, nombre FROM marca")->fetchAll(PDO::FETCH_OBJ);
$inventarios = $pdo_conn->query("SELECT id_inventario, nombre FROM inventario")->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistema de inventarios - Administrar datos ubicación </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <nav id="navmenu" class="navmenu">
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <?php
  require_once('cabecera.php');
  ?>

  <main class="main">
    <section id="hero" class="hero section">
      <div class="hero-bg"><img src="assets/img/hero-bg-light.webp" alt=""></div>
      <div class="container">
        <div class="text-center mb-4">
          <h1 data-aos="fade-up">Editar <span>Artículos</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">Ingrese todos los detalles técnicos y de control del activo</p>
        </div>

        <div class="card shadow-lg p-4" data-aos="fade-up" data-aos-delay="200">
          <form action="articulo_acc.php" method="post" enctype="multipart/form-data" class="row g-3">

            <!-- ocultos -->
            <input type="hidden" name="accion" value="EDITAR">
            <input type="hidden" name="id_articulo" value="<?php echo $art->id_articulo; ?>">
            <input type="hidden" name="foto_actual" value="<?php echo $art->foto; ?>">

            <!-- Ubicación -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Ubicación Física</label>
              <select name="id_ubicacion" class="form-select" required>
                <?php foreach ($ubicaciones as $u) { ?>
                  <option value="<?php echo $u->id_ubicacion; ?>"
                    <?php if ($u->id_ubicacion == $art->id_ubicacion) echo "selected"; ?>>
                    <?php echo $u->nombre; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- Inventario -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Categoría Inventario</label>
              <select name="id_inventario" class="form-select" required>
                <?php foreach ($inventarios as $i) { ?>
                  <option value="<?php echo $i->id_inventario; ?>"
                    <?php if ($i->id_inventario == $art->id_inventario) echo "selected"; ?>>
                    <?php echo $i->nombre; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- Marca -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Marca</label>
              <select name="id_marca" class="form-select" required>
                <?php foreach ($marcas as $m) { ?>
                  <option value="<?php echo $m->id_marca; ?>"
                    <?php if ($m->id_marca == $art->id_marca) echo "selected"; ?>>
                    <?php echo $m->nombre; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- Nro inventario -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Nro. Inventario ISTMS</label>
              <input type="text" name="n_inventario_istms" class="form-control"
                value="<?php echo $art->n_inventario_istms; ?>">
            </div>

            <!-- Tipo -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Tipo de Artículo</label>
              <input type="text" name="tipo_articulo" class="form-control"
                value="<?php echo $art->tipo_articulo; ?>">
            </div>

            <!-- Nombre -->
            <div class="col-md-4">
              <label class="form-label fw-bold">Nombre del Artículo</label>
              <input type="text" name="nombre" class="form-control"
                value="<?php echo $art->nombre; ?>">
            </div>

            <!-- Modelo -->
            <div class="col-md-3">
              <label class="form-label fw-bold">Modelo</label>
              <input type="text" name="modelo" class="form-control"
                value="<?php echo $art->modelo; ?>">
            </div>

            <!-- Serie -->
            <div class="col-md-3">
              <label class="form-label fw-bold">Nro. de Serie</label>
              <input type="text" name="n_serie" class="form-control"
                value="<?php echo $art->n_serie; ?>">
            </div>

            <!-- Estado -->
            <div class="col-md-3">
              <label class="form-label fw-bold">Estado Actual</label>
              <input type="text" name="estado" class="form-control"
                value="<?php echo $art->estado; ?>">
            </div>

            <!-- Foto -->
            <div class="col-md-3">
              <label class="form-label fw-bold">Foto del Activo</label>
              <?php if (!empty($art->foto)) { ?>
                <img src="uploads/<?php echo $art->foto; ?>" class="img-fluid mb-2 rounded">
              <?php } ?>
              <input type="file" name="foto" class="form-control">
            </div>

            <!-- Descripción -->
            <div class="col-12">
              <label class="form-label fw-bold">Descripción del Artículo</label>
              <textarea name="descripcion" class="form-control" rows="2"><?php echo $art->descripcion; ?></textarea>
            </div>
            <div class="col-md-2 text-start">
              <label class="form-label fw-bold">¿Baja?</label>
              <select name="baja" class="form-select">
                <option value="0">No</option>
                <option value="1">Sí</option>
              </select>
            </div>

            <div class="col-md-7 text-start">
              <label class="form-label fw-bold">Descripción de Baja</label>
              <input type="text" name="descrip_baja" class="form-control" placeholder="Motivo de la baja si aplica">
            </div>

            <div class="col-md-3 text-start">
              <label class="form-label fw-bold">Fecha de Baja</label>
              <input type="date" name="fecha_baja" class="form-control">
            </div>

            <div class="col-12 text-center mt-4">
              <button type="submit" name="agregar" class="btn btn-success btn-lg px-5">
                <i class="bi bi-plus-circle"></i> actualizar Artículo
              </button>
            </div>

          </form>


        </div>
      </div>
    </section>
  </main>

  <?php
  require_once('pie.php');
  ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>