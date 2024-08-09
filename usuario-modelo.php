<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include_once 'funciones/funciones.php';
  date_default_timezone_set('America/Bogota');
  $hoy = date("Y-m-d H:i:s");
  //::::::::::::::CREAR USUARIO:::::::::::::::://
  if ($_POST['user'] == 'nuevo') {
    $user_ide_tip = htmlspecialchars($_POST['user_ide_tip'], ENT_QUOTES, 'UTF-8');
    $user_ide_num = htmlspecialchars($_POST['user_ide_num'], ENT_QUOTES, 'UTF-8');
    $user_per_ape = mb_strtoupper(htmlspecialchars($_POST['user_per_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_ape = mb_strtoupper(htmlspecialchars($_POST['user_sdo_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_per_nom = mb_strtoupper(htmlspecialchars($_POST['user_per_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_nom = mb_strtoupper(htmlspecialchars($_POST['user_sdo_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');

    $user_rol = htmlspecialchars($_POST['user_rol'], ENT_QUOTES, 'UTF-8');
    $user_materia = htmlspecialchars($_POST['user_materia'], ENT_QUOTES, 'UTF-8');

    $usuario = strtolower(htmlspecialchars($_POST['user_user'], ENT_QUOTES, 'UTF-8'));
    $password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');
    $acceso = htmlspecialchars($_POST['nivel'], FILTER_SANITIZE_NUMBER_INT);

    $nombre = $user_per_nom . " " . $user_per_ape;
    $intentos = 0;
    $status = 'ACTIVO';

    $user_grados_array = array();

    try {
      $stmt = $conn->prepare("SELECT * FROM grados");
      $stmt->execute();
      $resultado = $stmt->get_result();
      while ($datos_grado = $resultado->fetch_assoc()) {
        $crr_grado = htmlspecialchars($_POST['g-' . $datos_grado['gdo_id']], ENT_QUOTES, 'UTF-8');

        if ($crr_grado === 'SI') {
          array_push($user_grados_array, $datos_grado['gdo_des_grado']);
        }
      }
      $user_grados = json_encode($user_grados_array);
    } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    try {

      $opciones = ['cost' => 12];
      $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones) . "/n";

      $stmt = $conn->prepare("INSERT INTO logins (logins_nickname, logins_nombre, logins_password, logins_nivel, logins_intentos, logins_status, logins_editado) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssiiss", $usuario, $nombre, $password_hashed, $acceso, $intentos, $status, $hoy);
      $stmt->execute();
      $id_registro = $stmt->insert_id;

      if ($id_registro > 0) {
        try {

          $stmt_err = $conn->prepare("DELETE FROM logins WHERE logins_id_login=?");
          $stmt_err->bind_param("i", $id_registro);

          $stmt = $conn->prepare("INSERT INTO usuarios (users_doc_tipo, users_doc_numero, users_1er_apellido, users_2do_apellido, users_1er_nombre, users_2do_nombre, users_rol, users_asignatura, users_id_logins, users_grados, user_editado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("sssssssssss", $user_ide_tip, $user_ide_num, $user_per_ape, $user_sdo_ape, $user_per_nom, $user_sdo_nom, $user_rol, $user_materia, $id_registro, $user_grados, $hoy);
          $stmt->execute();
          $id_registro2 = $stmt->insert_id;

          if ($id_registro2 > 0) {
            $respuesta = array(
              'respuesta' => 'exito',
              'id_usuario' => $id_registro2
            );
          } else {
            $stmt_err->execute();
            $respuesta = array(
              'respuesta' => 'error'
            );
          };
        } catch (Exception $e) {
          echo "Error:" . $e->getMessage();
          $stmt_err->execute();
        }
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
  //::::::::::::::ACTUALIZAR USUARIO:::::::::::::::://
  if ($_POST['user'] == 'actualizar') {

    $id_logins = htmlspecialchars($_POST['id_logins'], FILTER_VALIDATE_INT);
    $user_ide_tip = htmlspecialchars($_POST['user_ide_tip'], ENT_QUOTES, 'UTF-8');
    $user_ide_num = htmlspecialchars($_POST['user_ide_num'], ENT_QUOTES, 'UTF-8');
    $user_per_ape = mb_strtoupper(htmlspecialchars($_POST['user_per_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_ape = mb_strtoupper(htmlspecialchars($_POST['user_sdo_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_per_nom = mb_strtoupper(htmlspecialchars($_POST['user_per_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_nom = mb_strtoupper(htmlspecialchars($_POST['user_sdo_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');

    $user_rol = htmlspecialchars($_POST['user_rol'], ENT_QUOTES, 'UTF-8');
    $user_materia = htmlspecialchars($_POST['user_materia'], ENT_QUOTES, 'UTF-8');

    $usuario = strtolower(htmlspecialchars($_POST['user_user'], ENT_QUOTES, 'UTF-8'));
    $acceso = htmlspecialchars($_POST['nivel'], FILTER_SANITIZE_NUMBER_INT);

    $nombre = $user_per_nom . " " . $user_per_ape;
    $intentos = 0;
    $status = 'ACTIVO';

    $user_grados_array = array();

    try {
      $stmt = $conn->prepare("SELECT * FROM grados");
      $stmt->execute();
      $resultado = $stmt->get_result();
      while ($datos_grado = $resultado->fetch_assoc()) {
        $crr_grado = htmlspecialchars($_POST['g-' . $datos_grado['gdo_id']], ENT_QUOTES, 'UTF-8');

        if ($crr_grado === 'SI') {
          array_push($user_grados_array, $datos_grado['gdo_des_grado']);
        }
      }
      $user_grados = json_encode($user_grados_array);
    } catch (\Exception $e) {
      $error = $e->getMessage();
      echo $error;
    }

    try {
      $stmt = $conn->prepare("UPDATE logins SET logins_nickname=?, logins_nombre=?, logins_nivel=?, logins_intentos=?, logins_status=?, logins_editado= NOW() WHERE logins_id_login =?");
      $stmt->bind_param("ssiisi", $usuario, $nombre, $acceso, $intentos, $status, $id_logins);
      $stmt->execute();

      if ($stmt->affected_rows) {

        try {
          $stmt = $conn->prepare("UPDATE usuarios SET users_doc_tipo=?, users_doc_numero=?, users_1er_apellido=?, users_2do_apellido=?, users_1er_nombre=?, users_2do_nombre=?, users_rol=?, users_asignatura=?, users_grados=?, user_editado= NOW() WHERE users_id_logins=?");
          $stmt->bind_param("sssssssssi", $user_ide_tip, $user_ide_num, $user_per_ape, $user_sdo_ape, $user_per_nom, $user_sdo_nom, $user_rol, $user_materia, $user_grados, $id_logins);
          $stmt->execute();

          if ($stmt->affected_rows) {
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
    } catch (Exception $e) {
      echo "Error:" . $e->getMessage();
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }
  //::::::::::::::ACTUALIZAR USUARIO:::::::::::::::://
  if ($_POST['user'] == 'actcorta') {

    $id_logins = htmlspecialchars($_POST['id_logins'], FILTER_VALIDATE_INT);
    $user_ide_tip = htmlspecialchars($_POST['user_ide_tip'], ENT_QUOTES, 'UTF-8');
    $user_ide_num = htmlspecialchars($_POST['user_ide_num'], ENT_QUOTES, 'UTF-8');
    $user_per_ape = mb_strtoupper(htmlspecialchars($_POST['user_per_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_ape = mb_strtoupper(htmlspecialchars($_POST['user_sdo_ape'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_per_nom = mb_strtoupper(htmlspecialchars($_POST['user_per_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');
    $user_sdo_nom = mb_strtoupper(htmlspecialchars($_POST['user_sdo_nom'], ENT_QUOTES, 'UTF-8'), 'utf-8');


    try {
      $stmt = $conn->prepare("UPDATE usuarios SET users_doc_tipo=?, users_doc_numero=?, users_1er_apellido=?, users_2do_apellido=?, users_1er_nombre=?, users_2do_nombre=?, user_editado= NOW() WHERE users_id_logins=?");
      $stmt->bind_param("ssssssi", $user_ide_tip, $user_ide_num, $user_per_ape, $user_sdo_ape, $user_per_nom, $user_sdo_nom, $id_logins);
      $stmt->execute();

      if ($stmt->affected_rows) {
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
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }
  //::::::::::::::CONSULTA LOGIN USUARIO:::::::::::::::://
  if ($_POST['user'] == 'login') {
    $id_logins = htmlspecialchars($_POST['id_user'], FILTER_VALIDATE_INT);
    try {
      $stmt = $conn->prepare("SELECT * FROM logins WHERE logins_id_login=?");
      $stmt->bind_param("i", $id_logins);
      $stmt->execute();
      $resultado = $stmt->get_result();
      $fila = $resultado->fetch_assoc();
      if ($resultado->num_rows >= "1") {
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
  if ($_POST['user'] == 'login_act') {

    $id_logins = htmlspecialchars($_POST['id_login_l'], FILTER_VALIDATE_INT);
    $user_nick = strtolower(htmlspecialchars($_POST['user_nick_l'], ENT_QUOTES, 'UTF-8'));
    $user_pass = htmlspecialchars($_POST['user_password_l'], ENT_QUOTES, 'UTF-8');

    try {

      $opciones = [
        'cost' => 12,
      ];

      $password_hashed = password_hash($user_pass, PASSWORD_BCRYPT, $opciones) . "/n";

      $stmt = $conn->prepare("UPDATE logins SET logins_nickname=?, logins_password=?, logins_editado= NOW() WHERE logins_id_login =?");
      $stmt->bind_param("ssi", $user_nick, $password_hashed, $id_logins);
      $stmt->execute();
      
      if ($stmt->affected_rows) {
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
    } finally {
      $stmt->close();
      $conn->close();
    }

    die(json_encode($respuesta));
  }
  //:::::::::::ELIMINAR USUARIO:::::::::::::://
  if ($_POST['user'] == 'eliminar') {
    $id_borrar = $_POST['id'];

    try {
      $stmt = $conn->prepare("DELETE FROM usuarios WHERE users_id_logins = ?");
      $stmt->bind_param("i", $id_borrar);
      $stmt->execute();

      if ($stmt->affected_rows) {
        $stmt = $conn->prepare("DELETE FROM logins WHERE logins_id_login = ?");
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
      } else {
        $respuesta = array(
          'respuesta' => 'error'
        );
      }
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
