<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $grado = $_GET['grado'];
  if (!filter_var($grado, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
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
              Control de Simulacros
            </h1>
            <h5>Grado: <code><?php echo $grado_desc ?></code></h5>
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
                <h3 class="card-title">Módulo de gestión<strong></strong></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <table id="mat-lista" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Prueba</th>
                <th>Materia</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- :::: ASIGNACIONES PRIMERO PERIODO :::: -->
              <!-- Taller #1 P1-->
              
            <?php
              $orden = 2;
              try {
                $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_grado=?");
                $stmt->bind_param("s", $grado_desc);
                $stmt->execute();
                $resultado = $stmt->get_result();
                
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                } 
            ?>
              
            <?php while($existe = $resultado->fetch_assoc()){ ?>
              <tr>
            
                <td> <p>Prueba #<?php echo $existe['simul_orden'] ?> <span class="badge badge-success">Cargado</span></p> </td>
            
                <td>
                  <p><?php echo $existe['simul_materia'] ?></p>
                </td>
                <td>
                  <div class="btn-group" md5>
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                      <span>Desplegar</span>
                    </button>
                    <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="preifces-param4.php?grado=<?php echo $grado ?>&id=<?php echo $existe['simul_id'] ?>">Actualizar</a>
                        <a class="dropdown-item" href="preifces-revision.php?grado=<?php echo $grado ?>&id=<?php echo $existe['simul_id'] ?>">Revisión</a>
                        <a class="dropdown-item" href="preifces-entregas.php?simul_id=<?php echo $existe['simul_id'] ?>&grado=<?php echo $grado ?>">Resultados</a>
                        <a class="dropdown-item" href="#">Analizar(En Desarrollo)</a>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
              
              <!-- / .Taller #1 P1-->
            </tbody>
    <!--        <tfoot>
              <tr>
                <th>Materia</th>
                <th>Orden</th>
                <th>Acciones</th>
              </tr>
            </tfoot> -->
        </table>
        </div>
        <!-- /.card-body -->
      </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-metricas">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><small>Resumen: <strong><span id="alum_nom_modal2">Fermin</span></strong></small> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
              <div class="card-body">
                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                <div id="accordion">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                        <span><i class="fas fa-cog"></i> Entregas: <strong id="nro_entregas"></strong></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse1" class="collapse" data-parent="#accordion">
                      <div class="card-body" id="nombre_entregas">
                        
                      </div>
                    </div>
                  </div>
                  <div class="card card-warning">
                    <div class="card-header">
                      <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse2">
                        <span><i class="fas fa-cog"></i> Por entregar <strong id="nro_noentregas"></strong></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse2" class="collapse" data-parent="#accordion">
                      <div class="card-body" id="nombre_noentregas">
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.dialog -->
  </div>
  <!-- /.modal -->
  <?php
    include_once 'templates/footer.php';
    endif;
  ?> 
<script>
  function desplegarMetricas(id) {
    var id_taller = id;
    datos = {
      avasig: 'consultar',
      id_guia: id_taller
    };
    document.getElementById('nombre_entregas').innerHTML = '';
    document.getElementById('nombre_noentregas').innerHTML = '';
    $.ajax({
      data: datos,
      url: "av-modelo.php",
      type: "post",
      dataType: "json",
      success: function (data) {
        var resultado = data;
        //console.log(resultado.entregaron);
        var entregas = resultado.entregaron;
        var noentregas = resultado.no_entregaron;
        $("#nro_entregas").text(entregas.length);
        $("#nro_noentregas").text(noentregas.length);
        //resultado.forEach(element => console.log(element));
        
        for (i in entregas) {
          //console.log(noentregas[i]);
          $("#nombre_entregas").append('<p>'+entregas[i]+'</p>');
        }
        for (i in noentregas) {
          //console.log(noentregas[i]);
          $("#nombre_noentregas").append('<p>'+noentregas[i]+'</p>');
        }
        
        
      },
    });
  $("#modal-metricas").modal("show");
  }
</script>
