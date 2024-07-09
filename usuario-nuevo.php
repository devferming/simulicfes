<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3):
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
                        <input type="text" class="form-control number bloquear" name="user_ide_num" id="user_ide_num" Keyup="formatodemiles(this)"  required>
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Genero</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                        </div>
                        <select class="form-control bloquear" name="user_gen" required>
                          <option disabled selected > </option>
                          <option value="MASCULINO">MASCULINO</option>
                          <option value="FEMENINO">FEMENINO</option>
                        </select>
                        <div class="invalid-feedback">
                          Este campo es obligatorio.
                        </div>                   
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Fecha de Nacimiento</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control bloquear" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="user_nac_fec" required>
                        <div class="invalid-feedback">
                          Este campo es obligatorio.
                        </div>                   
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Lugar de Nacimiento</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="user_nac_lug">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Departamento</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="user_nac_dep">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Municipio</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="user_dir_mun">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Barrio</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="user_dir_bar">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Dirección</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control direccion mayusculas bloquear" name="user_dir_dir">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Número Teléfono móvil</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control bloquear" name="user_tel_mov" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Número Teléfono Local</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control bloquear" name="user_tel_loc" data-inputmask='"mask": "999-9999"' data-mask>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>E-mail</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control correo bloquear" name="user_mai">
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
                        <div id="resultado-password-contenedor2" style ="display:none">
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
                        <div id="resultado-password-contenedor" style ="display:none">
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
                          <option value="BIOLOGÍA">BIOLOGÍA</option>
                          <option value="QUÍMICA">QUÍMICA</option>
                          <option value="CIENCIAS NATURALES">CIENCIAS NATURALES</option>
                          <option value="LENGUAJE">LENGUAJE</option>
                          <option value="MATEMÁTICAS">MATEMÁTICAS</option>
                          <option value="CIENCIAS SOCIALES"> CIENCIAS SOCIALES</option>
                          <option value="INFORMÁTICA">INFORMÁTICA</option>
                          <option value="ARTE Y ÉTICA">ARTE Y ÉTICA</option>
                          <option value="DEPORTE">DEPORTE</option>
                          <option value="MÚSICA">MÚSICA</option>
                          <option value="N/A">N/A</option>
                          <option value="T/A">T/A</option>
                        </select>
                        <div class="invalid-feedback">
                          Este campo es obligatorio.
                        </div>                   
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Dirección de Grupo</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control bloquear" name="user_dgrupo" id="user_dgrupo" required>
                          <option value="PRE JARDÍN">PRE JARDÍN</option>
                          <option value="JARDÍN">JARDÍN</option>
                          <option value="TRANSICIÓN">TRANSICIÓN</option>
                          <option value="PRIMERO">PRIMERO</option>
                          <option value="SEGUNDO">SEGUNDO</option>
                          <option value="TERCERO">TERCERO</option>
                          <option value="CUARTO">CUARTO</option>
                          <option value="QUINTO">QUINTO</option>
                          <option value="SEXTO">SEXTO</option>
                          <option value="SEPTIMO">SÉPTIMO</option>
                          <option value="OCTAVO">OCTAVO</option>
                          <option value="NOVENO">NOVENO</option>
                          <option value="DECIMO">DÉCIMO</option>
                          <option value="UNDECIMO">UNDÉCIMO</option>
                          <option selected value="N/A">N/A</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Sección</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control bloquear" name="user_dgrupo_seccion" id="user_dgrupo_seccion" required>
                          <option value="U">U</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option selected value="N/A">N/A</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label style="color: white"> PJ</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>PJ</strong></span>
                        </div>
                        <select class="form-control bloquear" name="ipj" id="ipj" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label style="color: white"> J</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>J</strong></span>
                        </div>
                        <select class="form-control bloquear" name="ij" id="ij" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                <div class="col-sm-2">
                  <div class="form-group">
                    <label style="color: white"> T</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><strong>T</strong></span>
                      </div>
                      <select class="form-control bloquear" name="itrans" id="itrans" required>
                        <option selected value="N/A">N/A</option>
                        <option value="SI">SI</option>
                      </select>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-2">
                    <div class="form-group">
                      <label style="color: white"> 1</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>1°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="iprimero" id="iprimero" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 2</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>2°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="isegundo" id="isegundo" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 3</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>3°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="itercero" id="itercero" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 4</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>4°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="icuarto" id="icuarto" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 5</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>5°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="iquinto" id="iquinto" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 6</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>6°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="isexto" id="isexto" required>
                          <option selected value="N/A">N/A</option> 
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 7</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>7°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="iseptimo" id="iseptimo" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 8</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>8°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="ioctavo" id="ioctavo" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 9</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>9°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="inoveno" id="inoveno" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 10</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>10°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="idecimo" id="idecimo" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
                      </div>
                    </div>
                  </div> <!-- col -->
                  
                  <div class="col-sm-2">
                    <div class="form-group">
                    <label style="color: white"> 11</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>11°</strong></span>
                        </div>
                        <select class="form-control bloquear" name="iundecimo" id="iundecimo" required>
                          <option selected value="N/A">N/A</option>
                          <option value="SI">SI</option>
                        </select>
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
            <input type="hidden" name="user" value="nuevo">
            <input type="hidden" name="nivel" id="nivel"  value="">
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
