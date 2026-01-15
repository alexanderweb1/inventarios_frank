<?php
require_once('usuario.php');
session_start();
require_once("db.php");
include_once('config.php');
$ubicaciones = $pdo_conn->query("SELECT id_ubicacion, nombre FROM ubicacion")->fetchAll(PDO::FETCH_OBJ);
$marcas = $pdo_conn->query("SELECT id_marca, nombre FROM marca")->fetchAll(PDO::FETCH_OBJ);
$inventarios = $pdo_conn->query("SELECT id_inventario, nombre FROM inventario")->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistema de inventarios - Administrar articulo</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- fontawesome icons -->
  <script src="https://kit.fontawesome.com/58e95fbc3e.js" crossorigin="anonymous"></script>

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
          <h1 data-aos="fade-up">Administrar <span>Artículos</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">Ingrese todos los detalles técnicos y de control del activo</p>
        </div>

        <div class="card shadow-lg p-4" data-aos="fade-up" data-aos-delay="200">
          <form action="articulo_acc.php" method="post" enctype="multipart/form-data" class="row g-3">

            <input type="hidden" name="accion" value="AGREGAR">

            <div class="col-md-4">
              <label class="form-label fw-bold">Ubicación Física</label>
              <select name="id_ubicacion" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($ubicaciones as $u) echo "<option value='$u->id_ubicacion'>$u->nombre</option>"; ?>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold">Categoría Inventario</label>
              <select name="id_inventario" id="id_inventario" class="form-select" required onchange="generarCodigo()">
                <option value="">Seleccione...</option>
                <?php
                // Nota: Asegúrate de que tu consulta SQL de inventarios traiga el prefijo
                $inventarios = $pdo_conn->query("SELECT id_inventario, nombre, prefijo FROM inventario")->fetchAll(PDO::FETCH_OBJ);
                foreach ($inventarios as $i) {
                  echo "<option value='$i->id_inventario' data-prefijo='$i->prefijo'>$i->nombre</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold">Marca</label>
              <select name="id_marca" class="form-select" required>
                <option value="">Seleccione...</option>
                <?php foreach ($marcas as $m) echo "<option value='$m->id_marca'>$m->nombre</option>"; ?>
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold">Nro. Inventario ISTMS</label>
              <input type="text" name="n_inventario_istms" id="n_inventario_istms" class="form-control" required placeholder="Esperando categoría...">
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold">Tipo de Artículo</label>
              <input type="text" name="tipo_articulo" class="form-control" placeholder="Ej: Electrónico">
            </div>

            <div class="col-md-4">
              <label class="form-label fw-bold">Nombre del Artículo</label>
              <input type="text" name="nombre" class="form-control" required placeholder="Ej: Laptop Dell">
            </div>

            <div class="col-md-3">
              <label class="form-label fw-bold">Modelo</label>
              <input type="text" name="modelo" class="form-control">
            </div>

            <div class="col-md-3">
              <label class="form-label fw-bold">Nro. de Serie</label>
              <input type="text" name="n_serie" class="form-control">
            </div>

            <div class="col-md-3">
              <label class="form-label fw-bold">Estado Actual</label>
              <input type="text" name="estado" class="form-control" placeholder="Ej: Operativo">
            </div>

            <div class="col-md-3">
              <label class="form-label fw-bold">Foto del Activo</label>
              <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

            <div class="col-12 text-start">
              <label class="form-label fw-bold">Descripción del Artículo</label>
              <textarea name="descripcion" class="form-control" rows="2" placeholder="Detalles técnicos adicionales..."></textarea>
            </div>

            <div class="col-md-4 text-start">
              <label class="form-label fw-bold">Valor Inicial ($)</label>
              <input type="number" step="0.01" name="v_eco_initial" class="form-control">
            </div>

            <div class="col-md-4 text-start">
              <label class="form-label fw-bold">Fecha Adquisición</label>
              <input type="date" name="f_adquisicion" class="form-control">
            </div>

            <div class="col-md-4 text-start">
              <label class="form-label fw-bold">Fecha Ingreso Sistema</label>
              <input type="datetime-local" name="fecha_registro" class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>">
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
                <i class="bi bi-plus-circle"></i> Agregar Artículo
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <section class="services section light-background">
      <div class="container">
        <div class="table-responsive shadow">
          <table class="table table-hover table-bordered align-middle table-striped">
            <thead class="thead-dark">
              <tr class="text-center">
                <th colspan="7">Lista de artículos registrados</th>
              </tr>
              <tr class="text-center">
                <th>ID</th>
                <th>Nr.inventario</th>
                <th>Nombre</th>
                <th>Marca / Ubicación</th>
                <th>Estado</th>
                <th>Ingreso</th>
                <th width="120">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $sql = "SELECT 
                      a.id_articulo,
                      a.n_inventario_istms,
                      a.nombre,
                      a.modelo,
                      a.n_serie,
                      a.estado,
                      a.foto,
                      a.descripcion,
                      a.v_eco_inicial,
                      a.f_adquisicion,
                      a.fecha,
                      a.baja,
                      a.descrip_baja,
                      a.fecha_baja,
                      m.nombre AS m_nom,
                      u.nombre AS u_nom
                    FROM articulo a
                    JOIN marca m ON a.id_marca = m.id_marca
                    JOIN ubicacion u ON a.id_ubicacion = u.id_ubicacion
                    JOIN inventario i ON a.id_inventario = i.id_inventario";

              $articulos = $pdo_conn->query($sql)->fetchAll(PDO::FETCH_OBJ);

              foreach ($articulos as $art) {
              ?>
                <tr>
                  <!-- ID -->
                  <td class="text-center">
                    <span class="badge text-dark">
                      <?php echo $art->id_articulo; ?>
                    </span>
                  </td>

                  <!-- Código -->
                  <td>
                    <span class="badge bg-light text-dark border">
                      <?php echo $art->n_inventario_istms; ?>
                    </span>
                  </td>

                  <!-- Nombre -->
                  <td>
                    <strong><?php echo $art->nombre; ?></strong>
                  </td>

                  <!-- Marca / Ubicación -->
                  <td>
                    <small class="text-muted"><?php echo $art->m_nom; ?></small><br>
                    <span class="text-primary" style="font-size: 0.85rem;">
                      <i class="bi bi-geo-alt"></i> <?php echo $art->u_nom; ?>
                    </span>
                  </td>

                  <!-- Estado -->
                  <td class="text-center">
                    <span class="badge <?php echo $art->baja ? 'bg-danger' : 'bg-success'; ?>">
                      <?php echo $art->baja ? 'BAJA' : 'ACTIVO'; ?>
                    </span>
                  </td>

                  <!-- Ingreso -->
                  <td class="text-center">
                    <small><?php echo date('d/m/Y', strtotime($art->fecha)); ?></small>
                  </td>

                  <!-- Acciones -->
                  <td class="text-center">
                    <div class="btn-group gap-2">
                      <button type="button"
                        class="btn btn-sm btn-warning text-white"
                        onclick="verDetalles(<?php echo htmlspecialchars(json_encode($art)); ?>)"
                        title="Ver detalles completos">
                        <i class="fa fa-fw fa-eye"></i>
                      </button>

                      <a href="editar_articulo.php?id=<?php echo $art->id_articulo; ?>""
                        class=" btn btn-sm btn-info text-white"
                        title="Editar">
                        <i class="bi bi-pencil-square"></i>
                      </a>

                      <a href="delete_articulo.php?id=<?php echo $art->id_articulo; ?>"
                        class="btn btn-sm btn-danger text-white"
                        onclick="return confirm('¿Está seguro de eliminar este artículo?');"
                        title="Eliminar">
                        <i class="fa fa-fw fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>

          </table>
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

  <!-- modal -->
  <div class="modal fade" id="modalDetalles" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title"><i class="bi bi-info-circle"></i> Información Detallada del Activo</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-5 text-center mb-3">
              <img id="det_foto" src="assets/img/no-image.png" class="img-fluid rounded shadow" alt="Foto del activo">
            </div>
            <div class="col-md-7">
              <h4 id="det_nombre" class="text-primary mb-0"></h4>
              <p id="det_codigo" class="text-muted fw-bold mb-3"></p>

              <table class="table table-sm table-borderless">

                <tr>
                  <th>Marca:</th>
                  <td id="det_marca"></td>
                </tr>
                <tr>
                  <th>Modelo:</th>
                  <td id="det_modelo"></td>
                </tr>
                <tr>
                  <th>Serie:</th>
                  <td id="det_serie"></td>
                </tr>
                <tr>
                  <th>Ubicación:</th>
                  <td id="det_ubicacion"></td>
                </tr>
                <tr>
                  <th>Estado:</th>
                  <td id="det_estado"></td>
                </tr>
              </table>
            </div>
          </div>
          <hr>
          <div class="row mt-2">
            <div class="col-md-6 border-end">
              <h6 class="fw-bold text-success">Datos Económicos</h6>
              <p><strong>Valor Inicial:</strong> $<span id="det_valor"></span></p>
              <p><strong>Fecha Adquisición:</strong> <span id="det_fecha_adq"></span></p>
            </div>
            <div class="col-md-6 ps-4">
              <h6 class="fw-bold text-danger">Estado de Baja</h6>
              <p><strong>¿Está de baja?:</strong> <span id="det_baja"></span></p>
              <p><strong>Motivo:</strong> <span id="det_motivo_baja"></span></p>
            </div>
          </div>
          <div class="mt-3 bg-light p-3 rounded">
            <strong>Descripción técnica:</strong>
            <p id="det_descripcion" class="mb-0"></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- ajax -->
  <script>
    function generarCodigo() {
      const id_inventario = document.getElementById('id_inventario').value;
      const inputCodigo = document.getElementById('n_inventario_istms');

      if (id_inventario === "") {
        inputCodigo.value = "";
        return;
      }

      // Llamamos al servidor para obtener el siguiente número real
      fetch('get_next_correlativo.php?id_inventario=' + id_inventario)
        .then(response => response.text())
        .then(data => {
          inputCodigo.value = data; // Ejemplo: COMP-005
        })
        .catch(error => {
          console.error('Error:', error);
          inputCodigo.value = "ERR-000";
        });
    }

    function verDetalles(articulo) {
      document.getElementById('det_nombre').innerText = articulo.nombre;
      document.getElementById('det_codigo').innerText = "Código: " + articulo.n_inventario_istms;
      document.getElementById('det_marca').innerText = articulo.m_nom;
      document.getElementById('det_modelo').innerText = articulo.modelo || 'N/A';
      document.getElementById('det_serie').innerText = articulo.n_serie || 'N/A';
      document.getElementById('det_ubicacion').innerText = articulo.u_nom;
      document.getElementById('det_estado').innerText = articulo.estado || 'No especificado';
      document.getElementById('det_valor').innerText = articulo.v_eco_inicial || '0.00';
      document.getElementById('det_fecha_adq').innerText = articulo.f_adquisicion || 'No registrada';
      document.getElementById('det_descripcion').innerText = articulo.descripcion || 'Sin descripción adicional.';

      document.getElementById('det_baja').innerText = (articulo.baja == 1) ? "SÍ" : "NO";
      document.getElementById('det_motivo_baja').innerText = articulo.descrip_baja || 'Ninguno';

      const imgElement = document.getElementById('det_foto');

      if (articulo.foto && articulo.foto.trim() !== "") {
        imgElement.src = "uploads/" + articulo.foto;
      } else {
        imgElement.src = "assets/img/no-image.png";
      }

      const myModal = new bootstrap.Modal(document.getElementById('modalDetalles'));
      myModal.show();
    }
  </script>



</body>

</html>