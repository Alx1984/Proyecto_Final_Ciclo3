<?php

session_start();
require 'conexion.php';
//id, nombre, contra

$usuario = $_POST['usuario'];
$contra = $_POST['contra'];

echo($usuario);
echo($contra);

$sql = "SELECT * FROM tbl_login WHERE nombre ='$usuario' AND contra = '$contra'";
$checkLog = mysqli_query($conexion, $sql);
$row = $checkLog->fetch_assoc();
$check = mysqli_num_rows($checkLog);


if ($check > 0) {
    echo '<script>alert("Bienvenido envia muchos mensajes")</script> ';
	echo "<script>location.href='index.php'</script>";
    $_SESSION['usuario'] = $usuario;
    $_SESSION['usuarioId']= $row['id']; 
}
else {
    echo '<script>alert("ESTE USUARIO NO EXISTE, POR FAVOR REGISTRESE PARA PODER INGRESAR")</script> ';		
	echo "<script>location.href='login.php'</script>";
}