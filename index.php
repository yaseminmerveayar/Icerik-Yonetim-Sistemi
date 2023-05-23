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
    <nav class="navbar navbar-expand-lg" style="background-color:#9900ad;">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color:#ffffff;">İYS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../index.php" style="color:#ffffff;">Home</a>
                </li>
                <?php $dir    = "pages";
                $scanned_directory = array_diff(scandir($dir), array("..", "."));

                foreach ($scanned_directory as $key ) {
                    echo '<li class="nav-item active">
                    <a class="nav-link" style="color:#ffffff;" href="pages/'.$key.'">'.$key.'</a>
                    ';
                }?>

            </ul>
            </div>
        </div>
    </nav>
    
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
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
