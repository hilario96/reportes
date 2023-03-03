<?php
require_once "Assets/pdf/fpdf.php";
$total = 0.00;
$pdf = new FPDF('p', 'mm', array(105, 148));
$pdf->AddPage();
$pdf->setFont('Arial', 'B', 14);
$pdf->setTitle("Reporte");
$pdf->image(base_url().'Assets/img/logo.jpg', 70, 5, 30, 30, 'JPG');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(50, 5, utf8_decode($alert["nombre"]), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Teléfono"), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(50, 5, utf8_decode($alert["telefono"]), 0, 1, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Dirección"), 0, 0, 'L');
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(50, 5, utf8_decode($alert["direccion"]), 0, 1, 'L');
$pdf->Ln();
$pdf->setFont('Arial', 'B', 10);
$pdf->Cell(80, 8, utf8_decode("Detalle de los Objetos"), 0, 1, 'C');
$pdf->setFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(25, 5, utf8_decode("Descripcion"), 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'clave_promotor', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'objeto', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'codigo', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'Cantidad', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'Condicion', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'fecha', 1, 0, 'L', 1);
$pdf->Cell(10, 5, 'estado', 1, 0, 'L', 1);
$pdf->Cell(25, 5, 'Sub Total', 1, 1, 'L', 1);

foreach ($data as $Insumos) {
    $subtotal = $insumos['id'] * $insumos['clave_promotor'] * $insumos['objeto'] * $insumos['codigo'] * $insumos['cantidad'] * $insumos['condicion'] * $insumos['fecha'] * $insumos['estado'] * $insumos['subtotal'];
    $total = $total + $subtotal;
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(45, 5, utf8_decode($insumos['objeto']), 1, 0, 'L');
    $pdf->Cell(10, 5, $insumos['clave_promotor'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['objeto'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['codigo'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['cantidad'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['condicion'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['fecha'], 1, 0, 'L');
    $pdf->Cell(15, 5, $insumos['estado'], 1, 0, 'L');
    $pdf->Cell(20, 5, number_format($subtotal, 9, '.', ','), 1, 1, 'L');
}
$pdf->Ln();
$pdf->Cell(90, 5, 'Total S/.'. number_format( $total, 2, '.', ','), 0, 1, 'R');

$pdf->Output();

?>