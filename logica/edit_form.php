<?php

require 'conexion.php';

$rid = "";
$rnombre = "";
$remail = "";
$rcontacto_id = "";

if (isset($_GET['editar'])) {
    $email = $_GET['editar'];
    $sql = "SELECT * FROM tbl_emails WHERE email='$email'";
    $checkEmail = mysqli_query($conexion, $sql);
    $check = mysqli_num_rows($checkEmail);

    if ($check>0) {
        $row = $checkEmail->fetch_assoc();

        $rid = $row['id'];
        $rnombre = $row['nombre'];
        $remail = $row['email'];
        $rcontacto_id = $row['contacto_id'];
    }    
}


?>