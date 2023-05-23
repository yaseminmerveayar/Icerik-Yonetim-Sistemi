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
                    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#9900ad;">
                        <div class="container">
                            <a class="navbar-brand" style="color:#ffffff;" href="../../index.php">İYS</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
            
                            <div class="collapse navbar-collapse" id="navbarsExample">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                <a class="nav-link" style="color:#ffffff;" href="../../index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
            
                                <?php $dir    = "../../pages";
                                $scanned_directory = array_diff(scandir($dir), array("..", "."));
            
                                foreach ($scanned_directory as $key ) {
                                    echo '<li class="nav-item">
                                        <a class="nav-link" style="color:#ffffff;" href="../../pages/'.$key.'">'.$key.'</a>
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
                                                                    <p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam urna enim, consequat tristique hendrerit vel, convallis sed sem. Nullam congue molestie justo sit amet dapibus. Donec a sem lectus. Ut sagittis enim eget vehicula accumsan. Fusce id urna tempus nunc aliquam fermentum nec aliquam nisi. Etiam consequat, lorem eu sollicitudin ullamcorper, sapien erat fringilla leo, ut dictum lorem ligula id ligula. Pellentesque dictum hendrerit sapien, a congue ex semper sed. Mauris nibh odio, ullamcorper nec porttitor id, congue in odio. Quisque ut tortor ut nisi blandit convallis sed sed mauris.</p><p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Ut est augue, ultricies in diam non, pulvinar bibendum odio. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas mi leo, pretium placerat nisi sit amet, sagittis faucibus ligula. Maecenas tincidunt purus nec pulvinar pharetra. Donec luctus, ex vitae lobortis feugiat, sem nulla pharetra turpis, ut sodales enim enim vel eros. Etiam vel mattis est. Aenean euismod consectetur volutpat.</p><p style='margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: "Open Sans", Arial, sans-serif;'>Aenean id fringilla est. Aenean condimentum suscipit mi, vel porta lectus lacinia vel. Nunc ullamcorper tempus nisi, ac placerat mauris dignissim rutrum. Duis neque mauris, varius eu egestas nec, convallis eget tellus. Vestibulum vitae commodo leo. Mauris egestas dictum nunc, eu aliquam sapien varius in. Donec sollicitudin arcu nec dui molestie mattis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vehicula gravida lacinia. Morbi dignissim, leo nec porta accumsan, justo ex pellentesque eros, id elementum ipsum diam at augue. Vivamus porta ex nisl, et accumsan felis molestie sed. Suspendisse potenti. Sed congue leo ipsum, in facilisis est pretium nec. Sed tristique lobortis dapibus. Morbi pulvinar tristique sollicitudin.</p>
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                        <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
                    </body>
                    </html><!-- top -->
