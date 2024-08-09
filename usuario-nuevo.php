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
              <i class="fa fa-user-plus"></i>
              NUEVO USUARIO
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
              <li class="breadcrumb-item active">Nuevo Usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" name="user_nuevo" id="user_nuevo" method="post" action="usuario-modelo.php" class="needs-validation" novalidate autocomplete="on">
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
                        <option disabled selected> </option>
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option disabled>-</option>
                        <option value="PEP">PEP</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                        <option value="CI (VZLA)">CI (VZLA)</option>
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
                      <input type="text" class="form-control number bloquear" name="user_ide_num" id="user_ide_num" Keyup="formatodemiles(this)" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_per_ape" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_sdo_ape">
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_per_nom" required>
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
                      <input type="text" class="form-control letter mayusculas bloquear" name="user_sdo_nom">
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
                        <option disabled selected> </option>
                        <option value="RECTOR(A)">RECTOR(A)</option>
                        <option value="COORDINADOR(A)">COORDINADOR(A)</option>
                        <option value="SECRETARIA">SECRETARIA</option>
                        <option value="DOCENTE">DOCENTE</option>
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
                      <input type="text" class="form-control nickname minusculas bloquear" name="user_user" required>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="password" class="form-control password bloquear" name="user_password" id="password" required>
                      <div id="resultado-password-contenedor2" style="display:none">
                        <span id="resultado-password2">Este campo es obligatorio.</span>
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Confirmar Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <input type="password" class="form-control password bloquear" name="user_password2" id="repetir-password" required>
                      <div id="resultado-password-contenedor" style="display:none">
                        <span id="resultado-password">Este campo es obligatorio.</span>
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
          <div class="card card-secondary" style="display:none" id="perfil_docente">
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
                        <option value="INGLÉS">INGLÉS</option>
                        <option value="CIENCIAS NATURALES">CIENCIAS NATURALES</option>
                        <option value="LENGUAJE">LENGUAJE</option>
                        <option value="MATEMÁTICAS">MATEMÁTICAS</option>
                        <option value="CIENCIAS SOCIALES">CIENCIAS SOCIALES</option>
                        <option value="FILOSOFÍA">FILOSOFÍA</option>
                        <option value="FÍSICA">FÍSICA</option>
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

                while ($datos_grado = $resultado->fetch_assoc()) { ?>
                <?php $crr_gdo = $datos_grado['gdo_id'] ?>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label style="color: white">GDO</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong><?php echo $datos_grado['gdo_des_grado'] ?> </strong></span>
                        </div>
                        <select class="form-control bloquear" name="<?php echo 'g-'.$crr_gdo; ?>" id="<?php echo 'g-'.$crr_gdo; ?>" required>
                          <option selected value="NO">NO</option>
                          <option value="SI">SI</option>
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
            <input type="hidden" name="user" value="nuevo">
            <input type="hidden" name="nivel" id="nivel" value="">
            <button type="submit" class="btn btn-success" id="reg-user">Registrar</button>
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