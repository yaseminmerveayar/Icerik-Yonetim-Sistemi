<?php
    session_start();
    unset($_SESSION['NAME']);
    unset($_SESSION['SURNAME']);
    unset($_SESSION['LOGGED']);

    session_destroy();

    header("Location: login.php");
    exit;
?>