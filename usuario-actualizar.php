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
              ACTUALIZACIÓN DE USUARIO
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Usuarios</li>
              <li class="breadcrumb-item">Usuarios registrados</li>
              <li class="breadcrumb-item active">Actualizar usuario</li>
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
                      <select class="form-control bloquear" name="user_ide_tip" required>
                        <option value="CC" <?php if ($datos['users_doc_tipo'] == 'CC') echo 'selected'; ?>>CC</option>
                        <option value="CE" <?php if ($datos['users_doc_tipo'] == 'CE') echo 'selected'; ?>>CE</option>
                        <option disabled>-</option>
                        <option value="PEP" <?php if ($datos['users_doc_tipo'] == 'PEP') echo 'selected'; ?>>PEP</option>
                        <option value="PASAPORTE" <?php if ($datos['users_doc_tipo'] == 'PASAPORTE') echo 'selected'; ?>>PASAPORTE</option>
                        <option value="CI (VZLA)" <?php if ($datos['users_doc_tipo'] == 'CI (VZLA)') echo 'selected'; ?>>CI (VZLA)</option>
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
                      <select class="form-control bloquear" name="user_rol" id="user_rol" required>
                        <option value="RECTOR(A)" <?php if ($datos['users_rol'] == 'RECTOR(A)') echo 'selected'; ?>>RECTOR(A)</option>
                        <option value="COORDINADOR(A)" <?php if ($datos['users_rol'] == 'COORDINADOR(A)') echo 'selected'; ?>>COORDINADOR(A)</option>
                        <option value="SECRETARIA" <?php if ($datos['users_rol'] == 'SECRETARIA') echo 'selected'; ?>>SECRETARIA</option>
                        <option value="DOCENTE" <?php if ($datos['users_rol'] == 'DOCENTE') echo 'selected'; ?>>DOCENTE</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
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
                      <input type="text" class="form-control nickname minusculas bloquear" name="user_user" value="<?php echo $datos2['logins_nickname']; ?>" required>
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
                      <select class="form-control bloquear" name="user_materia" id="user_materia" required>
                        <option value="INGLÉS" <?php if ($datos['users_asignatura'] == 'INGLÉS') echo 'selected'; ?>>INGLÉS</option>
                        <option value="CIENCIAS NATURALES" <?php if ($datos['users_asignatura'] == 'CIENCIAS NATURALES') echo 'selected'; ?>>CIENCIAS NATURALES</option>
                        <option value="LENGUAJE" <?php if ($datos['users_asignatura'] == 'LENGUAJE') echo 'selected'; ?>>LENGUAJE</option>
                        <option value="MATEMÁTICAS" <?php if ($datos['users_asignatura'] == 'MATEMÁTICAS') echo 'selected'; ?>>MATEMÁTICAS</option>
                        <option value="CIENCIAS SOCIALES" <?php if ($datos['users_asignatura'] == 'CIENCIAS SOCIALES') echo 'selected'; ?>>CIENCIAS SOCIALES</option>
                        <option value="FILOSOFÍA" <?php if ($datos['users_asignatura'] == 'FILOSOFÍA') echo 'selected'; ?>>FILOSOFÍA</option>
                        <option value="FÍSICA" <?php if ($datos['users_asignatura'] == 'FÍSICA') echo 'selected'; ?>>FÍSICA</option>
                        <option value="N/A" <?php if ($datos['users_asignatura'] == 'N/A') echo 'selected'; ?>>N/A</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
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
                      <label style="color: white">GDO</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong><?php echo $des_gdo ?> </strong></span>
                        </div>
                        <select class="form-control bloquear" name="<?php echo 'g-'.$crr_gdo; ?>" id="<?php echo 'g-'.$crr_gdo; ?>" required>
                          <option selected value="NO">NO</option>
                          <option value="SI" <?php if (in_array($des_gdo, $g_arr)) echo 'selected'; ?>>SI</option>
                        </select>
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
            <input type="hidden" name="user" value="actualizar">
            <input type="hidden" name="nivel" id="nivel" value="<?php echo $datos2['logins_nivel']; ?>">
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