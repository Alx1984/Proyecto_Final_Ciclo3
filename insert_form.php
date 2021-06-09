<?php


if (isset($_POST['agregar'])) {
    $cliente_id = $_POST['cliente_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    require 'conexion.php';
    mysqli_query($conexion, "INSERT INTO tbl_emails (contacto_id, id, nombre, email)  SELECT MAX(contacto_id)+1, '$cliente_id', '$nombre', '$email' FROM tbl_emails") or
    die($mysqli->error);
    echo "<script>location.href='index.php'</script>";
}

?>