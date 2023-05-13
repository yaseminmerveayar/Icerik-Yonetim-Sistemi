<?php

if (isset($_POST['newTabName']) || isset($_POST['newHeaderName'])||isset($_POST['editorData']) || isset($_FILES['formFile'])) {
    if(empty($_POST['newTabName']) || empty($_POST['newHeaderName']) || empty($_POST['editorData'])){
        $errMessage = "Sekme,Başlık ve Metin boş bırakılamaz";
    }
    $fileExtensionsAllowed = ['jpeg','jpg','png'];

    
    $tabName = $_POST['newTabName'];
    $headerName = $_POST['newHeaderName'];
    $editorData = $_POST['editorData'];
    $image_path_str = "";

    $image_path = $_FILES['formFile']; 

            $target_dir = "../images/";
            $tmp_name = $image_path['tmp_name'];
            $file_name = $image_path['name'];
            $file_size = $image_path['size'];
            $tmp = explode('.',$file_name);
            $fileExtension = strtolower(end($tmp));
   
            if(!empty($file_name))
            {
               if(!file_exists($target_dir))
               {
                   mkdir($target_dir);
               }

               if (! in_array($fileExtension,$fileExtensionsAllowed)) {
                $errMessage = "This file extension is not allowed. Please upload a JPEG or PNG file";
               }
           
               if ($file_size > 10000000) {
                $errMessage = "File exceeds maximum size (10MB)";
               }
               if (empty($errMessage)) {  
                   $uploadPath = $target_dir. $file_name;
                   $image_path_str = "../../images/" . $file_name;
   
                   @move_uploaded_file($tmp_name, $uploadPath);
               }
            }
        if (empty($errMessage)) {  
        $dir = dirname("../pages/".$tabName."/index.php");
        mkdir( $dir , 0755, true);

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
            <link href="../../style/navbar.css" rel="stylesheet">

            <title>'.$tabName.'</title>
        </head>
        <body>
        <?php
            $q = $db->prepare("SELECT value FROM settings WHERE name=:name");
            $q->execute(array("name"=>"navbarColor"));

            $navbarColor = $q->fetch(); 
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark <?= $navbarColor[0] ?>">
            <div class="container">
                <a class="navbar-brand" href="../../index.php">CMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="../../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <?php

                    $dir    = "../../pages";
                    $scanned_directory = array_diff(scandir($dir), array("..", "."));

                    foreach ($scanned_directory as $key ) {
                        echo "<li class=\'nav-item\'>
                                <a class=\'nav-link\' href=\'../../pages/".$key."\'>".$key."</a>
                            </li>";
                    }
                    ?>

                </ul>

                </div>
            </div>
        </nav>

            <main role="main">
                <div class="container-fluid m-5">
                    <div class="row mx-4">
                        <div class="col mx-4">
                            <div >
                                <img src="'.$image_path_str.'" alt="" class="img-fluid mx-auto d-block" >
                            </div>
                            <h1 class=" my-3">'.$headerName.'</h1>
                            <div class="mr-5 metin">
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



    // $select = $db->prepare("SELECT id FROM tabs WHERE name=?");
    // $select->execute([$tabName]);

    // $tab = $select->fetch(); 

    // $selectTabName = $db->prepare("SELECT `name` FROM tabs WHERE `name`=? AND id!=? ");
    // $selectTabName->execute([$tabName,$tab[0]]);

    // $checkTabName = $selectTabName->fetch(); 

    // if (isset($checkTabName[0])) {

    //     $errMessage = "Bu sekme ismi zaten mevcut";

    // }else {

        // $insert = $db->prepare("INSERT INTO pages (title,`text`,tab_id) VALUES (?,?,?)");    
        // $insert -> execute([$headerName,$editorData,$tab[0]]);
        
    }

    

// }
?>