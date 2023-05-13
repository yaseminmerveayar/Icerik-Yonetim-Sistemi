<?php 
    session_start();
    require('database.php');

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

    $message = array();
    // include("updateNavbarColor.php");
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
                <form class="bg-white" method="POST">
                <div class="form-group mb-3">
                  <label for="navColor">Navbar için bir renk seçiniz</label>
                  <input type="color" class="form-control form-control-color" id="navColor" name="navColor">
                </div>
                  
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button class="btn btn-primary" onclick="selectColor()" type="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;">Kaydet</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
        
        </main>
      </div>
    </div>


    <?php  include("adminJs.html"); ?>

   <script src="deneme.js"></script>
   <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
  </body>
</html>
