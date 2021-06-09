<?php
    $servername =   'localhost';
    $username   =   'root';
    $password   =   '';
    $dbname     =   'emails';

    $conexion       =   mysqli_connect($servername, $username, $password, "$dbname");
    if($conexion === false)
    {
        die("ERROR: No se pudo conectar. " .mysqli_connect_error());
    }
?>