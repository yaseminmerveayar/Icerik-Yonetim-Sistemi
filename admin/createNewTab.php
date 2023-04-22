
<?php

if (isset($_POST['newTabName'])) {
    $tabName = $_POST['newTabName'];

    $select = $db->prepare("SELECT name FROM tabs WHERE name=:name");
    $select->execute(array('name'=>$tabName));

    $checkTabName = $select->fetch(); 

    if (isset($checkTabName[0])) {

        $errMessage = "Bu sekme ismi zaten mevcut";

    }else {

        $insert = $db->prepare("INSERT INTO tabs (name) VALUES (?)");    
        $insert -> execute([$_POST['newTabName']]);

        $message = "Sekme eklendi!";

        $dir = dirname("../pages/".$tabName."/index.php");
        mkdir( $dir , 0755, true);
    }

}
?>