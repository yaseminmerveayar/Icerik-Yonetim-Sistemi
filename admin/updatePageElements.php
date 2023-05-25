<?php
    session_start();
    // url'den sekme adını alıyoruz
    $tabName = $_GET['name'];

    // form'dan bilgi gelip gelmediğine göre işlemi başlatıyoruz
if (isset($_POST['newTab_Name']) || isset($_POST['newHeader_Name'])||isset($_POST['editor_Data']) || isset($_FILES['form_File']) || isset($_POST['flexRadio'])) {
    
    // gerekli kısımların doluluğunu kontrol ediyoruz
    if(empty($_POST['newTab_Name']) || empty($_POST['newHeader_Name']) || empty($_POST['editor_Data']) || empty($_POST['flexRadio'])){
        $_SESSION['ERROR'] = "Sekme,Başlık ve Metin boş bırakılamaz";
    }

    // kabul edeceğimiz dosya uzantılarını belirtiyoruz
    $fileExtensionsAllowed = ['jpeg','jpg','png'];
  
    // sayfanın tema özelliklerini almak için dom ile html sayfasını alıyoruz 
    $htmlTextOld = file_get_contents("../pages/".$tabName."/index.php");
    $dm = new DOMDocument();
    $dm->loadHTML($htmlTextOld);
  
    // yeni resim seçilmemesine karşı olarak eski resim adresini alıyoruz 
    foreach ($dm->getElementsByTagName("img") as $a) {
      $oldImage = $a->getAttribute("src");
    }

    // navbar rengini alıyoruz 
    foreach ($dm->getElementsByTagName("nav") as $a) {
        $navColor = $a->getAttribute("style");
        break;
    }

    // navbar metin rengini ve logo adını alıyoruz 
    foreach ($dm->getElementsByTagName("a") as $a) {
    $navTextColor = $a->getAttribute("style");
    $text = $a->nodeValue;
    break;
    }
  
    // form'dan gelen değerleri değişkenlere yazdırıyoruz 
    $tab_Name = $_POST['newTab_Name'];
    $headerName = $_POST['newHeader_Name'];
    $editorData = $_POST['editor_Data'];
    $navPosition = $_POST['flexRadio'];
    $image_path_str = "";
  
    // form'dan gelen dosya bilgilerini değişkenlere yazdırıyoruz 
    $image_path = $_FILES['form_File']; 
  
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
                if ($tab_Name == $key && $tabName != $key) {
                    $_SESSION['ERROR'] = "Bu sekme adı zaten mevcut";
                    break;
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
                $_SESSION['ERROR'] = "This file extension is not allowed. Please upload a JPEG or PNG file";
               }
           
            //    dosya boyutu kontrol 
               if ($file_size > 10000000) {
                $_SESSION['ERROR'] = "File exceeds maximum size (10MB)";
               }

            //    eğer hata mesajı yok ise 
               if (empty($_SESSION['ERROR'])) 
               {  
                    // dosyayı yükleyeceğimiz dosya yolunu veriyoruz
                   $uploadPath = $target_dir. $file_name;
                   $image_path_str = "../../images/" . $file_name;

                //    dosyayı adrese yüklüyoruz
                   @move_uploaded_file($tmp_name, $uploadPath);
  
                   $dir = "../pages/".$tabName."";

                //    var olan dosyamızı siliyoruz 
                    foreach(glob($dir . '/*') as $file) {
                        unlink($file);
                    }

                    // sekme adını güncelliyoruz
                    rename("../pages/".$tabName, "../pages/".$tab_Name);
            
                    // index.php adlı dosyayı açıyoruz
                    $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

                    // navbar pozisyonuna göre yazacağımız html text'i degisiyor
                    if ($navPosition == "top") {
                        // eger navbar basta ise ve yeni resim dosyası varsa burası yazdırılıyor
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
                        // eger navbar yanda ise ve yeni resim dosyası varsa burası yazdırılıyor
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
                    // text'i yazıp dosyayı kapatıyoruz
                    fwrite($myfile, $txt);
                    fclose($myfile);

                    // sekme adını yenisi ile değiştiriyoruz
                    $tabName = $tab_Name;

                    $_SESSION['MESSAGE'] = "Sekme Güncellendi!";
               }
            }else{
                // eger yeni dosya yüklemesi yapılmadıysa bu kısma giriyoruz ve işlemleri eski dosya yolu ile yapıyoruz
                $dir = "../pages/".$tabName."";

                foreach(glob($dir . '/*') as $file) {
        
                    unlink($file);
                    }
                rename("../pages/".$tabName, "../pages/".$tab_Name);
        
                $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

                if ($navPosition == "top") {
                    // eger navbar basta ise ve yeni resim dosyası yoksa burası yazdırılıyor
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
                    // eger navbar yanda ise ve yeni resim dosyası yoksa burası yazdırılıyor
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

            // dosyayı yazdırıp kapatıyoruz 
            fwrite($myfile, $txt);
            fclose($myfile);

            // sekme adını yenisi ile değiştiriyoruz
            $tabName = $tab_Name;

            // farklı sayfalarda bulundukları için hata mesajı session üzerinden gönderiliyor
            $_SESSION['MESSAGE'] = "Sekme Güncellendi!";
            }
}
// İşlemler bitince sayfaya geri dönüyoruz
    header("Location:updatePage.php?name=$tabName"); 
    exit();
?>