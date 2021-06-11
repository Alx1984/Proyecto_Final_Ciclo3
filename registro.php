<?php
require 'conexion.php';
$nombre = $_POST['nombre'];
$contra = $_POST['contra'];
$nivel = "user";

$sql = "SELECT * FROM tbl_login WHERE nombre = '$nombre'";
$consulta = mysqli_query($conexion,$sql);

if (isset($_POST['agregar'])) {  
    if (mysqli_num_rows($consulta)>0) {
        echo '<script>alert("Usuario ya existe, trata con otro nombre")</script> ';	
        echo "<script>location.href='index.php'</script>";
    }
    mysqli_query($conexion, "INSERT INTO tbl_login (id, nombre, contra, nivel)  SELECT MAX(id)+1, '$nombre', '$contra', '$nivel' FROM tbl_emails") or
    die($mysqli->error);
    echo '<script>alert("Usuario Creado con exito")</script> ';	
    echo "<script>location.href='index.php'</script>";
    
}
?>