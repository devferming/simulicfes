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
              <i class="fa fa-user-plus"></i>
              MATRICULA NUEVA
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
        <form role="form" name="mat_nueva" id="mat_nueva" method="post" action="matricula-modelo.php" class="needs-validation" novalidate autocomplete="off">

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user"></i> Datos del estudiante &nbsp <!-- <button type="button" class="btn btn-default" onclick="buscar_alumno()" ><i class="fa fa-search"></i></button> --></h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Tipo de documento</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="ide_tip" required id="ide_tip">
                        <option disabled selected> </option>
                        <option value="CC">CC</option>
                        <option value="TI">TI</option>
                        <option value="RC">RC</option>
                        <option value="NUIP">NUIP</option>
                        <option disabled>-</option>
                        <option value="CI (VZLA)">CI (VZLA)</option>
                        <option value="PN (VZLA)">PN (VZLA)</option>
                        <option value="PP (VZLA)">PP (VZLA)</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Numero de documento</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="text" class="form-control number bloquear" name="ide_num" id="ide_num" required>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->


                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Primer Apellido</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="text" class="form-control letter mayusculas bloquear" name="per_ape" required id="per_ape">
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Segundo Apellido</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="text" class="form-control letter mayusculas bloquear" name="sdo_ape" id="sdo_ape">
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Primer Nombre</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="text" class="form-control letter mayusculas bloquear" name="per_nom" required id="per_nom">
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Segundo Nombre</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="text" class="form-control letter mayusculas bloquear" name="sdo_nom" id="sdo_nom">
                    </div>
                  </div>
                </div> <!-- col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user"></i> Datos académicos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Año escolar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <?php
                      $anio_actual = date("Y");
                      ?>
                      <input disabled type="text" class="form-control bloquear" name="ani_esc" value="<?php echo $anio_actual ?>" required>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Grado</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="gra_esc" required>
                        <option disabled selected> </option>
                        <?php
                        while ($datos_grado = $resultado->fetch_assoc()) { ?>
                          <option value="<?php echo htmlspecialchars($datos_grado['gdo_des_grado'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($datos_grado['gdo_des_grado'], ENT_QUOTES, 'UTF-8'); ?>
                          </option>
                        <?php } ?>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card-footer">
            <input type="hidden" name="cmd" id="cmd" value="anuevo">
            <input type="hidden" name="id_alumno" id="id_alumno" value="">
            <button type="submit" class="btn btn-success">Matricular</button>
          </div>
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

</script>