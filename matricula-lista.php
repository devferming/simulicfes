<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 ):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $grado = $_GET['grado'];
  if (!filter_var($grado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  try {
    $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_cod_grado=?");
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
              <i class="fa fa-users-cog"></i>
              GESTIÓN DE MATRICULAS 
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Matricula</a></li>
              <li class="breadcrumb-item active">Matriculados</li>
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
                <h3 class="card-title">Alumnos matriculados en grado <strong><span><?php echo $grado_desc; ?></span></strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="mat-lista" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>N° Documento</th>
                    <th>Grado</th>
                    <th>Oferente</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    try {
                      $stmt2 = $conn->prepare("SELECT alum_id, alum_id_logins, alum_1er_nombre, alum_1er_apellido, alum_doc_numero, alum_grado, alum_banco_ofe FROM alumnos WHERE alum_grado=?");
                      $stmt2->bind_param("s", $grado_desc);
                      $stmt2->execute();
                      $resultado2 = $stmt2->get_result();
                    } catch (\Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                    }
                    while($datos_alum = $resultado2->fetch_assoc()){ ?>
                  <tr>
                    <td>
                      <?php echo $datos_alum['alum_1er_nombre']," ",$datos_alum['alum_1er_apellido'];?>
                    </td>
                    <td>
                      <?php echo $datos_alum['alum_doc_numero'];?>
                    </td>
                    <td>
                      <?php echo $datos_alum['alum_grado'];?>
                    </td>
                    <td>
                      <?php echo $datos_alum['alum_banco_ofe'];?>
                    </td>
                    <td>
                      <div class="btn-group">
                      <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="matricula-actualizar.php?id=<?php echo $datos_alum['alum_id'];?>">Ficha</a>
                        <a class="dropdown-item logins_form" id_log="<?php echo $datos_alum['alum_id_logins']?>" onclick="desplegar(<?php echo $datos_alum['alum_id_logins']?>);">Logín</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php };
                  $conn->close();
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Nombre y Apellido</th>
                    <th>N° Documento</th>
                    <th>Grado</th>
                    <th>Oferente</th>
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