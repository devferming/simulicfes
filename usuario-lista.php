<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
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
              USUARIOS REGISTRADOS
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Usuarios</li>
              <li class="breadcrumb-item active">Usuarios registrados</li>
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
            <h3 class="card-title">Usuarios (No estudiantes) registrados en el sistema</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="mat-lista" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre y Apellido</th>
                  <th>Rol</th>
                  <th>Asignatura</th>
                  <th>Grados</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $stmt = $conn->prepare("SELECT * FROM usuarios");
                  $stmt->execute();
                  $resultado = $stmt->get_result();
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }
                while ($datos = $resultado->fetch_assoc()) { ?>
                  <tr>
                    <td>
                      <?php echo $datos['users_1er_nombre'], " ", $datos['users_1er_apellido']; ?>
                    </td>
                    <td>
                      <?php echo $datos['users_rol']; ?>
                    </td>
                    <td>
                      <?php echo $datos['users_asignatura'] ?>
                    </td>
                    <td>
                      <?php
                      $id_login = $datos['users_id_logins'];
                      $crr_asig = json_decode($datos['users_grados'], true);

                      if ($crr_asig != null) {
                        foreach ($crr_asig as $key => $value) {
                          echo $value . '<br>';
                        }
                      } else {
                        echo 'N/A';
                      }

                      ?>

                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="usuario-actualizar.php?id=<?php echo $datos['users_id_logins']; ?>">Ficha</a>
                          <a class="dropdown-item logins_form" href="#" id_log="<?php echo $id_login ?>" onclick="desplegar(<?php echo $id_login ?>);">Logín</a>
                          <a class="dropdown-item" href="#" onclick="deleteU('<?php echo $id_login ?>')">Eliminar</a>
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
                  <th>Rol</th>
                  <th>Asignatura</th>
                  <th>Grados</th>
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

<script>
  function deleteU(id) {

    const datos = {
      "user": "eliminar",
      "id": id
    }

    $.ajax({
      data: datos,
      url: 'usuario-modelo.php',
      type: "post",
      dataType: "json",
      success: function(data) {
        const resultado = data;
        if (resultado.respuesta == "exito") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Usuario eliminado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });
          location.reload();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Algo salió mal",
            showConfirmButton: true,
          });
        }
      },
    });

  }
</script>