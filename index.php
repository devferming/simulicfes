<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3 || $_SESSION['nivel'] == 4) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';


  function ordenarMateriasDescendente($arrayMaterias)
  {
    foreach ($arrayMaterias as $materia => $resultados) {
      arsort($arrayMaterias[$materia]);
    }
    return $arrayMaterias;
  }

  $gran_array = array();
  $podium_general = array();

  ///////// /* ESTABLECE SI EL INFORME ES GENERAL O POR MATERIA (GENERAL PARA COORD. Y POR MATERIA PARA DOCENTES) /////////

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

  $car_tittle1 = '';

  if (isset($materias[$crr_mat])) {
    $arrMateria = array(
      $materias[$crr_mat][0] => array_slice($materias[$crr_mat], 1)
    );
    $car_tittle1 = $crr_mat;
  } else {
    $arrMateria = array_map(function ($materia) {
      return array_slice($materia, 1);
    }, $materias);
    $car_tittle1 = 'General';
  }
  ///////// ESTABLECE SI EL INFORME ES GENERAL O POR MATERIA (GENERAL PARA COORD. Y POR MATERIA PARA DOCENTES) */ /////////


  ///////// /* RECOPILACION DE DATOS ESTUDIANTES /////////
  $data_studiantes = array();

  try {
    $stmt = $conn->prepare("SELECT * FROM alumnos");
    $stmt->execute();
    $info_alum2 = $stmt->get_result();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

  while ($info_alum = $info_alum2->fetch_assoc()) {
    $data_studiantes[$info_alum['alum_id']] = $info_alum;
  }
  ///////// RECOPILACION DE DATOS ESTUDIANTES */ /////////


  ///////// /* WHILE PRINCIPAL /////////
  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros");
    $stmt->execute();
    $resultado_simulacro = $stmt->get_result();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

  while ($info_simulacro = $resultado_simulacro->fetch_assoc()) {
    $crr_simid = $info_simulacro['simul_id'];
    $crr_grado = $info_simulacro['simul_grado'];

    
    ///////// /* RECOPILACION RESPUESTAS DE LOS ESTUDIANTES /////////
    try {
      $stmt = $conn->prepare("SELECT * FROM simulacros");
      $stmt->execute();
      $max_simul_grado1 = $stmt->get_result();
      $max_simul_grado = 0;
      while ($max_simul_grado2 = $max_simul_grado1->fetch_assoc()) {
        $max_simul_grado2['simul_grado'] === $crr_grado ? $max_simul_grado++ : '';
      }      
      
    } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }
    ///////// /* RECOPILACION RESPUESTAS DE LOS ESTUDIANTES /////////


    ///////// /* RECOPILACION RESPUESTAS DE LOS ESTUDIANTES /////////
    $data_simulacrose = array();

    $stmt = $conn->prepare("SELECT * FROM simulacros_e WHERE simule_simul_id=?");
    $stmt->bind_param("i", $crr_simid);
    $stmt->execute();
    $info_simul2 = $stmt->get_result();

    while ($crr_info_simul = $info_simul2->fetch_assoc()) {
      $data_simulacrose[$crr_info_simul['simule_alum_id']] = $crr_info_simul['simule_respuestas'];
    }

    ///////// RECOPILACION RESPUESTAS DE LOS ESTUDIANTES */ /////////


    ///////// /* RECOPILACION DE REVISIONES DE SIMULACROS /////////
    $data_simulacrosr = array();

    try {
      $stmt = $conn->prepare("SELECT * FROM simulacros_r WHERE simulr_simul_id=?");
      $stmt->bind_param("i", $crr_simid);
      $stmt->execute();
      $resultado = $stmt->get_result();
    } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    while ($info_guia = $resultado->fetch_assoc()) {
      $data_simulacrosr[$crr_simid] = $info_guia;
    }

    ///////// RECOPILACION DE REVISIONES DE SIMULACROS */ /////////

    ///////// INICIA LA ESTADISTICA POR SIMULACRO /////////

    $puntajes_maximos = array();
    $puntajes_materias = array();
    $info_preguntas = array();
    $promedio_materias = array();
    $preguntas_resultados = array();

    foreach ($data_simulacrose as $ide_alum => $res_alum) {

      $nombre_estudiante = $data_studiantes[$ide_alum]['alum_1er_apellido'] . ' ' . $data_studiantes[$ide_alum]['alum_1er_nombre'];
      $grado_estudiante = $data_studiantes[$ide_alum]['alum_grado'];
      $respuestas_alum = json_decode($res_alum, true);

      if ($respuestas_alum) {

        $total_correctas = 0;
        $total_incorrectas = 0;
        $puntaje_global = 0;
        $puntaje_max = 0;
        $crr_mats = array();
        $crr_mats2 = array();

        foreach ($arrMateria as $key => $value) {

          $simul_param = json_decode($info_simulacro[$value[1]], true);
          $simul_p1 = (int) $simul_param[$value[2]];
          $simul_p2 = (int) $simul_param[$value[3]];
          $correctas = 0;
          $incorrectas = 0;

          $si_ingles = json_decode($data_simulacrosr[$crr_simid][$value[0]], true);

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
                $preguntas_resultados[$value[4]]["" . 'p-' . $control . ""]['malas'] +=  1;
              }

              if (!isset($info_preguntas[$value[4]]["" . 'p-' . $control . ""])) {
                $info_preguntas[$value[4]]["" . 'p-' . $control . ""] = 0;
              }
              $control += 1;
            }

            $total_preguntas = $correctas + $incorrectas;
            $puntaje2 = $correctas * 100 / $total_preguntas;
            $puntaje = number_format($puntaje2, 2);

            $puntaje_global += $puntaje;
            $puntajes_materias[$ide_alum][$value[4]] = $puntaje;
            $puntajes_materias[$ide_alum]['nombre'] = $nombre_alum;
            $promedio_materias[$value[4]] += $puntaje;

            $gran_array[$crr_grado]['promedio_materias'][$value[4]]['puntaje'] += $puntaje;
            $puntaje_max += 100;
          }
        }

        $total_preguntas_final = $total_correctas + $total_incorrectas;
        $puntajes_maximos[$ide_alum] = ($puntaje_global / $max_simul_grado);
      } 

    }

    $podium_preguntas = ordenarMateriasDescendente($info_preguntas);
    $podium_preguntasJS = json_encode($podium_preguntas);
    $materias_max = count($promedio_materias) * 100;

    $keys = array_keys($puntajes_maximos);
    $values = array_values($puntajes_maximos);
    array_multisort($values, SORT_DESC, $keys, $values);
    $podium = array_combine($keys, $values);

    $gran_array[$crr_grado][$crr_simid]['podium_preguntas'] = $podium_preguntas;
    $gran_array[$crr_grado][$crr_simid]['podium_preguntasJS'] = $podium_preguntasJS;
    $gran_array[$crr_grado][$crr_simid]['podium'] = $podium;

    $data_simulacrose = array();
    $data_simulacrosr = array();
  }
  ///////// WHILE PRINCIPAL */ /////////

  foreach ($gran_array as $grado => $grado_dat) {

    $simul_por_grado = count($gran_array[$grado]);

    foreach ($grado_dat as $simul_id => $simul_dat) {
      foreach ($simul_dat['podium'] as $estudiante_id => $estudiante_puntaje) {
        $puntaje_insert = $estudiante_puntaje; // $simul_por_grado;
        $podium_general[$grado][$estudiante_id] += $puntaje_insert;
        $podium_general['GENERAL'][$estudiante_id] += $puntaje_insert;
      }
    }
  }



?>

  <script>
  </script>
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

      <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h3 class="card-title"><?php echo 'Mejores puntajes - ' . $car_tittle1 ?></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>

          <div class="card-body row">


            <?php $general_tres = array(); ?>
            <?php $general_trres = array(); ?>
            <?php $init_g3 = 1; ?>
            <?php $init_gr = 6; ?>

            

            <?php foreach ($podium_general as $grado => $listado) { ?>

              <?php
              $list_keys = array_keys($listado);
              $list_values = array_values($listado);
              array_multisort($list_values, SORT_DESC, $list_keys, $list_values);
              $list_sort = array_combine($list_keys, $list_values);

              $top_tres = array_slice($list_sort, 0, 5, true);
              $top_rest = array_slice($list_sort, 5, null, true);

              if ($grado === 'GENERAL') {
                $general_tres = $top_tres;
                $general_trres = $top_rest;
              }

              ?>

              <?php if ($grado != 'GENERAL') : ?>

                <div class="col-md-3">

                  <div class="card card-widget widget-user-2 shadow-sm" style="margin-bottom: 0">

                    <div class="widget-user-header bg-secondary">
                      <h2 class="widget-user-desc" style="margin:0; font-size:0.9rem"><?php echo $grado ?> </h2>
                    </div>
                    <div class="card-footer p-0">
                      <ul class="nav flex-column">

                        <?php $init_t3 = 1; ?>
                        <?php $init_tr = 6; ?>

                        <?php foreach ($top_tres as $crr_id => $puntos) { ?>
                          <?php $crr_name = $data_studiantes[$crr_id]['alum_1er_apellido'] . ' ' . $data_studiantes[$crr_id]['alum_1er_nombre'] ?>
                          <li class="nav-item">
                            <p style="padding: 0.5em;">
                              <span class="float-left"><?php echo $init_t3 . '. ' . $crr_name; ?></span>
                              <span class="float-right"><?php echo number_format($puntos, 2) ?></span>
                            </p>
                          </li>
                        <?php $init_t3++;
                        } ?>

                        <li class="nav-item">
                          <div class="card card-success collapsed-card" style="box-shadow: none">
                            <div class="card-header"
                              style="
                                border-radius: 0;
                                background: #F7F7F7;
                                color:black;
                                height: 2.5em;
                                display: flex;
                                padding: 0.5em;
                                justify-content: flex-end;
                              ">
                              <span>Mostrar mas...</span>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" style="color:black">
                                <i class="fas fa-plus"></i>
                              </button>
                            </div>

                            <div class="card-body" style="display: none; padding: 0.5em;">
                              <?php foreach ($top_rest as $crr_id => $puntos) { ?>
                                <?php $crr_name = $data_studiantes[$crr_id]['alum_1er_apellido'] . ' ' . $data_studiantes[$crr_id]['alum_1er_nombre'] ?>

                                <p style="padding: 0; margin: 0; display: flex; justify-content: space-between;">
                                  <span><?php echo $init_tr . '. ' . $crr_name; ?></span>
                                  <span><?php echo number_format($puntos, 2) ?></span>
                                </p>
                              <?php $init_tr++;
                              } ?>
                            </div>

                          </div>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>

              <?php endif ?>

            <?php } ?>

            <div class="col-md-3">

              <div class="card card-widget widget-user-2 shadow-sm">

                <div class="widget-user-header bg-navy">
                  <h2 class="widget-user-desc" style="margin:0; font-size:0.9rem">GENERAL</h2>
                </div>
                <div class="card-footer p-0">
                  <ul class="nav flex-column">

                    <?php foreach ($general_tres as $crr_id => $puntos) { ?>
                      <?php $crr_name = $data_studiantes[$crr_id]['alum_1er_apellido'] . ' ' . $data_studiantes[$crr_id]['alum_1er_nombre'] ?>
                      <li class="nav-item">
                        <p style="padding: 0.5em;">
                          <span class="float-left">
                            <?php echo $init_g3 . '. ' . $crr_name; ?>
                            <small><?php echo '- ' . $data_studiantes[$crr_id]['alum_grado'] ?></small>
                          </span>
                          <span class="float-right"><?php echo number_format($puntos, 2) ?></span>
                        </p>
                      </li>
                    <?php $init_g3++;
                    } ?>

                    <li class="nav-item">
                      <div class="card card-success collapsed-card" style="box-shadow: none">
                        <div class="card-header"
                          style="
                                border-radius: 0;
                                background: #F7F7F7;
                                color:black;
                                height: 2.5em;
                                display: flex;
                                padding: 0.5em;
                                justify-content: flex-end;
                              ">
                          <span>Mostrar mas...</span>
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" style="color:black">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>

                        <div class="card-body" style="display: none; padding: 0.5em;">
                          <?php foreach ($general_trres as $crr_id => $puntos) { ?>
                            <?php $crr_name = $data_studiantes[$crr_id]['alum_1er_apellido'] . ' ' . $data_studiantes[$crr_id]['alum_1er_nombre'] ?>

                            <p style="padding: 0; margin: 0; display: flex; justify-content: space-between;">
                              <span>
                                <?php echo $init_gr . '. ' . $crr_name; ?>
                                <small><?php echo '- ' . $data_studiantes[$crr_id]['alum_grado'] ?></small>
                              </span>
                              <span><?php echo number_format($puntos, 2) ?></span>
                            </p>
                          <?php $init_gr++;
                          } ?>
                        </div>

                      </div>
                    </li>

                  </ul>
                </div>
              </div>

            </div>

          </div>

        </div>
      </div>

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