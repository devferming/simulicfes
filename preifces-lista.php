<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1):
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

                <?php while ($existe = $resultado->fetch_assoc()) { ?>
                  <tr>

                    <td>
                      <p>Prueba #<?php echo $existe['simul_orden'] ?> <span class="badge badge-success">Cargado</span></p>
                    </td>

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
                          <a class="dropdown-item" href="preifces-analisis.php?simul_id=<?php echo $existe['simul_id'] ?>&grado=<?php echo $grado ?>">Analizar</a>
                          <button class="dropdown-item" onclick="deleteSimul('<?php echo $existe['simul_id'] ?>')">Eliminar</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
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
<script>
  function deleteSimul(id) {

    Swal.fire({
      title: '¿Estás seguro?',
      text: "Los simulacros eliminados no se pueden recuperar",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
    }).then((result) => {
      if (result.isConfirmed) {

        const datos = {
          'simul-comando': 'delete',
          id
        };

        $.ajax({
          data: datos,
          url: "preifces-modelo.php",
          type: "POST",
          dataType: "json",
          success: function(response) {
            if (response.respuesta === 'exito') {
              Swal.fire(
                '¡Éxito!',
                'Simulacro eliminado correctamente',
                'success'
              );
              window.location.reload();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Algo salió mal, intente nuevamente o contacte con soporte técnico',
              });
            }
          },
          error: function() {
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: 'No se pudo conectar con el servidor. Inténtalo nuevamente más tarde.',
            });
          }
        });

      }
    });
  }
</script>