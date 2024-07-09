<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $grado = $_GET['grado'];
  $simul_id = $_GET['id'];
  if (!filter_var($grado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  date_default_timezone_set('America/Bogota');
  try {
    $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_cod_grado=?");
    $stmt->bind_param("s", $grado);
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
  $ingles_info = json_decode($info_simul['simul_materia_ingles'], true);
  $ingles_status = $ingles_info['ingles_status'];
  $ingles_p1 = $ingles_info['ingles_p1'];
  $ingles_p2 = $ingles_info['ingles_p2'];
  $ingles_dato = 'ingles';
  $naturales_info = json_decode($info_simul['simul_materia_naturales'], true);
  $naturales_status = $naturales_info['naturales_status'];
  $naturales_p1 = $naturales_info['naturales_p1'];
  $naturales_p2 = $naturales_info['naturales_p2'];
  $naturales_dato = 'naturales';
  
  $lenguaje_info = json_decode($info_simul['simul_materia_lenguaje'], true);
  $lenguaje_status = $lenguaje_info['lenguaje_status'];
  $lenguaje_p1 = $lenguaje_info['lenguaje_p1'];
  $lenguaje_p2 = $lenguaje_info['lenguaje_p2'];
  $lenguaje_dato = 'lenguaje';
  $matematicas_info = json_decode($info_simul['simul_materia_matematicas'], true);
  $matematicas_status = $matematicas_info['matematicas_status'];
  $matematicas_p1 = $matematicas_info['matematicas_p1'];
  $matematicas_p2 = $matematicas_info['matematicas_p2'];
  $matematicas_dato = 'matematicas';
  $sociales_info = json_decode($info_simul['simul_materia_sociales'], true);
  $sociales_status = $sociales_info['sociales_status'];
  $sociales_p1 = $sociales_info['sociales_p1'];
  $sociales_p2 = $sociales_info['sociales_p2'];
  $sociales_dato = 'sociales';
  
  $filosofia_info = json_decode($info_simul['simul_materia_filosofia'], true);
  $filosofia_status = $filosofia_info['filosofia_status'];
  $filosofia_p1 = $filosofia_info['filosofia_p1'];
  $filosofia_p2 = $filosofia_info['filosofia_p2'];
  $filosofia_dato = 'filosofia';
  $fisica_info = json_decode($info_simul['simul_materia_fisica'], true);
  $fisica_status = $fisica_info['fisica_status'];
  $fisica_p1 = $fisica_info['fisica_p1'];
  $fisica_p2 = $fisica_info['fisica_p2'];
  $fisica_dato = 'fisica';
  $simul_tiempo = $info_simul['simul_tiempo'];
?>
  <script>
    function buscarSelect2(dato, status)
    {
      // creamos un variable que hace referencia al select
      var select=document.getElementById(dato);
    
      // obtenemos el valor a buscar
      var buscar=status;
    
      // recorremos todos los valores del select
      for(var i=1;i<select.length;i++)
      {
        if(select.options[i].text==buscar)
        {
          // seleccionamos el valor que coincide
          select.selectedIndex=i;
        }
      }
    }
  </script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <i class="fa fa-user-plus"></i>
              Actualización de Simulacro
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
              <!--
              <object data="<?php //echo $info_simul['simul_ruta'] ?>" type="application/pdf" width="100%" height="500px"></object>
              -->
              
              <iframe src = "ViewerJS/#../<?php echo $info_simul['simul_ruta'] ?>" width = ' 100% ' height = ' 600px ' allowfullscreen webkitallowfullscreen></iframe></iframe>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Inglés</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Inglés</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="ingles" id="ingles" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $ingles_dato ?>', '<?php echo $ingles_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-ingles1" id="simul-pregunta-ingles1" value="<?php echo $ingles_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-ingles2" id="simul-pregunta-ingles2" value="<?php echo $ingles_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Ciencias Naturales</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Naturales</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="naturales" id="naturales" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $naturales_dato ?>', '<?php echo $naturales_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-naturales1" id="simul-pregunta-naturales1" value="<?php echo $naturales_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-naturales2" id="simul-pregunta-naturales2" value="<?php echo $naturales_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Lenguaje</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Lenguaje</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="lenguaje" id="lenguaje" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $lenguaje_dato ?>', '<?php echo $lenguaje_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-lenguaje1" id="simul-pregunta-lenguaje1" value="<?php echo $lenguaje_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-lenguaje2" id="simul-pregunta-lenguaje2" value="<?php echo $lenguaje_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Matemáticas</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Matemáticas</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="matematicas" id="matematicas" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $matematicas_dato ?>', '<?php echo $matematicas_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-matematicas1" id="simul-pregunta-matematicas1" value="<?php echo $matematicas_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-matematicas2" id="simul-pregunta-matematicas2" value="<?php echo $matematicas_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Ciencias Sociales</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Sociales</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="sociales" id="sociales" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $sociales_dato ?>', '<?php echo $sociales_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-sociales1" id="simul-pregunta-sociales1" value="<?php echo $sociales_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-sociales2" id="simul-pregunta-sociales2" value="<?php echo $sociales_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-navy">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Filosofía</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Filosofía</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="filosofia" id="filosofia" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $filosofia_dato ?>', '<?php echo $filosofia_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-filosofia1" id="simul-pregunta-filosofia1" value="<?php echo $filosofia_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-filosofia2" id="simul-pregunta-filosofia2" value="<?php echo $filosofia_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-purple">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Física</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                <label>Filosofía</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-diaspora"></i></span>
                    </div>
                    <select class="form-control bloquear" name="fisica" id="fisica" required>
                      <option selected value="N/A">N/A</option>
                      <option value="SI">SI</option>
                    </select>
                    <script>buscarSelect2('<?php echo $fisica_dato ?>', '<?php echo $fisica_status ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div> 
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Primera Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-fisica1" id="simul-pregunta-fisica1" value="<?php echo $fisica_p1 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Última Pregunta</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control number2 bloquear" name="simul-pregunta-fisica2" id="simul-pregunta-fisica2" value="<?php echo $fisica_p2 ?>">
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
            </div>
          </div>
        </div> <!-- col -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-edit"></i> Datos finales</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Instrucciones u observaciones</label>
                  <textarea class="form-control" rows="5" name="simul-inst" id="simul-inst"><?php echo $info_simul['simul_inst']; ?></textarea>
                </div>
              </div> <!-- col -->
              <?php
                $hoy = date("Y-m-d");
                $nac_fec1 = $info_simul['simul_fecha'];
              ?>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Fecha de realización</label>
                  <input class="form-control" type="date" name="simul-fecha" id="simul-fecha" value="<?php echo $nac_fec1 ?>" required>
                </div>
              </div> <!-- col -->
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Tiempo Máximo (en minutos)</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <select class="form-control bloquear" name="simul-tiempo" id="simul-tiempo" required>
                      <option value=" " class="seleccionados" disabled selected> </option>
                      <option value="30" class="seleccionados">30</option>
                      <option value="60" class="seleccionados">60</option>
                      <option value="90" class="seleccionados">90</option>
                      <option value="120" class="seleccionados">120</option>
                      <option value="150" class="seleccionados">150</option>
                      <option value="180" class="seleccionados">180</option>
                      <option value="210" class="seleccionados">210</option>
                      <option value="240" class="seleccionados">240</option>
                      <option value="270" class="seleccionados">270</option>
                      <option value="300" class="seleccionados">300</option>
                    </select>
                    <script>buscarSelect2('simul-tiempo', '<?php echo $simul_tiempo ?>');</script>
                    <div class="invalid-feedback">
                      Este campo es obligatorio.
                    </div>                   
                  </div>
                </div>
              </div> <!-- col -->
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Nuevo Archivo PDF <small>Deje en blanco para conservar la Prueba actual</small></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="simul-pdf" id="simul-pdf" accept="application/pdf">
                      <label class="custom-file-label" for="av-asig-guia">Elije un archivo</label>
                    </div>
                  </div>
                </div>
              </div> <!-- col -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <input type="hidden" name="simul-comando" id="simul-comando" value="act">
            <input type="hidden" name="simul-id-act" id="simul-id-act" value="<?php echo $simul_id ?>">
            <input type="hidden" name="simul-grado" id="simul-grado" value="<?php echo $grado ?>">
            <button type="submit" class="btn btn-success">Cargar</button>
            <button type="button" class="btn btn-warning" onclick="volverListaAsig('<?php echo $grado; ?>');">Pruebas Cargadas</button>
          </div>
        </div>
        <!-- /.card -->
        
          
          <br>
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
  window.location.href = 'preifces-lista.php?grado='+grado;
}
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script>
$('input[type="file"]').on('change', function(){
  var ext = $( this ).val().split('.').pop();
  if ($( this ).val() != '') {
    if(ext == "pdf"){
      //alert("La extensión es: " + ext);
      if($(this)[0].files[0].size > 83886080){
        Swal.fire({
            icon: 'warning',
            title: '¡Archivo muy pesado!',
            text: 'Se solicita un archivo no mayor a 2 Megabytes'
            //footer: '<a href>¿Porque ocurrió esto?</a>'
          })           
        $(this).val('');
      }else{
        $("#modal-gral").hide();
      }
    }
    else
    {
      $( this ).val('');
      Swal.fire({
            icon: 'warning',
            title: '¡El archivo no es PDF!',
            text: 'Se solicita un archivo con extención .pdf'
            //footer: '<a href>¿Porque ocurrió esto?</a>'
          })
    }
  }
});
</script>
