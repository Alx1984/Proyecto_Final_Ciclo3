<?php
require '../fpdf/fpdf.php';

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image("../img/logo.png", 10, 0, 35,0,"","../logica/dashboard.php");
    // Arial bold 15
    $this->SetFont("Arial", "B", 24);
    // Title
    $this->Cell(250,5, "Reporte de envio de Mensajes Vers. 1.0", 0, 1, "C");//largo que tendra la celda  ancho
    
    //Fecha
    $this->SetFont("Arial", "", 8);
    $this->Cell(500, 5, "Fecha: ".date("d/m/y"), 0, 1, "C");//largo que tendra la celda  ancho
    // Line break
    $this->Ln(10);//salto de linea
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}
?>