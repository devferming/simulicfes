<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 3):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  //$code = $_GET['code'];
  //$materia = $_GET['materia'];
  $grado = $_GET['grado'];
  $id_login = $_SESSION['id'];
  if (!filter_var($grado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  try {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE users_id_logins=?");
    $stmt->bind_param("i", $id_login);
    $stmt->execute();
    $result_id = $stmt->get_result();
    $result_id2 = $result_id->fetch_assoc();
    $prof_idx2 = $result_id2['users_id'];
    $prof_mat = $_SESSION['users_mat'];
    
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT * FROM materias WHERE mat_des_materia=?");
    $stmt->bind_param("s", $prof_mat);
    $stmt->execute();
    $result_prof_mat = $stmt->get_result();
    $result_prof_mat2 = $result_prof_mat->fetch_assoc();
    $prof_mat_rev = $result_prof_mat2['mat_rev_simul'];
    $prof_mat_rev2 = $result_prof_mat2['mat_rev_simul2'];
    
  } catch (\Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  try {
    $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_id=?");
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
              Gestión de Simulacros
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
                <h3 class="card-title">Simulacros publicados en el grado: <strong><?php echo $grado_desc; ?></strong></h3>
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
                    while($datos_guia = $resultado->fetch_assoc()){ 
                      
                      $id_simul = $datos_guia['simul_id'];
                      try {
                        $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
                        $stmt->bind_param("i", $id_simul);
                        $stmt->execute();
                        $resultado_simul = $stmt->get_result();
                        $resultado_simul2 = $resultado_simul->fetch_assoc();
                      } catch (\Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                      }
                      $simul_rev_content = $resultado_simul2["" . $prof_mat_rev . ""];
                      $datos_rev = json_decode($simul_rev_content, true);
                      
                      if ($datos_rev["" . $prof_mat_rev2 . ""] == 'SI') { ?>
                        <tr>
                          <td>
                            <p>Simulacro #<?php echo $datos_guia['simul_orden'];?></p>
                            
                            <?php
                              
                              /*
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
                                if ($datos_entrega['simule_status'] == 2) { ?>
                                  <span class="badge badge-success">Entregado</span></p>
                                <?php  
                                } else { ?>
                                  <span class="badge badge-warning">No entregado</span></p>
                                <?php  
                                }
                              */
                                ?>
                              
                          </td>
                          <td>
                            <?php
                            $nac_fec1 = $datos_guia['simul_fecha'];
                            $nac_fec = DateTime::createFromFormat('Y-m-d', $nac_fec1)->format('d-m-Y'); 
                            ?>
                            <p><?php echo $nac_fec;?></p>
                          </td>
                          <td>
                            <div class="btn-group" md5>
                            <a class="btn btn-success" href="preifces-param3.php?id=<?php echo 	$datos_guia['simul_id'] ?>">Explorar</a>
                            </div>
                          </td>
                        </tr>
                      
                      <?php
                      }
                      
                    };
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
