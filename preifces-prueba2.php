<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 3) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  //$code = $_GET['code'];
  $simul_mat = $_GET['simul_mat'];
  $id_simul = $_GET['id_simul'];

  if (!filter_var($id_simul, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
    $stmt->bind_param("i", $id_simul);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $info_guia = $resultado->fetch_assoc();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros_r WHERE simulr_simul_id=?");
    $stmt->bind_param("i", $id_simul);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $info_guia2 = $resultado->fetch_assoc();
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT mat_rev_simul FROM materias WHERE mat_des_materia=?");
    $stmt->bind_param("s", $simul_mat);
    $stmt->execute();
    $result_mat2 = $stmt->get_result();
    $result_mat = $result_mat2->fetch_assoc();
    $result_mat_desc = $result_mat['mat_rev_simul'];
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
              <i class="fa fa-pen-alt"></i>
              Revisión
            </h1>
            <h6>Grado: <?php echo $info_guia['simul_grado'] . ' '; ?><code>Simulacro #<?php echo $info_guia['simul_orden']; ?> </code></h6>
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
        <div class="card card-info">
          <div class="card-header">
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" onclick="desplegar2();">
                <i class="fas fa-edit"></i> Anotar </button>
            </div>
          </div>
          <div class="card-body p-0" style="display: block;">
            <iframe src="ViewerJS/#../<?php echo $info_guia['simul_ruta'] ?>" width=' 100% ' height=' 600px ' allowfullscreen webkitallowfullscreen></iframe></iframe>
          </div>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-notasp">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <small>
              Hoja de revisión
            </small>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" name="respuestas_simulacro2" id="respuestas_simulacro2" method="post" action="preifces-modelo.php">
          <div class="modal-body">
            <div class="card-body">
              <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
              <div id="accordion">
                <?php

                $simul_rev_array = array(
                  'simul_materia_ingles' => array('ingles', 'card-warning'),
                  'simul_materia_naturales' => array('naturales', 'card-primary'),
                  'simul_materia_lenguaje' => array('lenguaje', 'card-secondary'),
                  'simul_materia_matematicas' => array('matematicas', 'card-info'),
                  'simul_materia_sociales' => array('sociales', 'card-danger'),
                  'simul_materia_filosofia' => array('filosofia', 'card-navy'),
                  'simul_materia_fisica' => array('fisica', 'card-success'),
                );

                $mat_etiqueta = $simul_rev_array[$result_mat_desc][1];
                $mat_p1 = $simul_rev_array[$result_mat_desc][0] . '_p1';
                $mat_p2 = $simul_rev_array[$result_mat_desc][0] . '_p2';
                $result_mat_desc2 = 'simulr_' . $simul_rev_array[$result_mat_desc][0];

                $mat_actual = json_decode($info_guia["" . $result_mat_desc . ""], true);
                $mat_actual2 = json_decode($info_guia2["" . $result_mat_desc2 . ""], true);
                $total_preguntas;
                $mat_actual_p1 = $mat_actual["" . $mat_p1 . ""];
                $mat_actual_p2 = $mat_actual["" . $mat_p2 . ""];

                ?>

                <div class="card <?php echo $mat_etiqueta ?>">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                        <span><i class="fas fa-pencil-alt"></i><?php echo $simul_mat; ?><strong id="nro_entregas"></strong></span>
                      </a>
                    </h4>
                  </div>
                  <div id="collapse1" class="collapse" data-parent="#accordion">
                    <div class="card-body" id="#respuestas-ingles">

                      <?php
                      $suma_mat = $mat_actual_p1;
                      for ($i = $mat_actual_p1; $i <= $mat_actual_p2; $i++) {

                        $respuestar = $mat_actual2["" . 'p-' . $suma_mat . ""];
                        $respuestat = $mat_actual2["" . 'pt-' . $suma_mat . ""];
                        $respuestac = $mat_actual2["" . 'pc-' . $suma_mat . ""];

                      ?>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $suma_mat ?></span>
                              </div>
                              <select class="form-control bloquear" name="p-<?php echo $suma_mat ?>" id="p-<?php echo $suma_mat ?>">
                                <option value=" " class="seleccionados"></option>
                                <option value="A" class="seleccionados">A</option>
                                <option value="B" class="seleccionados">B</option>
                                <option value="C" class="seleccionados">C</option>
                                <option value="D" class="seleccionados">D</option>
                                <?php if ($simul_mat === 'INGLÉS') { ?>
                                  <option value="E" class="seleccionados">E</option>
                                  <option value="F" class="seleccionados">F</option>
                                  <option value="G" class="seleccionados">G</option>
                                  <option value="H" class="seleccionados">H</option>
                                <?php } ?>
                              </select>
                              <div class="invalid-feedback">
                                Este campo es obligatorio.
                              </div>
                            </div>
                          </div>
                        </div> <!-- col -->
                        <script>
                          function buscarSelect() {
                            // creamos un variable que hace referencia al select
                            var select = document.getElementById('p-<?php echo $suma_mat ?>');

                            // obtenemos el valor a buscar
                            var buscar = '<?php echo $respuestar ?>';

                            // recorremos todos los valores del select
                            for (var i = 1; i < select.length; i++) {
                              if (select.options[i].text == buscar) {
                                // seleccionamos el valor que coincide
                                select.selectedIndex = i;
                              }
                            }
                          }
                          buscarSelect();
                        </script>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $suma_mat ?></span>
                              </div>
                              <input type="text" class="form-control direccion" name="pt-<?php echo $suma_mat ?>" id="pt-<?php echo $suma_mat ?>" placeholder="Tema: P-<?php echo $suma_mat ?>" autocomplete="off" value="<?php echo $respuestat ?>">
                              <div class="invalid-feedback">
                                Este campo es obligatorio.
                              </div>
                            </div>
                          </div>
                        </div> <!-- col -->

                        <div class="col-sm-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $suma_mat ?></span>
                              </div>
                              <input type="text" class="form-control direccion" name="pc-<?php echo $suma_mat ?>" id="pc-<?php echo $suma_mat ?>" placeholder="Componente: P-<?php echo $suma_mat ?>" autocomplete="off" value="<?php echo $respuestac ?>">
                              <div class="invalid-feedback">
                                Este campo es obligatorio.
                              </div>
                            </div>
                          </div>
                        </div> <!-- col -->
                        <button type="submit" class="btn btn-block btn-info btn-xs">Guardar</button>
                        <hr>

                      <?php
                        $suma_mat += 1;
                        $total_preguntas += 1;
                      }
                      ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" id="cerrar_modal_nota" data-dismiss="modal">Cerrar</button>

            <input type="hidden" name="simul-comando" value="respuestas2">
            <input type="hidden" name="evaluacion" id="evaluacion" value="<?php echo $id_simul ?>">
            <input type="hidden" name="evaluaciontp" id="evaluaciontp" value="<?php echo $total_preguntas ?>">
            <input type="hidden" name="simul_p1" id="simul_p1" value="<?php echo $mat_actual_p1 ?>">
            <input type="hidden" name="simul_p2" id="simul_p2" value="<?php echo $mat_actual_p2 ?>">
            <input type="hidden" name="result_mat_desc" id="result_mat_desc" value="<?php echo $result_mat_desc ?>">
            <button type="submit" class="btn btn-info">Guardar Todo</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php
  include_once 'templates/footer.php';
endif;
?>
<script>
  function volverListaAsig2(dato1, dato2, dato3) {
    window.location.href = 'av-asignaciones-lista-2.php?grado=' + dato2 + '&materia=' + dato1 + '&code=' + dato3;
  }
</script>
<script>
  function desplegar2( /*p1, p2, p3, p4, p5, p6*/ ) {
    $("#modal-notasp").modal("show");
  }
  $('#cerrar_modal_nota').on('click', function(e) {
    //console.log('cerrar mdodal');
    $('.seleccionados').attr('selected', false);
  })
</script>