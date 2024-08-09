<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3 || $_SESSION['nivel'] == 4) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <?php if ($_SESSION['nivel'] !== 4) : ?>
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">SIMULICFES I.E Escuela Normal Superior de Ocaña </h1>
            </div><!-- /.col -->
          <?php endif; ?>
          <?php if ($_SESSION['nivel'] == 4) : ?>
            <div class="col-sm-6">
              <h1>
                <i class="fa fa-users-cog"></i>
                SIMULICFES I.E Escuela Normal Superior de Ocaña
              </h1>
            </div><!-- /.col -->
          <?php endif; ?>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">INICIO</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <?php if ($_SESSION['nivel'] !== 4) : ?>
        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-3 col-6">
              <?php
              $sql = "SELECT COUNT(simul_id) AS cargados FROM simulacros";
              $res = $conn->query($sql);
              $dat = $res->fetch_assoc();
              ?>

              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $dat['cargados']; ?></h3>
                  <p>Simulacros cargados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-book"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <?php
              $sql = "SELECT COUNT(alum_id ) AS totalAlumnos FROM alumnos";
              $res = $conn->query($sql);
              $dat = $res->fetch_assoc();
              ?>
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $dat['totalAlumnos']; ?></h3>
                  <p>Alumnos Matriculados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <!--<a href="#" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>-->
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>123</h3>
                  <p>Alumnos Privados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <?php
              $sql4 = "SELECT COUNT(users_id) AS docentes FROM usuarios WHERE users_rol = 'DOCENTE'";
              $resultado4 = $conn->query($sql4);
              $matriculados4 = $resultado4->fetch_assoc();
              ?>
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $matriculados4['docentes']; ?></h3>
                  <p>Docentes Registrados</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-female"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Estudiantes de género femenino</span>
                  <span class="info-box-number">
                    123
                    <small><i class="fas fa-heart"></i></small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-male"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Estudiantes de género masculino</span>
                  <span class="info-box-number">
                    123
                    <small><i class="fas fa-heart"></i></small>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      <?php endif; ?>
      <?php if ($_SESSION['nivel'] == 'NEO') :

        $dgrupo = $_SESSION['alum_grado'];
        $alum_user_id = $_SESSION['id'];
        $per = 'TERCERO';

      ?>
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Estan son tus guias entregadas y revisadas hasta ahora, del Periodo: <strong><span><?php echo $per; ?></span></strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="alum-reporte" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Inglés</th>
                    <th>Naturales</th>
                    <th>Lenguaje</th>
                    <th>Matemáticas</th>
                    <th>Sociales</th>
                    <th>Informática</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $stmt2 = $conn->prepare("SELECT * FROM alumnos WHERE alum_id_logins=?");
                    $stmt2->bind_param("i", $alum_user_id);
                    $stmt2->execute();
                    $resultado2 = $stmt2->get_result();
                    $datos_alum = $resultado2->fetch_assoc();
                  } catch (\Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }
                  $id_alum = $datos_alum['alum_id'];
                  $materia1 = 'INGLÉS';
                  $materia2 = 'CIENCIAS NATURALES';
                  $materia3 = 'LENGUAJE';
                  $materia4 = 'MATEMÁTICAS';
                  $materia5 = 'CIENCIAS SOCIALES';
                  $materia6 = 'INFORMÁTICA';
                  ?>
                  <tr>
                    <td>
                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia1, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                    <td>
                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia2, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                    <td>
                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia3, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                    <td>
                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia4, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                    <td>

                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia5, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                    <td>
                      <p>
                        <?php
                        try {
                          $stmt = $conn->prepare("SELECT * FROM notas_parciales_p2 WHERE notas_p_p2_id_alumno=? AND notas_p_p2_materia=? AND notas_p_p2_periodo=?");
                          $stmt->bind_param("iss", $id_alum, $materia6, $per);
                          $stmt->execute();
                          $notas_ingles2 = $stmt->get_result();
                          $notas_ingles = $notas_ingles2->fetch_assoc();
                        } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        ?>
                        <?php

                        $taller1 = $notas_ingles['notas_p_p2_t1'];
                        $taller2 = $notas_ingles['notas_p_p2_t2'];
                        $taller3 = $notas_ingles['notas_p_p2_t3'];
                        $proyecto = $notas_ingles['notas_p_p2_p'];
                        $examen = $notas_ingles['notas_p_p2_e'];
                        if ($taller1 > 0) { ?>
                          T1 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T1 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        } ?>
                        <br>
                        <?php
                        if ($taller2 > 0) { ?>
                          T2 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T2 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($taller3 > 0) { ?>
                          T3 = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          T3 = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($proyecto > 0) { ?>
                          P = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          P = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>
                        <br>
                        <?php

                        if ($examen > 0) { ?>
                          E = <i class="fas fa-check" style=color:green;></i>
                        <?php
                        } else { ?>
                          E = <i class="fas fa-times" style=color:red;></i>
                        <?php
                        }
                        ?>


                      </p>
                    </td>
                  </tr>
                  <?php
                  $conn->close();
                  ?>
                </tbody>
              </table>
              <br>
              <span>Recuerda que la <i class="fas fa-times" style="color:red;"></i> signfica que no has entregado la guia o que el profesor no la ha revisado y el <i class="fas fa-check" style="color:green;"></i> quiere decir que ya entregaste y que el profesor ya la revisó. <strong> Si ya entregaste tus guias y no te aparecen como revisadas, comunicate con el profesor y solicita que actualice tus entregas.</strong>

              </span>
            </div>
            <!-- /.card-body -->
          </div>
        </div><!-- /.container-fluid -->
      <?php endif; ?>
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include_once 'modal-login.php';
  include_once 'templates/footer.php';
endif;
?>