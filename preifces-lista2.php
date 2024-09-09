<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';

date_default_timezone_set('America/Bogota');
if ($_SESSION['nivel'] == 4) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  //$code = $_GET['code'];
  //$materia = $_GET['materia'];
  $grado = $_GET['grado'];
  $id_login = $_SESSION['id'];

  try {
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_id_logins=?");
    $stmt->bind_param("i", $id_login);
    $stmt->execute();
    $result_id = $stmt->get_result();
    $result_id2 = $result_id->fetch_assoc();
    $alum_idx2 = $result_id2['alum_id'];
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

  if (!filter_var($grado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  try {
    $stmt = $conn->prepare("SELECT * FROM grados WHERE gdo_id=?");
    $stmt->bind_param("i", $grado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $descripcion = $resultado->fetch_assoc();
    $grado_desc = $descripcion['gdo_des_grado'];
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="fa fa-user-plus"></i>
              Tus Simulacros
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Matricula nueva</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Simulacros publicados<strong></strong></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="asig-lista" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Asignación</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- :::: ASIGNACIONES PUBLICADAS :::: -->
                <?php
                try {
                  $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_grado=?");
                  $stmt->bind_param("s", $grado_desc);
                  $stmt->execute();
                  $resultado = $stmt->get_result();
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                while ($datos_guia = $resultado->fetch_assoc()) { ?>
                  <tr>
                    <td>
                      <p>Simulacro #<?php echo $datos_guia['simul_orden']; ?>

                        <?php
                        $id_simul = $datos_guia['simul_id'];
                        try {
                          $stmt = $conn->prepare("SELECT simule_status FROM simulacros_e WHERE simule_simul_id=? AND simule_alum_id=?");
                          $stmt->bind_param("ii", $id_simul, $alum_idx2);
                          $stmt->execute();
                          $resultado_subidas = $stmt->get_result();
                          $datos_entrega = $resultado_subidas->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        if ($datos_entrega['simule_status'] == 1) { ?>
                          <span class="badge badge-danger">No entregado</span>
                      </p>
                    <?php
                        } else if ($datos_entrega['simule_status'] == 2) { ?>
                      <span class="badge badge-warning">Incompleto</span></p>
                    <?php
                        } else if ($datos_entrega['simule_status'] == 3) { ?>
                      <span class="badge badge-success">Entregado</span></p>
                    <?php
                        } else { ?>
                      <span class="badge badge-danger">No entregado</span></p>
                    <?php
                        }
                    ?>

                    </td>
                    <td>
                      <?php
                      $nac_fec = DateTime::createFromFormat('Y-m-d', $datos_guia['simul_fecha']);
                      $fecha_actual_dt = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
                      ?>

                      <p><?php echo $nac_fec->format('d-m-Y') ?></p>
                    </td>
                    <td>
                      <div class="btn-group" md5>
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                          <span>Opciones</span>
                        </button>
                        <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="preifces-param2.php?id=<?php echo   $datos_guia['simul_id'] ?>">Explorar</a>

                          <?php if ($fecha_actual_dt > $nac_fec) { ?>
                            <a class="dropdown-item" href="preifces-entregas2.php?simul_id=<?php echo $datos_guia['simul_id'] ?>&id=<?php echo $alum_idx2 ?>&grado=<?php echo $grado ?>">Resultados</a>

                            <a class="dropdown-item" href="preifces-analisis2.php?simul_id=<?php echo $datos_guia['simul_id'] ?>&id=<?php echo $alum_idx2 ?>&grado=<?php echo $grado ?>"">Analizar</a>
                          <?php } ?>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php };
                $conn->close();
                $stmt->close();
                ?>
                <!-- :::: /ASIGNACIONES PUBLICADAS :::: -->
              </tbody>
              <tfoot>
                <tr>
                  <th>Asignación</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include_once 'templates/footer.php';
endif;
?>