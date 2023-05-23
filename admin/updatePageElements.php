<?php
    session_start();
    $tabName = $_GET['name'];

if (isset($_POST['newTab_Name']) || isset($_POST['newHeader_Name'])||isset($_POST['editor_Data']) || isset($_FILES['form_File']) || isset($_POST['flexRadio'])) {
    
    if(empty($_POST['newTab_Name']) || empty($_POST['newHeader_Name']) || empty($_POST['editor_Data']) || empty($_POST['flexRadio'])){
        $_SESSION['ERROR'] = "Sekme,Başlık ve Metin boş bırakılamaz";
    }

    $fileExtensionsAllowed = ['jpeg','jpg','png'];
  
    $htmlTextOld = file_get_contents("../pages/".$tabName."/index.php");
    $dm = new DOMDocument();
    $dm->loadHTML($htmlTextOld);
  
    foreach ($dm->getElementsByTagName("img") as $a) {
      $oldImage = $a->getAttribute("src");
    }

    foreach ($dm->getElementsByTagName("nav") as $a) {
        $navColor = $a->getAttribute("style");
        break;
    }

    foreach ($dm->getElementsByTagName("a") as $a) {
    $navTextColor = $a->getAttribute("style");
    $text = $a->nodeValue;
    break;
    }
  
    $tab_Name = $_POST['newTab_Name'];
    $headerName = $_POST['newHeader_Name'];
    $editorData = $_POST['editor_Data'];
    $navPosition = $_POST['flexRadio'];
    $image_path_str = "";
  
    $image_path = $_FILES['form_File']; 
  
        $target_dir = "../images/";
        $tmp_name = $image_path['tmp_name'];
        $file_name = $image_path['name'];
        $file_size = $image_path['size'];
        $tmp = explode('.',$file_name);
        $fileExtension = strtolower(end($tmp));

        $dir    = '../pages';
        $scanned_directory = array_diff(scandir($dir), array('..', '.'));

            foreach ($scanned_directory as $key ) {
                if ($tab_Name == $key && $tabName != $key) {
                    $_SESSION['ERROR'] = "Bu sekme adı zaten mevcut";
                    break;
                };
            }
            if(!empty($file_name))
            {
               if(!file_exists($target_dir))
               {
                   mkdir($target_dir);
               }
  
               if (! in_array($fileExtension,$fileExtensionsAllowed)) {
                $_SESSION['ERROR'] = "This file extension is not allowed. Please upload a JPEG or PNG file";
               }
           
               if ($file_size > 10000000) {
                $_SESSION['ERROR'] = "File exceeds maximum size (10MB)";
               }

               if (empty($_SESSION['ERROR'])) 
               {  
                   $uploadPath = $target_dir. $file_name;
                   $image_path_str = "../../images/" . $file_name;
   
                   @move_uploaded_file($tmp_name, $uploadPath);
  
                   $dir = "../pages/".$tabName."";

                    foreach(glob($dir . '/*') as $file) {
                        unlink($file);
                    }

                    rename("../pages/".$tabName, "../pages/".$tab_Name);
            
                    $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

                    if ($navPosition == "top") {

                        $txt = '<!DOCTYPE html>
                        <html lang="tr">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                            <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
                            <link href="../../style/navbar.css" rel="stylesheet">
                
                            <title>'.$tab_Name.'</title>
                        </head>
                        <body>
                        <nav class="navbar navbar-expand-lg navbar-dark " style="'.$navColor.'">
                            <div class="container">
                                <a class="navbar-brand" style="'.$navTextColor.'" href="../../index.php">'.$text.'</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                
                                <div class="collapse navbar-collapse" id="navbarsExample">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                    <a class="nav-link" style="'.$navTextColor.'" href="../../index.php">Home</a>
                                    </li>
                
                                    <?php
                
                                    $dir    = "../../pages";
                                    $scanned_directory = array_diff(scandir($dir), array("..", "."));
                
                                    foreach ($scanned_directory as $key ) {
                                        echo \'<li class="nav-item">
                                        <a class="nav-link" style="'.$navTextColor.'" href="../../pages/\'.$key.\'">\'.$key.\'</a>
                                        </li>\';
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
                        </html><!-- top -->';
                    }else{
                        $txt = '<!DOCTYPE html>
                        <html lang="tr">
                        <head>
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        
                            <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css">
                            <link href="../../style/sidebars.css" rel="stylesheet">
                        
                            <title>'.$tabName.'</title>
                        </head>
                        <body>
                        
                        <main class="d-flex flex-nowrap">
                            <nav class="d-flex flex-column flex-shrink-0 p-3 navi" style="'.$navColor.'">
                            <a href="../../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none" style="'.$navTextColor.'">'.$text.'</a>
                            <hr>
                            <ul class="nav nav-pills flex-column mb-auto">
                                <li class="nav-item">
                                <a href="../../index.php" class="nav-link" aria-current="page" style="'.$navTextColor.'">
                                    Home
                                </a>
                                </li>
                                <?php $dir    = "../../pages";
                                $scanned_directory = array_diff(scandir($dir), array("..", "."));
                        
                                foreach ($scanned_directory as $key ) {
                                    echo \'<li class="nav-item">
                                        <a class="nav-link" style="'.$navTextColor.'" href="../../pages/\'.$key.\'">\'.$key.\'</a>
                                        </li>\';
                                }
                                ?>
                            </ul>
                        
                            </nav>
                            <div class="b-example-vr "></div>
                            <div class="scrollarea">   
                        
                            <div class="container-fluid mr-5 context">
                                <div class="row m-5">
                                    <div class="col ">
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
                            </div>
                        
                        </main>
                        <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                        
                        </body>
                        </html><!--side-->';
                    }
            
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    $tabName = $tab_Name;

                    $_SESSION['MESSAGE'] = "Sekme Güncellendi!";
               }
            }else{
                $dir = "../pages/".$tabName."";

                foreach(glob($dir . '/*') as $file) {
        
                    unlink($file);
                    }
                    rename("../pages/".$tabName, "../pages/".$tab_Name);
        
                $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

                if ($navPosition == "top") {

                    $txt = '<!DOCTYPE html>
                    <html lang="tr">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
                        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
                        <link href="../../style/navbar.css" rel="stylesheet">
            
                        <title>'.$tab_Name.'</title>
                    </head>
                    <body>
                    <nav class="navbar navbar-expand-lg navbar-dark " style="'.$navColor.'">
                        <div class="container">
                            <a class="navbar-brand" style="'.$navTextColor.'" href="../../index.php">'.$text.'</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
            
                            <div class="collapse navbar-collapse" id="navbarsExample">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                <a class="nav-link" style="'.$navTextColor.'" href="../../index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
            
                                <?php
            
                                $dir    = "../../pages";
                                $scanned_directory = array_diff(scandir($dir), array("..", "."));
            
                                foreach ($scanned_directory as $key ) {
                                    echo \'<li class="nav-item">
                                        <a class="nav-link" style="'.$navTextColor.'" href="../../pages/\'.$key.\'">\'.$key.\'</a>
                                        </li>\';
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
                                            <img src="'.$oldImage.'" alt="" class="img-fluid mx-auto d-block" >
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
                    </html><!-- top -->';
                }else{
                    $txt = '<!DOCTYPE html>
                    <html lang="tr">
                    <head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    
                        <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css">
                        <link href="../../style/sidebars.css" rel="stylesheet">
                    
                        <title>'.$tabName.'</title>
                    </head>
                    <body>
                    
                    <main class="d-flex flex-nowrap">
                        <nav class="d-flex flex-column flex-shrink-0 p-3 navi" style="'.$navColor.'">
                        <a href="../../index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none" style="'.$navTextColor.'">'.$text.'</a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                            <a href="../../index.php" class="nav-link" aria-current="page" style="'.$navTextColor.'">
                                Home
                            </a>
                            </li>
                            <?php $dir    = "../../pages";
                            $scanned_directory = array_diff(scandir($dir), array("..", "."));
                    
                            foreach ($scanned_directory as $key ) {
                                echo \'<li class="nav-item">
                                    <a class="nav-link" style="'.$navTextColor.'" href="../../pages/\'.$key.\'">\'.$key.\'</a>
                                    </li>\';
                            }
                            ?>
                        </ul>
                    
                        </nav>
                        <div class="b-example-vr "></div>
                        <div class="scrollarea">   
                    
                        <div class="container-fluid mr-5 context">
                            <div class="row m-5">
                                <div class="col ">
                                    <div >
                                        <img src="'.$oldImage.'" alt="" class="img-fluid mx-auto d-block" >
                                    </div>
                                        <h1 class=" my-3">'.$headerName.'</h1>
                                    <div class="mr-5 metin">
                                        '.$editorData.'
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    
                    </main>
                    <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                    
                    </body>
                    </html><!--side-->';
                }

            fwrite($myfile, $txt);
            fclose($myfile);

            $tabName = $tab_Name;

            $_SESSION['MESSAGE'] = "Sekme Güncellendi!";
            }
}
    header("Location:updatePage.php?name=$tabName"); 
    exit();
?>