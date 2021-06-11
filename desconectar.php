<?php
    session_start();
    if ($_SESSION['nivel']) {
        session_destroy();
        header("location:index.php");
    }else {
        header("location:index.php");
    }
?>