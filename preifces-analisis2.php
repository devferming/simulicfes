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
  $grado = $_GET['grado'];
  $id = $_GET['id'];

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
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $info_alum_1 = $stmt->get_result();
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

  $arrMateria = array(
    'Inglés' => array('simulr_ingles', 'simul_materia_ingles', 'ingles_p1', 'ingles_p2', 'ingles'),
    'Naturales' => array('simulr_naturales', 'simul_materia_naturales', 'naturales_p1', 'naturales_p2', 'naturales'),
    'Lenguaje' => array('simulr_lenguaje', 'simul_materia_lenguaje', 'lenguaje_p1', 'lenguaje_p2', 'lenguaje'),
    'Matemáticas' => array('simulr_matematicas', 'simul_materia_matematicas', 'matematicas_p1', 'matematicas_p2', 'matematicas'),
    'Sociales' => array('simulr_sociales', 'simul_materia_sociales', 'sociales_p1', 'sociales_p2', 'sociales'),
    'Filosofía' => array('simulr_filosofia', 'simul_materia_filosofia', 'filosofia_p1', 'filosofia_p2', 'filosofia'),
    'Física' => array('simulr_fisica', 'simul_materia_fisica', 'fisica_p1', 'fisica_p2', 'fisica'),
  );

  $phpColors = array(
    'ingles' => '#FFC107',
    'naturales' => '#007BFF',
    'lenguaje' => '#6C757D',
    'matematicas' => '#17A2B8',
    'sociales' => '#DC3545',
    'filosofia' => '#001F3F',
    'fisica' => '#6F42C1'
  );

  function ordenarMateriasDescendente($arrayMaterias)
  {
    foreach ($arrayMaterias as $materia => $resultados) {
      arsort($arrayMaterias[$materia]);
    }
    return $arrayMaterias;
  }

  $puntajes_maximos = array();
  $puntajes_materias = array();
  $info_preguntas = array();
  $promedio_materias = array();
  $preguntas_resultados = array();

  $puntajes_maximos2 = array();
  $puntajes_materias2 = array();
  $info_preguntas2 = array();
  $promedio_materias2 = array();
  $preguntas_resultados2 = array();

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

    if ($simul_alum_id == $alum_id) {
      $nombre_alum = $info_alum['alum_1er_nombre'] . ' ' . $info_alum['alum_1er_apellido'];

      $total_correctas;
      $total_incorrectas;
      $puntaje_global;
      $puntaje_max = 0;
      $crr_mats = array();
      $crr_mats2 = array();

      foreach ($arrMateria as $key => $value) {

        $simul_param = json_decode($info_simulacro[$value[1]], true);
        $simul_p1 = (int) $simul_param[$value[2]];
        $simul_p2 = (int) $simul_param[$value[3]];
        $correctas = 0;
        $incorrectas = 0;

        $si_ingles = json_decode($info_guia[$value[0]], true);

        if ($simul_param[$value[4] . '_status'] === 'SI') {
          $crr_mats[$key] = $value[4];
          $control = $simul_p1;

          for ($i = $simul_p1; $i <= $simul_p2; $i++) {
            $respuesta_profesor = $si_ingles["" . 'p-' . $control . ""];
            $respuesta_alumno = $respuestas_alum["" . 'p-' . $control . ""];

            if ($respuesta_profesor === $respuesta_alumno) {
              $correctas += 1;
              $total_correctas += 1;
              $info_preguntas[$value[4]]["" . 'p-' . $control . ""] += 1;
              $preguntas_resultados[$value[4]]["" . 'p-' . $control . ""]['buenas'] += 1;
            } else {
              $incorrectas += 1;
              $total_incorrectas += 1;
              //$info_preguntas[$value[4]]["" . 'p-' . $control . ""] -= 1;

              $preguntas_resultados[$value[4]]["" . 'p-' . $control . ""]['malas'] +=  1;
            }

            $control += 1;
          }

          $total_preguntas = $correctas + $incorrectas;
          $puntaje2 = $correctas * 100 / $total_preguntas;
          $puntaje = number_format($puntaje2, 2);
          $puntaje_global += $puntaje;
          $puntajes_materias[$alum_id][$value[4]] = $puntaje;
          $puntajes_materias[$alum_id]['nombre'] = $nombre_alum;
          $promedio_materias[$value[4]] += $puntaje;

          $puntaje_max += 100;
        }
      }

      $total_preguntas_final = $total_correctas + $total_incorrectas;
      $puntajes_maximos["" . $alum_id . ""] = $puntaje_global;
    } else {
    }
    $total_correctas = 0;
    $total_incorrectas = 0;
    $puntaje_global = 0;
  }

  while ($info_alum_1 = $info_alum_1->fetch_assoc()) {

    $icfes_anio = $info_alum['alum_anio_escolar'];

    $alum_id = $info_alum['alum_id'];
    $stmt = $conn->prepare("SELECT * FROM simulacros_e WHERE simule_simul_id=? AND simule_alum_id=?");
    $stmt->bind_param("ii", $simul_id, $alum_id);
    $stmt->execute();
    $info_simul2 = $stmt->get_result();
    $info_simul = $info_simul2->fetch_assoc();

    $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
    $simul_alum_id = $info_simul['simule_alum_id'];

    if ($simul_alum_id == $alum_id) {
      $nombre_alum = $info_alum['alum_1er_nombre'] . ' ' . $info_alum['alum_1er_apellido'];

      $total_correctas;
      $total_incorrectas;
      $puntaje_global;
      $puntaje_max = 0;
      $crr_mats = array();
      $crr_mats2 = array();

      foreach ($arrMateria as $key => $value) {

        $simul_param = json_decode($info_simulacro[$value[1]], true);
        $simul_p1 = (int) $simul_param[$value[2]];
        $simul_p2 = (int) $simul_param[$value[3]];
        $correctas = 0;
        $incorrectas = 0;

        $si_ingles = json_decode($info_guia[$value[0]], true);

        if ($simul_param[$value[4] . '_status'] === 'SI') {
          $crr_mats[$key] = $value[4];
          $control = $simul_p1;

          for ($i = $simul_p1; $i <= $simul_p2; $i++) {
            $respuesta_profesor = $si_ingles["" . 'p-' . $control . ""];
            $respuesta_alumno = $respuestas_alum["" . 'p-' . $control . ""];

            if ($respuesta_profesor === $respuesta_alumno) {
              $correctas += 1;
              $total_correctas += 1;
              $info_preguntas[$value[4]]["" . 'p-' . $control . ""] += 1;
              $preguntas_resultados[$value[4]]["" . 'p-' . $control . ""]['buenas'] += 1;
            } else {
              $incorrectas += 1;
              $total_incorrectas += 1;
              //$info_preguntas[$value[4]]["" . 'p-' . $control . ""] -= 1;

              $preguntas_resultados[$value[4]]["" . 'p-' . $control . ""]['malas'] +=  1;
            }

            $control += 1;
          }

          $total_preguntas = $correctas + $incorrectas;
          $puntaje2 = $correctas * 100 / $total_preguntas;
          $puntaje = number_format($puntaje2, 2);
          $puntaje_global += $puntaje;
          $puntajes_materias[$alum_id][$value[4]] = $puntaje;
          $puntajes_materias[$alum_id]['nombre'] = $nombre_alum;
          $promedio_materias[$value[4]] += $puntaje;

          $puntaje_max += 100;
        }
      }

      $total_preguntas_final = $total_correctas + $total_incorrectas;
      $puntajes_maximos["" . $alum_id . ""] = $puntaje_global;
    } else {
    }
    $total_correctas = 0;
    $total_incorrectas = 0;
    $puntaje_global = 0;
  }

  $podium_preguntas = ordenarMateriasDescendente($info_preguntas);
  $podium_preguntasJS = json_encode($podium_preguntas);
  $materias_max = count($promedio_materias) * 100;

  $keys = array_keys($puntajes_maximos);
  $values = array_values($puntajes_maximos);
  array_multisort($values, SORT_DESC, $keys, $values);
  $podium = array_combine($keys, $values);

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="fa-solid fa-chart-pie"></i>
              Análisis del Simulacro
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
            <h3 class="card-title">Estadísticas</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-default" onclick="desplegarTabla();"><i class="fa fa-expand"></i> Tabla</button>
              <button type="button" class="btn btn-default" id="btn-pdf"><i class="fa-solid fa-file-pdf"></i> Pdf</button>
              <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Volver</button>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body row">

            <div class="col-md-12">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h3 class="card-title">Promedio</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body row">

                  <?php

                  $global_final = 0;

                  foreach ($promedio_materias as $materia => $resultados) { ?>
                    <?php $promedio_rounded = round($resultados / count($puntajes_maximos), 2); ?>
                    <?php $global_final += $promedio_rounded ?>

                    <div class="col-md-2 text-center" style="margin-bottom: 30px;">
                      <div style="position: relative;">
                        <input type="text" class="knob" value="<?php echo $promedio_rounded ?>" data-width="120" data-height="120" data-fgColor="<?php echo $phpColors[$materia]; ?>" data-readonly="true">
                        <small style="position: absolute; left: 50%; transform: translateX(-50%); bottom: 27%"><?php echo '/' . 100; ?></small>
                      </div>
                      <div class="knob-label"><?php echo $materia ?></div>
                    </div>

                  <?php }

                  ?>

                  <div class="col-md-2 text-center" style="margin-bottom: 30px;">
                    <div style="position: relative;">
                      <input type="text" class="knob" value="<?php echo $global_final ?>" data-width="120" data-height="120" data-fgColor="#28A745" data-readonly="true">
                      <small style="position: absolute; left: 50%; transform: translateX(-50%); bottom: 27%"><?php echo '/' . $materias_max; ?></small>
                    </div>
                    <div class="knob-label">global</div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-md-12">
              <div class="card card-outline card-navy">
                <div class="card-header">
                  <h3 class="card-title">Percentil</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body row">

                  <?php

                  $colorPercentil = array(
                    50 => 'secondary',
                    60 => 'warning',
                    70 => 'success',
                    80 => 'primary',
                    90 => 'navy',
                  );

                  $puntajesIndexados = array_values($podium);
                  sort($puntajesIndexados);

                  // Calcular y mostrar los percentiles deseados
                  $percentiles = [50, 60, 70, 80, 90];
                  foreach ($percentiles as $percentil) {
                    $n = count($puntajesIndexados);
                    // Calcular el índice para el percentil actual
                    $indice = round(($percentil / 100) * ($n - 1));

                    // Asegurarse de que el índice está dentro del rango válido
                    if ($indice < 0) $indice = 0;
                    if ($indice >= $n) $indice = $n - 1;

                    // Obtener el puntaje en el índice calculado
                    $percentilPuntaje = $puntajesIndexados[$indice];

                    // Contar cuántos puntajes están por encima del puntaje del percentil
                    $countAbove = count(array_filter($puntajesIndexados, function ($puntaje) use ($percentilPuntaje) {
                      return $puntaje >= $percentilPuntaje;
                    })); ?>

                    <div class="col-lg-3 col-6">
                      <div class="small-box <?php echo 'bg-' . $colorPercentil[$percentil]; ?>">
                        <div class="inner">
                          <h3><?php echo $percentil ?> <small style="font-size: 1rem;"><?php echo '/ ' . $percentilPuntaje ?></small></h3>
                          <p><?php echo $countAbove . ' Estudiante por encima' ?></p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>

                  <?php  }
                  ?>

                </div>

              </div>
            </div>

            <div class="col-md-12">
              <div class="card card-outline card-warning">
                <div class="card-header">
                  <h3 class="card-title">Resultado por pregunta</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">

                  <table id="icfes-revision" class="table table-bordered table-striped">

                    <thead>
                      <tr>
                        <th>Materia</th>
                        <th>Pregunta</th>
                        <th>Correctas</th>
                        <th>Incorrectas</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php



                      ?>

                      <?php foreach ($preguntas_resultados as $key => $value) { ?>
                        <?php foreach ($value as $pregunta => $datos) { ?>

                          <tr>
                            <th><?php echo $key ?> </th>
                            <th><?php echo str_replace("p-", "", $pregunta); ?></th>
                            <th><?php echo $datos['buenas']; ?> </th>
                            <th><?php echo $datos['malas']; ?> </th>
                          </tr>

                        <?php } ?>
                      <?php } ?>

                    </tbody>

                  </table>

                </div>

              </div>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Volver</button>
          </div>

        </div>
        <!-- /.card -->

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

  function volverListaAsig(grado) {
    window.location.href = 'preifces-lista.php?grado=' + grado;
  }
</script>

<script>
  $(function() {
    $('.knob').knob();
  })
</script>