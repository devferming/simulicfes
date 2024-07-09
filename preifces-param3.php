<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 3):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  //$code = $_GET['code'];
  $id = $_GET['id'];
  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  try {
    $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $info_guia = $resultado->fetch_assoc();
  } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
  }
  try {
    $orden1 = $info_guia['simul_pregunta1'];
    $orden2 = $info_guia['simul_pregunta2'];
    $suma = 0;
      for ($i = $orden1; $i <= $orden2; $i++) {
          $suma += 1;
      }
  } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT gdo_cod_grado FROM grados WHERE gdo_des_grado=?");
    $stmt->bind_param("s", $info_guia['simul_grado']);
    $stmt->execute();
    $resultado2 = $stmt->get_result();
    $gcode2 = $resultado2->fetch_assoc();
    $gcode = $gcode2['gdo_cod_grado'];
  } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
  } 
  $id_login = $_SESSION['id'];
  $materia_r = $_SESSION['users_mat'];
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="fa fa-user-clock"></i>
              Parametros del Simulacro
            </h1>
            <h6>Grado: <?php echo $info_guia['simul_grado'].' '; ?><code>Simulacro #<?php echo $info_guia['simul_orden']; ?> </code></h6>           
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
              <h3 class="card-title"><i class="fa fa-user"></i> Simulacro #<?php echo $info_guia['simul_orden'] ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                
                $si_ingles = json_decode($info_guia['simul_materia_ingles'], true);
                $si_naturales = json_decode($info_guia['simul_materia_naturales'], true);
                $si_lenguaje = json_decode($info_guia['simul_materia_lenguaje'], true);
                $si_matematicas = json_decode($info_guia['simul_materia_matematicas'], true);
                $si_sociales = json_decode($info_guia['simul_materia_sociales'], true);
                $si_filosofia = json_decode($info_guia['simul_materia_filosofia'], true);
                $si_fisica = json_decode($info_guia['simul_materia_fisica'], true);
                if ($si_ingles['ingles_status'] == 'SI') {
                  $si_ingles2 = '<span class="badge badge-warning">Inglés</span> ';
                  $ingles_p1 = $si_ingles['ingles_p1'];
                  $ingles_p2 = $si_ingles['ingles_p2'];
                  $suma_ingles = 0;
                    for ($i = $ingles_p1; $i <= $ingles_p2; $i++) {
                        $suma_ingles += 1;
                    }
                  $si_ingles3 = '<span class="badge badge-warning">Inglés desde: '.$ingles_p1.' '.'hasta: '.$ingles_p2.'</span>';
                }
                if ($si_naturales['naturales_status'] == 'SI') {
                  $si_naturales2 = '<span class="badge badge-primary">Naturales</span> ';
                  $naturales_p1 = $si_naturales['naturales_p1'];
                  $naturales_p2 = $si_naturales['naturales_p2'];
                  $suma_naturales = 0;
                    for ($i = $naturales_p1; $i <= $naturales_p2; $i++) {
                        $suma_naturales += 1;
                    }
                  $si_naturales3 = ' <span class="badge badge-primary">Naturales desde: '.$naturales_p1.' '.'hasta: '.$naturales_p2.'</span>';
                }
                if ($si_lenguaje['lenguaje_status'] == 'SI') {
                  $si_lenguaje2 = '<span class="badge badge-secondary">Lenguaje</span> ';
                  $lenguaje_p1 = $si_lenguaje['lenguaje_p1'];
                  $lenguaje_p2 = $si_lenguaje['lenguaje_p2'];
                  $suma_lenguaje = 0;
                    for ($i = $lenguaje_p1; $i <= $lenguaje_p2; $i++) {
                        $suma_lenguaje += 1;
                    }
                  $si_lenguaje3 = ' <span class="badge badge-secondary">Lenguaje desde: '.$lenguaje_p1.' '.'hasta: '.$lenguaje_p2.'</span>';
                }
                if ($si_matematicas['matematicas_status'] == 'SI') {
                  $si_matematicas2 = '<span class="badge badge-info">Matemáticas</span> ';
                  $matematicas_p1 = $si_matematicas['matematicas_p1'];
                  $matematicas_p2 = $si_matematicas['matematicas_p2'];
                  $suma_matematicas = 0;
                    for ($i = $matematicas_p1; $i <= $matematicas_p2; $i++) {
                        $suma_matematicas += 1;
                    }
                  $si_matematicas3 = ' <span class="badge badge-info">Matematicas desde: '.$matematicas_p1.' '.'hasta: '.$matematicas_p2.'</span>';
                }
                if ($si_sociales['sociales_status'] == 'SI') {
                  $si_sociales2 = '<span class="badge badge-danger">Sociales</span> ';
                  $sociales_p1 = $si_sociales['sociales_p1'];
                  $sociales_p2 = $si_sociales['sociales_p2'];
                  $suma_sociales = 0;
                    for ($i = $sociales_p1; $i <= $sociales_p2; $i++) {
                        $suma_sociales += 1;
                    }
                  $si_sociales3 = ' <span class="badge badge-danger">Sociales desde: '.$sociales_p1.' '.'hasta: '.$sociales_p2.'</span>';
                }
                if ($si_filosofia['filosofia_status'] == 'SI') {
                  $si_filosofia2 = '<span class="badge badge-dark">Filosofía</span> ';
                  $filosofia_p1 = $si_filosofia['filosofia_p1'];
                  $filosofia_p2 = $si_filosofia['filosofia_p2'];
                  $suma_filosofia = 0;
                    for ($i = $filosofia_p1; $i <= $filosofia_p2; $i++) {
                        $suma_filosofia += 1;
                    }
                  $si_filosofia3 = ' <span class="badge badge-dark">Filosofía desde: '.$filosofia_p1.' '.'hasta: '.$filosofia_p2.'</span>';
                }
                if ($si_fisica['fisica_status'] == 'SI') {
                  $si_fisica2 = '<span class="badge badge-success">Fisica</span> ';
                  $fisica_p1 = $si_fisica['fisica_p1'];
                  $fisica_p2 = $si_fisica['fisica_p2'];
                  $suma_fisica = 0;
                    for ($i = $fisica_p1; $i <= $fisica_p2; $i++) {
                        $suma_fisica += 1;
                    }
                  $si_fisica3 = ' <span class="badge badge-success">Física desde: '.$fisica_p1.' '.'hasta: '.$fisica_p2.'</span>';
                }
                $total_preguntas = $suma_ingles + $suma_naturales + $suma_lenguaje + $suma_matematicas + $suma_sociales + $suma_filosofia + $suma_fisica;
                
                
                
                ?>
                <div class="form-group">
                  <label>Materias</label>
                    <p><?php echo $si_ingles2.$si_naturales2.$si_lenguaje2.$si_matematicas2.$si_sociales2.$si_filosofia2.$si_fisica2 ?></p>
                </div>
                <div class="form-group">
                  <label>Instrucciones u Observaciones</label>
                  <textarea class="form-control" rows="5" readonly="true"> <?php echo $info_guia['simul_inst'] ?> </textarea>
                </div>
                <?php
                $nac_fec1 = $info_guia['simul_fecha'];
                $nac_fec = DateTime::createFromFormat('Y-m-d', $nac_fec1)->format('d-m-Y'); 
                ?>
                <div class="form-group">
                  <label>Fecha de realización</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                    </div>
                    <p class="form-control mayusculas" readonly="true"><?php echo $nac_fec ?></p>
                  </div>
                </div>
                <div class="form-group">
                  <label>Cantidad de preguntas (<?php echo $total_preguntas ?>) </label>
                    <p><?php echo $si_ingles3.$si_naturales3.$si_lenguaje3.$si_matematicas3.$si_sociales3.$si_filosofia3.$si_fisica3 ?></p>
                </div>
                <div class="form-group">
                  <label>Tiempo Máximo</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                    </div>
                    <p class="form-control mayusculas" readonly="true"><?php echo $info_guia['simul_tiempo'].' Minutos' ?></p>
                  </div>
                </div>
            </div>
            <?php
              $stmt = $conn->prepare("SELECT simule_status FROM simulacros_e WHERE simule_simul_id=? AND simule_alum_id=?");
              $stmt->bind_param("ii", $id, $alum_idx2);
              $stmt->execute();
              $revision = $stmt->get_result();
              $revision2 = $revision->fetch_assoc();
              $status_rev = $revision2['simule_status'];
            ?>
            <div class="card-footer">
                <?php 
                
                  if (isset($status_rev)) { 
                      if ($status_rev != 2) { ?>
                        <a class="btn btn-success" href="preifces-prueba2.php?simul_mat=<?php echo $materia_r ?>&id_simul=<?php echo $info_guia['simul_id'] ?>" disabled>Terminar Revisión</a>
                      
                      <?php
                      } 
                      ?>
                  
                  <?php
                  } else { ?>
                    <a class="btn btn-success" href="preifces-prueba2.php?simul_mat=<?php echo $materia_r ?>&id_simul=<?php echo $info_guia['simul_id'] ?>" disabled>Revisar Prueba</a>
                    
                  <?php
                  }
                  ?>
                <a class="btn btn-warning" href="preifces-lista3.php?grado=<?php echo $gcode ?>">Volver</a>
              </div>
            </div>
          <br>
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
  
    function pruebaRealizada() {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong!',
      footer: '<a href>Why do I have this issue?</a>'
    })
      
    }
  
  </script>