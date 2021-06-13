<?php

session_start();
$fechaini = '2021-05-01';
$fechafin = '2021-05-20';
$usuarioid = $_POST['usuarioid'];
$nivel = $_POST['nivel'];
require 'conexion.php';
require 'template_report.php';


$sqltotal1 = "SELECT nombrecorreo , COUNT( * ) AS veces, tbl_historial.fechaenvio
    FROM tbl_historial WHERE (tbl_historial.fechaenvio BETWEEN '$fechaini' AND '$fechafin')
    AND clienteid = '$usuarioid'
    GROUP BY nombrecorreo DESC LIMIT 1";
    $result1 = $conexion->query($sqltotal1);
    $chart1 = $result1 ->  fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <h2><?php echo $fechaini; ?> <br /></h2>
    <h2><?php echo $fechafin; ?> <br /></h2>
    <h2><?php echo $usuarioid; ?> <br /></h2>
    <h2><?php echo $chart1['nombrecorreo']; ?> <br /></h2>
    <h2><?php echo $chart1['veces']; ?> <br /></h2>





    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row["clienteid"]; ?></td>
            <td><?php echo $row["nombrecliente"]; ?></td>
            <td><?php echo $row["contactoid"]; ?></td>
            <td><?php echo $row["nombrecontacto"]; ?></td>
        </tr>
    <?php
    }
    ?>


                            <!--Enviar multiple valores con href-->
                        <td><a href="report.php?usuarioId=<?php $_SESSION['usuarioId']; ?>&nivel=<?php $_SESSION['nivel']; ?>" class="btn btn-link" name="reporte" value="reporte">Ver mi Reporte de Mensajes</a></td>



</body>

</html>