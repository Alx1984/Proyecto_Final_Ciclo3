<?php
include "mpdf/mpdf.php";

funtion selectTabla(){
$con = new mysqli("localhost","root","","graficos");
//verificar en caso de error
$sql ="select * from lucid";
$res = $con->query($sql);
$tabla="";
$tabla .="<table>
          <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>$ beca</th>
          <th>idPatrocinador</th>
          </tr>";
    while($fila =$res->fetch_assoc()){
$tabla .="<tr>
          <td>".$fila['idAlumno']."</td>
          <td>".$fila['nombre']."</td>
          <td>".$fila['monto_beca']."</td>
          <td>".$fila['idPatrocinador']."</td>
          </tr>":
    }
	$tabla .= <"table">;
	return $tabla;
}

$html = selectTabla();
$pdf= new mPDF('c');
$pdf->WriteHTML($html);
$pdf->Output();
exit;

?>