<?php


if (isset($_POST['edit'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    echo($nombre);
    echo($email);
    require 'conexion.php';
    mysqli_query($conexion, "UPDATE tbl_emails SET email='$email', nombre='$nombre' WHERE email='$email'") or
    die($mysqli->error);
    
}

?>