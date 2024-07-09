<?php
require('plugins/fpdf/fpdf.php');

class PDF extends FPDF
{


// Cabecera de página
function Header()
{
    // Logo
    $this->Image('dist/img/cpi_logo.png',10,8,20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(35);
    // Título
    $this->Cell(120,10, utf8_decode('CENTRO PEDAGÓGICO LA INMACULADA'),0,0,'C');
    // Salto de línea
    $this->Ln(8);

    $this->SetFont('Arial','',8);
    $this->Cell(44);
    $this->Write(5, 'LICENCIA DE FUNCIONAMIENTO No 0401 DEL 01 DE NOVIEMBRE DE 2013');
    $this->Ln(4);

    $this->Cell(80);
    $this->Write(5, 'DANE: 308433000654');
    $this->Ln(9);


}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',7);
    $this->SetTextColor(0, 0, 0);
    $this->Cell(93);
    // Número de página
    $this->Cell(10,10, utf8_decode('LOS DATOS CONTENIDOS EN ESTE DOCUMENTO PUEDEN SER VERIFICADOS CON EL CÓDIGO 11048326953 EN: https//www.cplainmaculada.edu.co/verificar'),0,0,'C');
}

}


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
    $alum_mat = '2020'.$id;
    $alum_grado2 = $datos_alum['alum_grado'].' '.'('.$datos_alum['alum_seccion'].')';


    $per = 'SEGUNDO';
    $alum_grado = $datos_alum['alum_grado'];
    $alum_seccion = $datos_alum['alum_seccion'];

    // CONSULTA NOTAS CIENCIAS NATURALES //

    $mat_1 = "CIENCIAS NATURALES";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_1, $per);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_1_aca_desc = '';
        $mat_1_act_desc = '';
        $mat_1_pro_desc = '';
        $mat_1_des_desc = '0';
        $mat_1_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_1_aca_desc = '';
        $mat_1_act_desc = '';
        $mat_1_pro_desc = '';
        $mat_1_des_desc = '0';
        $mat_1_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_1_aca_id = $descripcion['notas_aca'];
        $mat_1_act_id = $descripcion['notas_act'];
        $mat_1_pro_id = $descripcion['notas_pro'];
        $mat_1_des_desc = $descripcion['notas_des'];

    
        $mat_1_des_desc_ct = str_replace(',', '.', $mat_1_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_1_des_desc_ct <= 3.0) {
                $mat_1_des_desc_cl = 'BAJO';
            } elseif ($mat_1_des_desc_ct >= 3.1 && $mat_1_des_desc_ct <= 3.8) {
                $mat_1_des_desc_cl = 'BÁSICO';
            } elseif ($mat_1_des_desc_ct >= 3.9 && $mat_1_des_desc_ct <= 4.5) {
                $mat_1_des_desc_cl = 'ALTO';
            } elseif ($mat_1_des_desc_ct >= 4.6 && $mat_1_des_desc_ct <= 5) {
                $mat_1_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_1_des_desc_ct <= 3.3) {
                $mat_1_des_desc_cl = 'BAJO';
            } elseif ($mat_1_des_desc_ct >= 3.4 && $mat_1_des_desc_ct <= 4) {
                $mat_1_des_desc_cl = 'BÁSICO';
            } elseif ($mat_1_des_desc_ct >= 4.1 && $mat_1_des_desc_ct <= 4.5) {
                $mat_1_des_desc_cl = 'ALTO';
            } elseif ($mat_1_des_desc_ct >= 4.6 && $mat_1_des_desc_ct <= 5) {
                $mat_1_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_1_des_desc_ct <= 3.7) {
                $mat_1_des_desc_cl = 'BAJO';
            } elseif ($mat_1_des_desc_ct >= 3.8 && $mat_1_des_desc_ct <= 4) {
                $mat_1_des_desc_cl = 'BÁSICO';
            } elseif ($mat_1_des_desc_ct >= 4.1 && $mat_1_des_desc_ct <= 4.5) {
                $mat_1_des_desc_cl = 'ALTO';
            } elseif ($mat_1_des_desc_ct >= 4.6 && $mat_1_des_desc_ct <= 5) {
                $mat_1_des_desc_cl = 'SUPERIOR';
            }
        }



        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_1_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_1_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_1_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_1_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_1_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_1_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_1_aca_desc = '';
        $mat_1_act_desc = '';
        $mat_1_pro_desc = '';
        $mat_1_des_desc = '0';
        $mat_1_des_desc_cl = 'N/A';

    }

    

    // CONSULTA NOTAS CIENCIAS SOCIALES //

    $mat_2 = "CIENCIAS SOCIALES";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_2, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_2_aca_desc = '';
        $mat_2_act_desc = '';
        $mat_2_pro_desc = '';
        $mat_2_des_desc = '0';
        $mat_2_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_2_aca_desc = '';
        $mat_2_act_desc = '';
        $mat_2_pro_desc = '';
        $mat_2_des_desc = '0';
        $mat_2_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_2_aca_id = $descripcion['notas_aca'];
        $mat_2_act_id = $descripcion['notas_act'];
        $mat_2_pro_id = $descripcion['notas_pro'];
        $mat_2_des_desc = $descripcion['notas_des'];

        $mat_2_des_desc_ct = str_replace(',', '.', $mat_2_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_2_des_desc_ct <= 3.0) {
                $mat_2_des_desc_cl = 'BAJO';
            } elseif ($mat_2_des_desc_ct >= 3.1 && $mat_2_des_desc_ct <= 3.8) {
                $mat_2_des_desc_cl = 'BÁSICO';
            } elseif ($mat_2_des_desc_ct >= 3.9 && $mat_2_des_desc_ct <= 4.5) {
                $mat_2_des_desc_cl = 'ALTO';
            } elseif ($mat_2_des_desc_ct >= 4.6 && $mat_2_des_desc_ct <= 5) {
                $mat_2_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_2_des_desc_ct <= 3.3) {
                $mat_2_des_desc_cl = 'BAJO';
            } elseif ($mat_2_des_desc_ct >= 3.4 && $mat_2_des_desc_ct <= 4) {
                $mat_2_des_desc_cl = 'BÁSICO';
            } elseif ($mat_2_des_desc_ct >= 4.1 && $mat_2_des_desc_ct <= 4.5) {
                $mat_2_des_desc_cl = 'ALTO';
            } elseif ($mat_2_des_desc_ct >= 4.6 && $mat_2_des_desc_ct <= 5) {
                $mat_2_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_2_des_desc_ct <= 3.7) {
                $mat_2_des_desc_cl = 'BAJO';
            } elseif ($mat_2_des_desc_ct >= 3.8 && $mat_2_des_desc_ct <= 4) {
                $mat_2_des_desc_cl = 'BÁSICO';
            } elseif ($mat_2_des_desc_ct >= 4.1 && $mat_2_des_desc_ct <= 4.5) {
                $mat_2_des_desc_cl = 'ALTO';
            } elseif ($mat_2_des_desc_ct >= 4.6 && $mat_2_des_desc_ct <= 5) {
                $mat_2_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_2_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_2_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_2_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_2_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_2_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_2_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_2_aca_desc = '';
        $mat_2_act_desc = '';
        $mat_2_pro_desc = '';
        $mat_2_des_desc = '0';
        $mat_2_des_desc_cl = 'N/A';

    }
    


    // CONSULTA NOTAS ARTE Y ÉTICA //

    $mat_3 = "ARTE Y ÉTICA";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_3, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_3_aca_desc = '';
        $mat_3_act_desc = '';
        $mat_3_pro_desc = '';
        $mat_3_des_desc = '0';
        $mat_3_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_3_aca_desc = '';
        $mat_3_act_desc = '';
        $mat_3_pro_desc = '';
        $mat_3_des_desc = '0';
        $mat_3_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_3_aca_id = $descripcion['notas_aca'];
        $mat_3_act_id = $descripcion['notas_act'];
        $mat_3_pro_id = $descripcion['notas_pro'];
        $mat_3_des_desc = $descripcion['notas_des'];

        $mat_3_des_desc_ct = str_replace(',', '.', $mat_3_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            $mat_3_des_desc_cl = 'N/A';

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_3_des_desc_ct <= 3.3) {
                $mat_3_des_desc_cl = 'BAJO';
            } elseif ($mat_3_des_desc_ct >= 3.4 && $mat_3_des_desc_ct <= 4) {
                $mat_3_des_desc_cl = 'BÁSICO';
            } elseif ($mat_3_des_desc_ct >= 4.1 && $mat_3_des_desc_ct <= 4.5) {
                $mat_3_des_desc_cl = 'ALTO';
            } elseif ($mat_3_des_desc_ct >= 4.6 && $mat_3_des_desc_ct <= 5) {
                $mat_3_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_3_des_desc_ct <= 3.7) {
                $mat_3_des_desc_cl = 'BAJO';
            } elseif ($mat_3_des_desc_ct >= 3.8 && $mat_3_des_desc_ct <= 4) {
                $mat_3_des_desc_cl = 'BÁSICO';
            } elseif ($mat_3_des_desc_ct >= 4.1 && $mat_3_des_desc_ct <= 4.5) {
                $mat_3_des_desc_cl = 'ALTO';
            } elseif ($mat_3_des_desc_ct >= 4.6 && $mat_3_des_desc_ct <= 5) {
                $mat_3_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_3_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_3_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_3_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_3_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_3_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_3_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_3_aca_desc = '';
        $mat_3_act_desc = '';
        $mat_3_pro_desc = '';
        $mat_3_des_desc = '0';
        $mat_3_des_desc_cl = 'N/A';

    }


    // CONSULTA NOTAS DEPORTE //

    $mat_4 = "DEPORTE";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_4, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_4_aca_desc = '';
        $mat_4_act_desc = '';
        $mat_4_pro_desc = '';
        $mat_4_des_desc = '0';
        $mat_4_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_4_aca_desc = '';
        $mat_4_act_desc = '';
        $mat_4_pro_desc = '';
        $mat_4_des_desc = '0';
        $mat_4_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_4_aca_id = $descripcion['notas_aca'];
        $mat_4_act_id = $descripcion['notas_act'];
        $mat_4_pro_id = $descripcion['notas_pro'];
        $mat_4_des_desc = $descripcion['notas_des'];

        $mat_4_des_desc_ct = str_replace(',', '.', $mat_4_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_4_des_desc_ct <= 3.0) {
                $mat_4_des_desc_cl = 'BAJO';
            } elseif ($mat_4_des_desc_ct >= 3.1 && $mat_4_des_desc_ct <= 3.8) {
                $mat_4_des_desc_cl = 'BÁSICO';
            } elseif ($mat_4_des_desc_ct >= 3.9 && $mat_4_des_desc_ct <= 4.5) {
                $mat_4_des_desc_cl = 'ALTO';
            } elseif ($mat_4_des_desc_ct >= 4.6 && $mat_4_des_desc_ct <= 5) {
                $mat_4_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_4_des_desc_ct <= 3.3) {
                $mat_4_des_desc_cl = 'BAJO';
            } elseif ($mat_4_des_desc_ct >= 3.4 && $mat_4_des_desc_ct <= 4) {
                $mat_4_des_desc_cl = 'BÁSICO';
            } elseif ($mat_4_des_desc_ct >= 4.1 && $mat_4_des_desc_ct <= 4.5) {
                $mat_4_des_desc_cl = 'ALTO';
            } elseif ($mat_4_des_desc_ct >= 4.6 && $mat_4_des_desc_ct <= 5) {
                $mat_4_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_4_des_desc_ct <= 3.7) {
                $mat_4_des_desc_cl = 'BAJO';
            } elseif ($mat_4_des_desc_ct >= 3.8 && $mat_4_des_desc_ct <= 4) {
                $mat_4_des_desc_cl = 'BÁSICO';
            } elseif ($mat_4_des_desc_ct >= 4.1 && $mat_4_des_desc_ct <= 4.5) {
                $mat_4_des_desc_cl = 'ALTO';
            } elseif ($mat_4_des_desc_ct >= 4.6 && $mat_4_des_desc_ct <= 5) {
                $mat_4_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_4_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_4_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_4_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_4_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_4_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_4_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_4_aca_desc = '';
        $mat_4_act_desc = '';
        $mat_4_pro_desc = '';
        $mat_4_des_desc = '0';
        $mat_4_des_desc_cl = 'N/A';

    }


    // CONSULTA LENGUAJE //

    $mat_5 = "LENGUAJE";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_5, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_5_aca_desc = '';
        $mat_5_act_desc = '';
        $mat_5_pro_desc = '';
        $mat_5_des_desc = '0';
        $mat_5_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_5_aca_desc = '';
        $mat_5_act_desc = '';
        $mat_5_pro_desc = '';
        $mat_5_des_desc = '0';
        $mat_5_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_5_aca_id = $descripcion['notas_aca'];
        $mat_5_act_id = $descripcion['notas_act'];
        $mat_5_pro_id = $descripcion['notas_pro'];
        $mat_5_des_desc = $descripcion['notas_des'];

        $mat_5_des_desc_ct = str_replace(',', '.', $mat_5_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_5_des_desc_ct <= 3.0) {
                $mat_5_des_desc_cl = 'BAJO';
            } elseif ($mat_5_des_desc_ct >= 3.1 && $mat_5_des_desc_ct <= 3.8) {
                $mat_5_des_desc_cl = 'BÁSICO';
            } elseif ($mat_5_des_desc_ct >= 3.9 && $mat_5_des_desc_ct <= 4.5) {
                $mat_5_des_desc_cl = 'ALTO';
            } elseif ($mat_5_des_desc_ct >= 4.6 && $mat_5_des_desc_ct <= 5) {
                $mat_5_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_5_des_desc_ct <= 3.3) {
                $mat_5_des_desc_cl = 'BAJO';
            } elseif ($mat_5_des_desc_ct >= 3.4 && $mat_5_des_desc_ct <= 4) {
                $mat_5_des_desc_cl = 'BÁSICO';
            } elseif ($mat_5_des_desc_ct >= 4.1 && $mat_5_des_desc_ct <= 4.5) {
                $mat_5_des_desc_cl = 'ALTO';
            } elseif ($mat_5_des_desc_ct >= 4.6 && $mat_5_des_desc_ct <= 5) {
                $mat_5_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_5_des_desc_ct <= 3.7) {
                $mat_5_des_desc_cl = 'BAJO';
            } elseif ($mat_5_des_desc_ct >= 3.8 && $mat_5_des_desc_ct <= 4) {
                $mat_5_des_desc_cl = 'BÁSICO';
            } elseif ($mat_5_des_desc_ct >= 4.1 && $mat_5_des_desc_ct <= 4.5) {
                $mat_5_des_desc_cl = 'ALTO';
            } elseif ($mat_5_des_desc_ct >= 4.6 && $mat_5_des_desc_ct <= 5) {
                $mat_5_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_5_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_5_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_5_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_5_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_5_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_5_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_5_aca_desc = '';
        $mat_5_act_desc = '';
        $mat_5_pro_desc = '';
        $mat_5_des_desc = '0';
        $mat_5_des_desc_cl = 'N/A';

    }


    // CONSULTA INGLES //

    $mat_6 = "INGLES";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_6, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_6_aca_desc = '';
        $mat_6_act_desc = '';
        $mat_6_pro_desc = '';
        $mat_6_des_desc = '0';
        $mat_6_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_6_aca_desc = '';
        $mat_6_act_desc = '';
        $mat_6_pro_desc = '';
        $mat_6_des_desc = '0';
        $mat_6_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_6_aca_id = $descripcion['notas_aca'];
        $mat_6_act_id = $descripcion['notas_act'];
        $mat_6_pro_id = $descripcion['notas_pro'];
        $mat_6_des_desc = $descripcion['notas_des'];

        $mat_6_des_desc_ct = str_replace(',', '.', $mat_6_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_6_des_desc_ct <= 3.0) {
                $mat_6_des_desc_cl = 'BAJO';
            } elseif ($mat_6_des_desc_ct >= 3.1 && $mat_6_des_desc_ct <= 3.8) {
                $mat_6_des_desc_cl = 'BÁSICO';
            } elseif ($mat_6_des_desc_ct >= 3.9 && $mat_6_des_desc_ct <= 4.5) {
                $mat_6_des_desc_cl = 'ALTO';
            } elseif ($mat_6_des_desc_ct >= 4.6 && $mat_6_des_desc_ct <= 5) {
                $mat_6_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_6_des_desc_ct <= 3.3) {
                $mat_6_des_desc_cl = 'BAJO';
            } elseif ($mat_6_des_desc_ct >= 3.4 && $mat_6_des_desc_ct <= 4) {
                $mat_6_des_desc_cl = 'BÁSICO';
            } elseif ($mat_6_des_desc_ct >= 4.1 && $mat_6_des_desc_ct <= 4.5) {
                $mat_6_des_desc_cl = 'ALTO';
            } elseif ($mat_6_des_desc_ct >= 4.6 && $mat_6_des_desc_ct <= 5) {
                $mat_6_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_6_des_desc_ct <= 3.7) {
                $mat_6_des_desc_cl = 'BAJO';
            } elseif ($mat_6_des_desc_ct >= 3.8 && $mat_6_des_desc_ct <= 4) {
                $mat_6_des_desc_cl = 'BÁSICO';
            } elseif ($mat_6_des_desc_ct >= 4.1 && $mat_6_des_desc_ct <= 4.5) {
                $mat_6_des_desc_cl = 'ALTO';
            } elseif ($mat_6_des_desc_ct >= 4.6 && $mat_6_des_desc_ct <= 5) {
                $mat_6_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_6_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_6_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_6_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_6_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_6_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_6_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_6_aca_desc = '';
        $mat_6_act_desc = '';
        $mat_6_pro_desc = '';
        $mat_6_des_desc = '0';
        $mat_6_des_desc_cl = 'N/A';

    }
    
    

    // CONSULTA MATEMÁTICAS //

    $mat_7 = "MATEMÁTICAS";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_7, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_7_aca_desc = '';
        $mat_7_act_desc = '';
        $mat_7_pro_desc = '';
        $mat_7_des_desc = '0';
        $mat_7_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_7_aca_desc = '';
        $mat_7_act_desc = '';
        $mat_7_pro_desc = '';
        $mat_7_des_desc = '0';
        $mat_7_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_7_aca_id = $descripcion['notas_aca'];
        $mat_7_act_id = $descripcion['notas_act'];
        $mat_7_pro_id = $descripcion['notas_pro'];
        $mat_7_des_desc = $descripcion['notas_des'];

        $mat_7_des_desc_ct = str_replace(',', '.', $mat_7_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_7_des_desc_ct <= 3.0) {
                $mat_7_des_desc_cl = 'BAJO';
            } elseif ($mat_7_des_desc_ct >= 3.1 && $mat_7_des_desc_ct <= 3.8) {
                $mat_7_des_desc_cl = 'BÁSICO';
            } elseif ($mat_7_des_desc_ct >= 3.9 && $mat_7_des_desc_ct <= 4.5) {
                $mat_7_des_desc_cl = 'ALTO';
            } elseif ($mat_7_des_desc_ct >= 4.6 && $mat_7_des_desc_ct <= 5) {
                $mat_7_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_7_des_desc_ct <= 3.3) {
                $mat_7_des_desc_cl = 'BAJO';
            } elseif ($mat_7_des_desc_ct >= 3.4 && $mat_7_des_desc_ct <= 4) {
                $mat_7_des_desc_cl = 'BÁSICO';
            } elseif ($mat_7_des_desc_ct >= 4.1 && $mat_7_des_desc_ct <= 4.5) {
                $mat_7_des_desc_cl = 'ALTO';
            } elseif ($mat_7_des_desc_ct >= 4.6 && $mat_7_des_desc_ct <= 5) {
                $mat_7_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_7_des_desc_ct <= 3.7) {
                $mat_7_des_desc_cl = 'BAJO';
            } elseif ($mat_7_des_desc_ct >= 3.8 && $mat_7_des_desc_ct <= 4) {
                $mat_7_des_desc_cl = 'BÁSICO';
            } elseif ($mat_7_des_desc_ct >= 4.1 && $mat_7_des_desc_ct <= 4.5) {
                $mat_7_des_desc_cl = 'ALTO';
            } elseif ($mat_7_des_desc_ct >= 4.6 && $mat_7_des_desc_ct <= 5) {
                $mat_7_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_7_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_7_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_7_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_7_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_7_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_7_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_7_aca_desc = '';
        $mat_7_act_desc = '';
        $mat_7_pro_desc = '';
        $mat_7_des_desc = '0';
        $mat_7_des_desc_cl = 'N/A';

    }



    // CONSULTA INFORMÁTICA //

    $mat_8 = "INFORMÁTICA";
    
    try {
    
        $stmt = $conn->prepare("SELECT * FROM notas WHERE notas_id_alumno=? AND notas_materia=? AND notas_per=?");
        $stmt->bind_param("iss", $id, $mat_8, $per);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $descripcion = $resultado->fetch_assoc();

    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    } 

    if (is_null($descripcion)) {
        $mat_8_aca_desc = '';
        $mat_8_act_desc = '';
        $mat_8_pro_desc = '';
        $mat_8_des_desc = '0';
        $mat_8_des_desc_cl = 'N/A';

    } elseif (empty($descripcion)) {
        $mat_8_aca_desc = '';
        $mat_8_act_desc = '';
        $mat_8_pro_desc = '';
        $mat_8_des_desc = '0';
        $mat_8_des_desc_cl = 'N/A';

    } elseif (isset($descripcion)) {
        $mat_8_aca_id = $descripcion['notas_aca'];
        $mat_8_act_id = $descripcion['notas_act'];
        $mat_8_pro_id = $descripcion['notas_pro'];
        $mat_8_des_desc = $descripcion['notas_des'];

        $mat_8_des_desc_ct = str_replace(',', '.', $mat_8_des_desc);

        if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            if ($mat_8_des_desc_ct <= 3.0) {
                $mat_8_des_desc_cl = 'BAJO';
            } elseif ($mat_8_des_desc_ct >= 3.1 && $mat_8_des_desc_ct <= 3.8) {
                $mat_8_des_desc_cl = 'BÁSICO';
            } elseif ($mat_8_des_desc_ct >= 3.9 && $mat_8_des_desc_ct <= 4.5) {
                $mat_8_des_desc_cl = 'ALTO';
            } elseif ($mat_8_des_desc_ct >= 4.6 && $mat_8_des_desc_ct <= 5) {
                $mat_8_des_desc_cl = 'SUPERIOR';
            }

        } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO') {
            
            if ($mat_8_des_desc_ct <= 3.3) {
                $mat_8_des_desc_cl = 'BAJO';
            } elseif ($mat_8_des_desc_ct >= 3.4 && $mat_8_des_desc_ct <= 4) {
                $mat_8_des_desc_cl = 'BÁSICO';
            } elseif ($mat_8_des_desc_ct >= 4.1 && $mat_8_des_desc_ct <= 4.5) {
                $mat_8_des_desc_cl = 'ALTO';
            } elseif ($mat_8_des_desc_ct >= 4.6 && $mat_8_des_desc_ct <= 5) {
                $mat_8_des_desc_cl = 'SUPERIOR';
            }
        } elseif ($alum_grado == 'NOVENO' || $alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
            
            if ($mat_8_des_desc_ct <= 3.7) {
                $mat_8_des_desc_cl = 'BAJO';
            } elseif ($mat_8_des_desc_ct >= 3.8 && $mat_8_des_desc_ct <= 4) {
                $mat_8_des_desc_cl = 'BÁSICO';
            } elseif ($mat_8_des_desc_ct >= 4.1 && $mat_8_des_desc_ct <= 4.5) {
                $mat_8_des_desc_cl = 'ALTO';
            } elseif ($mat_8_des_desc_ct >= 4.6 && $mat_8_des_desc_ct <= 5) {
                $mat_8_des_desc_cl = 'SUPERIOR';
            }
        }

    
        try {
            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_8_aca_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_8_aca_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_8_act_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_8_act_desc = $descripcion2['indi_logro_descripcion'];

            $stmt = $conn->prepare("SELECT indi_logro_descripcion FROM indicadores WHERE indi_id =?");
            $stmt->bind_param("i", $mat_8_pro_id);
            $stmt->execute();
            $resultado2 = $stmt->get_result();
            $descripcion2 = $resultado2->fetch_assoc();
            $mat_8_pro_desc = $descripcion2['indi_logro_descripcion'];

        } catch (\Exception $e) {
            $error = $e->getMessage();
            echo $error;
        } 

    } else {
        $mat_8_aca_desc = '';
        $mat_8_act_desc = '';
        $mat_8_pro_desc = '';
        $mat_8_des_desc = '0';
        $mat_8_des_desc_cl = 'N/A';

    }
    


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