<?php
    // var olan sessionları yok ediyoruz 
    session_start();
    unset($_SESSION['MESSAGE']);
    unset($_SESSION['ERROR']);
    unset($_SESSION['LOGGED']);

    session_destroy();

    header("Location: login.php");
    exit;
?>