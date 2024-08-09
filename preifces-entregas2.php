<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 4) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $simul_id = $_GET['simul_id'];
  if (!filter_var($simul_id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  //$orden = $_GET['orden'];
  //$periodo = $_GET['periodo'];

  $id_estudiante = $_GET['id'];
  $grado = $_GET['grado'];
  //$simul_id = $simul_id;

  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
    $stmt->bind_param("i", $simul_id);
    $stmt->execute();
    $resultado_simulacro = $stmt->get_result();
    $info_simulacro = $resultado_simulacro->fetch_assoc();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  $alum_grado = $info_simulacro['simul_grado'];
  try {
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_id=?");
    $stmt->bind_param("i", $id_estudiante);
    $stmt->execute();
    $info_alum2 = $stmt->get_result();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros_r WHERE simulr_simul_id=?");
    $stmt->bind_param("i", $simul_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $info_guia = $resultado->fetch_assoc();
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
              <i class="fa fa-poll"></i>
              Resultados del Simulacro
            </h1>
            <h6>Simulacro: <code><?php echo '#' . $info_simulacro['simul_orden'] ?></code> Grado: <code><?php echo $alum_grado; ?></code></h6>
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

        <?php
        $puntajes_maximos = array();
        $puntajes_materias = array();

        while ($info_alum = $info_alum2->fetch_assoc()) {

          $icfes_anio = $info_alum['alum_anio_escolar'];

          $alum_id = $info_alum['alum_id'];
          $stmt = $conn->prepare("SELECT * FROM simulacros_e WHERE simule_simul_id=? AND simule_alum_id=?");
          $stmt->bind_param("ii", $simul_id, $alum_id);
          $stmt->execute();
          $info_simul2 = $stmt->get_result();
          $info_simul = $info_simul2->fetch_assoc();

          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
          $simul_alum_id = $info_simul['simule_alum_id'];

          if ($simul_alum_id == $alum_id) { ?>
            <?php $nombre_alum = $info_alum['alum_1er_nombre'] . ' ' . $info_alum['alum_1er_apellido']; ?>
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"><?php echo $nombre_alum ?></h3>
                <div class="card-tools">
                </div>

              </div>
              <div class="card-body">
                <table class="table">
                  <tbody>
                    <table class="table">
                      <tbody>
                        <tr>

                          <?php
                          $total_correctas;
                          $total_incorrectas;
                          $puntaje_global;
                          $puntaje_max = 0;
                          $crr_mats = array();
                          $crr_mats2 = array();


                          $arrMateria = array(
                            'Inglés' => array('simulr_ingles', 'simul_materia_ingles', 'ingles_p1', 'ingles_p2', 'ingles'),
                            'Naturales' => array('simulr_naturales', 'simul_materia_naturales', 'naturales_p1', 'naturales_p2', 'naturales'),
                            'Lenguaje' => array('simulr_lenguaje', 'simul_materia_lenguaje', 'lenguaje_p1', 'lenguaje_p2', 'lenguaje'),
                            'Matemáticas' => array('simulr_matematicas', 'simul_materia_matematicas', 'matematicas_p1', 'matematicas_p2', 'matematicas'),
                            'Sociales' => array('simulr_sociales', 'simul_materia_sociales', 'sociales_p1', 'sociales_p2', 'sociales'),
                            'Filosofía' => array('simulr_filosofia', 'simul_materia_filosofia', 'filosofia_p1', 'filosofia_p2', 'filosofia'),
                            'Física' => array('simulr_fisica', 'simul_materia_fisica', 'fisica_p1', 'fisica_p2', 'fisica'),
                          );

                          foreach ($arrMateria as $key => $value) {

                            $simul_param = json_decode($info_simulacro[$value[1]], true);
                            $simul_p1 = (int) $simul_param[$value[2]];
                            $simul_p2 = (int) $simul_param[$value[3]];
                            $correctas = 0;
                            $incorrectas = 0;

                            $si_ingles = json_decode($info_guia[$value[0]], true);

                            if ($simul_param[$value[4] . '_status'] === 'SI') {
                              $crr_mats[$key] = $value[4];
                              $control = $simul_p1; ?>

                        <tr>
                          <td>
                            <small><strong><?php echo $key ?> </strong></small><br>
                            <div class="divResIcfes__Container">
                              <?php
                              for ($i = $simul_p1; $i <= $simul_p2; $i++) {
                                $respuesta_profesor = $si_ingles["" . 'p-' . $control . ""];
                                $respuesta_alumno = $respuestas_alum["" . 'p-' . $control . ""];

                                if ($respuesta_profesor === $respuesta_alumno) {
                                  $correctas += 1;
                                  $total_correctas += 1;
                                  $resp_bg = 'divResIcfes__span--bg1';
                                } else {
                                  $incorrectas += 1;
                                  $total_incorrectas += 1;
                                  $resp_bg = 'divResIcfes__span--bg2';
                                }

                                if (!isset($respuesta_profesor)) {
                                  $resp_bg = 'divResIcfes__span--bg3';
                                }

                                if (!isset($respuesta_alumno)) {
                                  $resp_bg = 'divResIcfes__span--bg3';
                                }

                              ?>
                                <div class="divResIcfes">
                                  <label class="divResIcfes__label"><?php echo $control ?></label>
                                  <span class="divResIcfes__span <?php echo $resp_bg ?>"><?php echo $respuesta_alumno ?></span>
                                </div>
                              <?php $control += 1;
                              }

                              $total_preguntas = $correctas + $incorrectas;
                              $puntaje2 = $correctas * 100 / $total_preguntas;
                              $puntaje = number_format($puntaje2, 2);
                              $puntaje_global += $puntaje;
                              $puntajes_materias[$alum_id][$value[4]] = $puntaje;
                              $puntajes_materias[$alum_id]['nombre'] = $nombre_alum;

                              ?>
                            </div>
                            <br>
                            <span>
                              <i class="fas fa-check"></i><?php echo $correctas ?>&nbsp&nbsp
                              <i class="fas fa-times"></i><?php echo $incorrectas ?>&nbsp&nbsp
                              <i class="fas fa-trophy"></i><?php echo $puntaje . '/100' ?>
                            </span>
                          </td>
                        </tr>

                    <?php
                              $puntaje_max += 100;
                            }
                          }



                    ?>

                    <tr>
                      <td>
                        <small><strong>Datos Globales:</strong></small><br>
                        <span class="info-box-text"><i class="fas fa-check"></i> Respuestas correctas: <strong><?php echo $total_correctas ?></strong></span><br>
                        <span class="info-box-text"><i class="fas fa-times"></i> Respuestas incorrectas: <strong><?php echo $total_incorrectas ?></strong></span><br>
                        <?php
                        $total_preguntas_final = $total_correctas + $total_incorrectas;
                        // $puntaje_total_final = $total_correctas * 100 / $total_preguntas_final;
                        $puntajes_maximos["" . $alum_id . ""] = $puntaje_global;
                        ?>
                        <span class="info-box-text"><i class="fas fa-trophy"></i> Puntaje Goblal: <strong><?php echo $puntaje_global . '/' . $puntaje_max  ?></strong></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <small><strong>Hora de finalización:</strong></small><br>
                        <span class="info-box-text"><i class="fas fa-clock"></i> <?php echo $info_simul['simule_hora_final'] ?></span>
                        <br>
                      </td>
                    </tr>

                    </tr>
                      </tbody>
                    </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <?php
          } else { ?>

            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><?php echo $info_alum['alum_1er_nombre'] . ' ' . $info_alum['alum_1er_apellido']; ?></h3>
                <div class="card-tools">
                  <i class="fas fa-exclamation-circle" style="color:#DC3545"></i><span> No presentó</span>
                  <?php
                  $now = date("Y-m-d H:i:s");
                  $min = 120;
                  $fec = strtotime('+' . $min . ' minute', strtotime($now));
                  $fec = date('m/d/Y h:i A', $nuevafecha);
                  ?>
                </div>
              </div>
              <div class="card-body p-0" style="display: none;">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>No ha entregado ningún archivo</td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        </div>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        <?php
          }
          $total_correctas = 0;
          $total_incorrectas = 0;
          $puntaje_global = 0;
        }
        ?>

        <div class="card-footer">
          <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Volver</button>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>
  <!-- /.modal -->
<?php
  include_once 'templates/footer.php';
endif;
?>

<script>
  function volverListaAsig(grado) {
    window.location.href = 'preifces-lista2.php?grado=' + grado;
  }
</script>