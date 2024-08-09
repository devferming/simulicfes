<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include_once 'funciones/funciones.php';
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  //$fech1 = date($fecha_nac);
  $fech2 = date('Y-m-d');
  $anio_actual = date("Y");
  //::::::::REGISTRAR ALUMNO::::::::://
  if ($_POST['cmd'] == 'anuevo') {
    $ide_tip = htmlspecialchars($_POST['ide_tip'], ENT_QUOTES, 'UTF-8');
    $ide_num = htmlspecialchars($_POST['ide_num'], ENT_QUOTES, 'UTF-8');
    $per_ape = mb_strtoupper(htmlspecialchars($_POST['per_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $sdo_ape = mb_strtoupper(htmlspecialchars($_POST['sdo_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $per_nom = mb_strtoupper(htmlspecialchars($_POST['per_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $sdo_nom = mb_strtoupper(htmlspecialchars($_POST['sdo_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $ani_esc = $anio_actual;
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');
    $login_p = 0;

    try {
      $stmt = $conn->prepare("INSERT INTO alumnos (alum_id_logins, alum_doc_tipo, alum_doc_numero, alum_1er_apellido, alum_2do_apellido, alum_1er_nombre, alum_2do_nombre, alum_anio_escolar, alum_grado, alum_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssssssss", $login_p, $ide_tip, $ide_num, $per_ape, $sdo_ape, $per_nom, $sdo_nom, $ani_esc, $gra_esc, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      if ($id_registro > 0) {
        $respuesta = array(
          'respuesta' => 'exito',
          'id_alumno' => $id_registro
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }

  //::::::::ACTUALIZAR ALUMNO::::::::://
  if ($_POST['cmd'] == 'aactualizar') {
    $ide_tip = htmlspecialchars($_POST['ide_tip'], ENT_QUOTES, 'UTF-8');
    $ide_num = htmlspecialchars($_POST['ide_num'], ENT_QUOTES, 'UTF-8');
    $per_ape = mb_strtoupper(htmlspecialchars($_POST['per_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $sdo_ape = mb_strtoupper(htmlspecialchars($_POST['sdo_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $per_nom = mb_strtoupper(htmlspecialchars($_POST['per_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $sdo_nom = mb_strtoupper(htmlspecialchars($_POST['sdo_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $alu_id = htmlspecialchars($_POST['alu_id'], FILTER_SANITIZE_NUMBER_INT);
    $ani_esc = $anio_actual;
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');

    try {
      $stmt = $conn->prepare("UPDATE alumnos SET alum_doc_tipo=?, alum_doc_numero=?, alum_1er_apellido=?, alum_2do_apellido=?, alum_1er_nombre=?, alum_2do_nombre=?, alum_anio_escolar=?, alum_grado=?, alum_editado = NOW() WHERE alum_id = ?");
      $stmt->bind_param("ssssssssi", $ide_tip, $ide_num, $per_ape, $sdo_ape, $per_nom, $sdo_nom, $ani_esc, $gra_esc, $alu_id);
      $stmt->execute();

      if ($stmt->affected_rows) {
        $respuesta = array(
          'respuesta' => 'exito'
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };

    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }

  //::::::::REGISTRAR GRADO::::::::://
  if ($_POST['cmd'] == 'gnuevo') {
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');
    $sec_esc = htmlspecialchars($_POST['sec_esc'], ENT_QUOTES, 'UTF-8');

    $gdo_des_grado = $gra_esc . ' (' . $sec_esc . ')';

    try {
      $stmt = $conn->prepare("INSERT INTO grados (gdo_des_grado, gdo_editado) VALUES (?, ?)");
      $stmt->bind_param("ss", $gdo_des_grado, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      if ($id_registro > 0) {
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
    die(json_encode($respuesta));
  }

  //::::::::REGISTRAR GRADO::::::::://
  if ($_POST['cmd'] == 'gdelete') {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

    try {
      $stmt = $conn->prepare("DELETE FROM grados WHERE gdo_id=?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      if ($stmt->affected_rows) {
        $respuesta = array(
          'respuesta' => 'exito'
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }
}
