<?php 
    session_start();
    require('database.php');

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

    $message = array();
    include("updateNavbarColor.php");

    $dir    = '../pages';
    $scanned_directory = array_diff(scandir($dir), array('..', '.'));

    $navColor="";
    $navTextColor="";
    $text="";

    foreach ($scanned_directory as $key ) {

      $htmlText = file_get_contents("../pages/".$key."/index.php");

      $dom = new DOMDocument('1.0', 'UTF-8');
      $dom->encoding='UTF-8';
      @$dom->loadHTML(mb_convert_encoding($htmlText, 'HTML-ENTITIES', 'UTF-8'));

      foreach ($dom->getElementsByTagName("nav") as $a) {
        $attr = $a->getAttribute("style");
        $temp=substr($attr,17,-1);
        $navColor=$temp;
        break;
      }
      foreach ($dom->getElementsByTagName("a") as $a) {
        $attr = $a->getAttribute("style");
        $temp=substr($attr,6,-1);
        $navTextColor=$temp;
        $text = $a->nodeValue;
        break;
      }
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../style/navbar.css" rel="stylesheet">


    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
          <h1 class="h2">Genel Tema</h1>
        </div>
        <div class="container-fluid m-2">
          <div class="row">
              <div class="col">
              <?php  
                if(!empty($message)) {
                  echo "<div class='alert alert-success text-center m-5' role='alert'>
                      $message
                      </div>";
              }
              ?>

                <form class="bg-white" method="POST" >
                <div class="form-group mb-3">
                  <label for="navColor">Navbar için bir renk seçiniz</label>
                  <input type="color" class="form-control form-control-color" id="navColor" name="navColor" value="<?=$navColor?>">
                </div>

                <div class="form-group mb-3">
                  <label for="textColor">Navbar metni için bir renk seçiniz</label>
                  <input type="color" class="form-control form-control-color" id="textColor" name="textColor" value="<?=$navTextColor?>">
                </div>

                <div class="form-group mb-3">
                  <label for="logo">Navbar için şirket adı giriniz</label>
                  <input type="text" class="form-control" id="logo" name="logo" value="<?=$text?>">
                </div>
                  
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button class="btn btn-primary" type="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;">Kaydet</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
        </main>
      </div>
    </div>

    <?php  include("adminJs.html"); ?>

  </body>
</html>
