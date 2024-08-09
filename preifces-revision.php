<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $cgrado = $_GET['grado'];
  $simul_id = $_GET['id'];
  if (!filter_var($cgrado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  date_default_timezone_set('America/Bogota');
  try {
    $stmt = $conn->prepare("SELECT * FROM grados WHERE gdo_id=?");
    $stmt->bind_param("s", $cgrado);
    $stmt->execute();
    $resultado2 = $stmt->get_result();
    $gcode2 = $resultado2->fetch_assoc();
    $gcode = $gcode2['gdo_des_grado'];
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
    $stmt->bind_param("i", $simul_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $info_simul = $resultado->fetch_assoc();
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
              Revisión de Simulacro
            </h1>
            <h6>Grado: <code><?php echo $gcode ?></code> Prueba: #<code><?php echo $info_simul['simul_orden']; ?></code></h6>
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
        <form role="form" name="guardar-simul" id="guardar-simul" method="post" action="preifces-modelo.php" enctype="multipart/form-data">

          <div id="accordion">
            <div class="card card-light">
              <div class="card-header">
                <h4 class="card-title w-100 text-center">
                  <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                    <i class="fas fa-eye"></i> Visualizar Guia
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <iframe src="ViewerJS/#../<?php echo $info_simul['simul_ruta'] ?>" width=' 100% ' height=' 600px ' allowfullscreen webkitallowfullscreen></iframe></iframe>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Respuestas asignadas</span></strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="icfes-revision" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>Materia</th>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                    <th>Tema</th>
                    <th>Componente</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $stmt = $conn->prepare("SELECT * FROM simulacros_r WHERE simulr_simul_id=?");
                  $stmt->bind_param("i", $simul_id);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  $revisiones = $res->fetch_assoc();

                  foreach ($arrMateria as $key => $value) {
                    $simul_param = json_decode($info_simul[$value[1]], true);

/*                     echo '<pre>';
                      print_r($simul_param);
                    echo '</pre>'; */

                    if ($simul_param[$value[4] . '_status'] === 'SI') {
                      $arr_revisiones = json_decode($revisiones[$value[0]], true);

                      $simul_p1 = (int) $simul_param[$value[2]];
                      $simul_p2 = (int) $simul_param[$value[3]];
                      $control = $simul_p1;


                      for ($i = $simul_p1; $i <= $simul_p2; $i++) { ?>
                        <tr>
                          <th><?php echo $key ?> </th>
                          <th><?php echo $control ?></th>
                          <th><?php echo $arr_revisiones["" . 'p-' . $control . ""]; ?> </th>
                          <th><?php echo $arr_revisiones["" . 'pt-' . $control . ""]; ?> </th>
                          <th><?php echo $arr_revisiones["" . 'pc-' . $control . ""]; ?> </th>
                        </tr>
                  <?php $control += 1;
                      }
                    } 
                  }



                  ?>
                </tbody>
              </table>

            </div> <!-- /.card-body -->
          </div>


          <div class="card-footer">
            <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $cgrado; ?>');">Volver</button>
          </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
  include_once 'templates/footer.php';
endif;
?>
<script>
  function volverListaAsig(grado) {
    window.location.href = 'preifces-lista.php?grado=' + grado;
  }
</script>