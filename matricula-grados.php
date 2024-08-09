<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';

  try {
    $stmt = $conn->prepare("SELECT * FROM grados");
    $stmt->execute();
    $resultado = $stmt->get_result();
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
              <i class="fa-solid fa-list-ol"></i>
              GESTIÓN DE GRADOS
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Matricula nueva</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" name="grado_nuevo" id="grado_nuevo" method="post" action="matricula-modelo.php" class="needs-validation" novalidate autocomplete="off">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa-solid fa-list-ol"></i> Grados actuales</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">


              <div class="card-body">
                <table id="mat-grados" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>GRADO</th>
                      <th>ALUMNOS ACTUALES</th>
                      <th>ELIMINAR</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($datos_grado = $resultado->fetch_assoc()) { ?>
                      <tr>
                        <td>
                          <?php
                          echo $datos_grado['gdo_des_grado']
                          ?>
                        </td>
                        <td>
                          <?php
                          $crr_grado = $datos_grado['gdo_des_grado'];
                          $sql = "SELECT COUNT(alum_id) AS matriculados FROM alumnos WHERE alum_grado = '$crr_grado'";
                          $resultado_matriculados  = $conn->query($sql);
                          $matriculados = $resultado_matriculados ->fetch_assoc();
                          echo $matriculados['matriculados'];
                          ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-danger" onclick="deleteG('<?php echo  $datos_grado['gdo_id'] ?>')"><i class="fa-solid fa-trash"></i></button>
                        </td>
                      </tr>
                    <?php };
                    $conn->close();
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>GRADO</th>
                      <th>ALUMNOS ACTUALES</th>
                      <th>ELIMINAR</th>
                    </tr>
                  </tfoot>
                </table>
              </div> <!-- /.card-body -->

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa-solid fa-plus"></i> Crear grado</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Grado</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="gra_esc" required>
                        <option disabled selected> </option>
                        <option value="PRE JARDÍN">PRE JARDÍN</option>
                        <option value="JARDÍN">JARDÍN</option>
                        <option value="TRANSICIÓN">TRANSICIÓN</option>
                        <option value="PRIMERO">PRIMERO</option>
                        <option value="SEGUNDO">SEGUNDO</option>
                        <option value="TERCERO">TERCERO</option>
                        <option value="CUARTO">CUARTO</option>
                        <option value="QUINTO">QUINTO</option>
                        <option value="SEXTO">SEXTO</option>
                        <option value="SÉPTIMO">SÉPTIMO</option>
                        <option value="OCTAVO">OCTAVO</option>
                        <option value="NOVENO">NOVENO</option>
                        <option value="DÉCIMO">DÉCIMO</option>
                        <option value="UNDÉCIMO">UNDÉCIMO</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Seccion</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="sec_esc" required>
                        <option disabled selected> </option>
                        <option value="U">U</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="I">I</option>
                        <option value="J">J</option>
                        <option value="K">K</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->

              </div>
              <br>
              <button type="submit" class="btn btn-success">Crear grado</button>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <input type="hidden" name="cmd" id="cmd" value="gnuevo">
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
  function deleteG(id) {

    const datos = {
      "cmd": "gdelete",
      "id": id
    }

    $.ajax({
      data: datos,
      url: $("#grado_nuevo").attr("action"),
      type: "post",
      dataType: "json",
      success: function(data) {
        const resultado = data;
        if (resultado.respuesta == "exito") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Grado eliminado correctamente",
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