<?php
include_once 'funciones/funciones.php';
include_once 'funciones/sesiones.php';
include_once 'funciones/enigma.php';
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d H:i:s");
$grado = 7;
$periodo = 'PRIMERO';
$per = 1;
if (!filter_var($grado, FILTER_VALIDATE_INT)) {
  die("ERROR!");
}
try {
  $stmt = $conn->prepare("SELECT gdo_des_grado FROM grados WHERE gdo_cod_grado=?");
  $stmt->bind_param("i", $grado);
  $stmt->execute();
  $resultado_grado = $stmt->get_result();
  $descripcion_grado = $resultado_grado->fetch_assoc();
  $grado_desc = $descripcion_grado['gdo_des_grado'];
} catch (\Exception $e) {
  $error = $e->getMessage();
  echo $error;
}
try {
  $estatus = 'MATRICULADO';
  $stmt = $conn->prepare("SELECT * FROM alumnos WHERE alum_grado=? AND alum_estatus=?");
  $stmt->bind_param("ss", $grado_desc, $estatus);
  $stmt->execute();
  $id_alumnos = $stmt->get_result();
} catch (\Exception $e) {
  $error = $e->getMessage();
  echo $error;
}
if ($dgrupo == 'PRIMERO' || $dgrupo == 'SEGUNDO' || $dgrupo == 'TERCERO' || $dgrupo == 'CUARTO' || $dgrupo == 'QUINTO') 
{ 
    $minima = 3.1;
}
elseif ($dgrupo == 'SEXTO' || $dgrupo == 'SÉPTIMO' || $dgrupo == 'OCTAVO')
{
    $minima = 3.3;
}
elseif ($dgrupo == 'NOVENO' || $dgrupo == 'DÉCIMO' || $dgrupo == 'UNDÉCIMO')
{
    $minima = 3.7;
}
/*
echo '<pre>';
  print_r($id_alumnos);
echo '</pre>';
*/
while ($alum_todos = $id_alumnos->fetch_assoc())
{   
          $id_a = $alum_todos['alum_id'];
          $alum_nombre = $alum_todos['alum_1er_apellido'].' '.$alum_todos['alum_1er_nombre'];
          $mat_desc1 = 'CIENCIASSOCIALES';
          $mat_desc2 = 'LENGUAJE';
          $mat_desc3 = 'INGLÉS';
          $mat_desc4 = 'MATEMÁTICAS';
          $mat_desc5 = 'CIENCIASNATURALES';
          $mat_desc6 = 'INFORMÁTICA';
          $mat_desc7 = 'ÉTICA';
          $mat_desc8 = 'ARTE';
          $mat_desc9 = 'MÚSICA';
          $mat_desc10 = 'DEPORTE';
          echo 'Alumno: '.$alum_nombre.'<br>';
          $stmt = $conn->prepare("SELECT * FROM materias WHERE mat_des_materia=? 
          OR mat_des_materia=? 
          OR mat_des_materia=?
          OR mat_des_materia=?
          OR mat_des_materia=?
          OR mat_des_materia=?
          OR mat_des_materia=?");
          $stmt->bind_param("sssssss", $mat_desc1, $mat_desc2, $mat_desc3, $mat_desc4, $mat_desc5, $mat_desc6, $mat_desc10);
          $stmt->execute();
          $resultado_aprendizajes = $stmt->get_result();
          $evaluadas = 10;
          $perdidas = 0;
          $acu_promedio = 0;
          
          while ($datos_aprendizajes = $resultado_aprendizajes->fetch_assoc())
          {
            $mat = $datos_aprendizajes['mat_des_materia'];
            if ($grado_desc == 'PRIMERO' ||
              $grado_desc == 'SEGUNDO' ||
              $grado_desc == 'TERCERO' ||
              $grado_desc == 'CUARTO' ||
              $grado_desc == 'QUINTO')
            {
            $logros = $datos_aprendizajes['mat_logros_pri'];
            }
            elseif ($grado_desc == 'SEXTO' ||
                    $grado_desc == 'SÉPTIMO' ||
                    $grado_desc == 'OCTAVO' ||
                    $grado_desc == 'NOVENO' ||
                    $grado_desc == 'DÉCIMO' ||
                    $grado_desc == 'UNDÉCIMO'
                    )
            {
              $logros = $datos_aprendizajes['mat_logros_sec'];
            }
            
            
            $in = 1;
            $fn = $logros;
            $log = '';
            
            
            for ($i=$in; $i <= $fn; $i++)
            {
              $stmt = $conn->prepare("SELECT * FROM notas_parciales WHERE notas_parciales_id_alumno=?");
              $stmt->bind_param("i", $id_a);
              $stmt->execute();
              $notas_resultado = $stmt->get_result();
              if ($notas_resultado -> num_rows > 0) {
                $notas_detalle = $notas_resultado->fetch_assoc();
                $notas = json_decode($notas_detalle['notas_parciales_notas'], true);
                $n_ev1 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev1'];
                $n_ev2 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev2'];
                $n_ev3 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev3'];
                $n_ev4 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev4'];
                $n_ev5 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev5'];
                switch ($n_ev1) {case '':$nota_ev1 = 0;break; case null:$nota_ev1 = 0;break; default:$nota_ev1 = $n_ev1;break;}
                switch ($n_ev2) {case '':$nota_ev2 = 0;break; case null:$nota_ev2 = 0;break; default:$nota_ev2 = $n_ev2;break;}
                switch ($n_ev3) {case '':$nota_ev3 = 0;break; case null:$nota_ev3 = 0;break; default:$nota_ev3 = $n_ev3;break;}
                switch ($n_ev4) {case '':$nota_ev4 = 0;break; case null:$nota_ev4 = 0;break; default:$nota_ev4 = $n_ev4;break;}
                switch ($n_ev5) {case '':$nota_ev5 = 0;break; case null:$nota_ev5 = 0;break; default:$nota_ev5 = $n_ev5;break;}
              } else {
                $nota_ev1 = 0;
                $nota_ev2 = 0;
                $nota_ev3 = 0;
                $nota_ev4 = 0;
                $nota_ev5 = 0;
              }
              $def70 = number_format((float)((($nota_ev1 + $nota_ev2 + $nota_ev3) / 3) * 70) / 100, 2, '.', '');
              $def20 = number_format((float)($nota_ev4 * 20) / 100, 2, '.', '');
              $def10 = number_format((float)($nota_ev5 * 10) / 100, 2, '.', '');
              $def2 = number_format((float)$def70 + $def20 + $def10, 1, '.', '');
              $in += 1;
              $log .= '(L'.$i.':'.$def2.') ';
              
            }
            
            $n_final = $notas['p-'.$per]['m-'.$mat]['ncn'];
            $n_filog = $log;
            $for =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $dev =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $rec =$notas['p-'.$per]['m-'.$mat]['ncl'];
            if ($n_final <= $minima) {
              $perdidas += 1;
            }
            
            if ($mat == 'CIENCIASSOCIALES') {
              echo 'CIENCIAS SOCIALES, HISTORIA, GEOGRAFIA, CONSTITUCION POLITICA Y DEMOCRACIA'.'<br>';
              echo 'Historia y geografía, derechos humanos, solución de conflictos'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'MATEMÁTICAS') {
              echo 'MATEMÁTICAS'.'<br>';
              echo 'Matemáticas, geometría, estadística'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'CIENCIASNATURALES') {
              echo 'CIENCIAS NATURALES Y EDUCACION AMBIENTAL'.'<br>';
              echo 'Biología, química, física'.'<br>';
              echo ' Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } 
            
          }
          echo 'HUMANIDADES, LENGUA CASTELLANA E IDIOMAS EXTRANJEROS.<br>';
          $stmt = $conn->prepare("SELECT * FROM materias WHERE mat_des_materia=? OR mat_des_materia=?");
          $stmt->bind_param("ss", $mat_desc2, $mat_desc3);
          $stmt->execute();
          $resultado_aprendizajes = $stmt->get_result();
          while ($datos_aprendizajes = $resultado_aprendizajes->fetch_assoc())
          {
            $mat = $datos_aprendizajes['mat_des_materia'];
            if ($grado_desc == 'PRIMERO' ||
              $grado_desc == 'SEGUNDO' ||
              $grado_desc == 'TERCERO' ||
              $grado_desc == 'CUARTO' ||
              $grado_desc == 'QUINTO')
            {
            $logros = $datos_aprendizajes['mat_logros_pri'];
            }
            elseif ($grado_desc == 'SEXTO' ||
                    $grado_desc == 'SÉPTIMO' ||
                    $grado_desc == 'OCTAVO' ||
                    $grado_desc == 'NOVENO' ||
                    $grado_desc == 'DÉCIMO' ||
                    $grado_desc == 'UNDÉCIMO'
                    )
            {
              $logros = $datos_aprendizajes['mat_logros_sec'];
            }
            
            
            $in = 1;
            $fn = $logros;
            $log = '';
            
            
            for ($i=$in; $i <= $fn; $i++)
            {
              $stmt = $conn->prepare("SELECT * FROM notas_parciales WHERE notas_parciales_id_alumno=?");
              $stmt->bind_param("i", $id_a);
              $stmt->execute();
              $notas_resultado = $stmt->get_result();
              if ($notas_resultado -> num_rows > 0) {
                $notas_detalle = $notas_resultado->fetch_assoc();
                $notas = json_decode($notas_detalle['notas_parciales_notas'], true);
                $n_ev1 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev1'];
                $n_ev2 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev2'];
                $n_ev3 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev3'];
                $n_ev4 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev4'];
                $n_ev5 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev5'];
                switch ($n_ev1) {case '':$nota_ev1 = 0;break; case null:$nota_ev1 = 0;break; default:$nota_ev1 = $n_ev1;break;}
                switch ($n_ev2) {case '':$nota_ev2 = 0;break; case null:$nota_ev2 = 0;break; default:$nota_ev2 = $n_ev2;break;}
                switch ($n_ev3) {case '':$nota_ev3 = 0;break; case null:$nota_ev3 = 0;break; default:$nota_ev3 = $n_ev3;break;}
                switch ($n_ev4) {case '':$nota_ev4 = 0;break; case null:$nota_ev4 = 0;break; default:$nota_ev4 = $n_ev4;break;}
                switch ($n_ev5) {case '':$nota_ev5 = 0;break; case null:$nota_ev5 = 0;break; default:$nota_ev5 = $n_ev5;break;}
              } else {
                $nota_ev1 = 0;
                $nota_ev2 = 0;
                $nota_ev3 = 0;
                $nota_ev4 = 0;
                $nota_ev5 = 0;
              }
              $def70 = number_format((float)((($nota_ev1 + $nota_ev2 + $nota_ev3) / 3) * 70) / 100, 2, '.', '');
              $def20 = number_format((float)($nota_ev4 * 20) / 100, 2, '.', '');
              $def10 = number_format((float)($nota_ev5 * 10) / 100, 2, '.', '');
              $def2 = number_format((float)$def70 + $def20 + $def10, 1, '.', '');
              $in += 1;
              $log .= '(L'.$i.':'.$def2.') ';
              
            }
            
            $n_final = $notas['p-'.$per]['m-'.$mat]['ncn'];
            $n_filog = $log;
            $for =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $dev =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $rec =$notas['p-'.$per]['m-'.$mat]['ncl'];
            if ($n_final <= $minima) {
              $perdidas += 1;
            }
            
            if ($mat == 'LENGUAJE') {
              echo 'Humanidades y Lengua Castellana'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'INGLÉS') {
              echo 'Inglés'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } 
            
          }
          echo 'EDUCACION ARTISTICA Y CULTURAL.<br>';
          $stmt = $conn->prepare("SELECT * FROM materias WHERE mat_des_materia=? OR mat_des_materia=? OR mat_des_materia=?");
          $stmt->bind_param("sss", $mat_desc7, $mat_desc8, $mat_desc9);
          $stmt->execute();
          $resultado_aprendizajes = $stmt->get_result();
          while ($datos_aprendizajes = $resultado_aprendizajes->fetch_assoc())
          {
            $mat = $datos_aprendizajes['mat_des_materia'];
            if ($grado_desc == 'PRIMERO' ||
              $grado_desc == 'SEGUNDO' ||
              $grado_desc == 'TERCERO' ||
              $grado_desc == 'CUARTO' ||
              $grado_desc == 'QUINTO')
            {
            $logros = $datos_aprendizajes['mat_logros_pri'];
            }
            elseif ($grado_desc == 'SEXTO' ||
                    $grado_desc == 'SÉPTIMO' ||
                    $grado_desc == 'OCTAVO' ||
                    $grado_desc == 'NOVENO' ||
                    $grado_desc == 'DÉCIMO' ||
                    $grado_desc == 'UNDÉCIMO'
                    )
            {
              $logros = $datos_aprendizajes['mat_logros_sec'];
            }
            
            
            $in = 1;
            $fn = $logros;
            $log = '';
            
            
            for ($i=$in; $i <= $fn; $i++)
            {
              $stmt = $conn->prepare("SELECT * FROM notas_parciales WHERE notas_parciales_id_alumno=?");
              $stmt->bind_param("i", $id_a);
              $stmt->execute();
              $notas_resultado = $stmt->get_result();
              if ($notas_resultado -> num_rows > 0) {
                $notas_detalle = $notas_resultado->fetch_assoc();
                $notas = json_decode($notas_detalle['notas_parciales_notas'], true);
                $n_ev1 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev1'];
                $n_ev2 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev2'];
                $n_ev3 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev3'];
                $n_ev4 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev4'];
                $n_ev5 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev5'];
                switch ($n_ev1) {case '':$nota_ev1 = 0;break; case null:$nota_ev1 = 0;break; default:$nota_ev1 = $n_ev1;break;}
                switch ($n_ev2) {case '':$nota_ev2 = 0;break; case null:$nota_ev2 = 0;break; default:$nota_ev2 = $n_ev2;break;}
                switch ($n_ev3) {case '':$nota_ev3 = 0;break; case null:$nota_ev3 = 0;break; default:$nota_ev3 = $n_ev3;break;}
                switch ($n_ev4) {case '':$nota_ev4 = 0;break; case null:$nota_ev4 = 0;break; default:$nota_ev4 = $n_ev4;break;}
                switch ($n_ev5) {case '':$nota_ev5 = 0;break; case null:$nota_ev5 = 0;break; default:$nota_ev5 = $n_ev5;break;}
              } else {
                $nota_ev1 = 0;
                $nota_ev2 = 0;
                $nota_ev3 = 0;
                $nota_ev4 = 0;
                $nota_ev5 = 0;
              }
              $def70 = number_format((float)((($nota_ev1 + $nota_ev2 + $nota_ev3) / 3) * 70) / 100, 2, '.', '');
              $def20 = number_format((float)($nota_ev4 * 20) / 100, 2, '.', '');
              $def10 = number_format((float)($nota_ev5 * 10) / 100, 2, '.', '');
              $def2 = number_format((float)$def70 + $def20 + $def10, 1, '.', '');
              $in += 1;
              $log .= '(L'.$i.':'.$def2.') ';
              
            }
            
            $n_final = $notas['p-'.$per]['m-'.$mat]['ncn'];
            $n_filog = $log;
            $for =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $dev =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $rec =$notas['p-'.$per]['m-'.$mat]['ncl'];
            if ($n_final <= $minima) {
              $perdidas += 1;
            }
            
            if ($mat == 'ÉTICA') {
              echo 'ÉTICA'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'ARTE') {
              echo 'ARTE'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'MÚSICA') {
              echo 'MÚSICA'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } 
            
          }
          $stmt = $conn->prepare("SELECT * FROM materias WHERE mat_des_materia=? OR mat_des_materia=?");
          $stmt->bind_param("ss", $mat_desc6, $mat_desc10);
          $stmt->execute();
          $resultado_aprendizajes = $stmt->get_result();
          while ($datos_aprendizajes = $resultado_aprendizajes->fetch_assoc())
          {
            $mat = $datos_aprendizajes['mat_des_materia'];
            if ($grado_desc == 'PRIMERO' ||
              $grado_desc == 'SEGUNDO' ||
              $grado_desc == 'TERCERO' ||
              $grado_desc == 'CUARTO' ||
              $grado_desc == 'QUINTO')
            {
            $logros = $datos_aprendizajes['mat_logros_pri'];
            }
            elseif ($grado_desc == 'SEXTO' ||
                    $grado_desc == 'SÉPTIMO' ||
                    $grado_desc == 'OCTAVO' ||
                    $grado_desc == 'NOVENO' ||
                    $grado_desc == 'DÉCIMO' ||
                    $grado_desc == 'UNDÉCIMO'
                    )
            {
              $logros = $datos_aprendizajes['mat_logros_sec'];
            }
            
            
            $in = 1;
            $fn = $logros;
            $log = '';
            
            
            for ($i=$in; $i <= $fn; $i++)
            {
              $stmt = $conn->prepare("SELECT * FROM notas_parciales WHERE notas_parciales_id_alumno=?");
              $stmt->bind_param("i", $id_a);
              $stmt->execute();
              $notas_resultado = $stmt->get_result();
              if ($notas_resultado -> num_rows > 0) {
                $notas_detalle = $notas_resultado->fetch_assoc();
                $notas = json_decode($notas_detalle['notas_parciales_notas'], true);
                $n_ev1 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev1'];
                $n_ev2 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev2'];
                $n_ev3 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev3'];
                $n_ev4 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev4'];
                $n_ev5 = $notas['p-'.$per]['m-'.$mat]['l-'.$in]['ev5'];
                switch ($n_ev1) {case '':$nota_ev1 = 0;break; case null:$nota_ev1 = 0;break; default:$nota_ev1 = $n_ev1;break;}
                switch ($n_ev2) {case '':$nota_ev2 = 0;break; case null:$nota_ev2 = 0;break; default:$nota_ev2 = $n_ev2;break;}
                switch ($n_ev3) {case '':$nota_ev3 = 0;break; case null:$nota_ev3 = 0;break; default:$nota_ev3 = $n_ev3;break;}
                switch ($n_ev4) {case '':$nota_ev4 = 0;break; case null:$nota_ev4 = 0;break; default:$nota_ev4 = $n_ev4;break;}
                switch ($n_ev5) {case '':$nota_ev5 = 0;break; case null:$nota_ev5 = 0;break; default:$nota_ev5 = $n_ev5;break;}
              } else {
                $nota_ev1 = 0;
                $nota_ev2 = 0;
                $nota_ev3 = 0;
                $nota_ev4 = 0;
                $nota_ev5 = 0;
              }
              $def70 = number_format((float)((($nota_ev1 + $nota_ev2 + $nota_ev3) / 3) * 70) / 100, 2, '.', '');
              $def20 = number_format((float)($nota_ev4 * 20) / 100, 2, '.', '');
              $def10 = number_format((float)($nota_ev5 * 10) / 100, 2, '.', '');
              $def2 = number_format((float)$def70 + $def20 + $def10, 1, '.', '');
              $in += 1;
              $log .= '(L'.$i.':'.$def2.') ';
              
            }
            
            $n_final = $notas['p-'.$per]['m-'.$mat]['ncn'];
            $n_filog = $log;
            $for =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $dev =$notas['p-'.$per]['m-'.$mat]['ncl'];
            $rec =$notas['p-'.$per]['m-'.$mat]['ncl'];
            if ($n_final <= $minima) {
              $perdidas += 1;
            }
            
            if ($mat == 'INFORMÁTICA') {
              echo 'TECNOLOGIA E INFORMÁTICA'.'<br>';
              echo 'Informática - tecnología'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } if ($mat == 'DEPORTE') {
              echo 'EDUCACION FISICA RECREACION Y DEPORTES'.'<br>';
              echo ' Educación física'.'<br>';
              echo 'Def:'.$n_final.' Ap: '.$n_filog.'For: '.$for.' Dev: '.$dev.' Rec: '.$rec.'<br>';
              $acu_promedio += $n_final;
            } 
            
          }
          $promedio = number_format((float)$acu_promedio / $evaluadas, 2, '.', '');
          echo 'Promedio: '.$promedio.'<br>';
          echo 'Evaluadas: '.$evaluadas.'<br>';
          echo 'Perdidas: '.$perdidas.'<br><br>';
          
}
?>