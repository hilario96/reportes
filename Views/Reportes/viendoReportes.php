<?php
require("Assets/pdf/fpdf.php");

class PDF extends FPDF
{
// Cabecera de página

function Header()
{
    // Logo
    $this->Cell(-200);
    $this->Image(base_url().'Assets/img/logo.jpg', 70, 5, 30, 30, 'JPG');
    
    // Arial bold 15
    $this->Ln(10);
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(-200);
    // Título
    //$this->Cell(70,10,'Reporte de productos',0,0,'C');*//
    // Salto de línea
    //$this->Ln(20);
    
}


// Pie de página
function Footer()
{
   $this->SetFillColor(20.05,19);
   $this->Rect(0,270,220,30,'p');
   $this->SetY(-20); //sube las letras
   $this->SetFont('Arial','',10);
   $this->SetTextColor(255,255,255);
   $this->SetX(90);
   $this->Write(5, '  Ingenieria de Software');
   $this->Ln();
   $this->SetX(70);
   $this->Write(5,'             Direccion: Avenida Central - UPEA');
   $this->Ln();
   $this->SetX(80);
   $this->Write(5,'    Contactos: 78819752-78926348');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->SetY(70);
$pdf->SetX(45);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,59,120);
$pdf->Cell(50,9, 'Nombre', 0 ,0, 'C',1);
$pdf->Cell(17,9, 'Usuario', 0 ,0, 'C',1);
$pdf->Cell(50,9, 'Password', 0 ,1, 'C',1);




include('reportes.php');
require('reportes.php');
$consulta = "SELECT*FROM usuarios";
$resultado = mysqli_query($conexion,$consulta);


$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240,245,255);

while($row = $resultado->fetch_assoc()){
    $pdf->SetX(45);
    $pdf->Cell(50,9, $row['Nombre'], 0 ,0, 'C',1);
    $pdf->Cell(17,9, $row['Usuario'], 0 ,0, 'C',1);
    $pdf->Cell(50,9, $row['Contraseña'], 0 ,1, 'C',1);
  
    /*$pdf->Cell(25,9, $row['status'], 0 ,1, 'C',1);*/
  
}

$pdf->Output();
