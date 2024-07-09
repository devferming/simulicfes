<?php
if($_SERVER["REQUEST_METHOD"] === "POST")
{
  include_once 'funciones/funciones.php';
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  //::::::::::::::CREAR USUARIO:::::::::::::::://
  if($_POST['user'] == 'nuevo'){
    $user_ide_tip = htmlspecialchars($_POST['user_ide_tip'], ENT_QUOTES, 'UTF-8');
    $user_ide_num = htmlspecialchars($_POST['user_ide_num'], ENT_QUOTES, 'UTF-8');
    $user_per_ape = mb_strtoupper(htmlspecialchars($_POST['user_per_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_sdo_ape = mb_strtoupper(htmlspecialchars($_POST['user_sdo_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_per_nom = mb_strtoupper(htmlspecialchars($_POST['user_per_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_sdo_nom = mb_strtoupper(htmlspecialchars($_POST['user_sdo_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_gen = htmlspecialchars($_POST['user_gen'], ENT_QUOTES, 'UTF-8');
    $user_nac_fec2 = htmlspecialchars($_POST['user_nac_fec'], ENT_QUOTES, 'UTF-8');
    $user_nac_fec = DateTime::createFromFormat('d/m/Y', $user_nac_fec2)->format('Y-m-d'); 
    $user_nac_lug = mb_strtoupper(htmlspecialchars($_POST['user_nac_lug'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_nac_dep = mb_strtoupper(htmlspecialchars($_POST['user_nac_dep'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_dir = mb_strtoupper(htmlspecialchars($_POST['user_dir_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_mun = mb_strtoupper(htmlspecialchars($_POST['user_dir_mun'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_bar = mb_strtoupper(htmlspecialchars($_POST['user_dir_bar'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_tel_mov = htmlspecialchars($_POST['user_tel_mov'], ENT_QUOTES, 'UTF-8');
    $user_tel_loc = htmlspecialchars($_POST['user_tel_loc'], ENT_QUOTES, 'UTF-8');
    $user_mai = htmlspecialchars($_POST['user_mai'], ENT_QUOTES, 'UTF-8');
    $user_ipj = htmlspecialchars($_POST['ipj'], ENT_QUOTES, 'UTF-8');
    $user_ij = htmlspecialchars($_POST['ij'], ENT_QUOTES, 'UTF-8');
    $user_itrans = htmlspecialchars($_POST['itrans'], ENT_QUOTES, 'UTF-8');
    $user_iprimero = htmlspecialchars($_POST['iprimero'], ENT_QUOTES, 'UTF-8');
    $user_isegundo = htmlspecialchars($_POST['isegundo'], ENT_QUOTES, 'UTF-8');
    $user_itercero = htmlspecialchars($_POST['itercero'], ENT_QUOTES, 'UTF-8');
    $user_icuarto = htmlspecialchars($_POST['icuarto'], ENT_QUOTES, 'UTF-8');
    $user_iquinto = htmlspecialchars($_POST['iquinto'], ENT_QUOTES, 'UTF-8');
    $user_isexto = htmlspecialchars($_POST['isexto'], ENT_QUOTES, 'UTF-8');
    $user_iseptimo = htmlspecialchars($_POST['iseptimo'], ENT_QUOTES, 'UTF-8');
    $user_ioctavo = htmlspecialchars($_POST['ioctavo'], ENT_QUOTES, 'UTF-8');
    $user_inoveno = htmlspecialchars($_POST['inoveno'], ENT_QUOTES, 'UTF-8');
    $user_idecimo = htmlspecialchars($_POST['idecimo'], ENT_QUOTES, 'UTF-8');
    $user_iundecimo = htmlspecialchars($_POST['iundecimo'], ENT_QUOTES, 'UTF-8');
    $user_rol = htmlspecialchars($_POST['user_rol'], ENT_QUOTES, 'UTF-8');
    $user_materia = htmlspecialchars($_POST['user_materia'], ENT_QUOTES, 'UTF-8');
    $user_dgrupo = htmlspecialchars($_POST['user_dgrupo'], ENT_QUOTES, 'UTF-8');
    $user_dgrupo_seccion = htmlspecialchars($_POST['user_dgrupo_seccion'], ENT_QUOTES, 'UTF-8');
    $usuario = strtolower(htmlspecialchars($_POST['user_user'], ENT_QUOTES, 'UTF-8'));
    $password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');
    $acceso = htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8');
    $nombre = $user_per_nom . " " . $user_per_ape;
    $intentos = 0;
    $status = 'ACTIVO';
    
    try {
        $opciones = [
          'cost' => 12,
        ];
      $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones). "/n";
      $stmt = $conn->prepare("INSERT INTO logins (logins_nickname, logins_nombre, logins_password, logins_nivel, logins_intentos, logins_status, logins_editado) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssiiss", $usuario, $nombre, $password_hashed, $acceso, $intentos, $status, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;
      if($id_registro > 0){
        try {
          $stmt = $conn->prepare("INSERT INTO usuarios (users_doc_tipo, users_doc_numero, users_1er_apellido, users_2do_apellido, users_1er_nombre, users_2do_nombre, users_genero, users_nac_fecha, users_nac_lugar, users_departamento, users_municipio, users_barrio, users_direccion, users_telf_movil, users_telf_local, users_mail, users_rol, users_asignatura, users_dgrupo, users_dgrupo_seccion, users_id_logins, users_pj, users_j, users_t, users_1ro, users_2do, users_3ro, users_4to, users_5to, users_6to, users_7mo, users_8vo, users_9no, users_10mo, users_11mo, user_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssssssssssssssssssssssssssssssssss", $user_ide_tip, $user_ide_num, $user_per_ape, $user_sdo_ape, $user_per_nom, $user_sdo_nom, $user_gen, $user_nac_fec, $user_nac_lug, $user_nac_dep, $user_dir_mun, $user_dir_bar, $user_dir_dir, $user_tel_mov, $user_tel_loc, $user_mai, $user_rol, $user_materia, $user_dgrupo, $user_dgrupo_seccion, $id_registro, $user_ipj, $user_ij, $user_itrans, $user_iprimero, $user_isegundo, $user_itercero, $user_icuarto, $user_iquinto, $user_isexto, $user_iseptimo, $user_ioctavo, $user_inoveno, $user_idecimo, $user_iundecimo, $hoy);
          $stmt->execute();
          $id_registro2 = $stmt->insert_id;
          
          
          if($id_registro2 > 0){
          
              $respuesta = array(
                  'respuesta' => 'exito',
                  'id_usuario' => $id_registro2
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
  //::::::::::::::ACTUALIZAR USUARIO:::::::::::::::://
  if($_POST['user'] == 'actualizar'){
    $user_ide_tip = htmlspecialchars($_POST['user_ide_tip'], ENT_QUOTES, 'UTF-8');
    $user_ide_num = htmlspecialchars($_POST['user_ide_num'], ENT_QUOTES, 'UTF-8');
    $user_per_ape = mb_strtoupper(htmlspecialchars($_POST['user_per_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_sdo_ape = mb_strtoupper(htmlspecialchars($_POST['user_sdo_ape'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_per_nom = mb_strtoupper(htmlspecialchars($_POST['user_per_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_sdo_nom = mb_strtoupper(htmlspecialchars($_POST['user_sdo_nom'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_gen = htmlspecialchars($_POST['user_gen'], ENT_QUOTES, 'UTF-8');
    $user_nac_fec2 = htmlspecialchars($_POST['user_nac_fec'], ENT_QUOTES, 'UTF-8');
    $user_nac_fec = DateTime::createFromFormat('d/m/Y', $user_nac_fec2)->format('Y-m-d'); 
    $user_nac_lug = mb_strtoupper(htmlspecialchars($_POST['user_nac_lug'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_nac_dep = mb_strtoupper(htmlspecialchars($_POST['user_nac_dep'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_dir = mb_strtoupper(htmlspecialchars($_POST['user_dir_dir'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_mun = mb_strtoupper(htmlspecialchars($_POST['user_dir_mun'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_dir_bar = mb_strtoupper(htmlspecialchars($_POST['user_dir_bar'], ENT_QUOTES, 'UTF-8'),'utf-8');
    $user_tel_mov = htmlspecialchars($_POST['user_tel_mov'], ENT_QUOTES, 'UTF-8');
    $user_tel_loc = htmlspecialchars($_POST['user_tel_loc'], ENT_QUOTES, 'UTF-8');
    $user_mai = htmlspecialchars($_POST['user_mai'], ENT_QUOTES, 'UTF-8');
    $user_ipj = htmlspecialchars($_POST['ipj'], ENT_QUOTES, 'UTF-8');
    $user_ij = htmlspecialchars($_POST['ij'], ENT_QUOTES, 'UTF-8');
    $user_itrans = htmlspecialchars($_POST['itrans'], ENT_QUOTES, 'UTF-8');
    $user_iprimero = htmlspecialchars($_POST['iprimero'], ENT_QUOTES, 'UTF-8');
    $user_isegundo = htmlspecialchars($_POST['isegundo'], ENT_QUOTES, 'UTF-8');
    $user_itercero = htmlspecialchars($_POST['itercero'], ENT_QUOTES, 'UTF-8');
    $user_icuarto = htmlspecialchars($_POST['icuarto'], ENT_QUOTES, 'UTF-8');
    $user_iquinto = htmlspecialchars($_POST['iquinto'], ENT_QUOTES, 'UTF-8');
    $user_isexto = htmlspecialchars($_POST['isexto'], ENT_QUOTES, 'UTF-8');
    $user_iseptimo = htmlspecialchars($_POST['iseptimo'], ENT_QUOTES, 'UTF-8');
    $user_ioctavo = htmlspecialchars($_POST['ioctavo'], ENT_QUOTES, 'UTF-8');
    $user_inoveno = htmlspecialchars($_POST['inoveno'], ENT_QUOTES, 'UTF-8');
    $user_idecimo = htmlspecialchars($_POST['idecimo'], ENT_QUOTES, 'UTF-8');
    $user_iundecimo = htmlspecialchars($_POST['iundecimo'], ENT_QUOTES, 'UTF-8');
    $user_rol = htmlspecialchars($_POST['user_rol'], ENT_QUOTES, 'UTF-8');
    $user_materia = htmlspecialchars($_POST['user_materia'], ENT_QUOTES, 'UTF-8');
    $user_dgrupo = htmlspecialchars($_POST['user_dgrupo'], ENT_QUOTES, 'UTF-8');
    $user_dgrupo_seccion = htmlspecialchars($_POST['user_dgrupo_seccion'], ENT_QUOTES, 'UTF-8');
    $usuario = strtolower(htmlspecialchars($_POST['user_user'], ENT_QUOTES, 'UTF-8'));
    //$password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');
    $acceso = htmlspecialchars($_POST['nivel'], FILTER_VALIDATE_INT);
    $id_logins = htmlspecialchars($_POST['id_logins'], FILTER_VALIDATE_INT);
    $nombre = $user_per_nom . " " . $user_per_ape;
    $intentos = 0;
    $status = 'ACTIVO';
    try {
      $stmt = $conn->prepare("UPDATE logins SET logins_nickname=?, logins_nombre=?, logins_nivel=?, logins_intentos=?, logins_status=?, logins_editado= NOW() WHERE logins_id_login =?");
      $stmt->bind_param("ssiisi", $usuario, $nombre, $acceso, $intentos, $status, $id_logins);
      $stmt->execute();
      if($stmt->affected_rows){
        try {
          $stmt = $conn->prepare("UPDATE usuarios SET users_doc_tipo=?, users_doc_numero=?, users_1er_apellido=?, users_2do_apellido=?, users_1er_nombre=?, users_2do_nombre=?, users_genero=?, users_nac_fecha=?, users_nac_lugar=?, users_departamento=?, users_municipio=?, users_barrio=?, users_direccion=?, users_telf_movil=?, users_telf_local=?, users_mail=?, users_rol=?, users_asignatura=?, users_dgrupo=?, users_dgrupo_seccion=?, users_pj=?, users_j=?, users_t=?, users_1ro=?, users_2do=?, users_3ro=?, users_4to=?, users_5to=?, users_6to=?, users_7mo=?, users_8vo=?, users_9no=?, users_10mo=?, users_11mo=?, user_editado= NOW() WHERE users_id_logins=?");
          $stmt->bind_param("ssssssssssssssssssssssssssssssssssi", $user_ide_tip, $user_ide_num, $user_per_ape, $user_sdo_ape, $user_per_nom, $user_sdo_nom, $user_gen, $user_nac_fec, $user_nac_lug, $user_nac_dep, $user_dir_mun, $user_dir_bar, $user_dir_dir, $user_tel_mov, $user_tel_loc, $user_mai, $user_rol, $user_materia, $user_dgrupo, $user_dgrupo_seccion, $user_ipj, $user_ij, $user_itrans, $user_iprimero, $user_isegundo, $user_itercero, $user_icuarto, $user_iquinto, $user_isexto, $user_iseptimo, $user_ioctavo, $user_inoveno, $user_idecimo, $user_iundecimo, $id_logins);
          $stmt->execute();
          if($stmt->affected_rows){
          
              $respuesta = array(
                  'respuesta' => 'exito',
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
  //::::::::::::::CONSULTA LOGIN USUARIO:::::::::::::::://
  if($_POST['user'] == 'login'){
    $id_logins = htmlspecialchars($_POST['id_user'], FILTER_VALIDATE_INT);
    try {
      $stmt = $conn->prepare("SELECT * FROM logins WHERE logins_id_login=?");
      $stmt->bind_param("i", $id_logins);
      $stmt->execute();
      $resultado = $stmt->get_result();
      $fila = $resultado->fetch_assoc();
      if($resultado->num_rows >= "1"){
      $respuesta = array(
      'id' => $fila['logins_id_login'],
      'nombre' => $fila['logins_nombre'],
      'nickname' => $fila['logins_nickname']
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
  //::::::::::::::ACTUALIZAR LOGIN USUARIO:::::::::::::::://
  if($_POST['user'] == 'login_act'){
    $id_logins = htmlspecialchars($_POST['id_login_l'], FILTER_VALIDATE_INT);
    $user_name = htmlspecialchars($_POST['user_nombre_l'], ENT_QUOTES, 'UTF-8');
    $user_nick= strtolower(htmlspecialchars($_POST['user_nick_l'], ENT_QUOTES, 'UTF-8'));
    $user_pass = htmlspecialchars($_POST['user_password_l'], ENT_QUOTES, 'UTF-8');
    try {
      $opciones = [
        'cost' => 12,
      ];
    $password_hashed = password_hash($user_pass, PASSWORD_BCRYPT, $opciones). "/n";
    $stmt = $conn->prepare("UPDATE logins SET logins_nickname=?, logins_nombre=?, logins_password=?, logins_editado= NOW() WHERE logins_id_login =?");
    $stmt->bind_param("sssi", $user_nick, $user_name, $password_hashed, $id_logins);
    $stmt->execute();
    if($stmt->affected_rows){
      $respuesta = array(
        'respuesta' => 'exito',
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
  //:::::::::::ACTUALIZAR ADMINISTRADOR:::::::::::::://
  /*if($_POST['registro'] == 'actualizar'){
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $acceso = $_POST['nivel'];
    $password = $_POST['password'];
    $id_registro = $_POST['id_registro'];
    try {
      if (empty($_POST['password'])) {
        $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW(), nivel = ? WHERE id_admin = ?");
        $stmt->bind_param("ssii", $usuario, $nombre, $acceso, $id_registro);
      } else {
        $opciones = array(
            'cost' => 12
        );
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW(), nivel = ? WHERE id_admin = ?");
        $stmt->bind_param("sssii", $usuario, $nombre, $password_hashed, $acceso, $id_registro);
      };
      $stmt->execute();
      if ($stmt->affected_rows) {
        $respuesta = array(
          'respuesta' => 'exito',
          'id_actualizado' => $stmt->insert_id
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
  //:::::::::::ELIMINAR ADMINISTRADOR:::::::::::::://
  if($_POST['registro'] == 'eliminar'){
    $id_borrar = $_POST['id'];
    try {
      $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin = ?");
      $stmt->bind_param("i", $id_borrar);
      $stmt->execute();
      if ($stmt->affected_rows) {
        $respuesta = array(
          'respuesta' => 'exito',
          'id_eliminado' => $id_borrar
        );
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      }
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    }
    die(json_encode($respuesta));
  }*/
}
?>
