<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 3) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $simul_id = $_GET['simul_id'];
  if (!filter_var($simul_id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  //$orden = $_GET['orden'];
  //$periodo = $_GET['periodo'];
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
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_grado=?");
    $stmt->bind_param("s", $alum_grado);
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
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Resultados</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-default" onclick="desplegarTabla();"><i class="fa fa-expand"></i> Tabla</button>
              <button type="button" class="btn btn-default" id="btn-pdf"><i class="fa-solid fa-file-pdf"></i> Pdf</button>
              <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Volver</button>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
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
                <div class="card card-success collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title"><?php echo $nombre_alum ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i></button>
                    </div>

                  </div>
                  <div class="card-body p-0" style="display: none;">
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

                              $crr_mat = $_SESSION['users_mat'];

                              $materias = array(
                                  'INGLÉS' => array('Inglés', 'simulr_ingles', 'simul_materia_ingles', 'ingles_p1', 'ingles_p2', 'ingles'),
                                  'CIENCIAS NATURALES' => array('Naturales', 'simulr_naturales', 'simul_materia_naturales', 'naturales_p1', 'naturales_p2', 'naturales'),
                                  'LENGUAJE' => array('Lenguaje', 'simulr_lenguaje', 'simul_materia_lenguaje', 'lenguaje_p1', 'lenguaje_p2', 'lenguaje'),
                                  'MATEMÁTICAS' => array('Matemáticas', 'simulr_matematicas', 'simul_materia_matematicas', 'matematicas_p1', 'matematicas_p2', 'matematicas'),
                                  'CIENCIAS SOCIALES' => array('Sociales', 'simulr_sociales', 'simul_materia_sociales', 'sociales_p1', 'sociales_p2', 'sociales'),
                                  'FILOSOFÍA' => array('Filosofía', 'simulr_filosofia', 'simul_materia_filosofia', 'filosofia_p1', 'filosofia_p2', 'filosofia'),
                                  'FÍSICA' => array('Física', 'simulr_fisica', 'simul_materia_fisica', 'fisica_p1', 'fisica_p2', 'fisica')
                              );
                          
                              if (isset($materias[$crr_mat])) {
                                  $arrMateria = array(
                                      $materias[$crr_mat][0] => array_slice($materias[$crr_mat], 1)
                                  );
                              } else {
                                  $arrMateria = array_map(function($materia) {
                                      return array_slice($materia, 1);
                                  }, $materias);
                              }

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
                                    
                                    if ($respuesta_alumno === ' ' || !isset($respuesta_alumno)) {
                                      $respuesta_alumno = 'X';
                                    }

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
                            <button class="badge bg-warning"
                              onclick="ModalNuevoPlazo(
                              '<?php echo $info_simul['simule_hora_final'] ?>',
                              '<?php echo $simul_id ?>',
                              '<?php echo $alum_id ?>',
                              '1')" style="border: 0px;">+ tiempo</button>
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

                <div class="card card-default collapsed-card">
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
                      <button class="badge bg-warning" onclick="ModalNuevoPlazo(
                        '<?php echo $fec ?>',
                        '<?php echo $simul_id ?>',
                        '<?php echo $alum_id ?>',
                        '2'
                        )" style="border: 0px;">+ tiempo</button>
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
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
        <div class="card-footer">
          <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Volver</button>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-tabla-global">
    <div class="modal-dialog modal-lg" style="max-width: 95%; max-height: 95%; height: 95%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <small>
              Resultados Globales
            </small>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <di v class="modal-body">
          <div class="card-body">
            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
            <table id="icfes-tab" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Alumno</th>
                  <th>Global</th>
                  <?php
                  foreach ($crr_mats as $matKey => $MatDes) {
                    if ($key2 !== 'nombre') {
                      echo "<th>" . $MatDes . "</th>";
                    }
                  }
                  ?>
                </tr>
              </thead>
              <tbody>

                <?php
                $keys = array_keys($puntajes_maximos);
                $values = array_values($puntajes_maximos);
                array_multisort($values, SORT_DESC, $keys, $values);
                $podium = array_combine($keys, $values);
                ?>

                <?php
                $count = 1;
                foreach ($podium as $key => $value) { ?>
                  <tr>
                    <th>

                      <?php
                      if ($count === 1) {
                        echo $puntajes_materias[$key]['nombre'] . '<i class="fas fa-trophy"></i>';
                      } else {
                        echo $puntajes_materias[$key]['nombre'];
                      }
                      ?>

                    </th>

                    <th>
                      <?php echo $podium["" . $key . ""]; ?>
                    </th>


                  <?php

                  foreach ($puntajes_materias[$key] as $key2 => $value2) {
                    if ($key2 !== 'nombre') {
                      echo "<th>" . $value2 . "</th>";
                    }
                  }

                  echo '</tr>';

                  $count++;
                } ?>



              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-nuevo-plazo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Asignar nuevo plazo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" name="simul_nuevo_plazo" id="simul_nuevo_plazo" method="post" action="preifces-modelo.php" class="needs-validation" novalidate autocomplete="on">
            <!--class="needs-validation" novalidate autocomplete="on"-->
            <div class="row">

              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control jsdatetime" name="datos_nuevo_plazo" id="datos_nuevo_plazo" required>
                  </div>
                </div>
              </div> <!-- col -->
            </div>
            <!-- /.row -->
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="simul-comando" value="nuevo_plazo">
          <input type="hidden" name="nuevo_plazo_alum_id" id="nuevo_plazo_alum_id" value="">
          <input type="hidden" name="nuevo_plazo_simul_id" id="nuevo_plazo_simul_id" value="">
          <input type="hidden" name="nuevo_plazo_type" id="nuevo_plazo_type" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <input type="hidden" id="ptj-max" value='<?php echo json_encode($podium) ?>'>
  <input type="hidden" id="ptj-mat" value='<?php echo json_encode($puntajes_materias) ?>'>
  <input type="hidden" id="ptj-mli" value='<?php echo json_encode($crr_mats) ?>'>
  <input type="hidden" id="icfes-anio" value='<?php echo $icfes_anio ?>'>
  <input type="hidden" id="alum-grado" value='<?php echo $alum_grado ?>'>
  <input type="hidden" id="simul-orden" value='<?php echo $info_simulacro['simul_orden'] ?>'>
<?php
  include_once 'templates/footer.php';
endif;
?>
<script>
  function desplegarTabla(d1) {
    $("#modal-tabla-global").modal("show");
  }

  function ModalNuevoPlazo(hora, simul, alum, type) {
    $("#datos_nuevo_plazo").val(hora);
    $("#nuevo_plazo_simul_id").val(simul);
    $("#nuevo_plazo_alum_id").val(alum);
    $("#nuevo_plazo_type").val(type);
    $("#modal-nuevo-plazo").modal("show");
  }
</script>
<script>
  function volverListaAsig(grado) {
    const crrNivel = <?php echo $_SESSION['nivel'] ?>;
    let location = ''

    if (crrNivel === 1) {
      location = 'preifces-lista.php?grado='
    } else if (crrNivel === 3) {
      location = 'preifces-lista3.php?grado='
    }
    window.location.href = location + grado;
  }
</script>