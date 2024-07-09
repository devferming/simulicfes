<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $id = $_GET['id'];
  if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  }
  try {
    $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $descripcion = $resultado->fetch_assoc();
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
              ACTUALIZACIÓN DE MATRÍCULA
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Matriculados</li>
              <li class="breadcrumb-item active">Actualizar Matrícula</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form role="form" name="mat_actualizar" id="mat_actualizar" method="post" action="matricula-modelo.php" class="needs-validation" novalidate autocomplete="on">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user"></i> Datos del estudiante</h3>
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
                        <select class="form-control bloquear" name="ide_tip" required>
                          <option selected ><?php echo $descripcion['alum_doc_tipo'];?></option>
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
                        <input type="text" class="form-control number bloquear" name="ide_num" id="ide_num" value="<?php echo $descripcion['alum_doc_numero'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="ide_exp" value="<?php echo $descripcion['alum_doc_lugar'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="per_ape" value="<?php echo $descripcion['alum_1er_apellido'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="sdo_ape" value="<?php echo $descripcion['alum_2do_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="per_nom" value="<?php echo $descripcion['alum_1er_nombre'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="sdo_nom" value="<?php echo $descripcion['alum_2do_nombre'];?>">
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
                        <select class="form-control bloquear" name="alu_gen" required>
                          <option selected><?php echo $descripcion['alum_genero'];?></option>
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
                        <?php 
                          $fecha = $descripcion['alum_nac_fecha'];
                          $nac_fec = DateTime::createFromFormat('Y-m-d', $fecha)->format('d/m/Y');  
                        ?>
                        <input type="text" class="form-control bloquear" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" name="nac_fec" value="<?php echo $nac_fec;?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="nac_lug" value="<?php echo $descripcion['alum_nac_lugar'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="nac_dep" value="<?php echo $descripcion['alum_departamento'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="dir_mun" value="<?php echo $descripcion['alum_direccion'];?>">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="dir_dir" value="<?php echo $descripcion['alum_municipio'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="dir_bar" value="<?php echo $descripcion['alum_barrio'];?>">
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
                        <input type="text" class="form-control bloquear" name="tel_mov" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $descripcion['alum_telf_movil'];?>">
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
                        <input type="text" class="form-control bloquear" name="tel_loc" data-inputmask='"mask": "999-9999"' data-mask value="<?php echo $descripcion['alum_telf_local'];?>">
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
                        <input type="text" class="form-control correo bloquear" name="alu_mai" value="<?php echo $descripcion['alum_mail'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Estatus</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        <input type="text" class="form-control correo bloquear" name="alu_status" value="<?php echo $descripcion['alum_estatus'];?>" readonly>
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
            <?php
            try {
              $stmt2 = $conn->prepare("SELECT * FROM acudientes WHERE acu_id_alumno=?");
              $stmt2->bind_param("i", $id);
              $stmt2->execute();
              $resultado2 = $stmt2->get_result();
              $descripcion2 = $resultado2->fetch_assoc();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            ?> 
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Parentesco</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      </div>
                      <select class="form-control bloquear" name="acu_par" id="acu_par" required>
                        <option selected><?php echo $descripcion2['acu_parentesco'];?></option>
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
                          <option selected><?php echo $descripcion2['acu_doc_tipo'];?></option>
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
                        <input type="text" class="form-control number bloquear number2" name="acu_ndo" id="acu_ndo" value="<?php echo $descripcion2['acu_doc_numero'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_edo" id="acu_edo" value="<?php echo $descripcion2['acu_doc_lugar'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_1ap" id="acu_1ap" value="<?php echo $descripcion2['acu_1er_apellido'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_2ap" id="acu_2ap" value="<?php echo $descripcion2['acu_2do_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_1no" id="acu_1no" value="<?php echo $descripcion2['acu_1er_nombre'];?>" required>
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="acu_2no" id="acu_2no" value="<?php echo $descripcion2['acu_2do_nombre'];?>">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="acu_dir" id="acu_dir" value="<?php echo $descripcion2['acu_direccion'];?>">
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
                        <input type="text" class="form-control bloquear" name="acu_tmo" id="acu_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $descripcion2['acu_telf_movil'];?>" required>
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
                        <input type="text" class="form-control bloquear" name="acu_tlo" id="acu_tlo"  data-inputmask='"mask": "999-9999"' data-mask value="<?php echo $descripcion2['acu_telf_local'];?>">
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
                        <input type="text" class="form-control correo bloquear" name="acu_mai" id="acu_mai" value="<?php echo $descripcion2['acu_mail'];?>">
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
            <?php
            try {
              $parentesco1 = 'MADRE';
              $stmt3 = $conn->prepare("SELECT * FROM padres WHERE padres_id_alumno=? AND padres_parentesco=?");
              $stmt3->bind_param("is", $id, $parentesco1);
              $stmt3->execute();
              $resultado3 = $stmt3->get_result();
              $descripcion3 = $resultado3->fetch_assoc();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            ?> 
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
                          <option selected><?php echo $descripcion3['padres_doc_tipo'];?></option>
                          <option value="CC">CC</option>
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
                        <input type="text" class="form-control number bloquear number3" name="mad_ndo" id="mad_ndo" value="<?php echo $descripcion3['padres_doc_numero'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_edo" id="mad_edo" value="<?php echo $descripcion3['padres_doc_lugar'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_1ap" id="mad_1ap" value="<?php echo $descripcion3['padres_1er_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_2ap" id="mad_2ap" value="<?php echo $descripcion3['padres_2do_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_1no" id="mad_1no" value="<?php echo $descripcion3['padres_1er_nombre'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="mad_2no" id="mad_2no" value="<?php echo $descripcion3['padres_2do_nombre'];?>">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="mad_dir" id="mad_dir" value="<?php echo $descripcion3['padres_direccion'];?>">
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
                        <input type="text" class="form-control bloquear" name="mad_tmo" id="mad_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $descripcion3['padres_telf_movil'];?>">
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
                        <input type="text" class="form-control bloquear" name="mad_tlo" id="mad_tlo" data-inputmask='"mask": "999-9999"' data-mask value="<?php echo $descripcion3['padres_telf_local'];?>">
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
                        <input type="text" class="form-control correo bloquear" name="mad_mai" id="mad_mai" value="<?php echo $descripcion3['padres_mail'];?>">
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
            <?php
            try {
              $parentesco2 = 'PADRE';
              $stmt4 = $conn->prepare("SELECT * FROM padres WHERE padres_id_alumno=? AND padres_parentesco=?");
              $stmt4->bind_param("is", $id, $parentesco2);
              $stmt4->execute();
              $resultado4 = $stmt4->get_result();
              $descripcion4 = $resultado4->fetch_assoc();
            } catch (\Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }
            ?> 
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
                          <option selected><?php echo $descripcion4['padres_doc_tipo'];?></option>
                          <option value="CC">CC</option>
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
                        <input type="text" class="form-control number bloquear number4" name="pad_ndo" id="pad_ndo" value="<?php echo $descripcion4['padres_doc_numero'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_edo" id="pad_edo" value="<?php echo $descripcion4['padres_doc_lugar'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_1ap" id="pad_1ap" value="<?php echo $descripcion4['padres_1er_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_2ap" id="pad_2ap" value="<?php echo $descripcion4['padres_2do_apellido'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_1no" id="pad_1no" value="<?php echo $descripcion4['padres_1er_nombre'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="pad_2no" id="pad_2no" value="<?php echo $descripcion4['padres_2do_nombre'];?>">
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
                        <input type="text" class="form-control direccion mayusculas bloquear" name="pad_dir" id="pad_dir" value="<?php echo $descripcion4['padres_direccion'];?>">
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
                        <input type="text" class="form-control bloquear" name="pad_tmo" id="pad_tmo" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $descripcion4['padres_telf_movil'];?>">
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
                        <input type="text" class="form-control bloquear" name="pad_tlo" id="pad_tlo" data-inputmask='"mask": "999-9999"' data-mask value="<?php echo $descripcion4['padres_telf_local'];?>">
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
                        <input type="text" class="form-control correo bloquear" name="pad_mai" id="pad_mai" value="<?php echo $descripcion4['padres_mail'];?>">
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
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_0" value="<?php echo $descripcion['alum_grado_0'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>1°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_1" value="<?php echo $descripcion['alum_grado_1'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>2°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_2" value="<?php echo $descripcion['alum_grado_2'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>3°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_3" value="<?php echo $descripcion['alum_grado_3'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>4°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_4" value="<?php echo $descripcion['alum_grado_4'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>5°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_5" value="<?php echo $descripcion['alum_grado_5'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>6°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_6" value="<?php echo $descripcion['alum_grado_6'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>7°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_7" value="<?php echo $descripcion['alum_grado_7'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>8°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_8" value="<?php echo $descripcion['alum_grado_8'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>9°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_9" value="<?php echo $descripcion['alum_grado_9'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>10°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_10" value="<?php echo $descripcion['alum_grado_10'];?>">
                      </div>
                    </div>
                  </div> <!-- col -->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><strong>11°</strong></i></span>
                        </div>
                        <input type="text" class="form-control letter mayusculas bloquear" name="alu_11" value="<?php echo $descripcion['alum_grado_11'];?>">
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
              <h3 class="card-title"><i class="fa fa-user"></i> Datos finales</h3>
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
                    <input disabled type="text" class="form-control bloquear" name="ani_esc" value="<?php echo $anio_actual;?>" required>
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
                        <option selected ><?php echo $descripcion['alum_grado'];?></option>
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
                        <option selected ><?php echo $descripcion['alum_seccion'];?></option>
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
                        <option selected ><?php echo $descripcion['alum_banco_ofe'];?></option>
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
                      <textarea type="text" class="form-control letter bloquear" name="obs_mat"><?php echo $descripcion['alum_observacion'];?></textarea>
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
            <input type="hidden" name="alumno" value="actualizar">
            <input type="hidden" name="alu_id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-success">Actualizar</button>
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
