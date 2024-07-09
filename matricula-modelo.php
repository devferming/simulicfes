<?php
if($_SERVER["REQUEST_METHOD"] === "POST")
{
  include_once 'funciones/funciones.php';
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  //$fech1 = date($fecha_nac);
  $fech2 = date('Y-m-d');
  $anio_actual = date("Y");
  //::::::::REGISTRAR ALUMNO::::::::://
  if($_POST['alumno'] == 'nuevo'){
    $ide_tip = htmlspecialchars($_POST['ide_tip'], ENT_QUOTES, 'UTF-8');
    $ide_num = htmlspecialchars($_POST['ide_num'], ENT_QUOTES, 'UTF-8');
    $ide_exp = mb_strtoupper(htmlspecialchars($_POST['ide_exp'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_ape = mb_strtoupper(htmlspecialchars($_POST['per_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_ape = mb_strtoupper(htmlspecialchars($_POST['sdo_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_nom = mb_strtoupper(htmlspecialchars($_POST['per_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_nom = mb_strtoupper(htmlspecialchars($_POST['sdo_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_gen = htmlspecialchars($_POST['alu_gen'], ENT_QUOTES, 'UTF-8');
    $nac_fec1 = htmlspecialchars($_POST['nac_fec'], ENT_QUOTES, 'UTF-8');
    $nac_fec = DateTime::createFromFormat('d/m/Y', $nac_fec1)->format('Y-m-d');  
    $nac_lug = mb_strtoupper(htmlspecialchars($_POST['nac_lug'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $nac_dep = mb_strtoupper(htmlspecialchars($_POST['nac_dep'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_dir = mb_strtoupper(htmlspecialchars($_POST['dir_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_mun = mb_strtoupper(htmlspecialchars($_POST['dir_mun'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_bar = mb_strtoupper(htmlspecialchars($_POST['dir_bar'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $tel_mov = htmlspecialchars($_POST['tel_mov'], ENT_QUOTES, 'UTF-8');
    $tel_loc = htmlspecialchars($_POST['tel_loc'], ENT_QUOTES, 'UTF-8');
    $alu_mai = htmlspecialchars($_POST['alu_mai'], ENT_QUOTES, 'UTF-8');
    $mad_tdo = htmlspecialchars($_POST['mad_tdo'], ENT_QUOTES, 'UTF-8');
    $mad_ndo = htmlspecialchars($_POST['mad_ndo'], ENT_QUOTES, 'UTF-8');
    $mad_edo = mb_strtoupper(htmlspecialchars($_POST['mad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1ap = mb_strtoupper(htmlspecialchars($_POST['mad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2ap = mb_strtoupper(htmlspecialchars($_POST['mad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1no = mb_strtoupper(htmlspecialchars($_POST['mad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2no = mb_strtoupper(htmlspecialchars($_POST['mad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_dir = mb_strtoupper(htmlspecialchars($_POST['mad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_tmo = htmlspecialchars($_POST['mad_tmo'], ENT_QUOTES, 'UTF-8');
    $mad_tlo = htmlspecialchars($_POST['mad_tlo'], ENT_QUOTES, 'UTF-8');
    $mad_mai = htmlspecialchars($_POST['mad_mai'], ENT_QUOTES, 'UTF-8');
    $pad_tdo = htmlspecialchars($_POST['pad_tdo'], ENT_QUOTES, 'UTF-8');
    $pad_ndo = htmlspecialchars($_POST['pad_ndo'], ENT_QUOTES, 'UTF-8');
    $pad_edo = mb_strtoupper(htmlspecialchars($_POST['pad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1ap = mb_strtoupper(htmlspecialchars($_POST['pad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2ap = mb_strtoupper(htmlspecialchars($_POST['pad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1no = mb_strtoupper(htmlspecialchars($_POST['pad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2no = mb_strtoupper(htmlspecialchars($_POST['pad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_dir = mb_strtoupper(htmlspecialchars($_POST['pad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_tmo = htmlspecialchars($_POST['pad_tmo'], ENT_QUOTES, 'UTF-8');
    $pad_tlo = htmlspecialchars($_POST['pad_tlo'], ENT_QUOTES, 'UTF-8');
    $pad_mai = htmlspecialchars($_POST['pad_mai'], ENT_QUOTES, 'UTF-8');
    $acu_tdo = htmlspecialchars($_POST['acu_tdo'], ENT_QUOTES, 'UTF-8');
    $acu_ndo = htmlspecialchars($_POST['acu_ndo'], ENT_QUOTES, 'UTF-8');
    $acu_edo = mb_strtoupper(htmlspecialchars($_POST['acu_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1ap = mb_strtoupper(htmlspecialchars($_POST['acu_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2ap = mb_strtoupper(htmlspecialchars($_POST['acu_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1no = mb_strtoupper(htmlspecialchars($_POST['acu_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2no = mb_strtoupper(htmlspecialchars($_POST['acu_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_dir = mb_strtoupper(htmlspecialchars($_POST['acu_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_tmo = htmlspecialchars($_POST['acu_tmo'], ENT_QUOTES, 'UTF-8');
    $acu_tlo = htmlspecialchars($_POST['acu_tlo'], ENT_QUOTES, 'UTF-8');
    $acu_mai = htmlspecialchars($_POST['acu_mai'], ENT_QUOTES, 'UTF-8');
    $acu_par = htmlspecialchars($_POST['acu_par'], ENT_QUOTES, 'UTF-8');
    $alu_0 = mb_strtoupper(htmlspecialchars($_POST['alu_0'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_1 = mb_strtoupper(htmlspecialchars($_POST['alu_1'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_2 = mb_strtoupper(htmlspecialchars($_POST['alu_2'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_3 = mb_strtoupper(htmlspecialchars($_POST['alu_3'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_4 = mb_strtoupper(htmlspecialchars($_POST['alu_4'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_5 = mb_strtoupper(htmlspecialchars($_POST['alu_5'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_6 = mb_strtoupper(htmlspecialchars($_POST['alu_6'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_7 = mb_strtoupper(htmlspecialchars($_POST['alu_7'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_8 = mb_strtoupper(htmlspecialchars($_POST['alu_8'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_9 = mb_strtoupper(htmlspecialchars($_POST['alu_9'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_10 = mb_strtoupper(htmlspecialchars($_POST['alu_10'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_11 = mb_strtoupper(htmlspecialchars($_POST['alu_11'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $ani_esc = 2022;
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');
    $sec_esc = htmlspecialchars($_POST['sec_esc'], ENT_QUOTES, 'UTF-8');
    $ban_ofe = htmlspecialchars($_POST['ban_ofe'], ENT_QUOTES, 'UTF-8');
    $obs_mat = htmlspecialchars($_POST['obs_mat'], ENT_QUOTES, 'UTF-8');
    $mad_par = 'MADRE';
    $pad_par = 'PADRE';
    $alu_sta = 'MATRICULADO';
    $login_p = 0;
    try {
      $stmt = $conn->prepare("INSERT INTO alumnos (alum_id_logins, alum_doc_tipo, alum_doc_numero, alum_doc_lugar, alum_1er_apellido, alum_2do_apellido, alum_1er_nombre, alum_2do_nombre, alum_genero, alum_nac_fecha, alum_nac_lugar, alum_departamento, alum_direccion, alum_municipio, alum_barrio, alum_telf_movil, alum_telf_local, alum_mail, alum_grado_0, alum_grado_1, alum_grado_2, alum_grado_3, alum_grado_4, alum_grado_5, alum_grado_6, alum_grado_7, alum_grado_8, alum_grado_9, alum_grado_10, alum_grado_11, alum_anio_escolar, alum_grado, alum_seccion, alum_banco_ofe, alum_observacion, alum_estatus, alum_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssssssssssssssssssssssssssssssss", $login_p, $ide_tip, $ide_num, $ide_exp, $per_ape, $sdo_ape, $per_nom, $sdo_nom, $alu_gen, $nac_fec, $nac_lug, $nac_dep, $dir_dir, $dir_mun, $dir_bar, $tel_mov, $tel_loc, $alu_mai, $alu_0, $alu_1, $alu_2, $alu_3, $alu_4, $alu_5, $alu_6, $alu_7, $alu_8, $alu_9, $alu_10, $alu_11, $ani_esc, $gra_esc, $sec_esc, $ban_ofe, $obs_mat, $alu_sta, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      if($id_registro > 0){
        try {
          $stmt = $conn->prepare("INSERT INTO padres (padres_id_alumno, padres_parentesco, padres_doc_tipo, padres_doc_numero, padres_doc_lugar, padres_1er_apellido, padres_2do_apellido, padres_1er_nombre, padres_2do_nombre, padres_direccion, padres_telf_movil, padres_telf_local, padres_mail, padres_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("isssssssssssss", $id_registro, $mad_par, $mad_tdo, $mad_ndo, $mad_edo, $mad_1ap, $mad_2ap, $mad_1no, $mad_2no, $mad_dir, $mad_tmo, $mad_tlo, $mad_mai, $hoy);
          $stmt->execute();
          $stmt->bind_param("isssssssssssss", $id_registro, $pad_par, $pad_tdo, $pad_ndo, $pad_edo, $pad_1ap, $pad_2ap, $pad_1no, $pad_2no, $pad_dir, $pad_tmo, $pad_tlo, $pad_mai, $hoy);
          $stmt->execute();
          $stmt = $conn->prepare("INSERT INTO acudientes (acu_id_alumno, acu_parentesco, acu_doc_tipo, acu_doc_numero, acu_doc_lugar, acu_1er_apellido, acu_2do_apellido, acu_1er_nombre, acu_2do_nombre, acu_direccion, acu_telf_movil, acu_telf_local, acu_mail, acu_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("isssssssssssss", $id_registro, $acu_par, $acu_tdo, $acu_ndo, $acu_edo, $acu_1ap, $acu_2ap, $acu_1no, $acu_2no, $acu_dir, $acu_tmo, $acu_tlo, $acu_mai, $hoy);
          $stmt->execute();
          if($stmt->affected_rows){
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
        }
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
  //::::::::REGISTRAR ALUMNO2::::::::://
  if($_POST['alumno'] == 'nuevo2'){
    $alu_id = htmlspecialchars($_POST['id_alumno'], FILTER_SANITIZE_NUMBER_INT);
    $ide_tip = htmlspecialchars($_POST['ide_tip'], ENT_QUOTES, 'UTF-8');
    $ide_num = htmlspecialchars($_POST['ide_num'], ENT_QUOTES, 'UTF-8');
    $ide_exp = mb_strtoupper(htmlspecialchars($_POST['ide_exp'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_ape = mb_strtoupper(htmlspecialchars($_POST['per_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_ape = mb_strtoupper(htmlspecialchars($_POST['sdo_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_nom = mb_strtoupper(htmlspecialchars($_POST['per_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_nom = mb_strtoupper(htmlspecialchars($_POST['sdo_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_gen = htmlspecialchars($_POST['alu_gen'], ENT_QUOTES, 'UTF-8');
    $nac_fec1 = htmlspecialchars($_POST['nac_fec'], ENT_QUOTES, 'UTF-8');
    $nac_fec = DateTime::createFromFormat('d/m/Y', $nac_fec1)->format('Y-m-d');  
    $nac_lug = mb_strtoupper(htmlspecialchars($_POST['nac_lug'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $nac_dep = mb_strtoupper(htmlspecialchars($_POST['nac_dep'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_dir = mb_strtoupper(htmlspecialchars($_POST['dir_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_mun = mb_strtoupper(htmlspecialchars($_POST['dir_mun'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_bar = mb_strtoupper(htmlspecialchars($_POST['dir_bar'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $tel_mov = htmlspecialchars($_POST['tel_mov'], ENT_QUOTES, 'UTF-8');
    $tel_loc = htmlspecialchars($_POST['tel_loc'], ENT_QUOTES, 'UTF-8');
    $alu_mai = htmlspecialchars($_POST['alu_mai'], ENT_QUOTES, 'UTF-8');
    $mad_tdo = htmlspecialchars($_POST['mad_tdo'], ENT_QUOTES, 'UTF-8');
    $mad_ndo = htmlspecialchars($_POST['mad_ndo'], ENT_QUOTES, 'UTF-8');
    $mad_edo = mb_strtoupper(htmlspecialchars($_POST['mad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1ap = mb_strtoupper(htmlspecialchars($_POST['mad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2ap = mb_strtoupper(htmlspecialchars($_POST['mad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1no = mb_strtoupper(htmlspecialchars($_POST['mad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2no = mb_strtoupper(htmlspecialchars($_POST['mad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_dir = mb_strtoupper(htmlspecialchars($_POST['mad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_tmo = htmlspecialchars($_POST['mad_tmo'], ENT_QUOTES, 'UTF-8');
    $mad_tlo = htmlspecialchars($_POST['mad_tlo'], ENT_QUOTES, 'UTF-8');
    $mad_mai = htmlspecialchars($_POST['mad_mai'], ENT_QUOTES, 'UTF-8');
    $pad_tdo = htmlspecialchars($_POST['pad_tdo'], ENT_QUOTES, 'UTF-8');
    $pad_ndo = htmlspecialchars($_POST['pad_ndo'], ENT_QUOTES, 'UTF-8');
    $pad_edo = mb_strtoupper(htmlspecialchars($_POST['pad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1ap = mb_strtoupper(htmlspecialchars($_POST['pad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2ap = mb_strtoupper(htmlspecialchars($_POST['pad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1no = mb_strtoupper(htmlspecialchars($_POST['pad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2no = mb_strtoupper(htmlspecialchars($_POST['pad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_dir = mb_strtoupper(htmlspecialchars($_POST['pad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_tmo = htmlspecialchars($_POST['pad_tmo'], ENT_QUOTES, 'UTF-8');
    $pad_tlo = htmlspecialchars($_POST['pad_tlo'], ENT_QUOTES, 'UTF-8');
    $pad_mai = htmlspecialchars($_POST['pad_mai'], ENT_QUOTES, 'UTF-8');
    $acu_tdo = htmlspecialchars($_POST['acu_tdo'], ENT_QUOTES, 'UTF-8');
    $acu_ndo = htmlspecialchars($_POST['acu_ndo'], ENT_QUOTES, 'UTF-8');
    $acu_edo = mb_strtoupper(htmlspecialchars($_POST['acu_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1ap = mb_strtoupper(htmlspecialchars($_POST['acu_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2ap = mb_strtoupper(htmlspecialchars($_POST['acu_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1no = mb_strtoupper(htmlspecialchars($_POST['acu_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2no = mb_strtoupper(htmlspecialchars($_POST['acu_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_dir = mb_strtoupper(htmlspecialchars($_POST['acu_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_tmo = htmlspecialchars($_POST['acu_tmo'], ENT_QUOTES, 'UTF-8');
    $acu_tlo = htmlspecialchars($_POST['acu_tlo'], ENT_QUOTES, 'UTF-8');
    $acu_mai = htmlspecialchars($_POST['acu_mai'], ENT_QUOTES, 'UTF-8');
    $acu_par = htmlspecialchars($_POST['acu_par'], ENT_QUOTES, 'UTF-8');
    $alu_0 = mb_strtoupper(htmlspecialchars($_POST['alu_0'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_1 = mb_strtoupper(htmlspecialchars($_POST['alu_1'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_2 = mb_strtoupper(htmlspecialchars($_POST['alu_2'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_3 = mb_strtoupper(htmlspecialchars($_POST['alu_3'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_4 = mb_strtoupper(htmlspecialchars($_POST['alu_4'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_5 = mb_strtoupper(htmlspecialchars($_POST['alu_5'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_6 = mb_strtoupper(htmlspecialchars($_POST['alu_6'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_7 = mb_strtoupper(htmlspecialchars($_POST['alu_7'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_8 = mb_strtoupper(htmlspecialchars($_POST['alu_8'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_9 = mb_strtoupper(htmlspecialchars($_POST['alu_9'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_10 = mb_strtoupper(htmlspecialchars($_POST['alu_10'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_11 = mb_strtoupper(htmlspecialchars($_POST['alu_11'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $ani_esc = $anio_actual;
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');
    $sec_esc = htmlspecialchars($_POST['sec_esc'], ENT_QUOTES, 'UTF-8');
    $ban_ofe = htmlspecialchars($_POST['ban_ofe'], ENT_QUOTES, 'UTF-8');
    $obs_mat = htmlspecialchars($_POST['obs_mat'], ENT_QUOTES, 'UTF-8');
    $mad_par = 'MADRE';
    $pad_par = 'PADRE';
    $alu_sta = 'MATRICULADO';
    $login_p = 0;
    try {
      $stmt = $conn->prepare("INSERT INTO alumnos (alum_id, alum_id_logins, alum_doc_tipo, alum_doc_numero, alum_doc_lugar, alum_1er_apellido, alum_2do_apellido, alum_1er_nombre, alum_2do_nombre, alum_genero, alum_nac_fecha, alum_nac_lugar, alum_departamento, alum_direccion, alum_municipio, alum_barrio, alum_telf_movil, alum_telf_local, alum_mail, alum_grado_0, alum_grado_1, alum_grado_2, alum_grado_3, alum_grado_4, alum_grado_5, alum_grado_6, alum_grado_7, alum_grado_8, alum_grado_9, alum_grado_10, alum_grado_11, alum_anio_escolar, alum_grado, alum_seccion, alum_banco_ofe, alum_observacion, alum_estatus, alum_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssssssssssssssssssssssssssssssssssss", $alu_id, $login_p, $ide_tip, $ide_num, $ide_exp, $per_ape, $sdo_ape, $per_nom, $sdo_nom, $alu_gen, $nac_fec, $nac_lug, $nac_dep, $dir_dir, $dir_mun, $dir_bar, $tel_mov, $tel_loc, $alu_mai, $alu_0, $alu_1, $alu_2, $alu_3, $alu_4, $alu_5, $alu_6, $alu_7, $alu_8, $alu_9, $alu_10, $alu_11, $ani_esc, $gra_esc, $sec_esc, $ban_ofe, $obs_mat, $alu_sta, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      if($id_registro > 0){
        try {
          $stmt = $conn->prepare("UPDATE padres SET padres_doc_tipo=?, padres_doc_numero=?, padres_doc_lugar=?, padres_1er_apellido=?, padres_2do_apellido=?, padres_1er_nombre=?, padres_2do_nombre=?, padres_direccion=?, padres_telf_movil=?, padres_telf_local=?, padres_mail=?, padres_editado = NOW() WHERE padres_id_alumno=? AND padres_parentesco=?");
          $stmt->bind_param("sssssssssssis", $mad_tdo, $mad_ndo, $mad_edo, $mad_1ap, $mad_2ap, $mad_1no, $mad_2no, $mad_dir, $mad_tmo, $mad_tlo, $mad_mai, $alu_id, $mad_par);
          $stmt->execute();
          $stmt = $conn->prepare("UPDATE padres SET padres_doc_tipo=?, padres_doc_numero=?, padres_doc_lugar=?, padres_1er_apellido=?, padres_2do_apellido=?, padres_1er_nombre=?, padres_2do_nombre=?, padres_direccion=?, padres_telf_movil=?, padres_telf_local=?, padres_mail=?, padres_editado = NOW() WHERE padres_id_alumno=? AND padres_parentesco=?");
          $stmt->bind_param("sssssssssssis", $pad_tdo, $pad_ndo, $pad_edo, $pad_1ap, $pad_2ap, $pad_1no, $pad_2no, $pad_dir, $pad_tmo, $pad_tlo, $pad_mai, $alu_id, $pad_par);
          $stmt->execute();
          $stmt = $conn->prepare("UPDATE acudientes SET acu_parentesco=?, acu_doc_tipo=?, acu_doc_numero=?, acu_doc_lugar=?, acu_1er_apellido=?, acu_2do_apellido=?, acu_1er_nombre=?, acu_2do_nombre=?, acu_direccion=?, acu_telf_movil=?, acu_telf_local=?, acu_mail=?, acu_editado = NOW() WHERE acu_id_alumno=?");
          $stmt->bind_param("ssssssssssssi", $acu_par, $acu_tdo, $acu_ndo, $acu_edo, $acu_1ap, $acu_2ap, $acu_1no, $acu_2no, $acu_dir, $acu_tmo, $acu_tlo, $acu_mai, $alu_id);
          $stmt->execute();
          if($stmt->affected_rows){
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
        }
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
  
  //::::::::ACTUALIZAR ALUMNO::::::::://
  if($_POST['alumno'] == 'actualizar'){
    $ide_tip = htmlspecialchars($_POST['ide_tip'], ENT_QUOTES, 'UTF-8');
    $ide_num = htmlspecialchars($_POST['ide_num'], ENT_QUOTES, 'UTF-8');
    $ide_exp = mb_strtoupper(htmlspecialchars($_POST['ide_exp'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_ape = mb_strtoupper(htmlspecialchars($_POST['per_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_ape = mb_strtoupper(htmlspecialchars($_POST['sdo_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $per_nom = mb_strtoupper(htmlspecialchars($_POST['per_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $sdo_nom = mb_strtoupper(htmlspecialchars($_POST['sdo_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_gen = htmlspecialchars($_POST['alu_gen'], ENT_QUOTES, 'UTF-8');
    $nac_fec1 = htmlspecialchars($_POST['nac_fec'], ENT_QUOTES, 'UTF-8');
    $nac_fec = DateTime::createFromFormat('d/m/Y', $nac_fec1)->format('Y-m-d');  
    $nac_lug = mb_strtoupper(htmlspecialchars($_POST['nac_lug'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $nac_dep = mb_strtoupper(htmlspecialchars($_POST['nac_dep'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_dir = mb_strtoupper(htmlspecialchars($_POST['dir_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_mun = mb_strtoupper(htmlspecialchars($_POST['dir_mun'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $dir_bar = mb_strtoupper(htmlspecialchars($_POST['dir_bar'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $tel_mov = htmlspecialchars($_POST['tel_mov'], ENT_QUOTES, 'UTF-8');
    $tel_loc = htmlspecialchars($_POST['tel_loc'], ENT_QUOTES, 'UTF-8');
    $alu_mai = htmlspecialchars($_POST['alu_mai'], ENT_QUOTES, 'UTF-8');
    $mad_tdo = htmlspecialchars($_POST['mad_tdo'], ENT_QUOTES, 'UTF-8');
    $mad_ndo = htmlspecialchars($_POST['mad_ndo'], ENT_QUOTES, 'UTF-8');
    $mad_edo = mb_strtoupper(htmlspecialchars($_POST['mad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1ap = mb_strtoupper(htmlspecialchars($_POST['mad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2ap = mb_strtoupper(htmlspecialchars($_POST['mad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_1no = mb_strtoupper(htmlspecialchars($_POST['mad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_2no = mb_strtoupper(htmlspecialchars($_POST['mad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_dir = mb_strtoupper(htmlspecialchars($_POST['mad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $mad_tmo = htmlspecialchars($_POST['mad_tmo'], ENT_QUOTES, 'UTF-8');
    $mad_tlo = htmlspecialchars($_POST['mad_tlo'], ENT_QUOTES, 'UTF-8');
    $mad_mai = htmlspecialchars($_POST['mad_mai'], ENT_QUOTES, 'UTF-8');
    $pad_tdo = htmlspecialchars($_POST['pad_tdo'], ENT_QUOTES, 'UTF-8');
    $pad_ndo = htmlspecialchars($_POST['pad_ndo'], ENT_QUOTES, 'UTF-8');
    $pad_edo = mb_strtoupper(htmlspecialchars($_POST['pad_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1ap = mb_strtoupper(htmlspecialchars($_POST['pad_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2ap = mb_strtoupper(htmlspecialchars($_POST['pad_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_1no = mb_strtoupper(htmlspecialchars($_POST['pad_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_2no = mb_strtoupper(htmlspecialchars($_POST['pad_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_dir = mb_strtoupper(htmlspecialchars($_POST['pad_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $pad_tmo = htmlspecialchars($_POST['pad_tmo'], ENT_QUOTES, 'UTF-8');
    $pad_tlo = htmlspecialchars($_POST['pad_tlo'], ENT_QUOTES, 'UTF-8');
    $pad_mai = htmlspecialchars($_POST['pad_mai'], ENT_QUOTES, 'UTF-8');
    $acu_tdo = htmlspecialchars($_POST['acu_tdo'], ENT_QUOTES, 'UTF-8');
    $acu_ndo = htmlspecialchars($_POST['acu_ndo'], ENT_QUOTES, 'UTF-8');
    $acu_edo = mb_strtoupper(htmlspecialchars($_POST['acu_edo'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1ap = mb_strtoupper(htmlspecialchars($_POST['acu_1ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2ap = mb_strtoupper(htmlspecialchars($_POST['acu_2ap'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_1no = mb_strtoupper(htmlspecialchars($_POST['acu_1no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_2no = mb_strtoupper(htmlspecialchars($_POST['acu_2no'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_dir = mb_strtoupper(htmlspecialchars($_POST['acu_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $acu_tmo = htmlspecialchars($_POST['acu_tmo'], ENT_QUOTES, 'UTF-8');
    $acu_tlo = htmlspecialchars($_POST['acu_tlo'], ENT_QUOTES, 'UTF-8');
    $acu_mai = htmlspecialchars($_POST['acu_mai'], ENT_QUOTES, 'UTF-8');
    $acu_par = htmlspecialchars($_POST['acu_par'], ENT_QUOTES, 'UTF-8');
    $alu_0 = mb_strtoupper(htmlspecialchars($_POST['alu_0'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_1 = mb_strtoupper(htmlspecialchars($_POST['alu_1'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_2 = mb_strtoupper(htmlspecialchars($_POST['alu_2'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_3 = mb_strtoupper(htmlspecialchars($_POST['alu_3'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_4 = mb_strtoupper(htmlspecialchars($_POST['alu_4'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_5 = mb_strtoupper(htmlspecialchars($_POST['alu_5'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_6 = mb_strtoupper(htmlspecialchars($_POST['alu_6'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_7 = mb_strtoupper(htmlspecialchars($_POST['alu_7'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_8 = mb_strtoupper(htmlspecialchars($_POST['alu_8'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_9 = mb_strtoupper(htmlspecialchars($_POST['alu_9'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_10 = mb_strtoupper(htmlspecialchars($_POST['alu_10'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_11 = mb_strtoupper(htmlspecialchars($_POST['alu_11'], ENT_QUOTES, 'UTF-8'),'utf-8');
    
    $alu_sta = mb_strtoupper(htmlspecialchars($_POST['alu_status'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $alu_id = htmlspecialchars($_POST['alu_id'], FILTER_SANITIZE_NUMBER_INT);
    $ani_esc = $anio_actual;
    $gra_esc = htmlspecialchars($_POST['gra_esc'], ENT_QUOTES, 'UTF-8');
    $sec_esc = htmlspecialchars($_POST['sec_esc'], ENT_QUOTES, 'UTF-8');
    $ban_ofe = htmlspecialchars($_POST['ban_ofe'], ENT_QUOTES, 'UTF-8');
    $obs_mat = htmlspecialchars($_POST['obs_mat'], ENT_QUOTES, 'UTF-8');
    $mad_par = 'MADRE';
    $pad_par = 'PADRE';
    $login_p = 0;
    try {
      $stmt = $conn->prepare("UPDATE alumnos SET alum_doc_tipo=?, alum_doc_numero=?, alum_doc_lugar=?, alum_1er_apellido=?, alum_2do_apellido=?, alum_1er_nombre=?, alum_2do_nombre=?, alum_genero=?, alum_nac_fecha=?, alum_nac_lugar=?, alum_departamento=?, alum_direccion=?, alum_municipio=?, alum_barrio=?, alum_telf_movil=?, alum_telf_local=?, alum_mail=?, alum_grado_0=?, alum_grado_1=?, alum_grado_2=?, alum_grado_3=?, alum_grado_4=?, alum_grado_5=?, alum_grado_6=?, alum_grado_7=?, alum_grado_8=?, alum_grado_9=?, alum_grado_10=?, alum_grado_11=?, alum_anio_escolar=?, alum_grado=?, alum_seccion=?, alum_banco_ofe=?, alum_observacion=?, alum_estatus=?, alum_editado = NOW() WHERE alum_id = ?");
      $stmt->bind_param("sssssssssssssssssssssssssssssssssssi", $ide_tip, $ide_num, $ide_exp, $per_ape, $sdo_ape, $per_nom, $sdo_nom, $alu_gen, $nac_fec, $nac_lug, $nac_dep, $dir_dir, $dir_mun, $dir_bar, $tel_mov, $tel_loc, $alu_mai, $alu_0, $alu_1, $alu_2, $alu_3, $alu_4, $alu_5, $alu_6, $alu_7, $alu_8, $alu_9, $alu_10, $alu_11, $ani_esc, $gra_esc, $sec_esc, $ban_ofe, $obs_mat, $alu_sta, $alu_id);
      $stmt->execute();
      if($stmt->affected_rows){
        try {
          $stmt = $conn->prepare("UPDATE padres SET padres_doc_tipo=?, padres_doc_numero=?, padres_doc_lugar=?, padres_1er_apellido=?, padres_2do_apellido=?, padres_1er_nombre=?, padres_2do_nombre=?, padres_direccion=?, padres_telf_movil=?, padres_telf_local=?, padres_mail=?, padres_editado = NOW() WHERE padres_id_alumno=? AND padres_parentesco=?");
          $stmt->bind_param("sssssssssssis", $mad_tdo, $mad_ndo, $mad_edo, $mad_1ap, $mad_2ap, $mad_1no, $mad_2no, $mad_dir, $mad_tmo, $mad_tlo, $mad_mai, $alu_id, $mad_par);
          $stmt->execute();
          $stmt = $conn->prepare("UPDATE padres SET padres_doc_tipo=?, padres_doc_numero=?, padres_doc_lugar=?, padres_1er_apellido=?, padres_2do_apellido=?, padres_1er_nombre=?, padres_2do_nombre=?, padres_direccion=?, padres_telf_movil=?, padres_telf_local=?, padres_mail=?, padres_editado = NOW() WHERE padres_id_alumno=? AND padres_parentesco=?");
          $stmt->bind_param("sssssssssssis", $pad_tdo, $pad_ndo, $pad_edo, $pad_1ap, $pad_2ap, $pad_1no, $pad_2no, $pad_dir, $pad_tmo, $pad_tlo, $pad_mai, $alu_id, $pad_par);
          $stmt->execute();
          $stmt = $conn->prepare("UPDATE acudientes SET acu_parentesco=?, acu_doc_tipo=?, acu_doc_numero=?, acu_doc_lugar=?, acu_1er_apellido=?, acu_2do_apellido=?, acu_1er_nombre=?, acu_2do_nombre=?, acu_direccion=?, acu_telf_movil=?, acu_telf_local=?, acu_mail=?, acu_editado = NOW() WHERE acu_id_alumno=?");
          $stmt->bind_param("ssssssssssssi", $acu_par, $acu_tdo, $acu_ndo, $acu_edo, $acu_1ap, $acu_2ap, $acu_1no, $acu_2no, $acu_dir, $acu_tmo, $acu_tlo, $acu_mai, $alu_id);
          $stmt->execute();
          if($stmt->affected_rows){
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
        }
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
  
  //::::::::BUSCAR ALUMNO::::::::://
  if($_POST['alumno'] == 'buscar'){
    $alu_id = htmlspecialchars($_POST['id_alumno'], FILTER_SANITIZE_NUMBER_INT);
    try {
      $stmt = $conn->prepare("SELECT * FROM egresados WHERE alum_id=?");
      $stmt->bind_param("i", $alu_id);
      $stmt->execute();
      $resultado = $stmt->get_result();
      $datos_alum = $resultado->fetch_assoc();
    
      
    
      if($stmt->affected_rows){
        
        $alum_id2 = $datos_alum['alum_id'];
        $alum_doc_tipo = $datos_alum['alum_doc_tipo'];
        $alum_doc_numero = $datos_alum['alum_doc_numero'];
        $alum_doc_lugar = $datos_alum['alum_doc_lugar'];
        $alum_1er_apellido = $datos_alum['alum_1er_apellido'];
        $alum_2do_apellido = $datos_alum['alum_2do_apellido'];
        $alum_1er_nombre = $datos_alum['alum_1er_nombre'];
        $alum_2do_nombre = $datos_alum['alum_2do_nombre'];
        $alum_genero = $datos_alum['alum_genero'];
        $alum_nac_fecha2 = $datos_alum['alum_nac_fecha'];
        $alum_nac_fecha = DateTime::createFromFormat('Y-m-d', $alum_nac_fecha2)->format('d/m/Y');
        $alum_nac_lugar = $datos_alum['alum_nac_lugar'];
        $alum_departamento = $datos_alum['alum_departamento'];
        $alum_municipio = $datos_alum['alum_municipio'];
        $alum_direccion = $datos_alum['alum_direccion'];
        $alum_barrio = $datos_alum['alum_barrio'];
        $alum_telf_movil = $datos_alum['alum_telf_movil'];
        $alum_telf_local = $datos_alum['alum_telf_local'];
        $alum_mail = $datos_alum['alum_mail'];
        $alum_grado_0 = $datos_alum['alum_grado_0'];
        $alum_grado_1 = $datos_alum['alum_grado_1'];
        $alum_grado_2 = $datos_alum['alum_grado_2'];
        $alum_grado_3 = $datos_alum['alum_grado_3'];
        $alum_grado_4 = $datos_alum['alum_grado_4'];
        $alum_grado_5 = $datos_alum['alum_grado_5'];
        $alum_grado_6 = $datos_alum['alum_grado_6'];
        $alum_grado_7 = $datos_alum['alum_grado_7'];
        $alum_grado_8 = $datos_alum['alum_grado_8'];
        $alum_grado_9 = $datos_alum['alum_grado_9'];
        $alum_grado_10 = $datos_alum['alum_grado_10'];
        $alum_grado_11 = $datos_alum['alum_grado_11'];
        $stmt = $conn->prepare("SELECT * FROM acudientes WHERE acu_id_alumno=?");
        $stmt->bind_param("i", $alu_id);
        $stmt->execute();
        $resultado2 = $stmt->get_result();
        $datos_alum2 = $resultado2->fetch_assoc();
  
        $acu_parentesco = $datos_alum2['acu_parentesco'];
        $acu_doc_tipo = $datos_alum2['acu_doc_tipo'];
        $acu_doc_numero = $datos_alum2['acu_doc_numero'];
        $acu_doc_lugar = $datos_alum2['acu_doc_lugar'];
        $acu_1er_apellido = $datos_alum2['acu_1er_apellido'];
        $acu_2do_apellido = $datos_alum2['acu_2do_apellido'];
        $acu_1er_nombre = $datos_alum2['acu_1er_nombre'];
        $acu_2do_nombre = $datos_alum2['acu_2do_nombre'];
        $acu_direccion = $datos_alum2['acu_direccion'];
        $acu_telf_movil = $datos_alum2['acu_telf_movil'];
        $acu_telf_local = $datos_alum2['acu_telf_local'];
        $acu_mail = $datos_alum2['acu_mail'];
        $mad_paren = 'MADRE';
        $pad_paren = 'PADRE';
        $stmt = $conn->prepare("SELECT * FROM padres WHERE padres_id_alumno=? AND padres_parentesco=?");
        $stmt->bind_param("is", $alu_id, $mad_paren);
        $stmt->execute();
        $resultado3 = $stmt->get_result();
        $datos_alum3 = $resultado3->fetch_assoc();
        $stmt->bind_param("is", $alu_id, $pad_paren);
        $stmt->execute();
        $resultado4 = $stmt->get_result();
        $datos_alum4 = $resultado4->fetch_assoc();
        $madre_doc_tipo = $datos_alum3['padres_doc_tipo'];
        $madre_doc_numero = $datos_alum3['padres_doc_numero'];
        $madre_doc_lugar = $datos_alum3['padres_doc_lugar'];
        $madre_1er_apellido = $datos_alum3['padres_1er_apellido'];
        $madre_2do_apellido = $datos_alum3['padres_2do_apellido'];
        $madre_1er_nombre = $datos_alum3['padres_1er_nombre'];
        $madre_2do_nombre = $datos_alum3['padres_2do_nombre'];
        $madre_direccion = $datos_alum3['padres_direccion'];
        $madre_telf_movil = $datos_alum3['padres_telf_movil'];
        $madre_telf_local = $datos_alum3['padres_telf_local'];
        $madre_mail = $datos_alum3['padres_mail'];
        $padre_doc_tipo = $datos_alum4['padres_doc_tipo'];
        $padre_doc_numero = $datos_alum4['padres_doc_numero'];
        $padre_doc_lugar = $datos_alum4['padres_doc_lugar'];
        $padre_1er_apellido = $datos_alum4['padres_1er_apellido'];
        $padre_2do_apellido = $datos_alum4['padres_2do_apellido'];
        $padre_1er_nombre = $datos_alum4['padres_1er_nombre'];
        $padre_2do_nombre = $datos_alum4['padres_2do_nombre'];
        $padre_direccion = $datos_alum4['padres_direccion'];
        $padre_telf_movil = $datos_alum4['padres_telf_movil'];
        $padre_telf_local = $datos_alum4['padres_telf_local'];
        $padre_mail = $datos_alum4['padres_mail'];
        $respuesta = array(
          'respuesta' => 'exito',
          'id_alum2' => $alum_id2,
          'alum_doc_tipo' => $alum_doc_tipo,
          'alum_doc_numero' => $alum_doc_numero,
          'alum_doc_lugar' => $alum_doc_lugar,
          
          'alum_1er_apellido' => $alum_1er_apellido,
          'alum_2do_apellido' => $alum_2do_apellido,
          'alum_1er_nombre' => $alum_1er_nombre,
          'alum_2do_nombre' => $alum_2do_nombre,
          'alum_genero' => $alum_genero,
          'alum_nac_fecha' => $alum_nac_fecha,
          'alum_nac_lugar' => $alum_nac_lugar,
          'alum_departamento' => $alum_departamento,
          'alum_municipio' => $alum_municipio,
          'alum_direccion' => $alum_direccion,
          'alum_barrio' => $alum_barrio,
          'alum_telf_movil' => $alum_telf_movil,
          'alum_telf_local' => $alum_telf_local,
          'alum_mail' => $alum_mail,
          'alum_grado_0' => $alum_grado_0,
          'alum_grado_1' => $alum_grado_1,
          'alum_grado_2' => $alum_grado_2,
          'alum_grado_3' => $alum_grado_3,
          'alum_grado_4' => $alum_grado_4,
          'alum_grado_5' => $alum_grado_5,
          'alum_grado_6' => $alum_grado_6,
          'alum_grado_7' => $alum_grado_7,
          'alum_grado_8' => $alum_grado_8,
          'alum_grado_9' => $alum_grado_9,
          'alum_grado_10' => $alum_grado_10,
          'alum_grado_11' => $alum_grado_11,
          'acu_parentesco' => $acu_parentesco,
          'acu_doc_tipo' => $acu_doc_tipo,
          'acu_doc_numero' => $acu_doc_numero,
          'acu_doc_lugar' => $acu_doc_lugar,
          'acu_1er_apellido' => $acu_1er_apellido,
          'acu_2do_apellido' => $acu_2do_apellido,
          'acu_1er_nombre' => $acu_1er_nombre,
          'acu_2do_nombre' => $acu_2do_nombre,
          'acu_direccion' => $acu_direccion,
          'acu_telf_movil' => $acu_telf_movil,
          'acu_telf_local' => $acu_telf_local,
          'acu_mail' => $acu_mail,
          'madre_doc_tipo' => $madre_doc_tipo,
          'madre_doc_numero' => $madre_doc_numero,
          'madre_doc_lugar' => $madre_doc_lugar,
          'madre_1er_apellido' => $madre_1er_apellido,
          'madre_2do_apellido' => $madre_2do_apellido,
          'madre_1er_nombre' => $madre_1er_nombre,
          'madre_2do_nombre' => $madre_2do_nombre,
          'madre_direccion' => $madre_direccion,
          'madre_telf_movil' => $madre_telf_movil,
          'madre_telf_local' => $madre_telf_local,
          'madre_mail' => $madre_mail,
          'padre_doc_tipo' => $padre_doc_tipo,
          'padre_doc_numero' => $padre_doc_numero,
          'padre_doc_lugar' => $padre_doc_lugar,
          'padre_1er_apellido' => $padre_1er_apellido,
          'padre_2do_apellido' => $padre_2do_apellido,
          'padre_1er_nombre' => $padre_1er_nombre,
          'padre_2do_nombre' => $padre_2do_nombre,
          'padre_direccion' => $padre_direccion,
          'padre_telf_movil' => $padre_telf_movil,
          'padre_telf_local' => $padre_telf_local,
          'padre_mail' => $padre_mail
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      };
    
    
    
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
    
    die(json_encode($respuesta)); 
    
  } 
}
?>
