<?php

    session_start();

    $tabName = $_GET['name'];

    deleteAll("../pages/".$tabName."");

    // delete all files and sub-folders from a folder
    function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file)){
        deleteAll($file);
        }else{
        unlink($file);
        }}
    rmdir($dir);
    }

    header("Location: pageList.php"); 
    exit();

    


?>