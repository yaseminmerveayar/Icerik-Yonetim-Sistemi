<?php 
    session_start();
    require("database.php");

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

    $errMessage = array();
    $message = array();
    $tabChange = false;
    echo "11111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111";
    echo $tabName;
if (empty($tabName)) {
  $tabName = $_GET['name'];
}
echo "22222222222222";
echo $tabName;
    $htmlTextOld = file_get_contents("../pages/".$tabName."/index.php");
    $dm = new DOMDocument();
    $dm->loadHTML($htmlTextOld);
  
    foreach ($dm->getElementsByTagName("img") as $a) {
      $oldImage = $a->getAttribute("src");
  }


if (isset($_POST['newTab_Name']) || isset($_POST['newHeader_Name'])||isset($_POST['editor_Data']) || isset($_FILES['form_File'])) {
    
  if(empty($_POST['newTab_Name']) || empty($_POST['newHeader_Name']) || empty($_POST['editor_Data'])){
      $errMessage = "Sekme,Başlık ve Metin boş bırakılamaz";
  }
  $fileExtensionsAllowed = ['jpeg','jpg','png'];



  
  $tab_Name = $_POST['newTab_Name'];
  $headerName = $_POST['newHeader_Name'];
  $editorData = $_POST['editor_Data'];
  $image_path_str = "";

  $image_path = $_FILES['form_File']; 

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

                 $dir = "../pages/".$tabName."";
      foreach(glob($dir . '/*') as $file) {

          unlink($file);
          }
          rename("../pages/".$tabName, "../pages/".$tab_Name);

      $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

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

          <title>'.$tab_Name.'</title>
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
  $tabChange = true;
$tab = $tab_Name;
echo "1...................................";
echo $tab;
  $message = "Sekme Güncellendi!";
             }
          }else{
            $dir = "../pages/".$tabName."";
      foreach(glob($dir . '/*') as $file) {

          unlink($file);
          }
          rename("../pages/".$tabName, "../pages/".$tab_Name);

      $myfile = fopen("../pages/".$tab_Name."/index.php", "w") or die("Unable to open file!");

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

          <title>'.$tab_Name.'</title>
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
      </html>';

  fwrite($myfile, $txt);
  fclose($myfile);
  $tab = $tab_Name;
  $tabChange = true;
  echo "1...................................";
  echo $tabName;
  $message = "Sekme Güncellendi!";
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
              if (!empty($tab)) {
                $tabName = $tab;
              }
echo $tabName;
                $htmlText = file_get_contents("../pages/".$tabName."/index.php");

                $dom = new DOMDocument();
                $dom->loadHTML($htmlText);

                ?>

              <?php  
                if (!empty($errMessage)) {
                  echo "<div class='alert alert-danger text-center m-5' role='alert'>
                      $errMessage
                      </div>";
                }elseif(!empty($message)) {
                  echo "<div class='alert alert-success text-center m-5' role='alert'>
                      $message
                      </div>";
              }
              ?>
                <form class="bg-white" method="POST" enctype="multipart/form-data">

                  <div class="form-group mb-3">
                      <label for="newTabName">Sekme İsmini Güncelleyiniz</label>
                      <input type="text" name="newTab_Name" class="form-control" id="newTab_Name" value="<?= $tabName ?>">
                  </div>

                <?php
                    foreach ($dom->getElementsByTagName("img") as $a) {
                        $image_path = $a->getAttribute("src");
                        $str = substr($image_path, 3);
                    }

                ?>
                <div class="mb-3">
                    <img src="<?= $str ?>" alt="" class="img-fluid mx-auto d-block">
                </div>
                  <div class="form-group mb-3">
                    <label for="formFile">Resim Seçiniz</label>
                    <input class="form-control" type="file" id="form_File" name="form_File">
                  </div>

                <?php   

                foreach ($dom->getElementsByTagName("h1") as $a) {
                echo  '<div class="form-group mb-3">
                      <label for="newHeaderName">Bir Başlık Giriniz</label>
                      <input type="text" name="newHeader_Name" class="form-control" id="newHeader_Name" value="'.$a->nodeValue.'">
                    </div>';
                }
                preg_match('/<div class="mr-5 metin">(.*?)<\/div>/s', $htmlText, $match);
                  $text = $match[1];
                  // if (empty($match[1])) {
                  //   $text = $match[0];
                  // }
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
<?php




?>