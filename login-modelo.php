<?php
if($_SERVER["REQUEST_METHOD"] === "POST")
{
  if(isset($_POST['login-user'])){
    $usuario = $_POST['nickname'];
    $password = $_POST['password'];
    include_once 'funciones/funciones.php';
        
        try {
    
          $stmt = $conn->prepare("SELECT * FROM logins WHERE logins_nickname=?");
          $stmt->bind_param("s", $usuario);
          $stmt->execute();
          $resultado = $stmt->get_result();
    
            if($resultado->num_rows >= "1"){
              $existe = $resultado->fetch_assoc();
              
              $status = $existe['logins_status'];
              $user_id = $existe['logins_id_login'];
              $nickname = $existe['logins_nickname'];
              $user_nombre = $existe['logins_nombre'];
              $user_nivel = $existe['logins_nivel'];
              $user_password = $existe['logins_password'];
              if ($status == 'BLOQUEADO') {
                $respuesta = array(
                  'respuesta' => 'bloqueado'
                );
              } else {
        
                  if ($user_nivel == 4) {
                    
                    $stmt = $conn->prepare("SELECT alum_grado FROM alumnos WHERE alum_id_logins=?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $resultado2 = $stmt->get_result();
                    $datos = $resultado2->fetch_assoc();
                    $alum_grado = $datos['alum_grado'];

                    $stmt = $conn->prepare("SELECT * FROM grados WHERE gdo_des_grado=?");
                    $stmt->bind_param("s", $alum_grado);
                    $stmt->execute();
                    $resultado3 = $stmt->get_result();
                    $datos2 = $resultado3->fetch_assoc();
                    $alum_grad_code = $datos2['gdo_id'];

                  } else {
                    
                    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE users_id_logins=?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $resultado2 = $stmt->get_result();
                    $datos = $resultado2->fetch_assoc();
                    $users_mat = $datos['users_asignatura'];
                    $users_grados = $datos['users_grados'];

                    if ($datos['users_grados'] != 'N/A') {
                      $g_arr = json_decode($datos['users_grados'], true);
                    } else {
                      $g_arr = array();
                    }

                    $stmt = $conn->prepare("SELECT mat_cod_materia FROM materias WHERE mat_des_materia=?");
                    $stmt->bind_param("s", $users_mat);
                    $stmt->execute();
                    $resultado3 = $stmt->get_result();
                    $datos2 = $resultado3->fetch_assoc();
                    $users_mat_code = $datos2['mat_cod_materia'];
                  }
      
                  if(password_verify($password, $user_password)){
                    
                    $intentos = 0;
                    $stmt = $conn->prepare("UPDATE logins SET logins_intentos=?, logins_editado= NOW() WHERE logins_nickname =?");
                    $stmt->bind_param("is", $intentos, $usuario);
                    $stmt->execute();
                    if ($user_nivel == 4) {
                      
                      session_start();
                      $_SESSION['usuario'] = $nickname;
                      $_SESSION['nombre'] = $user_nombre;
                      $_SESSION['nivel'] = $user_nivel;
                      $_SESSION['id'] = $user_id;
                      $_SESSION['alum_grado'] = $alum_grad_code;
                      
                    } else {
                      
                      session_start();
                      $_SESSION['usuario'] = $nickname;
                      $_SESSION['nombre'] = $user_nombre;
                      $_SESSION['nivel'] = $user_nivel;
                      $_SESSION['id'] = $user_id;
                      $_SESSION['users_mat'] = $users_mat;
                      $_SESSION['users_mat_code'] = $users_mat_code;
                      $_SESSION['users_grados'] = $g_arr;
                    }
      
                    $respuesta = array(
                      'respuesta' => 'aprobado',
                      'usuario' => $user_nombre,
                      'nivel' => $user_nivel
                    );
      
                  } else {
                    try {
                      $stmt = $conn->prepare("SELECT logins_intentos FROM logins WHERE logins_nickname=?");
                      $stmt->bind_param("s", $usuario);
                      $stmt->execute();
                      $resultado = $stmt->get_result();
                      $existe = $resultado->fetch_assoc();
                      $intentos = $existe['logins_intentos'];
    
                      $intentos2 = $intentos + 1;
    
                      $stmt = $conn->prepare("UPDATE logins SET logins_intentos=?, logins_editado= NOW() WHERE logins_nickname =?");
                      $stmt->bind_param("is", $intentos2, $usuario);
                      $stmt->execute();
    
                      $stmt = $conn->prepare("SELECT logins_intentos FROM logins WHERE logins_nickname=?");
                      $stmt->bind_param("s", $usuario);
                      $stmt->execute();
                      $resultado = $stmt->get_result();
                      $existe = $resultado->fetch_assoc();
                      $intentos = $existe['logins_intentos'];
    
                      if ($intentos >= 10) {
    
                        $status = 'BLOQUEADO';
    
                        $stmt = $conn->prepare("UPDATE logins SET logins_status=?, logins_editado= NOW() WHERE logins_nickname =?");
                        $stmt->bind_param("ss", $status, $usuario);
                        $stmt->execute();
            
                        $respuesta = array(
                          'respuesta' => 'bloqueado',
                        );
            
                      } else {
                        $respuesta = array(
                          'respuesta' => 'advertencia',
                        );
    
                      }
    
                    } catch (Exception $e) {
                      echo "Error:" . $e->getMessage();
                      }
                  }
                
              }
            } else {
              $respuesta = array(
                'respuesta' => 'nouser'
              );
            }
    
          $stmt->close();
          $conn->close();
    
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        } 
  } else {
      $respuesta = array(
      'respuesta' => 'error'
      );
    }
    die(json_encode($respuesta));
    
}
  //::::::::::::::LOGIN:::::::::::::::::::::::::::::://
?>
