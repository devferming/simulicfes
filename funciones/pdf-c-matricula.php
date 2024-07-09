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
    $this->SetY(-25);
    // Arial italic 8
    $this->SetFont('Arial','',9);
    $this->SetTextColor(0, 0, 0);
    $this->Cell(93);
    $this->Cell(10,10, utf8_decode('Dirección Calle 10D No 2CS-08  Teléfono: 3164298'),0,0,'C');
    $this->Ln(4);//Linea nueva

    $this->Cell(93);
    $this->Cell(10,10, utf8_decode('E-mail: cepelainmaculada@gmail.com'),0,0,'C');
    $this->Ln(4);//Linea nueva

    $this->Cell(93);
    $this->Cell(10,10, utf8_decode('Bellavista - Malambo'),0,0,'C');

}

var $B=0;
var $I=0;
var $U=0;
var $HREF='';
var $ALIGN='';

function WriteHTML($html)
{
    //HTML parser
    $html=str_replace("\n",' ',$html);
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            elseif($this->ALIGN=='center')
                $this->Cell(0,5,$e,0,1,'C');
            else
                $this->Write(5,$e);
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract properties
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $prop=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $prop[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$prop);
            }
        }
    }
}

function OpenTag($tag,$prop)
{
    //Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF=$prop['HREF'];
    if($tag=='BR')
        $this->Ln(5);
    if($tag=='P')
        $this->ALIGN=$prop['ALIGN'];
    if($tag=='HR')
    {
        if( !empty($prop['WIDTH']) )
            $Width = $prop['WIDTH'];
        else
            $Width = $this->w - $this->lMargin-$this->rMargin;
        $this->Ln(2);
        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetLineWidth(0.4);
        $this->Line($x,$y,$x+$Width,$y);
        $this->SetLineWidth(0.2);
        $this->Ln(2);
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='P')
        $this->ALIGN='';
}

function SetStyle($tag,$enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
        if($this->$s>0)
            $style.=$s;
    $this->SetFont('',$style);
}

function PutLink($URL,$txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


}


    // CONSULTA DATOS ESTUDIANTE //

    $hoy = date("Y-m-d H:i:s");

    $dia = date('d');

    $mes2 = date('m');

    if ($mes2 == 01) {
    $mes = 'Enero';
    } elseif ($mes2 == 02) {
    $mes = 'Febrero';
    } elseif ($mes2 == 03) {
    $mes = 'Marzo';
    } elseif ($mes2 == 04) {
    $mes = 'Abril';
    } elseif ($mes2 == 05) {
    $mes = 'Mayo';
    } elseif ($mes2 == 06) {
    $mes = 'Junio';
    } elseif ($mes2 == 07) {
    $mes = 'Julio';
    } elseif ($mes2 == 10) {
    $mes = 'Octubre';
    } elseif ($mes2 == 11) {
    $mes = 'Noviembre';
    } elseif ($mes2 == 12) {
    $mes = 'Diciembre';
    }

    $anio = date('Y');

    try {
        $stmt = $conn->prepare("SELECT alum_doc_tipo, alum_doc_numero, alum_1er_apellido, alum_2do_apellido, alum_1er_nombre, alum_2do_nombre, alum_genero, alum_grado, alum_seccion, alum_banco_ofe  FROM alumnos WHERE alum_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos_alum = $resultado->fetch_assoc();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }

    $alum_grado = $datos_alum['alum_grado'];
    $alum_genero = $datos_alum['alum_genero'];

    if ($alum_genero == 'MASCULINO') {
        $identif = 'identificado con';
        $matri = 'matriculado';
    } elseif ($alum_genero == 'FEMENINO') {
        $identif = 'identificada con';
        $matri = 'matriculada';
    }


    try {
        $stmt = $conn->prepare("SELECT gdo_cod_grado FROM grados WHERE gdo_des_grado=?");
        $stmt->bind_param("s", $alum_grado);
        $stmt->execute();
        $resultado2 = $stmt->get_result();
        $datos_alum2 = $resultado2->fetch_assoc();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }

    $grado_cod = $datos_alum2['gdo_cod_grado'];
    $oferente = $datos_alum['alum_banco_ofe'];

    if ($oferente == 'SI') {
        $oferent = 'Subsidiado en un 100% en el PROGRAMA DE BANCO DE OFERENTES';
    } else {
        $oferent = '';
    }


    $alum_nombre = $datos_alum['alum_1er_nombre'].' '.$datos_alum['alum_2do_nombre'].' '.$datos_alum['alum_1er_apellido'].' '.$datos_alum['alum_2do_apellido'];

    $alum_grado2 = $datos_alum['alum_grado'].' ('.$grado_cod.'°'.')'.' Sección: '.'('.$datos_alum['alum_seccion'].')';
    $doc_tipo = $datos_alum['alum_doc_tipo'];
    $doc_numb = $datos_alum['alum_doc_numero'];



    if ($alum_grado == 'PRIMERO' || $alum_grado == 'SEGUNDO' || $alum_grado == 'TERCERO' || $alum_grado == 'CUARTO' || $alum_grado == 'QUINTO') {

            $jordana = 'Mañana';
            $educacion = 'Educación Básica Primaria';
            $matricula = '$120.000';
            $pension = '$100.000';

    } elseif ($alum_grado == 'SEXTO' || $alum_grado == 'SÉPTIMO' || $alum_grado == 'OCTAVO' || $alum_grado == 'NOVENO') {
        
            $jordana = 'Mañana';
            $educacion = 'Educación Básica Secundaria';
            $matricula = '$150.000';
            $pension = '$120.000';


    } elseif ($alum_grado == 'DÉCIMO' || $alum_grado == 'UNDÉCIMO') {
        
            $jordana = 'Única';
            $educacion = 'Educación Media';
            $matricula = '$150.000';
            $pension = '$120.000';

    }


    $html1 = 'Que '.'<b>'.$alum_nombre.'</b>'.' '.$identif.' '.'<b>'.$doc_tipo.' N°'.$doc_numb.'</b>'.', se encuentra '.$matri.' en esta institución en la Jornada '.'<b>'.$jordana.'</b>'.' para cursar el grado '.'<b>'.$alum_grado2.'</b>'.' de '.$educacion.' en el presente año lectivo '.$anio.'. '.$oferent. 
    '<br>
    <br>'
    .'Cancelando por concepto de Matrícula un valor de '. $matricula.', y por concepto de pensión un valor de '.$pension. 
    '<br>
    <br>'
    .
    'Dado en Malambo a los '.$dia.' días del mes de '.$mes.' del '.$anio;




?>