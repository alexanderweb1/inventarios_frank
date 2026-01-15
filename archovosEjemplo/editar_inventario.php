<?php
require_once('usuario.php');
session_start();
require_once("db.php");
include_once('config.php');
$id_inventario = $_REQUEST["id_inventario"];

$inv = $pdo_conn->query("SELECT * FROM inventario WHERE id_inventario=$id_inventario; ");
$inventario = $inv->fetchAll(PDO::FETCH_OBJ);
foreach ($inventario as $m) {
  $nombre = $m->nombre;
  $prefijo = $m->prefijo;
  $descripcion = $m->descripcion;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistema de inventarios - Editar inventario </title>
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
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Administrar <span>Inventario</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">Escriba información del inventario</p>

          <div class="card shadow-sm p-4 w-100" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="200">
            <form id="form1" name="form1" method="post" action="inventario_acc.php">

              <div class="row">
                <div class="col-md-8 form-group text-start mb-3">
                  <label class="fw-bold">Nombre del inventario:</label>
                  <input required name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" placeholder="Ej: Equipos de Cómputo">
                  <input type=hidden name="id_inventario" id="id_inventario" value="<?php echo $id_inventario; ?>">
                  <input type=hidden name="accion" id="accion" value="EDITAR">
                </div>

                <div class="col-md-4 form-group text-start mb-3">
                  <label class="fw-bold">Prefijo:</label>
                  <input required name="prefijo" id="prefijo" class="form-control" value="<?php echo $prefijo; ?>" placeholder="Ej: COMP" maxlength="5">
                </div>
              </div>


              <div class="form-group text-start mb-4">
                <label class="fw-bold">Descripción:</label>
                <textarea required id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Ingrese la descripción del inventario"><?php echo $descripcion; ?></textarea>
              </div>

              <button name="agregar" id="agregar" class="btn btn-secondary px-5 shadow-sm" type="submit">
                <i class="bi bi-plus-circle"></i> Actualizar
              </button>
            </form>
          </div>
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