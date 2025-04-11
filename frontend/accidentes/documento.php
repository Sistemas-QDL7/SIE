<?php 
session_start();
require '../../backend/fpdf/fpdf.php';
date_default_timezone_set('America/Mexico_City');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Texto del encabezado
        $this->setY(12);
        $this->setX(10);
        //Nombre del Sistema
        $this->SetFont('times', 'B', 20);
        $this->Text(40, 20, mb_convert_encoding('SIE', 'ISO-8859-1', 'UTF-8'));
        $this->SetFont('times', 'B', 15);
        $this->Text(40, 27, mb_convert_encoding('Sistema Integral de Enfermería', 'ISO-8859-1', 'UTF-8'));
        // Línea debajo del encabezado
        $this->SetLineWidth(0.5); // Grosor de la línea
        $this->Line(10, 31, 200, 31); // Coordenadas de inicio (x1, y1) y fin (x2, y2)


        // Imagen
        $this->Image('../../backend/img/neu.png', 10, 10, 30);

        // Nombre del Archivo
        $this->SetFont('Arial', 'B', 10);    
        $this->Text(80, 54, mb_convert_encoding('Boleta de Accidente Laboral', 'ISO-8859-1', 'UTF-8'));

        
    }

    // Pie de página
    function Footer()
    {
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(265);
        $this->Cell(95, 5, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8').$this->PageNo().' / {nb}', 0, 0, 'L');
        $this->Cell(95, 5, date('d/m/Y | g:i A') , 0, 1, 'R');
        $this->Line(10, 287, 200, 287);
        
        // Añadir los datos que quitamos del encabezado
        $this->Cell(0, 5, mb_convert_encoding('Imprimió: ' . $_SESSION['name'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 30);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);

$pdf->setY(60);
$pdf->setX(135);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);

// Conectar a la base de datos y obtener los datos
require '../../backend/bd/Conexion.php';
$id = $_GET['id'];
$stmt = $connect->prepare("SELECT accidentes.id_acc, accidentes.idlab, laboratory.idlab, laboratory.nomlab, accidentes.idpa,  patients.idpa, patients.numhs, patients.nompa, patients.apepa, patients.grup, accidentes.fecha, accidentes.lesion, accidentes.incapacidad, accidentes.mecanismo_accidente FROM accidentes INNER JOIN patients ON accidentes.idpa = patients.idpa INNER JOIN laboratory ON accidentes.idlab = laboratory.idlab WHERE accidentes.id_acc= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    // Encabezados de la fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('# Colaborador', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(90, 7, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(60, 7, mb_convert_encoding('Área', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0); // Salto de línea

    // Datos de la fila
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 7, mb_convert_encoding($row['numhs'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(90, 7, mb_convert_encoding($row['nompa'] . " " . $row['apepa'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(60, 7, mb_convert_encoding($row['grup'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0); // Salto de línea

    // Agregar espacio antes de la siguiente sección
    $pdf->Ln(5);

    // Sección de 'Fecha'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Fecha:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['fecha'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0); // Completa la fila
    
    // Sección de 'Días de Incapacidad'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Días de Incapacidad:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['incapacidad'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0);

    // Sección de 'Lesión'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Lesión:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['lesion'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0); // Completa la fila

    // Sección de 'Servicio de Atención'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Servicio de Atención:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['nomlab'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0);

    // Sección de 'Mecanismo del Accidente'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, mb_convert_encoding('Mecanismo del Accidente:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L'); // Texto sin borde
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(190, 7, mb_convert_encoding($row['mecanismo_accidente'], 'ISO-8859-1', 'UTF-8'), 1, 'J'); // Texto con borde y justificado

    // Espaciado entre registros
    $pdf->Ln(10);

    // Construir el nombre del archivo
    $fileName = 'accidente_' . $row['nompa'] . ' ' . $row['apepa'] . '_' . $row['numhs'] . '.pdf';
}

// Guardar el archivo PDF con el nombre generado
$pdf->Output($fileName, 'D');
?>