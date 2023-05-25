<?php
    // form değerleri var ise döngüye giriyoruz 
    if (isset($_POST['navColor']) || isset($_POST['textColor']) || isset($_POST['logo'])) {

        // form'dan aldığımız degerleri degiskenlere atıyoruz 
        $navbarColor = $_POST['navColor'];
        $textColor = $_POST['textColor'];
        $text = $_POST['logo'];
        
        // pages altında bulunan tüm dosya isimlerini bir array'e yazıyoruz 
        $dir    = '../pages';
        $scanned_directory = array_diff(scandir($dir), array('..', '.'));
          

        // var olan tüm sekmeleri tek tek foreach ile dolasıyoruz 
        foreach ($scanned_directory as $key ) {

            $htmlText = file_get_contents("../pages/".$key."/index.php");

            // istedigimiz doayanın html textini dom ile alıyoruz 
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->encoding='UTF-8';
            @$dom->loadHTML(mb_convert_encoding($htmlText, 'HTML-ENTITIES', 'UTF-8'));


            // navbar rengini degistikmek icin 
            foreach ($dom->getElementsByTagName("nav") as $a) {

                // nav tagını bulup style attribute'ını degistiriyoruz 
                $a->setAttribute("style",'background-color:'.$navbarColor.';');

                // Güncellenmiş halini newHTML olarak kaydediyoruz
                $newHTML = urldecode($dom->saveHTML());
                // text icinde encoding yapmasını engellemek için yapılan islemler 
                $new_string = iconv("UTF-8", "UTF-8//TRANSLIT",$newHTML);
                $html_entity_decode=html_entity_decode($newHTML,ENT_QUOTES,"UTF-8");
                // dosyayı açıp güncel halini yazıyoruz 
                $f = fopen("../pages/".$key."/index.php", 'w+');
                fwrite($f, $html_entity_decode);

                fclose($f);
       
            }

            // logo ismi ilk a tagında olguğu için sayac oluşturduk
            $sayac = 0; 
            // logo adı ve metin rengini degistirmek için 
            foreach ($dom->getElementsByTagName("a") as $a) {

                $sayac = $sayac+1;
                // metin rengini değiştiriyoruz 
                $a->setAttribute("style",'color:'.$textColor.';');

                if ($sayac <= 1) {
                    // eger ilk seferde ise logo adını degistiriyor 
                    $a->nodeValue = $text;
                }

                $newHTML = urldecode($dom->saveHTML());
                $new_string = iconv("UTF-8", "UTF-8//TRANSLIT",$newHTML);
                $html_entity_decode=html_entity_decode($newHTML,ENT_QUOTES,"UTF-8");
                $f = fopen("../pages/".$key."/index.php", 'w+');
                fwrite($f, $html_entity_decode);
            
                fclose($f);
            }
            // aynı işlemleri home page için tekrarlıyoruz 

            $htmlText2 = file_get_contents("../index.php");

            $document = new DOMDocument('1.0', 'UTF-8');
            $document->encoding='UTF-8';
            @$document->loadHTML(mb_convert_encoding($htmlText2, 'HTML-ENTITIES', 'UTF-8'));


            foreach ($document->getElementsByTagName("nav") as $a) {

                $a->setAttribute("style",'background-color:'.$navbarColor.';');

                $newHTML = urldecode($document->saveHTML());
                $new_string = iconv("UTF-8", "UTF-8//TRANSLIT",$newHTML);
                $html_entity_decode=html_entity_decode($newHTML,ENT_QUOTES,"UTF-8");
                $f = fopen("../index.php", 'w+');
                fwrite($f, $html_entity_decode);

                fclose($f);
       
            }

            $sayac2 = 0;
            foreach ($document->getElementsByTagName("a") as $a) {

                $sayac2 = $sayac2+1;
                $a->setAttribute("style",'color:'.$textColor.';');

                if ($sayac2 <= 1) {
                    $a->nodeValue = $text;
                }
                $newHTML = urldecode($document->saveHTML());
                $new_string = iconv("UTF-8", "UTF-8//TRANSLIT",$newHTML);
                $html_entity_decode=html_entity_decode($newHTML,ENT_QUOTES,"UTF-8");
                $f = fopen("../index.php", 'w+');
                fwrite($f, $html_entity_decode);
            
                fclose($f);
            }
        }

        $message = "Tema Güncellendi";

    }
?>
