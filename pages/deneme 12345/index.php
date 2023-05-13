<?php
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
  
            <title>deneme 12345</title>
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
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='../../pages/".$key."'>".$key."</a>
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
                                <img src="../../images/aa.jpg" alt="" class="img-fluid mx-auto d-block" >
                            </div>
                            <h1 class=" my-3">Bu Bir Başlık 2</h1>
                            <div class="mr-5 metin">
                                                                                                                                            <p>koko</p>
                            
                            
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script  type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        </body>
        </html>