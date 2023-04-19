<?php

if (isset($_POST['newTabName'])&&isset($_POST['newHeaderName'])&&isset($_POST['editorData'])) {
    $tabName = $_POST['newTabName'];
    $headerName = $_POST['newHeaderName'];
    $editorData = $_POST['editorData'];

    $select = $db->prepare("SELECT id FROM tabs WHERE name=?");
    $select->execute([$tabName]);

    $tab = $select->fetch(); 

    $insert = $db->prepare("INSERT INTO pages (title,`text`,tab_id) VALUES (?,?,?)");    
    $insert -> execute([$headerName,$editorData,$tab[0]]);
    $message = "Sekme eklendi!";

    $myfile = fopen("../pages/".$tabName."/index.php", "w") or die("Unable to open file!");

    $txt = '<?php
    $db = new PDO("sqlite:../../database.db");
    ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link href="style/navbar.css" rel="stylesheet">

    <title>'.$tabName.'</title>
</head>
<body>
<?php include("../../navbar.php"); ?>
    <main role="main">
        <div class="container-fluid m-5">
            <div class="row mx-4">
                <div class="col mx-4">
                    <h1 class=" my-3">'.$headerName.'</h1>
                    <div class="mr-5">
                    '.$editorData.'
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script  type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>';

    fwrite($myfile, $txt);
    fclose($myfile);

}
?>