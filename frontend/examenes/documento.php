<?php 
session_start();
require '../../backend/fpdf/fpdf.php';
require '../../backend/bd/Conexion.php';
date_default_timezone_set('America/Mexico_City');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
{
    // Imagen constante (Logo)
    $this->Image('../../backend/img/neu.png', 10, 10, 40); // Logo en la esquina superior izquierda

    // Cuadro principal (encabezado completo)
    $this->SetLineWidth(0.3);
    $this->Rect(10, 10, 190, 32); // Altura ajustada a 32

    // División interna: Línea vertical (separa logo y texto)
    $this->Line(50, 10, 50, 42); // Nueva altura ajustada (y=42)

    // Títulos a la derecha del logo
    $this->SetFont('Arial', 'B', 12);
    $this->Text(52, 19, mb_convert_encoding('DIRECCIÓN DE ADMINISTRACIÓN Y FINANZAS', 'ISO-8859-1', 'UTF-8')); // Ajustado a y=19
    $this->SetFont('Arial', 'B', 14);
    $this->Text(62, 35, mb_convert_encoding('RESULTADO EXAMEN MÉDICO', 'ISO-8859-1', 'UTF-8')); // Ajustado a y=34

    // Configura la posición de la tabla a la derecha
    $this->SetFont('Arial', '', 10);
    $this->setY(12);
    $this->setX(130);

    global $connect;
        $stmt1 = $connect->prepare("SELECT * FROM format_templates WHERE id = 2");
        $stmt1->execute();
        $formato = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($formato) {
            $codigo = $formato['codigo'];
            $elaboracion = $formato['elaboracion'];
            $revision = $formato['revision'];
            $expiracion = $formato['expiracion'];
            $rev = $formato['rev'];
            $paginas = $formato['paginas'];
        }

    // División interna: Línea vertical (separa los títulos y texto)
    $this->Line(150, 10, 150, 42); // Línea ajustada a nueva altura (y=42)

    $this->Line(50, 25, 150, 25); // Línea horizontal desde (x=10, y=30) hasta (x=200, y=30)

    // Datos en la parte derecha (última columna)
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Código: ', 'ISO-8859-1', 'UTF-8') . $codigo, 0, 1, 'L');
    $this->Line(150, 17, 200, 17);
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Fecha Elaboración: ', 'ISO-8859-1', 'UTF-8') . $elaboracion, 0, 1, 'L');
    $this->Line(150, 22, 200, 22);
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Fecha Revisión: ', 'ISO-8859-1', 'UTF-8') . $revision, 0, 1, 'L');
    $this->Line(150, 27, 200, 27);
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Fecha Expiración: ', 'ISO-8859-1', 'UTF-8') . $expiracion, 0, 1, 'L');
    $this->Line(150, 32, 200, 32);
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Revisión: ', 'ISO-8859-1', 'UTF-8') . $rev, 0, 1, 'L');
    $this->Line(150, 37, 200, 37);
    $this->setX(150);
    $this->Cell(70, 5, mb_convert_encoding('Página: ', 'ISO-8859-1', 'UTF-8') . $paginas, 0, 1, 'L');

    // Línea horizontal final ajustada
    $this->Line(10, 42, 200, 42); // Nueva posición de la línea final (y=42)

    // Sistema en la parte inferior (centrado)
    $this->SetY(44);
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(0, 10, mb_convert_encoding('SIE - SISTEMA INTEGRAL DE ENFERMERÍA', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
}



// División interna: Línea horizontal (parte justo a la mitad)
    //$this->Line(50, 30, 150, 30); // Línea horizontal desde (x=10, y=30) hasta (x=200, y=30)

    // Pie de página
    function Footer()
    {
        $this->SetFont('helvetica', 'B', 8);
        $this->SetY(265);
        $this->Cell(0, 5, mb_convert_encoding('Campo Menonita 105 #516 C.P. 31615. Ciudad Cuauhtémoc. Tel. 01 800 720 50 50', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
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

// Encabezados de la tabla principal
//$pdf->SetFont('Arial', 'B', 10);
//$pdf->Cell(40, 7, mb_convert_encoding('# Colaborador', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
//$pdf->Cell(70, 7, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
//$pdf->Cell(70, 7, mb_convert_encoding('Área', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);


$pdf->SetFont('Arial', '', 10);

// Conectar a la base de datos y obtener los datos

$id = $_GET['id'];
$stmt = $connect->prepare("SELECT examenes.idex, examenes.nombre, examenes.status,  examenes.observaciones, examenes.fecha, examenes.idodc, doctor.idodc, doctor.nodoc, doctor.apdoc FROM examenes INNER JOIN doctor ON examenes.idodc = doctor.idodc WHERE examenes.idex= '$id'");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

while ($row = $stmt->fetch()) {
    // Encabezados de la fila
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('# Colaborador', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(80, 7, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(70, 7, mb_convert_encoding('Área', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0); // Salto de línea

    // Datos de la fila
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('N/A', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(80, 7, mb_convert_encoding($row['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(70, 7, mb_convert_encoding('N/A', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0); // Salto de línea

    // Agregar espacio antes de la siguiente sección
    $pdf->Ln(5);

    // Sección de 'Fecha'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Fecha:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['fecha'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0); // Completa la fila
    
    // Sección de 'Estatus'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Estatus:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['status'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0);

    // Sección de 'Nombre de quién realizo el examen médico'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, mb_convert_encoding('Examen reaizado por:', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(150, 7, mb_convert_encoding($row['nodoc']. " " . $row['apdoc'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'L', 0);

    // Sección de 'Observaciones'
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 7, mb_convert_encoding('Observaciones:', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L'); // Texto sin borde

    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(190, 7, mb_convert_encoding($row['observaciones'], 'ISO-8859-1', 'UTF-8'), 1, 'J'); // Texto con borde y justificado


    
    // Posicionar la línea
    $pdf->SetXY(80, 220); // Coordenadas de inicio
    $pdf->Cell(50, 5, '', 'T', 0, 'C'); // 'T' dibuja solo la línea superior

    // Texto opcional debajo de la línea
    $pdf->SetY(225); // Coordenada fija en el eje Y (altura de la página)
$pdf->SetX(80);  // Coordenada fija en el eje X (horizontal desde la izquierda)
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(50, 5, mb_convert_encoding('Firma de quien realiza el examen médico', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C'); // Texto opcional

    

    // Espaciado entre registros
    $pdf->Ln(10);

    // Construir el nombre del archivo
    $fileName = 'examen_nuevo_ingreso_' . $row['nombre'].'.pdf';
}

// Guardar el archivo PDF con el nombre generado
$pdf->Output($fileName, 'D');
?>