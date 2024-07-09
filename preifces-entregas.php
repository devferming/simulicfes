<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  if($_SESSION['nivel'] == 1 || $_SESSION['id'] == 44):
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
  $simul_id = $_GET['simul_id'];
  if (!filter_var($simul_id, FILTER_VALIDATE_INT)) {
    die("ERROR!");
  };
  //$orden = $_GET['orden'];
  //$periodo = $_GET['periodo'];
  $grado = $_GET['grado'];
    //$simul_id = $simul_id;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
        $stmt->bind_param("i", $simul_id);
        $stmt->execute();
        $resultado_simulacro = $stmt->get_result();
        $info_simulacro = $resultado_simulacro->fetch_assoc();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
    $alum_grado = $info_simulacro['simul_grado'];
    try {
        $stmt = $conn-> prepare("SELECT * FROM alumnos WHERE alum_grado=?");
        $stmt -> bind_param("s", $alum_grado);
        $stmt -> execute();
        $info_alum2 = $stmt-> get_result();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
    try {
        $stmt = $conn->prepare("SELECT * FROM simulacros_r WHERE simulr_simul_id=?");
        $stmt->bind_param("i", $simul_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $info_guia = $resultado->fetch_assoc();
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
              <i class="fa fa-poll"></i>
              Resultados del Simulacro
            </h1>
            <h6>Simulacro: <code><?php echo '#'.$info_simulacro['simul_orden'] ?></code> Grado: <code><?php echo $alum_grado; ?></code></h6>
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
        <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Resultados</h3>
                <div class="card-tools">
                <button type="button" class="btn btn-default" onclick="desplegarTabla();"><i class="fa fa-expand"></i> Tabla</button>
                  <button type="button" class="btn btn-default" onclick="volverListaAsig('<?php echo $grado; ?>');"><i class="fa fa-arrow-alt-circle-left"></i> Volver</button>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  $puntajes_maximos = array();
                  $puntajes_materias = array();
                  while ($info_alum = $info_alum2-> fetch_assoc()) {
                      $alum_id = $info_alum['alum_id'];
                      $stmt = $conn-> prepare("SELECT * FROM simulacros_e WHERE simule_simul_id=? AND simule_alum_id=?");
                      $stmt -> bind_param("ii", $simul_id, $alum_id);
                      $stmt -> execute();
                      $info_simul2 = $stmt-> get_result();
                      $info_simul = $info_simul2-> fetch_assoc();
                      
                      $simul_alum_id = $info_simul['simule_alum_id'];
                      if ($simul_alum_id == $alum_id) { ?>
                        <div class="card card-success collapsed-card">
                          <div class="card-header">
                            <h3 class="card-title"><?php echo $info_alum['alum_1er_nombre'].' '.$info_alum['alum_1er_apellido'];?></h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-plus"></i></button>
                            </div>
                  
                          </div>
                          <div class="card-body p-0" style="display: none;">
                            <table class="table">
                              <tbody>
                              <table class="table">
                              <tbody>
                                <tr>
                                  
                                  <?php
                                  $total_correctas;
                                  $total_incorrectas;
                                  $puntaje_global;
                                  $si_ingles = json_decode($info_guia['simulr_ingles'], true);
                                  if($si_ingles != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_ingles'], true);
                                      $simul_p1 = (int) $simul_param['ingles_p1'];
                                      $simul_p2 = (int) $simul_param['ingles_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>Inglés:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_profesor = $si_ingles["" .'p-'.$control . ""].'<br>';
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""].'<br>';
                                                
                                                if ($respuesta_profesor == $respuesta_alumno) { ?>
                                                    
                                                  <a href="#" class="badge bg-gray"><?php echo $control.": ".$respuesta_alumno?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control.": ".$respuesta_alumno?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            } 
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-ingles' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  $si_naturales = json_decode($info_guia['simulr_naturales'], true);
                                  if($si_naturales != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_naturales'], true);
                                      $simul_p1 = (int) $simul_param['naturales_p1'];
                                      $simul_p2 = (int) $simul_param['naturales_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>naturales:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""];
                                                $respuesta_profesor = $si_naturales["" .'p-'.$control . ""];
                                                
                                                if ($respuesta_alumno == $respuesta_profesor) { ?>
                                                  <a href="#" class="badge bg-gray"><?php echo $control.": ".$respuesta_alumno?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control.": ".$respuesta_alumno?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-naturales' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  $si_lenguaje = json_decode($info_guia['simulr_lenguaje'], true);
                                  if($si_lenguaje != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_lenguaje'], true);
                                      $simul_p1 = (int) $simul_param['lenguaje_p1'];
                                      $simul_p2 = (int) $simul_param['lenguaje_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>Lenguaje:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""];
                                                $respuesta_profesor = $si_lenguaje["" .'p-'.$control . ""];
                                                ?>
                                                <?php
                                                
                                                if ($respuesta_alumno == $respuesta_profesor) { ?>
                                                  <a href="#" class="badge bg-gray"><?php echo $control.": ".$respuesta_alumno?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control.": ".$respuesta_alumno?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-lenguaje' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  $si_matematicas = json_decode($info_guia['simulr_matematicas'], true);
                                  if($si_matematicas != NULL) { ?>
                                      <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_matematicas'], true);
                                      $simul_p1 = (int) $simul_param['matematicas_p1'];
                                      $simul_p2 = (int) $simul_param['matematicas_p2'];
                                      $info_alum['alum_1er_nombre'].' '.$info_alum['alum_1er_apellido'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                            <tr>
                                            <td>
                                            <small><strong>Matemáticas:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_profesor = $si_matematicas["" .'p-'.$control . ""].'<br>';
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""].'<br>';
                                                
                                                if ($respuesta_profesor == $respuesta_alumno) { ?>
                                                    
                                                  <a href="#" class="badge bg-gray"><?php echo $control.": ".$respuesta_alumno?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control.": ".$respuesta_alumno?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-matematicas' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php        
                                  }
                                  $si_sociales = json_decode($info_guia['simulr_sociales'], true);
                                  if($si_sociales != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_sociales'], true);
                                      $simul_p1 = (int) $simul_param['sociales_p1'];
                                      $simul_p2 = (int) $simul_param['sociales_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>Sociales:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_profesor = $si_sociales["" .'p-'.$control . ""];
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""]; 
                                                
                                                if ($respuesta_profesor == $respuesta_alumno) { ?>
                                                  <a href="#" class="badge bg-gray"><?php echo $control.": ".$respuesta_alumno?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control.": ".$respuesta_alumno?></a>
                                                  <?php
                                                  $incorrectas +=1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-sociales' . ""] = $puntaje;
                                            
                                            ?>
                                            
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  $si_filosofia = json_decode($info_guia['simulr_filosofia'], true);
                                  if($si_filosofia != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_filosofia'], true);
                                      $simul_p1 = (int) $simul_param['filosofia_p1'];
                                      $simul_p2 = (int) $simul_param['filosofia_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>Filosofía:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_profesor = $si_filosofia["" .'p-'.$control . ""].'<br>';
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""].'<br>';
                                                
                                                if ($respuesta_profesor == $respuesta_alumno) { ?>
                                                    
                                                  <a href="#" class="badge bg-gray"><?php echo $control?></a>
                                                    <?php
                                                    $correctas += 1;
                                                    $total_correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                  $total_incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-filosofia' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  $si_fisica = json_decode($info_guia['simulr_fisica'], true);
                                  if($si_fisica != NULL) { ?>
                                    <?php
                                      $simul_param = json_decode($info_simulacro['simul_materia_fisica'], true);
                                      $simul_p1 = (int) $simul_param['fisica_p1'];
                                      $simul_p2 = (int) $simul_param['fisica_p2'];
                                          $correctas = 0;
                                          $incorrectas = 0;
                                          $respuestas_alum = json_decode($info_simul['simule_respuestas'], true);
                                          
                                          $control = $simul_p1; ?>
                                          
                                            <tr>
                                            <td>
                                            <small><strong>Física:</strong></small><br>
                                            <?php
                                            for ($i = $simul_p1; $i <= $simul_p2; $i++) { 
                                                $respuesta_profesor = $si_fisica["" .'p-'.$control . ""].'<br>';
                                                $respuesta_alumno = $respuestas_alum["" .'p-'.$control . ""].'<br>';
                                                
                                                if ($respuesta_profesor == $respuesta_alumno) { ?>
                                                    
                                                  <a href="#" class="badge bg-gray"><?php echo $control?></a>
                                                    <?php
                                                    $correctas += 1;
                                                } else { ?>
                                                    <a href="#" class="badge bg-danger"><?php echo $control?></a>
                                                  <?php
                                                  $incorrectas += 1;
                                                }
                                                $control += 1;
                                            }
                                            
                                            $total_preguntas = $correctas + $incorrectas;
                                            $puntaje2 = $correctas * 100 / $total_preguntas;
                                            $puntaje = number_format($puntaje2, 2);
                                            $puntaje_global += $puntaje;
                                            $puntajes_materias["" . $alum_id.'-fisica' . ""] = $puntaje;
                                            
                                            ?>
                                            <h5><span class="badge bg-gray"><i class="fas fa-check"></i><?php echo ' '.$correctas ?></span>&nbsp<span class="badge bg-danger"><i class="fas fa-times"></i><?php echo ' '.$incorrectas ?></span>&nbsp<span class="badge bg-info"><i class="fas fa-percentage"></i><?php echo ' '.$puntaje ?></span></h5> <?php ?>
                                          </td>
                                        </tr>
                                        
                                    <?php 
                                  }
                                  ?>
                                    <tr>
                                      <td>
                                        <small><strong>Datos Globales:</strong></small><br>
                                          <span class="info-box-text"><i class="fas fa-check"></i> Respuestas correctas: <strong><?php echo $total_correctas ?></strong></span>
                                          <br>
                                          <span class="info-box-text"><i class="fas fa-check"></i> Respuestas incorrectas: <strong><?php echo $total_incorrectas ?></strong></span>
                                          <br> <?php
                                          $total_preguntas_final = $total_correctas + $total_incorrectas;
                                          $puntaje_total_final = $total_correctas * 100 / $total_preguntas_final;
                                          $puntajes_maximos["" . $alum_id . ""] = $puntaje_global;
                                          ?>
                                          <span class="info-box-text"><i class="fas fa-check"></i> Puntaje Goblal: <strong><?php echo $puntaje_global ?></strong></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <small><strong>Hora de finalización:</strong></small><br>
                                          <span class="info-box-text"><i class="fas fa-clock"></i> <?php echo $info_simul['simule_hora_final'] ?></span>
                                          <button class="badge bg-warning" onclick="ModalNuevoPlazo('<?php echo $info_simul['simule_hora_final'] ?>', '<?php echo $simul_id ?>', '<?php echo $alum_id ?>')" style="border: 0px;">Cambiar</button>
                                          <br>
                                      </td>
                                    </tr>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <?php 
                      } else { ?>
                          
                          <div class="card card-default collapsed-card">
                            <div class="card-header">
                              <h3 class="card-title"><?php echo $info_alum['alum_1er_nombre'].' '.$info_alum['alum_1er_apellido'];?></h3>
                              <div class="card-tools">
                                  <i class="fas fa-exclamation-circle" style="color:#DC3545"></i> No presentó</button>
                              </div>
                            </div>
                            <div class="card-body p-0" style="display: none;">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>No ha entregado ningún archivo</td>
                                    <td class="text-right py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                      </div>
                                    </td>
                                  </tr>
                                    
                                  
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                        <?php
                      }
                      $total_correctas = 0;
                      $total_incorrectas = 0;
                      $puntaje_global = 0;
                  
                  }
                ?>
              </div>
              <!-- /.card-body -->
              
        </div>
        <!-- /.card -->
        <div class="card-footer">
          <button type="button" class="btn btn-default" onclick="volverListaAsig('<?php echo $grado; ?>');"><i class="fa fa-arrow-alt-circle-left"></i> Volver</button>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-tabla-global">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <small>
                Resultados Globales
            </small>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
            <div id="accordion"> 
            <table id="mat-lista" class="table table-sm">
              <thead>
                <tr>
                  <th>Alumno</th>
                  <th>Puntaje Global</th>
                  <th>Inglés</th>
                  <th>Naturales</th>
                  <th>Lenguaje</th>
                  <th>Matemáticas</th>
                  <th>Sociales</th>
                  <th>Filosofía</th>
                  <th>Física</th>
                </tr>
              </thead>
              <tbody>
                <?php
                arsort($puntajes_maximos);
                $ganador = array_key_first($puntajes_maximos);
                foreach($puntajes_maximos as $key => $val) {
                  $stmt = $conn-> prepare("SELECT * FROM alumnos WHERE alum_id=?");
                  $stmt -> bind_param("i", $key);
                  $stmt -> execute();
                  $info_alum_final2 = $stmt-> get_result();
                  $info_alum_final = $info_alum_final2->fetch_assoc(); ?>
                  <tr>
                  <th>
                  <?php
                  if ( $ganador == $info_alum_final['alum_id']) {
                    echo '<i class="fas fa-trophy"></i> '.$nombre = $info_alum_final['alum_1er_nombre'].' '.$info_alum_final['alum_1er_apellido'];
                  } else {
                    echo $nombre = $info_alum_final['alum_1er_nombre'].' '.$info_alum_final['alum_1er_apellido'];
                  }
                  ?>
                  <?php echo $puntajes_maximos[0] ?>
                  </th>
                  <th> 
                  <?php echo $puntajes_maximos["". $key .""];?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-ingles' .""] > 0) {
                        echo $puntajes_materias["". $key.'-ingles' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-naturales' .""] > 0) {
                        echo $puntajes_materias["". $key.'-naturales' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-lenguaje' .""] > 0) {
                        echo $puntajes_materias["". $key.'-lenguaje' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-matematicas' .""] > 0) {
                        echo $puntajes_materias["". $key.'-matematicas' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-sociales' .""] > 0) {
                        echo $puntajes_materias["". $key.'-sociales' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-filosifa' .""] > 0) {
                        echo $puntajes_materias["". $key.'-filosifa' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  <th> 
                    <?php 
                      if ($puntajes_materias["". $key.'-fisica' .""] > 0) {
                        echo $puntajes_materias["". $key.'-fisica' .""];
                      } else { ?>
                        --
                        <?php
                      }
                    ?>
                  </th>
                  
                  </tr>
                <?php
                }
                ?>
                <tr>
              </tbody>
            </table>
                
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="cerrar_modal_nota" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-nuevo-plazo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Asignar nuevo plazo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" name="simul_nuevo_plazo" id="simul_nuevo_plazo" method="post" action="preifces-modelo.php" class="needs-validation" novalidate autocomplete="on">
            <!--class="needs-validation" novalidate autocomplete="on"-->
            <div class="row">
              
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-clock"></i></span>
                    </div>
                    <input type="text" class="form-control jsdatetime" name="datos_nuevo_plazo" id="datos_nuevo_plazo" required>
                  </div>
                </div>
              </div> <!-- col -->
            </div>
            <!-- /.row -->
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="simul-comando" value="nuevo_plazo">
              <input type="hidden" name="nuevo_plazo_alum_id" id="nuevo_plazo_alum_id" value="">
              <input type="hidden" name="nuevo_plazo_simul_id" id="nuevo_plazo_simul_id" value="">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" >Actualizar</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
    include_once 'templates/footer.php';
    endif;
  ?> 
<script>
  function desplegarTabla(d1) {
    $("#modal-tabla-global").modal("show");
  }
  function ModalNuevoPlazo(hora, simul, alum) {
$("#datos_nuevo_plazo").val(hora);
$("#nuevo_plazo_simul_id").val(simul);
$("#nuevo_plazo_alum_id").val(alum);
$("#modal-nuevo-plazo").modal("show");
}
</script>
<script>
  function volverListaAsig(grado) {
    window.location.href = 'preifces-lista.php?grado='+grado;
  }
</script>
