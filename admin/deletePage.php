<?php

    session_start();
    require('database.php');

    $tabName = $_GET['name'];

    // $select = $db->prepare("SELECT name FROM tabs WHERE id=?");
    // $select->execute([$tabId]);

    // $tabName = $select->fetch(); 

    // $sql = "DELETE  FROM tabs WHERE id=?";
    // $delete= $db->prepare($sql);
    // $delete->execute([$tabId]);

    // $sql2 = "DELETE  FROM pages WHERE tab_id=?";
    // $deletePage= $db->prepare($sql2);
    // $deletePage->execute([$tabId]);

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