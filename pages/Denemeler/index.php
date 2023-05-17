<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <link href="../../style/navbar.css" rel="stylesheet">

        <title>Denemeler</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#740792;">
        <div class="container">
            <a class="navbar-brand" href="../../index.php" style="color:#ffffff;">CmS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="../../index.php" style="color:#ffffff;">Home <span class="sr-only">(current)</span></a>
                </li>

                <?php $dir    = "../../pages";
                $scanned_directory = array_diff(scandir($dir), array("..", "."));

                foreach ($scanned_directory as $key ) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="../../pages/'.$key.'" style="color:#ffffff;">'.$key.'</a>
                        ';
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
                        <div>
                            <img src="../../images/1129166.jpg" alt="" class="img-fluid mx-auto d-block">
                        </div>
                        <h1 class=" my-3">Bu Bir Başlık</h1>
                        <div class="mr-5 metin">
                        <p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consectetur at nibh a tempus. Ut quis nisl lectus. Cras purus purus, faucibus et mattis nec, pulvinar ut nisi. Aliquam sodales commodo tristique. Integer ante metus, pretium non enim in, gravida pulvinar sapien. Vestibulum sodales sem at euismod dictum. Mauris porta diam sed est pulvinar, eu molestie odio vulputate. Fusce at vestibulum nunc.</p><p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Fusce ut vulputate felis, non vulputate purus. Duis placerat vel lacus quis ornare. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ut dui mi. Ut quis mollis ipsum. Nulla a dictum nibh, vel iaculis nulla.</p><p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Nulla eget lacus eget mauris pellentesque tempor eget sit amet erat. Etiam scelerisque convallis est a malesuada. Nullam laoreet nisl vel justo convallis consectetur. Ut ut velit vitae sapien ultrices convallis a aliquam turpis. Sed et sagittis lectus. Morbi sit amet facilisis ligula. Sed fringilla metus scelerisque nunc tristique aliquet. Suspendisse laoreet aliquet nibh. Vivamus euismod tortor vitae leo cursus, luctus porta sem volutpat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>
