<?php 
    session_start();
    require("database.php");

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

    include("updateNavbarColor.php");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link href="dashboard.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
    <title>Admin</title>
</head>
<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-3">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Panel</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="logout.php">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item my-2">
              <a class="nav-link active" href="admin.php">
                <span data-feather="home"></span>
                Dashboard 
              </a>
            </li>
            <li class="nav-item my-2">
              <a class="nav-link" href="newTab.php">
                <span data-feather="file"></span>
                Oluştur
              </a>
            </li>
            <li class="nav-item my-2">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            
          </ul>

      
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
        </div>
        
    
        <div class="container-fluid m-2">
          <div class="row">
              <div class="col">
              <div id="summernote"></div>
              <script>
      $('#summernote').summernote({
        placeholder: 'Metni giriniz ...',
        tabsize: 2,
        height: 100
      });
    </script>
                <form class="bg-white" method="POST">
                
                  <div class="form-group">
                    <label for="navColorSelect">Navbar için bir renk seçiniz</label>
                    <select class="form-control" id="navColorSelect" name="navColorSelect">
                      <?php
                        $p = $db->prepare("SELECT value FROM settings WHERE name=:name");
                        $p->execute(array('name'=>"navbarColor"));

                        $navbarCode = $p->fetch(); 

                        $d = $db->prepare("SELECT name FROM colors WHERE code=:code");
                        $d->execute(array('code'=>$navbarCode[0]));

                        $navbarColor = $d->fetch(); 
                      ?>
                    <option><?= $navbarColor[0]  ?></option>
                      <?php

                        $q = $db->prepare("SELECT * FROM colors WHERE code!=:code");
                        $q->execute(array('code'=>$navbarCode[0]));

                        $colors = $q->fetchAll(); 
                        foreach ($colors as $key) {
                            echo "<option value='".$key['code']."'>".$key['name']."</option>";
                        }
                        ?>
                    </select>
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button class="btn btn-primary" type="submit" style="padding-left: 2.5rem; padding-right: 2.5rem;">Kaydet</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
        <canvas class="my-4" id="myChart" width="900" height="380"></canvas>

        

      </main>
    </div>
  </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
</body>
</html>