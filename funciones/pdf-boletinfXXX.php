<?php

    // CONSULTA DATOS ESTUDIANTE //

    try {
        $stmt = $conn->prepare("SELECT alum_1er_nombre, alum_2do_nombre, alum_1er_apellido, alum_2do_apellido, alum_doc_numero, alum_grado, alum_seccion FROM alumnos WHERE alum_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos_alum = $resultado->fetch_assoc();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }

    $alum_nombre = $datos_alum['alum_1er_apellido'].' '.$datos_alum['alum_2do_apellido'].' '.$datos_alum['alum_1er_nombre'].' '.$datos_alum['alum_2do_nombre'];
    $alum_nombre2 = $datos_alum['alum_1er_apellido'].' '.$datos_alum['alum_1er_nombre'];
    $alum_mat = '2020'.$id;
    $alum_grado2 = $datos_alum['alum_grado'].' '.'('.$datos_alum['alum_seccion'].')';


    $alum_grado = $datos_alum['alum_grado'];
    $grado_desc = $datos_alum['alum_grado'];
    $alum_seccion = $datos_alum['alum_seccion'];

    // CONSULTA NOTAS CIENCIAS NATURALES //

    $mat_1 = "CIENCIAS NATURALES";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_1, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_1, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_1, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_1 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_1_des_desc = number_format( (float) $nota_final_mat_1, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_1_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3 AND $mat_1_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 3.5 AND $mat_1_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 3.7 AND $mat_1_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 3.9 AND $mat_1_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.2 AND $mat_1_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.4 AND $mat_1_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.6 AND $mat_1_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  >= 4.8 AND $mat_1_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  > 4.9 AND $mat_1_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_1_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3.1 AND $mat_1_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3.2 AND $mat_1_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  >= 3.4 AND $mat_1_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 3.7 AND $mat_1_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  > 3.9 AND $mat_1_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 4.1 AND $mat_1_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.3 AND $mat_1_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  > 4.4 AND $mat_1_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.6 AND $mat_1_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  >= 4.8 AND $mat_1_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  > 4.9 AND $mat_1_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_1_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3.2 AND $mat_1_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3.4 AND $mat_1_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BAJO';

          } elseif ($mat_1_des_desc  > 3.7 AND $mat_1_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  > 3.8 AND $mat_1_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  > 3.9 AND $mat_1_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'BÁSICO';

          } elseif ($mat_1_des_desc  >= 4.1 AND $mat_1_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.3 AND $mat_1_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  > 4.4 AND $mat_1_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'ALTO';

          } elseif ($mat_1_des_desc  >= 4.6 AND $mat_1_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  >= 4.8 AND $mat_1_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_1_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_1_des_desc  > 4.9 AND $mat_1_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_1_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_1, $alum_grado, $periodo, $area1, $mat_1_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_1_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_1, $alum_grado, $periodo, $area2, $mat_1_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_1_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_1, $alum_grado, $periodo, $area3, $mat_1_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_1_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 
    

    // CONSULTA NOTAS CIENCIAS SOCIALES //

    $mat_2 = "CIENCIAS SOCIALES";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_2, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_2, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_2, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_2 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_2_des_desc = number_format( (float) $nota_final_mat_2, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_2_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3 AND $mat_2_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 3.5 AND $mat_2_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 3.7 AND $mat_2_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 3.9 AND $mat_2_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.2 AND $mat_2_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.4 AND $mat_2_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.6 AND $mat_2_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  >= 4.8 AND $mat_2_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  > 4.9 AND $mat_2_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_2_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3.1 AND $mat_2_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3.2 AND $mat_2_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  >= 3.4 AND $mat_2_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 3.7 AND $mat_2_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  > 3.9 AND $mat_2_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 4.1 AND $mat_2_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.3 AND $mat_2_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  > 4.4 AND $mat_2_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.6 AND $mat_2_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  >= 4.8 AND $mat_2_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  > 4.9 AND $mat_2_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_2_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3.2 AND $mat_2_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3.4 AND $mat_2_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BAJO';

          } elseif ($mat_2_des_desc  > 3.7 AND $mat_2_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  > 3.8 AND $mat_2_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  > 3.9 AND $mat_2_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'BÁSICO';

          } elseif ($mat_2_des_desc  >= 4.1 AND $mat_2_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.3 AND $mat_2_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  > 4.4 AND $mat_2_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'ALTO';

          } elseif ($mat_2_des_desc  >= 4.6 AND $mat_2_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  >= 4.8 AND $mat_2_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_2_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_2_des_desc  > 4.9 AND $mat_2_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_2_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_2, $alum_grado, $periodo, $area1, $mat_2_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_2_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_2, $alum_grado, $periodo, $area2, $mat_2_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_2_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_2, $alum_grado, $periodo, $area3, $mat_2_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_2_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 



    // CONSULTA NOTAS ARTE Y ÉTICA //

    $mat_3 = "ARTE Y ÉTICA";

    if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

        $mat_3_aca_desc = '';
        $mat_3_act_desc = '';
        $mat_3_pro_desc = '';
        $mat_3_des_desc = '0';
        $mat_3_des_desc_cl = 'N/A';

    } else {
    
        try {

            $nota_p1 = 'PRIMERO';
            $nota_p2 = 'SEGUNDO';
            $nota_p3 = 'TERCERO';
    
            $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
            $stmt->bind_param("iss", $id, $mat_3, $nota_p1);
            $stmt->execute();
            $resultadop1 = $stmt->get_result();
            $datosp1 = $resultadop1->fetch_assoc();
    
            $stmt->bind_param("iss", $id, $mat_3, $nota_p2);
            $stmt->execute();
            $resultadop2 = $stmt->get_result();
            $datosp2 = $resultadop2->fetch_assoc();
    
            $stmt->bind_param("iss", $id, $mat_3, $nota_p3);
            $stmt->execute();
            $resultadop3 = $stmt->get_result();
            $datosp3 = $resultadop3->fetch_assoc();
    
            $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
            $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
            $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');
    
            $nota_final_mat_3 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
            $mat_3_des_desc = number_format( (float) $nota_final_mat_3, 1, '.', '');
    
            $area1 = 'ACADÉMICO';
            $area2 = 'ACTITUDINAL';
            $area3 = 'PROCEDIMENTAL'; 
    
            if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
            
    
              if ($mat_3_des_desc  <= 3) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3 AND $mat_3_des_desc  <= 3.4) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 3.5 AND $mat_3_des_desc  <= 3.6) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 3.7 AND $mat_3_des_desc  <= 3.8) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 3.9 AND $mat_3_des_desc  <= 4.1) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.2 AND $mat_3_des_desc  <= 4.3) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.4 AND $mat_3_des_desc  <= 4.5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.6 AND $mat_3_des_desc  <= 4.7) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  >= 4.8 AND $mat_3_des_desc  <= 4.9) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  > 4.9 AND $mat_3_des_desc  <= 5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              }
    
            } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
              
              if ($mat_3_des_desc  <= 3.1) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3.1 AND $mat_3_des_desc  <= 3.2) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3.2 AND $mat_3_des_desc  <= 3.3) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  >= 3.4 AND $mat_3_des_desc  <= 3.6) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 3.7 AND $mat_3_des_desc  <= 3.9) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  > 3.9 AND $mat_3_des_desc  <= 4) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 4.1 AND $mat_3_des_desc  <= 4.2) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.3 AND $mat_3_des_desc  <= 4.4) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  > 4.4 AND $mat_3_des_desc  <= 4.5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.6 AND $mat_3_des_desc  <= 4.7) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  >= 4.8 AND $mat_3_des_desc  <= 4.9) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  > 4.9 AND $mat_3_des_desc  <= 5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              }
    
              
            } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
              
              if ($mat_3_des_desc  <= 3.2) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3.2 AND $mat_3_des_desc  <= 3.4) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3.4 AND $mat_3_des_desc  <= 3.7) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BAJO';
    
              } elseif ($mat_3_des_desc  > 3.7 AND $mat_3_des_desc  <= 3.8) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  > 3.8 AND $mat_3_des_desc  <= 3.9) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  > 3.9 AND $mat_3_des_desc  <= 4) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'BÁSICO';
    
              } elseif ($mat_3_des_desc  >= 4.1 AND $mat_3_des_desc  <= 4.2) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.3 AND $mat_3_des_desc  <= 4.4) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  > 4.4 AND $mat_3_des_desc  <= 4.5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'ALTO';
    
              } elseif ($mat_3_des_desc  >= 4.6 AND $mat_3_des_desc  <= 4.7) {
    
                $indicador_final = 3;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  >= 4.8 AND $mat_3_des_desc  <= 4.9) {
    
                $indicador_final = 2;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              } elseif ($mat_3_des_desc  > 4.9 AND $mat_3_des_desc  <= 5) {
    
                $indicador_final = 1;
                $mat_3_des_desc_cl = 'SUPERIOR';
    
              }
    
              
            }
    
            $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
            $stmt->bind_param("ssssss", $mat_3, $alum_grado, $periodo, $area1, $mat_3_des_desc_cl, $indicador_final);
            $stmt->execute();
            $resultado_l = $stmt->get_result();
            $descripcion = $resultado_l->fetch_assoc();
            $mat_3_aca_desc = $descripcion['indi_logro_descripcion'];
    
            $stmt->bind_param("ssssss", $mat_3, $alum_grado, $periodo, $area2, $mat_3_des_desc_cl, $indicador_final);
            $stmt->execute();
            $resultado_l = $stmt->get_result();
            $descripcion = $resultado_l->fetch_assoc();
            $mat_3_act_desc = $descripcion['indi_logro_descripcion'];
    
            $stmt->bind_param("ssssss", $mat_3, $alum_grado, $periodo, $area3, $mat_3_des_desc_cl, $indicador_final);
            $stmt->execute();
            $resultado_l = $stmt->get_result();
            $descripcion = $resultado_l->fetch_assoc();
            $mat_3_pro_desc = $descripcion['indi_logro_descripcion'];
    
        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 
    }


    // CONSULTA NOTAS DEPORTE //

    $mat_4 = "DEPORTE";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_4, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_4, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_4, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_4 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_4_des_desc = number_format( (float) $nota_final_mat_4, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_4_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3 AND $mat_4_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 3.5 AND $mat_4_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 3.7 AND $mat_4_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 3.9 AND $mat_4_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.2 AND $mat_4_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.4 AND $mat_4_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.6 AND $mat_4_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  >= 4.8 AND $mat_4_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  > 4.9 AND $mat_4_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_4_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3.1 AND $mat_4_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3.2 AND $mat_4_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  >= 3.4 AND $mat_4_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 3.7 AND $mat_4_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  > 3.9 AND $mat_4_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 4.1 AND $mat_4_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.3 AND $mat_4_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  > 4.4 AND $mat_4_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.6 AND $mat_4_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  >= 4.8 AND $mat_4_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  > 4.9 AND $mat_4_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_4_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3.2 AND $mat_4_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3.4 AND $mat_4_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BAJO';

          } elseif ($mat_4_des_desc  > 3.7 AND $mat_4_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  > 3.8 AND $mat_4_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  > 3.9 AND $mat_4_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'BÁSICO';

          } elseif ($mat_4_des_desc  >= 4.1 AND $mat_4_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.3 AND $mat_4_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  > 4.4 AND $mat_4_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'ALTO';

          } elseif ($mat_4_des_desc  >= 4.6 AND $mat_4_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  >= 4.8 AND $mat_4_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_4_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_4_des_desc  > 4.9 AND $mat_4_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_4_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_4, $alum_grado, $periodo, $area1, $mat_4_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_4_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_4, $alum_grado, $periodo, $area2, $mat_4_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_4_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_4, $alum_grado, $periodo, $area3, $mat_4_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_4_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 


    // CONSULTA LENGUAJE //

    $mat_5 = "LENGUAJE";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_5, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_5, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_5, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_5 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_5_des_desc = number_format( (float) $nota_final_mat_5, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_5_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3 AND $mat_5_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 3.5 AND $mat_5_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 3.7 AND $mat_5_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 3.9 AND $mat_5_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.2 AND $mat_5_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.4 AND $mat_5_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.6 AND $mat_5_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  >= 4.8 AND $mat_5_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  > 4.9 AND $mat_5_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_5_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3.1 AND $mat_5_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3.2 AND $mat_5_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  >= 3.4 AND $mat_5_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 3.7 AND $mat_5_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  > 3.9 AND $mat_5_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 4.1 AND $mat_5_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.3 AND $mat_5_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  > 4.4 AND $mat_5_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.6 AND $mat_5_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  >= 4.8 AND $mat_5_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  > 4.9 AND $mat_5_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_5_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3.2 AND $mat_5_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3.4 AND $mat_5_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BAJO';

          } elseif ($mat_5_des_desc  > 3.7 AND $mat_5_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  > 3.8 AND $mat_5_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  > 3.9 AND $mat_5_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'BÁSICO';

          } elseif ($mat_5_des_desc  >= 4.1 AND $mat_5_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.3 AND $mat_5_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  > 4.4 AND $mat_5_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'ALTO';

          } elseif ($mat_5_des_desc  >= 4.6 AND $mat_5_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  >= 4.8 AND $mat_5_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_5_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_5_des_desc  > 4.9 AND $mat_5_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_5_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_5, $alum_grado, $periodo, $area1, $mat_5_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_5_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_5, $alum_grado, $periodo, $area2, $mat_5_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_5_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_5, $alum_grado, $periodo, $area3, $mat_5_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_5_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 


    // CONSULTA INGLES //

    $mat_6 = "INGLES";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_6, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_6, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_6, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_6 = ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_6_des_desc = number_format( (float) $nota_final_mat_6, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_6_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3 AND $mat_6_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 3.5 AND $mat_6_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 3.7 AND $mat_6_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 3.9 AND $mat_6_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.2 AND $mat_6_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.4 AND $mat_6_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.6 AND $mat_6_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  >= 4.8 AND $mat_6_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  > 4.9 AND $mat_6_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_6_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3.1 AND $mat_6_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3.2 AND $mat_6_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  >= 3.4 AND $mat_6_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 3.7 AND $mat_6_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  > 3.9 AND $mat_6_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 4.1 AND $mat_6_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.3 AND $mat_6_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  > 4.4 AND $mat_6_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.6 AND $mat_6_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  >= 4.8 AND $mat_6_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  > 4.9 AND $mat_6_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_6_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3.2 AND $mat_6_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3.4 AND $mat_6_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BAJO';

          } elseif ($mat_6_des_desc  > 3.7 AND $mat_6_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  > 3.8 AND $mat_6_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  > 3.9 AND $mat_6_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'BÁSICO';

          } elseif ($mat_6_des_desc  >= 4.1 AND $mat_6_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.3 AND $mat_6_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  > 4.4 AND $mat_6_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'ALTO';

          } elseif ($mat_6_des_desc  >= 4.6 AND $mat_6_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  >= 4.8 AND $mat_6_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_6_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_6_des_desc  > 4.9 AND $mat_6_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_6_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_6, $alum_grado, $periodo, $area1, $mat_6_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_6_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_6, $alum_grado, $periodo, $area2, $mat_6_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_6_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_6, $alum_grado, $periodo, $area3, $mat_6_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_6_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 
    
    

    // CONSULTA MATEMÁTICAS //

    $mat_7 = "MATEMÁTICAS";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_7, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_7, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_7, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_7= ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_7_des_desc = number_format( (float) $nota_final_mat_7, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_7_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3 AND $mat_7_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 3.5 AND $mat_7_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 3.7 AND $mat_7_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 3.9 AND $mat_7_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.2 AND $mat_7_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.4 AND $mat_7_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.6 AND $mat_7_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  >= 4.8 AND $mat_7_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  > 4.9 AND $mat_7_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_7_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3.1 AND $mat_7_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3.2 AND $mat_7_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  >= 3.4 AND $mat_7_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 3.7 AND $mat_7_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  > 3.9 AND $mat_7_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 4.1 AND $mat_7_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.3 AND $mat_7_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  > 4.4 AND $mat_7_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.6 AND $mat_7_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  >= 4.8 AND $mat_7_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  > 4.9 AND $mat_7_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_7_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3.2 AND $mat_7_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3.4 AND $mat_7_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BAJO';

          } elseif ($mat_7_des_desc  > 3.7 AND $mat_7_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  > 3.8 AND $mat_7_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  > 3.9 AND $mat_7_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'BÁSICO';

          } elseif ($mat_7_des_desc  >= 4.1 AND $mat_7_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.3 AND $mat_7_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  > 4.4 AND $mat_7_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'ALTO';

          } elseif ($mat_7_des_desc  >= 4.6 AND $mat_7_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  >= 4.8 AND $mat_7_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_7_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_7_des_desc  > 4.9 AND $mat_7_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_7_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_7, $alum_grado, $periodo, $area1, $mat_7_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_7_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_7, $alum_grado, $periodo, $area2, $mat_7_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_7_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_7, $alum_grado, $periodo, $area3, $mat_7_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_7_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 



    // CONSULTA INFORMÁTICA //

    $mat_8 = "INFORMÁTICA";
    
    try {

        $nota_p1 = 'PRIMERO';
        $nota_p2 = 'SEGUNDO';
        $nota_p3 = 'TERCERO';

        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_8, $nota_p1);
        $stmt->execute();
        $resultadop1 = $stmt->get_result();
        $datosp1 = $resultadop1->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_8, $nota_p2);
        $stmt->execute();
        $resultadop2 = $stmt->get_result();
        $datosp2 = $resultadop2->fetch_assoc();

        $stmt->bind_param("iss", $id, $mat_8, $nota_p3);
        $stmt->execute();
        $resultadop3 = $stmt->get_result();
        $datosp3 = $resultadop3->fetch_assoc();

        $nota_per1 = str_replace(',', '.', $datosp1['notas_des']);
        $nota_per2 = number_format( (float) $datosp2['notas_des'], 1, '.', '');
        $nota_per3 = number_format( (float) $datosp3['notas_des'], 1, '.', '');

        $nota_final_mat_8= ($nota_per1 + $nota_per2 + $nota_per3) / 3;
        $mat_8_des_desc = number_format( (float) $nota_final_mat_8, 1, '.', '');

        $area1 = 'ACADÉMICO';
        $area2 = 'ACTITUDINAL';
        $area3 = 'PROCEDIMENTAL'; 

        if ($grado_desc == 'PRIMERO' || $grado_desc == 'SEGUNDO' || $grado_desc == 'TERCERO' || $grado_desc == 'CUARTO' || $grado_desc == 'QUINTO') {
        

          if ($mat_8_des_desc  <= 3) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3 AND $mat_8_des_desc  <= 3.4) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 3.5 AND $mat_8_des_desc  <= 3.6) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 3.7 AND $mat_8_des_desc  <= 3.8) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 3.9 AND $mat_8_des_desc  <= 4.1) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.2 AND $mat_8_des_desc  <= 4.3) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.4 AND $mat_8_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.6 AND $mat_8_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  >= 4.8 AND $mat_8_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  > 4.9 AND $mat_8_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'SUPERIOR';

          }

        } elseif ($grado_desc == 'SEXTO' || $grado_desc == 'SÉPTIMO' || $grado_desc == 'OCTAVO') {
          
          if ($mat_8_des_desc  <= 3.1) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3.1 AND $mat_8_des_desc  <= 3.2) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3.2 AND $mat_8_des_desc  <= 3.3) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  >= 3.4 AND $mat_8_des_desc  <= 3.6) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 3.7 AND $mat_8_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  > 3.9 AND $mat_8_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 4.1 AND $mat_8_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.3 AND $mat_8_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  > 4.4 AND $mat_8_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.6 AND $mat_8_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  >= 4.8 AND $mat_8_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  > 4.9 AND $mat_8_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'SUPERIOR';

          }

          
        } elseif ($grado_desc == 'NOVENO' || $grado_desc == 'DÉCIMO' || $grado_desc == 'UNDÉCIMO') {
          
          if ($mat_8_des_desc  <= 3.2) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3.2 AND $mat_8_des_desc  <= 3.4) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3.4 AND $mat_8_des_desc  <= 3.7) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BAJO';

          } elseif ($mat_8_des_desc  > 3.7 AND $mat_8_des_desc  <= 3.8) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  > 3.8 AND $mat_8_des_desc  <= 3.9) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  > 3.9 AND $mat_8_des_desc  <= 4) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'BÁSICO';

          } elseif ($mat_8_des_desc  >= 4.1 AND $mat_8_des_desc  <= 4.2) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.3 AND $mat_8_des_desc  <= 4.4) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  > 4.4 AND $mat_8_des_desc  <= 4.5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'ALTO';

          } elseif ($mat_8_des_desc  >= 4.6 AND $mat_8_des_desc  <= 4.7) {

            $indicador_final = 3;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  >= 4.8 AND $mat_8_des_desc  <= 4.9) {

            $indicador_final = 2;
            $mat_8_des_desc_cl = 'SUPERIOR';

          } elseif ($mat_8_des_desc  > 4.9 AND $mat_8_des_desc  <= 5) {

            $indicador_final = 1;
            $mat_8_des_desc_cl = 'SUPERIOR';

          }

          
        }

        $stmt = $conn->prepare("SELECT * FROM indicadores WHERE indi_materia=? AND indi_grado=? AND indi_periodo=? AND indi_area=? AND indi_logro=? AND indi_logro_nivel=?");
        $stmt->bind_param("ssssss", $mat_8, $alum_grado, $periodo, $area1, $mat_8_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_8_aca_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_8, $alum_grado, $periodo, $area2, $mat_8_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_8_act_desc = $descripcion['indi_logro_descripcion'];

        $stmt->bind_param("ssssss", $mat_8, $alum_grado, $periodo, $area3, $mat_8_des_desc_cl, $indicador_final);
        $stmt->execute();
        $resultado_l = $stmt->get_result();
        $descripcion = $resultado_l->fetch_assoc();
        $mat_8_pro_desc = $descripcion['indi_logro_descripcion'];

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 
    
    // FINAL DE LA CONSULTA DE NOTAS


    try {
    
        $stmt = $conn->prepare("SELECT notas_id_alumno, SUM(notas_des) FROM notas GROUP BY notas_id_alumno");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            $rango_bajo = '0 - 3.0';
            $rango_basico = '3.1 - 3.8';
            $rango_alto = '3.9 - 4.5';
            $rango_superior = '4.6 - 5';

    } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
        
            $rango_bajo = '0 - 3.3';
            $rango_basico = '3.4 - 4';
            $rango_alto = '4.1 - 4.5';
            $rango_superior = '4.6 - 5';

    } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
        
            $rango_bajo = '0 - 3.7';
            $rango_basico = '3.8 - 4';
            $rango_alto = '4.1 - 4.5';
            $rango_superior = '4.6 - 5';
    }





?>