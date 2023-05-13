<?php 
    session_start();
    require("database.php");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="style/navbar.css" rel="stylesheet">

    <title>Anasayfa</title>
</head>
<body>
    <?php include("navbar.php"); ?>
    
    <main role="main">
                <div class="container-fluid m-5">
                    <div class="row mr-4">
                        <div class="col mx-2">
                            <div class="text-center">
                                <img class="img-fluid mx-auto d-block" src="images/CMS-Icerik-Yonetim-Sistemi.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </main>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script  type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>