<?php


if (isset($_GET['borrar'])) {
    $email = $_GET['borrar'];

    require 'conexion.php';
    mysqli_query($conexion, "DELETE FROM tbl_emails WHERE email='$email'") or
    die($mysqli->error);
    echo "<script>location.href='index.php'</script>";
}

?>