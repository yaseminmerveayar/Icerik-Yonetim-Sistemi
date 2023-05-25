<?php 
    session_start();

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }
    // url'den sekme adını alıyoruz
    $tabName = $_GET['name'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Update Page</title>

    <!-- For summernote text editor -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- include summernote css/js-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../style/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php  include("navbar.php"); ?>

    <div class="container-fluid">
      <div class="row">
      <?php  include("menu.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Sekme Güncelle</h1>
        </div>
    
        <div class="container-fluid m-2">
          <div class="row">
              <div class="col">
              <?php

                // ihtiyacımız olan sekmenin index.php kodunu dom ile alıyoruz 
                $htmlText = file_get_contents("../pages/".$tabName."/index.php");

                $dom = new DOMDocument();
                @$dom->loadHTML($htmlText);

                ?>

              <?php  
              // hata mesajları için oluşturulan kısım 
                if (!empty($_SESSION['ERROR'])) {
                  echo "<div class='alert alert-danger text-center m-5' role='alert'>
                  ".$_SESSION['ERROR']."
                      </div>";
                      unset( $_SESSION['ERROR']);
                }elseif(!empty($_SESSION['MESSAGE'])) {
                  echo "<div class='alert alert-success text-center m-5' role='alert'>
                  ".$_SESSION['MESSAGE']."
                      </div>";
                      unset( $_SESSION['MESSAGE']);
              }
              ?>

                <form class="bg-white" method="POST" enctype="multipart/form-data" action="updatePageElements.php?name=<?=$tabName?>">

                  <div class="form-group mb-3">
                      <label for="newTabName">Sekme İsmini Güncelleyiniz</label>
                      <input type="text" name="newTab_Name" class="form-control" id="newTab_Name" value="<?= $tabName ?>">
                  </div>

                <?php
                    // dom ile resim dosyasının yolunu src icinden alıyoruz 
                    foreach ($dom->getElementsByTagName("img") as $a) {
                        $image_path = $a->getAttribute("src");
                        $str = substr($image_path, 3);
                    }

                ?>
                <div class="mb-3">
                  <!-- aldıgımız resmi kullanıcının görmesi için -->
                    <img src="<?= $str ?>" alt="" class="img-fluid mx-auto d-block">
                </div>
                  <div class="form-group mb-3">
                    <label for="formFile">Resim Seçiniz</label>
                    <input class="form-control" type="file" id="form_File" name="form_File">
                  </div>

                <?php   
                // dom ile baslıgı alıyoruz h1 tagı ile 
                foreach ($dom->getElementsByTagName("h1") as $a) {
                echo  '<div class="form-group mb-3">
                      <label for="newHeaderName">Bir Başlık Giriniz</label>
                      <input type="text" name="newHeader_Name" class="form-control" id="newHeader_Name" value="'.$a->nodeValue.'">
                    </div>';
                }
                // navbar konumunu alırken sıkıntı yasamamak icin tüm boşlukları kaldırıyoruz 
                $string = preg_replace("/\s+/", "", $htmlText);
                // navbar konumunu bilmek için html kodlarının sonuna yazmış olduğumuz yorum satırından bilgiyi çekiyoruz 
                $navPosition=substr($string,-7,4);

                $side = "";
                $top = "";

                // var olan konum degerine göre değişkenleri atıyoruz 
                if ($navPosition == "side") {
                  $side = "checked";
                }else{
                  $top = "checked";
                }
                echo '<div class="form-group mb-3">
                <label for="" class="control-label">Navbar için konum seçiniz</label>
                <div class="form-check ">
                  <input class="form-check-input" type="radio" name="flexRadio" value="top" id="flexRadio1" '.$top.'>
                  <label class="form-check-label" for="flexRadio1">
                    Üst Navbar
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="radio" name="flexRadio" value="side" id="flexRadio2" '.$side.'>
                  <label class="form-check-label" for="flexRadio2">
                    Yan Navbar
                  </label>
                </div>
              </div>';

                // metin icin belirli div icerisindeki tüm degerleri preg_match fonk. ile alıyoruz 
                preg_match('/<div class="mr-5 metin">(.*?)<\/div>/s', $htmlText, $match);
                  $text = $match[1];
                 echo '<div class="form-group mb-3">
                    <label for="editorData">Sayfa için bir metin yazın</label>
                    <textarea id="summernote" id="editor_Data" name="editor_Data">'.$text.'</textarea>
                  </div>';
  ?>

                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button class="btn btn-primary" type="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;">Güncelle</button>
                  </div>
                </form>
              </div>
            </div>
        </div>

        </main>
      </div>
    </div>

    <!-- summernote text editor için default degerler  -->
    <script>
      $('#summernote').summernote({
        placeholder: 'Metni giriniz ...',
        tabsize: 2,
        height: 100
      });
    </script>

    <?php  include("adminJs.html"); ?>
    
  </body>
</html>
