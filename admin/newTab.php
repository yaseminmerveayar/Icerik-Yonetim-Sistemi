<?php 
    session_start();

    // eger kisi giris yapmamıs ise login sayfasına yönlendiriliyor 
    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

    // kullanıcı mesajları için array olusturduk 
    $errMessage = array();
    $message = array();

    // yeni sayfa oluşturma sayfamızı koda dahil ettik 
    include("createNewPage.php");


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Create New Page</title>

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

    <!-- formda bulunan zorunlu kısımlar için oluşturulan kırmızı * isareti  -->
    <style>
      .form-group.mb-3 .control-label:after {
        content:"*";
        color:red;
      }
    </style>
  </head>

  <body>
    <?php  include("navbar.php"); ?>

    <div class="container-fluid">
      <div class="row">
      <?php  include("menu.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Yeni Sekme Oluştur</h1>
        </div>
    
        <div class="container-fluid m-2">
          <div class="row">
              <div class="col">

              <?php  
              // hata mesajları için 
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
              <!-- yeni sayfa oluşturmak için formumuzu olusturuyoruz  -->
                <form class="bg-white" method="POST" enctype="multipart/form-data">

                  <div class="form-group mb-3">
                      <label for="newTabName" class="control-label">Yeni sekme ismi giriniz</label>
                      <input type="text" name="newTabName" class="form-control" id="newTabName" placeholder="Sekme adı">
                  </div>

                  <div class="form-group mb-3">
                    <label for="formFile">Resim Seçiniz</label>
                    <input class="form-control" type="file" id="formFile" name="formFile">
                  </div>

                  <div class="form-group mb-3">
                      <label for="newHeaderName" class="control-label">Bir Başlık Giriniz</label>
                      <input type="text" name="newHeaderName" class="form-control" id="newHeaderName" placeholder="Başlık">
                  </div>

                  <div class="form-group mb-3">
                    <label for="" class="control-label">Navbar için konum seçiniz</label>
                    <div class="form-check ">
                      <input class="form-check-input" type="radio" name="flexRadio" value="top" id="flexRadio1" >
                      <label class="form-check-label" for="flexRadio1">
                        Üst Navbar
                      </label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="radio" name="flexRadio" value="side" id="flexRadio2" >
                      <label class="form-check-label" for="flexRadio2">
                        Yan Navbar
                      </label>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <label for="editorData" class="control-label">Sayfa için bir metin yazın</label>
                    <textarea id="summernote" id="editorData" name="editorData" class="form-control"></textarea>

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
