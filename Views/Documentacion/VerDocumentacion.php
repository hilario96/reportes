<?php
require_once "Assets/pdf/fpdf.php";
$total = 0.00;
$pdf = new FPDF('P', 'mm', array(105 , 148));
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Documentacion");
$pdf->image(base_url().'Assets/img/logo.jpg', 70, 5, 30, 30, 'JPG');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(50, 5, utf8_decode($config['objeto']), 0, 1, 'L');
$pdf->Cell(20, 5, utf8_decode("clave"), 0, 0, 'L');
$pdf->setFont('Arial', '', 10);
$pdf->Cell(50, 5, utf8_decode($config['clave']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Teléfono"), 0, 0, 'L');
$pdf->setFont('Arial', '', 10);
$pdf->Cell(50, 5, utf8_decode($config['telefono']), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Dirección"), 0, 0, 'L');
$pdf->setFont('Arial', '', 10);
$pdf->Cell(50, 5, utf8_decode($config['direccion']), 0, 1, 'L');
$pdf->Ln();
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(80, 8, utf8_decode("Datos del promotor"), 0, 1, 'C');
$pdf->setFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(20, 5, 'clave', 0, 0, 'L');
$pdf->Cell(50, 5, 'objeto', 0, 0, 'L');
$pdf->Cell(30, 5, utf8_decode('Teléfono'), 0, 0, 'L');


$pdf->Ln(10);
$pdf->setFont('Arial', '', 9);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(45, 5, utf8_decode('Descripción'), 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'Cant.', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'Condcion', 1, 0, 'L', 1);
$pdf->Cell(20, 5, 'Sub Total', 1, 1, 'L', 1);

foreach ($data as $documentacion) {
    $subtotal = $documentacion['cantidad'] * $documentacion[''];
    $total = $total + $subtotal;
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(45, 5, utf8_decode($documentacion['objeto']), 0, 0, 'L');
    $pdf->Cell(10, 5, $documentacion['cantidad'], 0, 0, 'L');
    $pdf->Cell(45, 5, utf8_decode($documentacion['condicion']), 0, 0, 'L');
    $pdf->Cell(20, 5, number_format($subtotal, 2, '.', ','), 0, 1, 'L');
}
$pdf->Ln();
$pdf->Cell(90, 5, 'Total S/.'. number_format( $total, 2, '.', ','), 0, 1, 'R');

$pdf->Output();
?>