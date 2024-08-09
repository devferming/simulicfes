<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) :
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $id = $_GET['id'];
  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  }
  try {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE users_id_logins=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $datos = $resultado->fetch_assoc();
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
              <i class="fa fa-user-cog"></i>
              <?php echo $_SESSION['nombre']; ?>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Mis Datos</li>
              <li class="breadcrumb-item">Datos Institucionales</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" name="user_actualizar" id="user_actualizar" method="post" action="usuario-modelo.php" class="needs-validation" novalidate autocomplete="on">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user"></i> Datos del usuario</h3>
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
                      <?php $dtip = $datos['users_doc_tipo']; ?>
                      <select class="form-control bloquear" name="user_ide_tip" required>
                        <option value="CC" <?php if ($dtip === 'CC') echo 'selected'; ?>>CC</option>
                        <option value="CE" <?php if ($dtip === 'CE') echo 'selected'; ?>>CE</option>
                        <option disabled>-</option>
                        <option value="PEP" <?php if ($dtip === 'PEP') echo 'selected'; ?>>PEP</option>
                        <option value="PASAPORTE" <?php if ($dtip === 'PASAPORTE') echo 'selected'; ?>>PASAPORTE</option>
                        <option value="CI (VZLA)" <?php if ($dtip === 'CI (VZLA)') echo 'selected'; ?>>CI (VZLA)</option>
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
                      <input type="text" class="form-control number bloquear" name="user_ide_num" id="user_ide_num" Keyup="formatodemiles(this)" value="<?php echo $datos['users_doc_numero']; ?>" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_per_ape" value="<?php echo $datos['users_1er_apellido']; ?>" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_sdo_ape" value="<?php echo $datos['users_2do_apellido']; ?>">
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_per_nom" value="<?php echo $datos['users_1er_nombre']; ?>" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_sdo_nom" value="<?php echo $datos['users_2do_nombre']; ?>">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos de acceso al sistema</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Rol</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <span class="form-control spanDisabled"><?php echo $datos['users_rol']; ?></span>
                    </div>
                  </div>
                </div> <!-- col -->

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Nickname</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <?php

                      $id_login = $datos['users_id_logins'];
                      try {
                        $stmt2 = $conn->prepare("SELECT * FROM logins WHERE logins_id_login=?");
                        $stmt2->bind_param("i", $id_login);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();
                        $datos2 = $resultado2->fetch_assoc();
                      } catch (\Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }
                      ?>
                      <span class="form-control spanDisabled"><?php echo $datos2['logins_nickname']; ?></span>
                    </div>
                  </div>
                </div> <!-- col -->

              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-secondary" style="display:block" id="perfil_docente">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user"></i> Perfil Usuario</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">

                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Asignatura</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <span class="form-control spanDisabled"><?php echo $datos['users_asignatura']; ?></span>
                    </div>
                  </div>
                </div> <!-- col -->

                <?php

                try {
                  $stmt = $conn->prepare("SELECT * FROM grados");
                  $stmt->execute();
                  $resultado = $stmt->get_result();
                } catch (\Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }

                if ($datos['users_grados'] != 'N/A') {
                  $g_arr = json_decode($datos['users_grados'], true);
                } else {
                  $g_arr = array();
                }

                while ($datos_grado = $resultado->fetch_assoc()) { ?>
                  <?php $crr_gdo = $datos_grado['gdo_id'] ?>
                  <?php $des_gdo = $datos_grado['gdo_des_grado'] ?>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label style="color: white">Rol</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><?php echo $des_gdo ?></span>
                        </div>
                        <span class="form-control spanDisabled"><?php echo in_array($des_gdo, $g_arr) ? 'SI' : 'NO'; ?></span>
                      </div>
                    </div>
                  </div> <!-- col -->
                <?php } ?>

              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card-footer">
            <input type="hidden" name="user" value="actcorta">
            <input type="hidden" name="id_logins" value="<?php echo $datos2['logins_id_login']; ?>">
            <button type="submit" class="btn btn-success">Actualizar</button>
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