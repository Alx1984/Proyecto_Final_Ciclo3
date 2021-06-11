<?php
include "mpdf/mpdf.php";
function selectTabla(){;
$con = new mysqli("localhost","root","","emails");
$sql = "SELECT COUNT(mensaje)as cantidad,fechaenvio from tbl_historial GROUP by fechaenvio";
$res = $con->query($sql);
$tabla="";
$tabla .="<table border='1'>
            <tr>
                <th>Cantidad Enviada</th>
                <th>Fecha</th>
                </tr>
                ";
                while($fila =$res->fetch_assoc()){
                    $tabla .="<tr>
                    <td>".$fila['cantidad']."</td>
                    <td>".$fila['fechaenvio']."</td>
                </tr>";
                }
                            $tabla .= "</table>";
                             return $tabla;
    }                                   

$html .= selectTabla();
$pdf= new mPDF('c');
$pdf->WriteHTML($html);
$pdf->Output();
exit;

?>