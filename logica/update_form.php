<?php


    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contacto_id = $_POST['contacto_id'];

    

    require 'conexion.php';
    mysqli_query($conexion, "UPDATE tbl_emails SET email='$email', nombre='$nombre' WHERE contacto_id = '$contacto_id'");
    echo "<script>location.href='lista_form.php'</script>";
    



?>