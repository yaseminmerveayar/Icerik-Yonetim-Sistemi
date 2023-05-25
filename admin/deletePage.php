<?php

    session_start();
    // sekme adını urlden alıyoruz 
    $tabName = $_GET['name'];

    // oluşturduğumuzfonk. çağırıyoruz 
    deleteAll("../pages/".$tabName."");

    // belirttiğimiz yoldaki tüm dosyaları ve içindekileri silmek için
    function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file)){
            // dosyanın içindeki dosyaları bulmak için
        deleteAll($file);
        }else{
            // dosyanın kendisini silmek için 
        unlink($file);
        }}
        // en sonunda ana dosyayı kaldırıyoruz
    rmdir($dir);
    }

    // listeleme sayfasına geri dönüyoruz 
    header("Location: pageList.php"); 
    exit();

    


?>