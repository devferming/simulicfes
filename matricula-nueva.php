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
                          <option disabled selected > </option>
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
                      <label>Lugar de expedición</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="ide_exp" id="ide_exp" required>
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Genero</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                        </div>
                        <select class="form-control bloquear" name="alu_gen" required id="alu_gen">
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
                        <input type="text" class="form-control bloquear" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="nac_fec" required id="nac_fec">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="nac_lug">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="nac_dep">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="dir_mun">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="dir_dir">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="dir_bar">
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
                        <input type="text" class="form-control bloquear" name="tel_mov" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                        <input type="text" class="form-control bloquear" name="tel_loc" data-inputmask='"mask": "999-9999"' data-mask>
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
                        <input type="text" class="form-control correo bloquear" name="alu_mai">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos del acudiente</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Parentesco</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="acu_par" id="acu_par" required>
                        <option disabled selected> </option>
                        <option value="MADRE">MADRE</option>
                        <option value="PADRE">PADRE</option>
                        <option value="ABUELO(A)">ABUELO(A)</option>
                        <option value="TÍO(A)">TÍO(A)</option>
                        <option value="HERMANO(A)">HERMANO(A)</option>
                        <option value="PRIMO(A)">PRIMO(A)</option>
                        <option value="PADRASTRO/MADRASTRA">PADRASTRO/MADRASTRA</option>
                        <option value="PROFESOR(A)">PROFESOR(A)</option>
                        <option value="VECINO(A)">VECINO(A)</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>                   
                    </div>
                  </div>
                </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Tipo de documento</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        </div>
                        <select class="form-control bloquear" name="acu_tdo" id="acu_tdo" required>
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
                        <input type="text" class="form-control number bloquear number2" name="acu_ndo" id="acu_ndo">
                        <div class="invalid-feedback">
                        Este campo es obligatorio.
                        </div>                   
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Lugar de expedición</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_edo" id="acu_edo">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_1ap" id="acu_1ap" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_2ap" id="acu_2ap">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_1no" id="acu_1no" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_2no" id="acu_2no">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="acu_dir" id="acu_dir">
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
                        <input type="text" class="form-control bloquear" name="acu_tmo" id="acu_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
                        <div class="invalid-feedback">
                        Este campo es obligatorio.
                        </div>              
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
                        <input type="text" class="form-control bloquear" name="acu_tlo" id="acu_tlo"  data-inputmask='"mask": "999-9999"' data-mask>
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
                        <input type="text" class="form-control correo bloquear" name="acu_mai" id="acu_mai">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos de la Madre</h3>
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
                        <select class="form-control bloquear" name="mad_tdo" id="mad_tdo">
                          <option selected value="CC">CC</option>
                          <option value="CE">CE</option>
                          <option disabled>-</option>
                          <option value="PEP">PEP</option>
                          <option value="PASAPORTE">PASAPORTE</option>
                          <option value="CI (VZLA)">CI (VZLA)</option>
                        </select>
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
                        <input type="text" class="form-control number bloquear number3" name="mad_ndo" id="mad_ndo">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Lugar de expedición</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_edo" id="mad_edo">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_1ap" id="mad_1ap">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_2ap" id="mad_2ap">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_1no" id="mad_1no">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_2no" id="mad_2no">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="mad_dir" id="mad_dir">
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
                        <input type="text" class="form-control bloquear" name="mad_tmo" id="mad_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                        <input type="text" class="form-control bloquear" name="mad_tlo" id="mad_tlo" data-inputmask='"mask": "999-9999"' data-mask>
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
                        <input type="text" class="form-control correo bloquear" name="mad_mai" id="mad_mai">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos del padre</h3>
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
                        <select class="form-control bloquear" name="pad_tdo" id="pad_tdo">
                          <option selected value="CC">CC</option>
                          <option value="CE">CE</option>
                          <option disabled>-</option>
                          <option value="PEP">PEP</option>
                          <option value="PASAPORTE">PASAPORTE</option>
                          <option value="CI (VZLA)">CI (VZLA)</option>
                        </select>
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
                        <input type="text" class="form-control number bloquear number4" name="pad_ndo" id="pad_ndo">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Lugar de expedición</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_edo" id="pad_edo">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_1ap" id="pad_1ap">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_2ap" id="pad_2ap">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_1no" id="pad_1no">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_2no" id="pad_2no">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="pad_dir" id="pad_dir">
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
                        <input type="text" class="form-control bloquear" name="pad_tmo" id="pad_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                        <input type="text" class="form-control bloquear" name="pad_tlo" id="pad_tlo" data-inputmask='"mask": "999-9999"' data-mask>
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
                        <input type="text" class="form-control correo bloquear" name="pad_mai" id="pad_mai">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Cursos Anteriores</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>T</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_0">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>1°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_1">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>2°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_2">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>3°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_3">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>4°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_4">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>5°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_5">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>6°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_6">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>7°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_7">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>8°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_8">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>9°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_9">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>10°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_10">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>11°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_11">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos de finales</h3>
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
                    <input disabled type="text" class="form-control bloquear" name="ani_esc" value="<?php echo $anio_actual?>" required>
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
                        <option disabled selected > </option>
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
                        <option disabled selected > </option>
                        <option value="U">U</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Banco Oferentes</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="ban_ofe" required>
                        <option disabled selected > </option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                      <div class="invalid-feedback">
                        Este campo es obligatorio.
                      </div>
                    </div>
                  </div>
                </div> <!-- col -->
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Observacion</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                      </div>
                      <textarea type="text" class="form-control letter bloquear" name="obs_mat"></textarea>
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
            <input type="hidden" name="alumno" id="alumno" value="nuevo">
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
function buscar_alumno() {
  $("#modal-buscar-alumno").modal("show");
}
function buscar_cargar_alumno(id) {
    var id_alum = id;
    console.log(id_alum);
    $.ajax({
        type: 'post',
        data: {"alumno" : "buscar", "id_alumno" : id_alum},
        url: 'matricula-modelo.php',
        dataType: 'json',
        success: function(data){
          var resultado = data;
          if(resultado.respuesta == 'exito'){
            //location.reload();
            console.log(resultado.id_alum2);
            $('#ide_tip').val(resultado.alum_doc_tipo);
            $('#ide_num').val(resultado.alum_doc_numero);
            $('#ide_exp').val(resultado.alum_doc_lugar);
            $('#per_ape').val(resultado.alum_1er_apellido);
            $('#sdo_ape').val(resultado.alum_2do_apellido);
            $('#per_nom').val(resultado.alum_1er_nombre);
            $('#sdo_nom').val(resultado.alum_2do_nombre);
            $('#alu_gen').val(resultado.alum_genero);
            $('#nac_fec').val(resultado.alum_nac_fecha);
            $('#nac_lug').val(resultado.alum_nac_lugar);
            $('#nac_dep').val(resultado.alum_departamento);
            $('#dir_mun').val(resultado.alum_municipio);
            $('#dir_dir').val(resultado.alum_direccion);
            $('#dir_bar').val(resultado.alum_barrio);
            $('#tel_mov').val(resultado.alum_telf_movil);
            $('#tel_loc').val(resultado.alum_telf_local);
            $('#alu_mai').val(resultado.alum_mail);
            $('#alu_0').val(resultado.alum_grado_0);
            $('#alu_1').val(resultado.alum_grado_1);
            $('#alu_2').val(resultado.alum_grado_2);
            $('#alu_3').val(resultado.alum_grado_3);
            $('#alu_4').val(resultado.alum_grado_4);
            $('#alu_5').val(resultado.alum_grado_5);
            $('#alu_6').val(resultado.alum_grado_6);
            $('#alu_7').val(resultado.alum_grado_7);
            $('#alu_8').val(resultado.alum_grado_8);
            $('#alu_9').val(resultado.alum_grado_9);
            $('#alu_10').val(resultado.alum_grado_10);
            $('#alu_11').val(resultado.alum_grado_11);
            $('#acu_par').val(resultado.acu_parentesco);
            $('#acu_tdo').val(resultado.acu_doc_tipo);
            $('#acu_ndo').val(resultado.acu_doc_numero);
            $('#acu_edo').val(resultado.acu_doc_lugar);
            $('#acu_1ap').val(resultado.acu_1er_apellido);
            $('#acu_2ap').val(resultado.acu_2do_apellido);
            $('#acu_1no').val(resultado.acu_1er_nombre);
            $('#acu_2no').val(resultado.acu_2do_nombre);
            $('#acu_dir').val(resultado.acu_direccion);
            $('#acu_tmo').val(resultado.acu_telf_movil);
            $('#acu_tlo').val(resultado.acu_telf_local);
            $('#acu_mai').val(resultado.acu_mail);
            $('#mad_tdo').val(resultado.madre_doc_tipo);
            $('#mad_ndo').val(resultado.madre_doc_numero);
            $('#mad_edo').val(resultado.madre_doc_lugar);
            $('#mad_1ap').val(resultado.madre_1er_apellido);
            $('#mad_2ap').val(resultado.madre_2do_apellido);
            $('#mad_1no').val(resultado.madre_1er_nombre);
            $('#mad_2no').val(resultado.madre_2do_nombre);
            $('#mad_dir').val(resultado.madre_direccion);
            $('#mad_tmo').val(resultado.madre_telf_movil);
            $('#mad_tlo').val(resultado.madre_telf_local);
            $('#mad_mai').val(resultado.madre_mail);
            $('#pad_tdo').val(resultado.padre_doc_tipo);
            $('#pad_ndo').val(resultado.padre_doc_numero);
            $('#pad_edo').val(resultado.padre_doc_lugar);
            $('#pad_1ap').val(resultado.padre_1er_apellido);
            $('#pad_2ap').val(resultado.padre_2do_apellido);
            $('#pad_1no').val(resultado.padre_1er_nombre);
            $('#pad_2no').val(resultado.padre_2do_nombre);
            $('#pad_dir').val(resultado.padre_direccion);
            $('#pad_tmo').val(resultado.padre_telf_movil);
            $('#pad_tlo').val(resultado.padre_telf_local);
            $('#pad_mai').val(resultado.padre_mail);
            $('#id_alumno').val(resultado.id_alum2);
            $('#alumno').val('nuevo2');
            $("#modal-buscar-alumno").modal("toggle");
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Hubo un error',
            })
          }
        }
      }); 
}
</script>
