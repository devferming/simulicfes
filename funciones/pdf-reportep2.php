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
    $this->Cell(10,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

}



    // CONSULTA NOTA ESTUDIANTE POR MATERIA Y SECCION //

    $materia = $_SESSION['users_mat'];
    $grado = $_SESSION['dgrupo'];
    $seccion = $_SESSION['dgrupos'];
    $periodo = "SEGUNDO";



    try {
        $stmt = $conn->prepare("SELECT * FROM materias");
        $stmt->execute();
        $resultado1 = $stmt->get_result();
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }




?>