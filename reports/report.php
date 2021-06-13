<?php
session_start();

$fechaini = $_POST['fechaini'];
$fechafin = $_POST['fechafin'];

$usuarioId = $_SESSION['usuarioId'];
$nivel = $_SESSION['nivel'];
require '../logica/conexion.php';
require 'template_report.php';



if ($nivel == 'admin') {
    $sql = "SELECT clienteid, nombrecliente, contactoid, nombrecontacto, contactoemail, fechaenvio, horaenvio, nombrecorreo, mensaje
     FROM tbl_historial";
    $result = mysqli_query($conexion, $sql);

    $sqltotal1 = "SELECT nombrecorreo , COUNT( * ) AS veces, tbl_historial.fechaenvio
    FROM tbl_historial WHERE (tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin')
    GROUP BY nombrecorreo DESC LIMIT 1";
    $result1 = $conexion->query($sqltotal1);
    $chart1 = $result1 ->  fetch_assoc();

    //Total contactos y total mensajes por ID
    $sqltotal2 = "SELECT COUNT(mensaje) AS totalmensaje, COUNT(DISTINCT contactoemail) AS contactosC
     FROM tbl_historial
     WHERE (tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin')";
    $result2 = $conexion->query($sqltotal2);
    $chart2 = $result2 ->  fetch_assoc();


}else {
    $sql = "SELECT clienteid, nombrecliente, contactoid, nombrecontacto, contactoemail, fechaenvio, horaenvio, nombrecorreo, mensaje
     FROM tbl_historial
     WHERE tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin'
     AND clienteid = '$usuarioId'
     ORDER BY  fechaenvio ASC";
    $result = mysqli_query($conexion, $sql);

    //correo mas enviado por ID
    $sqltotal1 = "SELECT nombrecorreo , COUNT( * ) AS veces, tbl_historial.fechaenvio
    FROM tbl_historial WHERE (tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin')
    AND clienteid = '$usuarioId'
    GROUP BY nombrecorreo DESC LIMIT 1";
    $result1 = $conexion->query($sqltotal1);
    $chart1 = $result1 ->  fetch_assoc();

    //Total contactos y total mensajes por ID
    $sqltotal2 = "SELECT COUNT(mensaje) AS totalmensaje, COUNT(DISTINCT contactoemail) AS contactosC
     FROM tbl_historial
     WHERE (tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin')
     AND clienteid = '$usuarioId'";
    $result2 = $conexion->query($sqltotal2);
    $chart2 = $result2 ->  fetch_assoc();


}

    

$pdf = new PDF("L", "mm", "letter");//L es para horizontal mm=milimetros
$pdf->AliasNbPages();//total de paginas
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();


$pdf->SetFont("Arial", "B", 10);
$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, "Mensaje mas utilizado", 1, 0, "C");
$pdf->Cell(40, 10, "Veces enviado", 1, 0, "C");
$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, "Total Contactos", 1, 0, "C");
$pdf->Cell(40, 10, "Total Mensajes", 1, 0, "C");
$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, "Fecha inicial", 1, 0, "C");
$pdf->Cell(40, 10, "Fecha cierre", 1, 0, "C");

$pdf->Ln(10); //saltos de linea

$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, $chart1['nombrecorreo'], 1, 0, "C");//inicio largo x ancho - numeros del final es borde x salto de linea, C= Center, R =right ...
$pdf->Cell(40, 10, $chart1['veces'], 1, 0, "C");
$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, $chart2['contactosC'], 1, 0, "C");
$pdf->Cell(40, 10, $chart2['totalmensaje'], 1, 0, "C");
$pdf->Cell(5, 10, "", 0, 0, "C");
$pdf->Cell(40, 10, $fechaini, 1, 0, "C");
$pdf->Cell(40, 10, $fechafin, 1, 0, "C");





$pdf->Ln(15); //2 saltos de linea



$pdf->Cell(15, 10, "ID", 1, 0, "C");//inicio largo x ancho - numeros del final es borde x salto de linea, C= Center, R =right ...
$pdf->Cell(15, 10, "Sender", 1, 0, "C");
$pdf->Cell(15, 10, "Cont.ID", 1, 0, "C");
$pdf->Cell(22, 10, "Cont.Name", 1, 0, "C");
$pdf->Cell(55, 10, "email", 1, 0, "C");
$pdf->Cell(20, 10, "Date", 1, 0, "C");
$pdf->Cell(15, 10, "Time", 1, 0, "C");
$pdf->Cell(50, 10, "Email Name", 1, 0, "C");
$pdf->Cell(60, 10, "Text", 1, 0, "C");

$pdf->SetFont("Arial", "", 8);
$pdf->Ln(15); //2 saltos de linea

while($row = mysqli_fetch_array($result)) {

    $pdf->Cell(15, 5, $row['clienteid'], 0, 0, "C");//inicio largo x ancho - numeros del final es borde x salto de linea, C= Center, R =right ...
    $pdf->Cell(15, 5, $row['nombrecliente'], 0, 0, "C");
    $pdf->Cell(15, 5, $row['contactoid'], 0, 0, "C");
    $pdf->Cell(22, 5, $row['nombrecontacto'], 0, 0, "L");
    $pdf->Cell(55, 5, $row['contactoemail'], 0, 0, "L");
    $pdf->Cell(20, 5, $row['fechaenvio'], 0, 0, "C");
    $pdf->Cell(15, 5, $row['horaenvio'], 0, 0, "C");
    $pdf->Cell(50, 5, $row['nombrecorreo'], 0, 0, "C");
    $pdf->Cell(60, 5, $row['mensaje'], 0, 0, "L");
    $pdf->Ln(5); //2 saltos de linea

}




$pdf->Output();






 



?>
