<?php
// form'dan bilgi gelip gelmediğine göre işlemi başlatıyoruz
if (isset($_POST['newTabName']) || isset($_POST['newHeaderName'])||isset($_POST['editorData']) || isset($_FILES['formFile']) || isset($_POST['flexRadio'])) {
    
    // gerekli kısımların doluluğunu kontrol ediyoruz
    if(empty($_POST['newTabName']) || empty($_POST['newHeaderName']) || empty($_POST['editorData']) || empty($_POST['flexRadio'])){
        $errMessage = "Sekme,Başlık ve Metin boş bırakılamaz";
    }
    // kabul edeceğimiz dosya uzantılarını belirtiyoruz
    $fileExtensionsAllowed = ['jpeg','jpg','png'];

    // form'dan gelen değerleri değişkenlere yazdırıyoruz 
    $tabName = $_POST['newTabName'];
    $headerName = $_POST['newHeaderName'];
    $editorData = $_POST['editorData'];
    $navPosition = $_POST['flexRadio'];
    $image_path_str = "";

    // form'dan gelen dosya bilgilerini değişkenlere yazdırıyoruz 
    $image_path = $_FILES['formFile']; 

    // dosya işlemleri
    $target_dir = "../images/";
    $tmp_name = $image_path['tmp_name'];
    $file_name = $image_path['name'];
    $file_size = $image_path['size'];
    $tmp = explode('.',$file_name);
    $fileExtension = strtolower(end($tmp));

    // pages içindeki dosya isimlerini kontrol ederek aynı olmaması için bir döngü oluşturuyoruz 
    $dir    = '../pages';
    $scanned_directory = array_diff(scandir($dir), array('..', '.'));

    foreach ($scanned_directory as $key ) {
        if ($tabName == $key) {
            $errMessage = "Bu sekme adı zaten mevcut";
        };
    }

    // eğer form ile bir dosya gönderildiyse buraya giriyoruz
    if(!empty($file_name))
    {
        // dosya zaten var mı kontrol 
        if(!file_exists($target_dir))
        {
            mkdir($target_dir);
        }

        //    dosya uzantısı kontrol 
        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errMessage = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }
    
        //    dosya boyutu kontrol 
        if ($file_size > 10000000) {
        $errMessage = "File exceeds maximum size (10MB)";
        }
        //    eğer hata mesajı yok ise 
        if (empty($errMessage)) {  
            // dosyayı yükleyeceğimiz dosya yolunu veriyoruz
            $uploadPath = $target_dir. $file_name;
            $image_path_str = "../../images/" . $file_name;

            //    dosyayı adrese yüklüyoruz
            @move_uploaded_file($tmp_name, $uploadPath);
        }
    }

    if (empty($errMessage)) {  
    // sekme adı ile bir dosya oluşturuyoruz 
    $dir = dirname("../pages/".$tabName."/index.php");
    mkdir( $dir , 0755, true);

    $message = "Sekme eklendi!";

    $htmlText = file_get_contents("../index.php");
    // sayfanın tema özelliklerini almak için dom ile html sayfasını alıyoruz 
    $dom = new DOMDocument();
    @$dom->loadHTML($htmlText);

    // navbar rengini alıyoruz 
    foreach ($dom->getElementsByTagName("nav") as $a) {
        $navColor = $a->getAttribute("style");
        break;
    }

    // navbar metin rengini ve logo adını alıyoruz 
    foreach ($dom->getElementsByTagName("a") as $a) {
    $navTextColor = $a->getAttribute("style");
    $text = $a->nodeValue;
    break;
    }

    // oluşturduğumuz dosyayı açıyoruz
    $myfile = fopen("../pages/".$tabName."/index.php", "w") or die("Unable to open file!");

    // navbar pozisyonuna göre yazacağımız html text'i degisiyor
    if ($navPosition == "top") {
        // eger navbar basta ise burası yazdırılıyor
        $txt = '<!DOCTYPE html>
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
        <nav class="navbar navbar-expand-lg navbar-dark " style="'.$navColor.'">
            <div class="container">
                <a class="navbar-brand" href="../../index.php" style="'.$navTextColor.'">'.$text.'</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="../../index.php" style="'.$navTextColor.'">Home</a>
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
        // eger navbar yanda ise burası yazdırılıyor
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
    
    // dosyaya txt değerini yazıp dosyayı kapatıyoruz 
    fwrite($myfile, $txt);
    fclose($myfile);
    }
}

?>