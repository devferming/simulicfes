<?php 

include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';

date_default_timezone_set('America/Bogota');

$hoy = date("Y-m-d H:i:s");

            $arranque = 0;
            $acceso = 4;
            $intentos = 0;
            $status = 'ACTIVO';

            $stmt = $conn->prepare("SELECT alum_id, alum_doc_numero, alum_1er_apellido, alum_1er_nombre FROM alumnos WHERE alum_id_logins = ? ");
            $stmt->bind_param("i", $arranque);
            $stmt->execute();
            $resultado2 = $stmt->get_result();

            while ($datos = $resultado2->fetch_assoc()) {
                
                $alum_id = $datos['alum_id'];
                $datos2 = str_replace(".", "", $datos['alum_doc_numero']);
                $nombre = $datos['alum_1er_nombre'].' '.$datos['alum_1er_apellido'];
                echo 'Usuario: '.$datos2.' Password: '.$datos2.' Nombre: '.$nombre.'<br>';


                $opciones = [
                    'cost' => 12,
                  ];
          
                $password_hashed = password_hash($datos2, PASSWORD_BCRYPT, $opciones). "/n";
          
          
                $stmt = $conn->prepare("INSERT INTO logins (logins_nickname, logins_nombre, logins_password, logins_nivel, logins_intentos, logins_status, logins_editado) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssiiss", $datos2, $nombre, $password_hashed, $acceso, $intentos, $status, $hoy);
                $stmt->execute();


                $id_registro = $stmt->insert_id;

                if($id_registro > 0){
          
                  try {
          
                    $stmt = $conn->prepare("UPDATE alumnos SET alum_id_logins=?, alum_editado= NOW() WHERE alum_id =?");
                    $stmt->bind_param("ii", $id_registro, $alum_id);
                    $stmt->execute();
          
                    $id_registro2 = $stmt->insert_id;
                    
                    
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



            }




            $nivel = 4;
            $status = 'BLOQUEADO';

            $intentos = 0;
            $intentos2 = 'ACTIVO';


            $stmt = $conn->prepare("SELECT * FROM logins WHERE logins_nivel =? AND logins_status =? ");
            $stmt->bind_param("is", $nivel, $status);
            $stmt->execute();
            $resultado2 = $stmt->get_result();

            while ($datos = $resultado2->fetch_assoc()) {

                    $id_alum = $datos['logins_id_login'];

                    $stmt = $conn->prepare("UPDATE logins SET logins_intentos=?, logins_status=? WHERE logins_id_login =?");
                    $stmt->bind_param("isi", $intentos, $intentos2, $id_alum);
                    $stmt->execute();


            }




























?>