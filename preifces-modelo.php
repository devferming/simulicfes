<?php
if($_SERVER["REQUEST_METHOD"] === "POST")
{
  include_once 'funciones/funciones.php';
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  $fech2 = date('Y-m-d');
  $anio_actual = date("Y");
  //::::::::REGISTRAR GUIA::::::::://
  if($_POST['simul-comando'] == 'nuevo'){
      $inst = htmlspecialchars($_POST['simul-inst'], ENT_QUOTES, 'UTF-8');
      $fecha = htmlspecialchars($_POST['simul-fecha'], ENT_QUOTES, 'UTF-8');
      $tiempo = htmlspecialchars($_POST['simul-tiempo'], ENT_QUOTES, 'UTF-8');
      $grado = htmlspecialchars($_POST['simul-grado'], FILTER_SANITIZE_NUMBER_INT);
      $ingles_status = htmlspecialchars($_POST['ingles'], ENT_QUOTES, 'UTF-8');
      $ingles_p1 = htmlspecialchars($_POST['simul-pregunta-ingles1'], ENT_QUOTES, 'UTF-8');
      $ingles_p2 = htmlspecialchars($_POST['simul-pregunta-ingles2'], ENT_QUOTES, 'UTF-8');
      $ingles1=array(
        'ingles_status' => $ingles_status,
        'ingles_p1' => $ingles_p1,
        'ingles_p2' => $ingles_p2
        );
      $ingles = json_encode($ingles1);
      $naturales_status = htmlspecialchars($_POST['naturales'], ENT_QUOTES, 'UTF-8');
      $naturales_p1 = htmlspecialchars($_POST['simul-pregunta-naturales1'], ENT_QUOTES, 'UTF-8');
      $naturales_p2 = htmlspecialchars($_POST['simul-pregunta-naturales2'], ENT_QUOTES, 'UTF-8');
      $naturales1=array(
        'naturales_status' => $naturales_status,
        'naturales_p1' => $naturales_p1,
        'naturales_p2' => $naturales_p2
        );
      $naturales = json_encode($naturales1);
      $lenguaje_status = htmlspecialchars($_POST['lenguaje'], ENT_QUOTES, 'UTF-8');
      $lenguaje_p1 = htmlspecialchars($_POST['simul-pregunta-lenguaje1'], ENT_QUOTES, 'UTF-8');
      $lenguaje_p2 = htmlspecialchars($_POST['simul-pregunta-lenguaje2'], ENT_QUOTES, 'UTF-8');
      $lenguaje1=array(
        'lenguaje_status' => $lenguaje_status,
        'lenguaje_p1' => $lenguaje_p1,
        'lenguaje_p2' => $lenguaje_p2
        );
      $lenguaje = json_encode($lenguaje1);
      $matematicas_status = htmlspecialchars($_POST['matematicas'], ENT_QUOTES, 'UTF-8');
      $matematicas_p1 = htmlspecialchars($_POST['simul-pregunta-matematicas1'], ENT_QUOTES, 'UTF-8');
      $matematicas_p2 = htmlspecialchars($_POST['simul-pregunta-matematicas2'], ENT_QUOTES, 'UTF-8');
      $matematicas1=array(
        'matematicas_status' => $matematicas_status,
        'matematicas_p1' => $matematicas_p1,
        'matematicas_p2' => $matematicas_p2
        );
      $matematicas = json_encode($matematicas1);
      
      $sociales_status = htmlspecialchars($_POST['sociales'], ENT_QUOTES, 'UTF-8');
      $sociales_p1 = htmlspecialchars($_POST['simul-pregunta-sociales1'], ENT_QUOTES, 'UTF-8');
      $sociales_p2 = htmlspecialchars($_POST['simul-pregunta-sociales2'], ENT_QUOTES, 'UTF-8');
      $sociales1=array(
        'sociales_status' => $sociales_status,
        'sociales_p1' => $sociales_p1,
        'sociales_p2' => $sociales_p2
        );
      $sociales = json_encode($sociales1);
      $filosofia_status = htmlspecialchars($_POST['filosofia'], ENT_QUOTES, 'UTF-8');
      $filosofia_p1 = htmlspecialchars($_POST['simul-pregunta-filosofia1'], ENT_QUOTES, 'UTF-8');
      $filosofia_p2 = htmlspecialchars($_POST['simul-pregunta-filosofia2'], ENT_QUOTES, 'UTF-8');
      $filosofia1=array(
        'filosofia_status' => $filosofia_status,
        'filosofia_p1' => $filosofia_p1,
        'filosofia_p2' => $filosofia_p2
        );
      $filosofia = json_encode($filosofia1);
      $fisica_status = htmlspecialchars($_POST['fisica'], ENT_QUOTES, 'UTF-8');
      $fisica_p1 = htmlspecialchars($_POST['simul-pregunta-fisica1'], ENT_QUOTES, 'UTF-8');
      $fisica_p2 = htmlspecialchars($_POST['simul-pregunta-fisica2'], ENT_QUOTES, 'UTF-8');
      $fisica1=array(
        'fisica_status' => $fisica_status,
        'fisica_p1' => $fisica_p1,
        'fisica_p2' => $fisica_p2
        );
      $fisica = json_encode($fisica1);
      try {
        $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_cod_grado=?");
        $stmt->bind_param("i", $grado);
        $stmt->execute();
        $result_grado = $stmt->get_result();
        $result_grado2 = $result_grado->fetch_assoc();
        $cod_grado = $result_grado2['gdo_des_grado'];
        $stmt = $conn->prepare("SELECT MAX(simul_orden) AS max_orden FROM simulacros WHERE simul_grado=?");
        $stmt->bind_param("s", $cod_grado);
        $stmt->execute();
        $result_simul = $stmt->get_result();
        $result_simul2 = $result_simul->fetch_assoc();
        $orden_simul = $result_simul2['max_orden'];
        if (isset($orden_simul)) {
          $orden3 = $orden_simul +1;
        } else {
          $orden3 = 1;
        }
      } catch (\Exception $e) {
          $error = $e->getMessage();
          echo $error;
      } 
    
      
      $banco = "simulacros/subidos/$cod_grado/";
      $ext = pathinfo($_FILES['simul-pdf']['name'], PATHINFO_EXTENSION);
      if (!is_dir($banco)) {
        mkdir($banco, 0755, true);
      }
      $simul_status = 1;
      if (move_uploaded_file($_FILES['simul-pdf']['tmp_name'], $banco . 'G'.$grado.'S'.$orden3. "." . $ext)) {
        $doc_url = $banco . 'G'.$grado.'S'.$orden3. "." . $ext;
        try {
          $stmt = $conn->prepare("INSERT INTO simulacros (simul_grado, simul_materia_ingles, simul_materia_naturales, simul_materia_lenguaje, simul_materia_matematicas, simul_materia_sociales, simul_materia_filosofia, simul_materia_fisica, simul_orden, simul_inst, simul_fecha, simul_tiempo, simul_ruta, simul_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssssssisssss", $cod_grado, $ingles, $naturales, $lenguaje, $matematicas, $sociales, $filosofia, $fisica, $orden3, $inst, $fecha, $tiempo, $doc_url, $hoy);
          $stmt->execute();
          
          $id_registro2 = $stmt->insert_id;
          
          $stmt = $conn->prepare("INSERT INTO simulacros_r (simulr_simul_id, simulr_editado) VALUES (?, ?)");
          $stmt->bind_param("is", $id_registro2, $hoy);
          $stmt->execute();
          
          $id_registro = $stmt->insert_id;
  
          if($id_registro > 0){
            $respuesta = array(
              'respuesta' => 'exito',
              'id_creado' => $id_registro,
              'grado' => $cod_grado
            );
          } else {
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
  
          $stmt->close();
          $conn->close();
  
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
        } 
      } else {
        $respuesta = array(
          'respuesta' => error_get_last()
        );
      } 
      
      die(json_encode($respuesta));
   
  }
  //::::::::ACTUALIZAR GUIA::::::::://
  if($_POST['simul-comando'] == 'act'){
    $simul_id_act = htmlspecialchars($_POST['simul-id-act'], FILTER_SANITIZE_NUMBER_INT);
    $grado = htmlspecialchars($_POST['simul-grado'], FILTER_SANITIZE_NUMBER_INT);
    $inst = htmlspecialchars($_POST['simul-inst'], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST['simul-fecha'], ENT_QUOTES, 'UTF-8');
    $tiempo = htmlspecialchars($_POST['simul-tiempo'], ENT_QUOTES, 'UTF-8');
    $ingles_status = htmlspecialchars($_POST['ingles'], ENT_QUOTES, 'UTF-8');
    $ingles_p1 = htmlspecialchars($_POST['simul-pregunta-ingles1'], ENT_QUOTES, 'UTF-8');
    $ingles_p2 = htmlspecialchars($_POST['simul-pregunta-ingles2'], ENT_QUOTES, 'UTF-8');
    $ingles1=array(
      'ingles_status' => $ingles_status,
      'ingles_p1' => $ingles_p1,
      'ingles_p2' => $ingles_p2
      );
    $ingles = json_encode($ingles1);
    $naturales_status = htmlspecialchars($_POST['naturales'], ENT_QUOTES, 'UTF-8');
    $naturales_p1 = htmlspecialchars($_POST['simul-pregunta-naturales1'], ENT_QUOTES, 'UTF-8');
    $naturales_p2 = htmlspecialchars($_POST['simul-pregunta-naturales2'], ENT_QUOTES, 'UTF-8');
    $naturales1=array(
      'naturales_status' => $naturales_status,
      'naturales_p1' => $naturales_p1,
      'naturales_p2' => $naturales_p2
      );
    $naturales = json_encode($naturales1);
    $lenguaje_status = htmlspecialchars($_POST['lenguaje'], ENT_QUOTES, 'UTF-8');
    $lenguaje_p1 = htmlspecialchars($_POST['simul-pregunta-lenguaje1'], ENT_QUOTES, 'UTF-8');
    $lenguaje_p2 = htmlspecialchars($_POST['simul-pregunta-lenguaje2'], ENT_QUOTES, 'UTF-8');
    $lenguaje1=array(
      'lenguaje_status' => $lenguaje_status,
      'lenguaje_p1' => $lenguaje_p1,
      'lenguaje_p2' => $lenguaje_p2
      );
    $lenguaje = json_encode($lenguaje1);
    $matematicas_status = htmlspecialchars($_POST['matematicas'], ENT_QUOTES, 'UTF-8');
    $matematicas_p1 = htmlspecialchars($_POST['simul-pregunta-matematicas1'], ENT_QUOTES, 'UTF-8');
    $matematicas_p2 = htmlspecialchars($_POST['simul-pregunta-matematicas2'], ENT_QUOTES, 'UTF-8');
    $matematicas1=array(
      'matematicas_status' => $matematicas_status,
      'matematicas_p1' => $matematicas_p1,
      'matematicas_p2' => $matematicas_p2
      );
    $matematicas = json_encode($matematicas1);
    $sociales_status = htmlspecialchars($_POST['sociales'], ENT_QUOTES, 'UTF-8');
    $sociales_p1 = htmlspecialchars($_POST['simul-pregunta-sociales1'], ENT_QUOTES, 'UTF-8');
    $sociales_p2 = htmlspecialchars($_POST['simul-pregunta-sociales2'], ENT_QUOTES, 'UTF-8');
    $sociales1=array(
      'sociales_status' => $sociales_status,
      'sociales_p1' => $sociales_p1,
      'sociales_p2' => $sociales_p2
      );
    $sociales = json_encode($sociales1);
    $filosofia_status = htmlspecialchars($_POST['filosofia'], ENT_QUOTES, 'UTF-8');
    $filosofia_p1 = htmlspecialchars($_POST['simul-pregunta-filosofia1'], ENT_QUOTES, 'UTF-8');
    $filosofia_p2 = htmlspecialchars($_POST['simul-pregunta-filosofia2'], ENT_QUOTES, 'UTF-8');
    $filosofia1=array(
      'filosofia_status' => $filosofia_status,
      'filosofia_p1' => $filosofia_p1,
      'filosofia_p2' => $filosofia_p2
      );
    $filosofia = json_encode($filosofia1);
    $fisica_status = htmlspecialchars($_POST['fisica'], ENT_QUOTES, 'UTF-8');
    $fisica_p1 = htmlspecialchars($_POST['simul-pregunta-fisica1'], ENT_QUOTES, 'UTF-8');
    $fisica_p2 = htmlspecialchars($_POST['simul-pregunta-fisica2'], ENT_QUOTES, 'UTF-8');
    $fisica1=array(
      'fisica_status' => $fisica_status,
      'fisica_p1' => $fisica_p1,
      'fisica_p2' => $fisica_p2
      );
    $fisica = json_encode($fisica1);
    try {
      $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_cod_grado=?");
      $stmt->bind_param("i", $grado);
      $stmt->execute();
      $result_grado = $stmt->get_result();
      $result_grado2 = $result_grado->fetch_assoc();
      $cod_grado = $result_grado2['gdo_des_grado'];
      $stmt = $conn->prepare("SELECT simul_orden FROM simulacros WHERE simul_id=?");
      $stmt->bind_param("i", $simul_id_act);
      $stmt->execute();
      $result_simul = $stmt->get_result();
      $result_simul2 = $result_simul->fetch_assoc();
      $orden3 = $result_simul2['simul_orden'];
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 
  
    
    $banco = "simulacros/subidos/$cod_grado/";
    $ext = pathinfo($_FILES['simul-pdf']['name'], PATHINFO_EXTENSION);
    if (!is_dir($banco)) {
      mkdir($banco, 0755, true);
    }
    $simul_status = 1;
    if (move_uploaded_file($_FILES['simul-pdf']['tmp_name'], $banco . 'G'.$grado.'S'.$orden3. "." . $ext)) {
      $doc_url = $banco . 'G'.$grado.'S'.$orden3. "." . $ext;
      try {
        $stmt = $conn->prepare("UPDATE simulacros SET simul_materia_ingles=?, simul_materia_naturales=?, simul_materia_lenguaje=?, simul_materia_matematicas=?, simul_materia_sociales=?, simul_materia_filosofia=?, simul_materia_fisica=?, simul_inst=?, simul_fecha=?, simul_tiempo=?, simul_ruta=?, simul_editado=NOW() WHERE simul_id=?");
        $stmt->bind_param("sssssssssssi", $ingles, $naturales, $lenguaje, $matematicas, $sociales, $filosofia, $fisica, $inst, $fecha, $tiempo, $doc_url, $simul_id_act);
        $stmt->execute();
        $id_registro = $stmt->affected_rows;
        if($id_registro > 0){
          $respuesta = array(
            'respuesta' => 'exito',
            'id_creado' => $id_registro,
            'grado' => $cod_grado
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        };
        $stmt->close();
        $conn->close();
      } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
      } 
    } else {
      try {
        $stmt = $conn->prepare("UPDATE simulacros SET simul_materia_ingles=?, simul_materia_naturales=?, simul_materia_lenguaje=?, simul_materia_matematicas=?, simul_materia_sociales=?, simul_materia_filosofia=?, simul_materia_fisica=?, simul_inst=?, simul_fecha=?, simul_tiempo=?, simul_editado=NOW() WHERE simul_id=?");
        $stmt->bind_param("ssssssssssi", $ingles, $naturales, $lenguaje, $matematicas, $sociales, $filosofia, $fisica, $inst, $fecha, $tiempo, $simul_id_act);
        $stmt->execute();
        $id_registro = $stmt->affected_rows;
        if($id_registro > 0){
          $respuesta = array(
            'respuesta' => 'exito',
            'id_creado' => $id_registro,
            'grado' => $cod_grado
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        };
        $stmt->close();
        $conn->close();
      } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
      } 
    } 
    
    die(json_encode($respuesta));
 
  }
  //::::::::REGISTRAR RESPUESTAS::::::::://
  if($_POST['simul-comando'] == 'respuestas'){
    $simul_id = htmlspecialchars($_POST['evaluacion'], FILTER_SANITIZE_NUMBER_INT);
    $simul_tp = htmlspecialchars($_POST['evaluaciontp'], FILTER_SANITIZE_NUMBER_INT);
    $alum_id = htmlspecialchars($_POST['alum_id'], FILTER_SANITIZE_NUMBER_INT);
    try {
      $stmt = $conn->prepare("SELECT * FROM simulacros WHERE simul_id=?");
      $stmt->bind_param("i", $simul_id);
      $stmt->execute();
      $resultado = $stmt->get_result();
      $info_guia = $resultado->fetch_assoc();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 
    
    $si_ingles = json_decode($info_guia['simul_materia_ingles'], true);
    $si_naturales = json_decode($info_guia['simul_materia_naturales'], true);
    $si_lenguaje = json_decode($info_guia['simul_materia_lenguaje'], true);
    $si_matematicas = json_decode($info_guia['simul_materia_matematicas'], true);
    $si_sociales = json_decode($info_guia['simul_materia_sociales'], true);
    $si_filosofia = json_decode($info_guia['simul_materia_filosofia'], true);
    $si_fisica = json_decode($info_guia['simul_materia_fisica'], true);
   
    $total_preguntas;
    
    $respuestas=array();
    if ($si_ingles['ingles_status'] == 'SI') {
      $ingles_p1_2 = $si_ingles['ingles_p1'];
      $ingles_p2_2 = $si_ingles['ingles_p2'];
      $ingles_p1 = (int) $ingles_p1_2;
      $ingles_p2 = (int) $ingles_p2_2;
      $respuesta1 = 'p-'.$ingles_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_ingles = $ingles_p1;
      for ($i = $ingles_p1; $i < $ingles_p2; $i++) {
        $suma_ingles += 1;
        $respuesta1 = 'p-'.$suma_ingles;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_naturales['naturales_status'] == 'SI') {
      $naturales_p1_2 = $si_naturales['naturales_p1'];
      $naturales_p2_2 = $si_naturales['naturales_p2'];
      $naturales_p1 = (int) $naturales_p1_2;
      $naturales_p2 = (int) $naturales_p2_2;
      $respuesta1 = 'p-'.$naturales_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_naturales = $naturales_p1;
      for ($i = $naturales_p1; $i < $naturales_p2; $i++) {
        $suma_naturales += 1;
        $respuesta1 = 'p-'.$suma_naturales;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_lenguaje['lenguaje_status'] == 'SI') {
      $lenguaje_p1_2 = $si_lenguaje['lenguaje_p1'];
      $lenguaje_p2_2 = $si_lenguaje['lenguaje_p2'];
      $lenguaje_p1 = (int) $lenguaje_p1_2;
      $lenguaje_p2 = (int) $lenguaje_p2_2;
      $respuesta1 = 'p-'.$lenguaje_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_lenguaje = $lenguaje_p1;
      for ($i = $lenguaje_p1; $i < $lenguaje_p2; $i++) {
        $suma_lenguaje += 1;
        $respuesta1 = 'p-'.$suma_lenguaje;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_matematicas['matematicas_status'] == 'SI') {
      $matematicas_p1_2 = $si_matematicas['matematicas_p1'];
      $matematicas_p2_2 = $si_matematicas['matematicas_p2'];
      $matematicas_p1 = (int) $matematicas_p1_2;
      $matematicas_p2 = (int) $matematicas_p2_2;
      $respuesta1 = 'p-'.$matematicas_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_matematicas = $matematicas_p1;
      for ($i = $matematicas_p1; $i < $matematicas_p2; $i++) {
        $suma_matematicas += 1;
        $respuesta1 = 'p-'.$suma_matematicas;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_sociales['sociales_status'] == 'SI') {
      $sociales_p1_2 = $si_sociales['sociales_p1'];
      $sociales_p2_2 = $si_sociales['sociales_p2'];
      $sociales_p1 = (int) $sociales_p1_2;
      $sociales_p2 = (int) $sociales_p2_2;
      $respuesta1 = 'p-'.$sociales_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_sociales = $sociales_p1;
      for ($i = $sociales_p1; $i < $sociales_p2; $i++) {
        $suma_sociales += 1;
        $respuesta1 = 'p-'.$suma_sociales;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_filosofia['filosofia_status'] == 'SI') {
      $filosofia_p1_2 = $si_filosofia['filosofia_p1'];
      $filosofia_p2_2 = $si_filosofia['filosofia_p2'];
      $filosofia_p1 = (int) $filosofia_p1_2;
      $filosofia_p2 = (int) $filosofia_p2_2;
      $respuesta1 = 'p-'.$filosofia_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_filosofia = $filosofia_p1;
      for ($i = $filosofia_p1; $i < $filosofia_p2; $i++) {
        $suma_filosofia += 1;
        $respuesta1 = 'p-'.$suma_filosofia;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    if ($si_fisica['fisica_status'] == 'SI') {
      $fisica_p1_2 = $si_fisica['fisica_p1'];
      $fisica_p2_2 = $si_fisica['fisica_p2'];
      $fisica_p1 = (int) $fisica_p1_2;
      $fisica_p2 = (int) $fisica_p2_2;
      $respuesta1 = 'p-'.$fisica_p1;
      $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
      $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      $suma_fisica = $fisica_p1;
      for ($i = $fisica_p1; $i < $fisica_p2; $i++) {
        $suma_fisica += 1;
        $respuesta1 = 'p-'.$suma_fisica;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $respuestas["" . $respuesta1 . ""] = $respuesta_1;
      }
    }
    $respuestas_final = json_encode($respuestas);
    $status = 1;
    
    try {
      $stmt = $conn->prepare("SELECT alum_grado FROM alumnos WHERE alum_id=?");
      $stmt->bind_param("i", $alum_id);
      $stmt->execute();
      $result_id = $stmt->get_result();
      $result_id2 = $result_id->fetch_assoc();
      $alum_grado = $result_id2['alum_grado'];
      $stmt = $conn->prepare("SELECT gdo_cod_grado FROM grados WHERE gdo_des_grado=?");
      $stmt->bind_param("s", $alum_grado);
      $stmt->execute();
      $result_idx = $stmt->get_result();
      $result_id2x = $result_idx->fetch_assoc();
      $alum_gradox = $result_id2x['gdo_cod_grado'];
      $stmt = $conn->prepare("UPDATE simulacros_e SET simule_respuestas=?, simule_status=?, simule_editado = NOW() WHERE simule_simul_id=? AND simule_alum_id=?");
      $stmt->bind_param("siii", $respuestas_final, $status, $simul_id, $alum_id);
      $stmt->execute();
      $registro = $stmt->affected_rows;
      if($registro > 0){
        $respuesta = array(
          'respuesta' => 'exito',
          'grado' => $alum_gradox
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
      $stmt->close();
      $conn->close();
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } 
    die(json_encode($respuesta));
  
  }
  //::::::::REGISTRAR REVISIÓN DE PREGUNTAS::::::::://
  if($_POST['simul-comando'] == 'respuestas2'){
    $simul_id = htmlspecialchars($_POST['evaluacion'], FILTER_SANITIZE_NUMBER_INT);
    $simul_tp = htmlspecialchars($_POST['evaluaciontp'], FILTER_SANITIZE_NUMBER_INT);
    $result_mat_desc = htmlspecialchars($_POST['result_mat_desc'], ENT_QUOTES, 'UTF-8');
    $simul_p1 = htmlspecialchars($_POST['simul_p1'], FILTER_SANITIZE_NUMBER_INT);
    $simul_p2 = htmlspecialchars($_POST['simul_p2'], FILTER_SANITIZE_NUMBER_INT);
    
    if ($result_mat_desc == 'simul_materia_ingles') {
      $result_mat_desc2 = 'simulr_ingles';
      /////////////////////
      $revisiones=array();
      $control = $simul_p1;
      for ($i = $simul_p1; $i <= $simul_p2; $i++) {
        $respuesta1 = 'p-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pt-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pc-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $control += 1;
      }
      $revisiones_final = json_encode($revisiones);
      try {
        $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
        $stmt->bind_param("si", $revisiones_final, $simul_id);
        $stmt->execute();
  
        $registro = $stmt->affected_rows;
  
        if($registro > 0){
          $respuesta = array(
            'respuesta' => 'exito'
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        };
  
        $stmt->close();
        $conn->close();
  
      } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
      } 
      //////////////////
    } if ($result_mat_desc == 'simul_materia_naturales') {
      $result_mat_desc2 = 'simulr_naturales';
      /////////////////////
      $revisiones=array();
      $control = $simul_p1;
      for ($i = $simul_p1; $i <= $simul_p2; $i++) {
        $respuesta1 = 'p-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pt-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pc-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $control += 1;
      }
      $revisiones_final = json_encode($revisiones);
      try {
        $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
        $stmt->bind_param("si", $revisiones_final, $simul_id);
        $stmt->execute();
  
        $registro = $stmt->affected_rows;
  
        if($registro > 0){
          $respuesta = array(
            'respuesta' => 'exito'
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        };
  
        $stmt->close();
        $conn->close();
  
      } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
      } 
      //////////////////
    } if ($result_mat_desc == 'simul_materia_lenguaje') {
      $result_mat_desc2 = 'simulr_lenguaje';
      /////////////////////
      $revisiones=array();
      $control = $simul_p1;
      for ($i = $simul_p1; $i <= $simul_p2; $i++) {
        $respuesta1 = 'p-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pt-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pc-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $control += 1;
      }
      $revisiones_final = json_encode($revisiones);
      try {
        $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
        $stmt->bind_param("si", $revisiones_final, $simul_id);
        $stmt->execute();
  
        $registro = $stmt->affected_rows;
  
        if($registro > 0){
          $respuesta = array(
            'respuesta' => 'exito'
          );
        } else {
          $respuesta = array(
            'respuesta' => 'error'
          );
        };
  
        $stmt->close();
        $conn->close();
  
      } catch (Exception $e) {
        echo "Error:" . $e->getMessage();
      } 
      //////////////////
      
    } if ($result_mat_desc == 'simul_materia_matematicas') {
      $result_mat_desc2 = 'simulr_matematicas';
      $result_mat_desc3 = 'simulr_fisica';
      /////////////////////
      $fisica_status = htmlspecialchars($_POST['fisica_status'], ENT_QUOTES, 'UTF-8');
      $revisiones=array();
      $control = $simul_p1;
      for ($i = $simul_p1; $i <= $simul_p2; $i++) {
        $respuesta1 = 'p-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pt-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pc-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $control += 1;
      }
      $revisiones_final = json_encode($revisiones);
      if ($fisica_status == 'SI') {
        
        $simul_p1x2 = htmlspecialchars($_POST['simul_p1x2'], FILTER_SANITIZE_NUMBER_INT);
        $simul_p2x2 = htmlspecialchars($_POST['simul_p2x2'], FILTER_SANITIZE_NUMBER_INT);
  
        $revisionesx2=array();
        $controlx2 = $simul_p1x2;
        for ($i = $simul_p1x2; $i <= $simul_p2x2; $i++) {
          $respuesta1x2 = 'p-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $respuesta1x2 = 'pt-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $respuesta1x2 = 'pc-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $controlx2 += 1;
        }
        $revisiones_finalx2 = json_encode($revisionesx2);
        try {
          $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, $result_mat_desc3=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
          $stmt->bind_param("ssi", $revisiones_final, $revisiones_finalx2, $simul_id);
          $stmt->execute();
          $registro = $stmt->affected_rows;
          
    
          if($registro > 0){
            $respuesta = array(
              'respuesta' => 'exito'
            );
          } else {
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
    
          $stmt->close();
          $conn->close();
    
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
        } 
      } else {
        try {
          $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
          $stmt->bind_param("si", $revisiones_final, $simul_id);
          $stmt->execute();
    
          $registro = $stmt->affected_rows;
          
    
          if($registro > 0){
            $respuesta = array(
              'respuesta' => 'exito'
            );
          } else {
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
    
          $stmt->close();
          $conn->close();
    
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
        } 
      }
     
    } if ($result_mat_desc == 'simul_materia_sociales') {
      $result_mat_desc2 = 'simulr_sociales';
      $result_mat_desc3 = 'simulr_filosofia';
      /////////////////////
      $filosofia_status = htmlspecialchars($_POST['filosofia_status'], ENT_QUOTES, 'UTF-8');
      $revisiones=array();
      $control = $simul_p1;
      for ($i = $simul_p1; $i <= $simul_p2; $i++) {
        $respuesta1 = 'p-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pt-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $respuesta1 = 'pc-'.$control;
        $respuesta_1 = htmlspecialchars($_POST["" . $respuesta1 . ""], ENT_QUOTES, 'UTF-8');
        $revisiones["" . $respuesta1 . ""] = $respuesta_1;
        $control += 1;
      }
      $revisiones_final = json_encode($revisiones);
      if ($filosofia_status == 'SI') {
        
        $simul_p1x2 = htmlspecialchars($_POST['simul_p1x2'], FILTER_SANITIZE_NUMBER_INT);
        $simul_p2x2 = htmlspecialchars($_POST['simul_p2x2'], FILTER_SANITIZE_NUMBER_INT);
  
        $revisionesx2=array();
        $controlx2 = $simul_p1x2;
        for ($i = $simul_p1x2; $i <= $simul_p2x2; $i++) {
          $respuesta1x2 = 'p-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $respuesta1x2 = 'pt-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $respuesta1x2 = 'pc-'.$controlx2;
          $respuesta_1x2 = htmlspecialchars($_POST["" . $respuesta1x2 . ""], ENT_QUOTES, 'UTF-8');
          $revisionesx2["" . $respuesta1x2 . ""] = $respuesta_1x2;
          $controlx2 += 1;
        }
        $revisiones_finalx2 = json_encode($revisionesx2);
        try {
          $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, $result_mat_desc3=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
          $stmt->bind_param("ssi", $revisiones_final, $revisiones_finalx2, $simul_id);
          $stmt->execute();
          $registro = $stmt->affected_rows;
          
    
          if($registro > 0){
            $respuesta = array(
              'respuesta' => 'exito'
            );
          } else {
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
    
          $stmt->close();
          $conn->close();
    
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
        } 
      } else {
        try {
          $stmt = $conn->prepare("UPDATE simulacros_r SET $result_mat_desc2=?, simulr_editado = NOW() WHERE simulr_simul_id=?");
          $stmt->bind_param("si", $revisiones_final, $simul_id);
          $stmt->execute();
    
          $registro = $stmt->affected_rows;
          
    
          if($registro > 0){
            $respuesta = array(
              'respuesta' => 'exito'
            );
          } else {
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
    
          $stmt->close();
          $conn->close();
    
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
        } 
      }
    }
  
    
    die(json_encode($respuesta));
      
  } 
  
  //::::::::ASIGNAR HORA FINAL::::::::://
  if($_POST['simul-comando'] == 'hora_final'){
    $minutos = 30;
    $nuevafecha = strtotime ( '+'.$minutos.' minute' , strtotime  ( $hoy ) ) ;
    $nuevafecha = date ( 'd/m/Y H:i A' , $nuevafecha );
    if (!htmlspecialchars($_POST['id_alum'], FILTER_VALIDATE_INT)) {
      die("ERROR!");
    }else {
      $id_alum = $_POST['id_alum'];
      $id_simul = $_POST['id_simul'];
    };
    try {
      $stmt = $conn->prepare("INSERT INTO simulacros_e (simule_simul_id, simule_alum_id, simul_fecha, simul_editado) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiss", $id_simul, $id_alum, $nuevafecha, $hoy);
      $stmt->execute();
      
      $id_registro = $stmt->insert_id;
      if($id_registro > 0){
        $respuesta = array(
          'respuesta' => 'exito',
          'id_creado' => $id_registro,
          'grado' => $cod_grado
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
      $stmt->close();
      $conn->close();
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } 
    die(json_encode($respuesta));
    
    
    //var_dump($entregados);
  }
  //::::::::ASIGNAR NUEVO PLAZO::::::::://
  if($_POST['simul-comando'] == 'nuevo_plazo'){
    
    $simul = htmlspecialchars($_POST['nuevo_plazo_simul_id'], FILTER_SANITIZE_NUMBER_INT);
    $alum = htmlspecialchars($_POST['nuevo_plazo_alum_id'], FILTER_SANITIZE_NUMBER_INT);
    $plazo = htmlspecialchars($_POST['datos_nuevo_plazo'], ENT_QUOTES, 'UTF-8');
    try {
      $stmt = $conn->prepare("UPDATE simulacros_e SET simule_hora_final=?, simule_editado=NOW() WHERE simule_simul_id=? AND simule_alum_id=?");
      $stmt->bind_param("sii", $plazo, $simul, $alum);
      $stmt->execute();
      $id_registro = $stmt->affected_rows;
      if($id_registro > 0){
        $respuesta = array(
          'respuesta' => 'exito',
          'id_creado' => $id_registro,
          'grado' => $cod_grado
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
      $stmt->close();
      $conn->close();
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } 
    die(json_encode($respuesta));
  
  }
  
}
?>
