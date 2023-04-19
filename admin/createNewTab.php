
<?php
if (isset($_POST['newTabName'])) {
    $tabName = $_POST['newTabName'];
    $insert = $db->prepare("INSERT INTO tabs (name) VALUES (?)");    
    $insert -> execute([$_POST['newTabName']]);
    $message = "Sekme eklendi!";

    $dir = dirname("../pages/".$tabName."/index.php");
    mkdir( $dir , 0755, true);

    

}
?>