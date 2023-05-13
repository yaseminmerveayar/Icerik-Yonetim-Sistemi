<?php
        $db = new PDO("sqlite:../database.db");
        ?>

        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            <link href="../style/navbar.css" rel="stylesheet">

            <title>Denemeler</title>
        </head>
        <body>
      
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../index.php">CMS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <?php

                    $q = $db->prepare("SELECT * FROM tabs ");
                    $q->execute();

                    $tabs = $q->fetchAll(); 

                    foreach ($tabs as $key) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href=../'.$key["name"].'>'.$key["name"].'</a>
                            </li>';
                    }
                    ?>

                </ul>

                </div>
            </div>
        </nav>

            <main role="main">
                <div class="container-fluid container-lg m-5">
                    <div class="row mx-4">
                        <div class="col mx-4">
                            <div class="container-fluid" >
                                <img src="../images/ademin-yaratılışı.png" alt="" class="img-fluid" style="max-width: 2000px;">
                            </div>
                            <h1 class=" my-3">Bu Bir Başlık 2 </h1>
                            <div class="mr-5">
                            <p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porta turpis dolor, sit amet pulvinar justo dignissim a. Sed bibendum placerat diam, ac euismod libero. Mauris non metus id sem ultrices sollicitudin. Ut tempor magna eget risus iaculis, vel iaculis arcu efficitur. Donec blandit felis quam, nec egestas justo vestibulum vitae. Donec ac viverra sem. Mauris eget nunc quis nulla laoreet suscipit porta id nunc. Donec ac risus tristique, fringilla diam vitae, viverra magna.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Aenean leo nunc, rutrum eleifend eleifend ut, dictum bibendum quam. Vivamus vestibulum, tortor maximus dictum pretium, ligula metus imperdiet lacus, a tempus orci urna vel nunc. Duis ac eros ut massa semper vulputate. Phasellus venenatis pharetra risus, tincidunt gravida lacus. Curabitur consequat turpis diam, vel luctus sapien lacinia vitae. Quisque gravida quis nulla efficitur faucibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec dui erat, pretium at velit in, tincidunt dapibus dui. Etiam commodo mauris vitae magna semper vestibulum. Phasellus eu purus quam. Fusce ultricies eu ipsum eu tincidunt. Vestibulum euismod neque a lorem rutrum ullamcorper. Vestibulum at nibh porta, volutpat arcu in, finibus felis. Vivamus convallis ipsum lacus, ac efficitur velit luctus at. Pellentesque eget lectus libero.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Morbi tempor, ex a imperdiet sagittis, odio velit congue metus, nec ornare elit arcu quis turpis. Nullam tortor mauris, semper a lectus non, volutpat maximus tellus. Fusce leo dolor, tempor id libero fringilla, ornare rhoncus lacus. Morbi diam ex, venenatis nec massa eu, faucibus pharetra ante. Nam aliquet hendrerit eros quis laoreet. Duis porttitor vestibulum urna, a blandit dolor porta id. Sed varius sapien id nulla mattis, nec mollis metus sagittis. Phasellus gravida, ex sit amet posuere dapibus, nisi turpis sodales libero, at lobortis justo elit id lacus. Suspendisse potenti. Praesent lectus ligula, vehicula non placerat non, imperdiet eu augue. Donec sed mollis sapien, quis mattis leo. Quisque porta urna in ipsum rhoncus pretium. Ut sed lorem at purus auctor tempus. Mauris lectus nibh, mollis ac venenatis ultrices, hendrerit sed sem. Morbi finibus rutrum libero.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">In vestibulum facilisis nulla a suscipit. Sed massa metus, lobortis in interdum tempor, euismod vel enim. Pellentesque aliquam ut eros ac cursus. Fusce posuere augue ipsum, sit amet congue ante maximus ut. Curabitur neque diam, porta nec orci id, mollis mollis enim. Donec at ornare leo. Sed non lacus quis ex varius hendrerit et pulvinar metus. Vivamus eu risus ac nisl facilisis accumsan eget id neque.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Suspendisse vel quam vitae mauris viverra feugiat vehicula vel ligula. Maecenas non commodo felis. Proin ultrices dui eget ipsum tempus sodales. Duis metus augue, sagittis eget urna ut, vehicula pretium tellus. Aenean fringilla ex et scelerisque porttitor. Aliquam at nisl sed lorem viverra auctor. Phasellus pulvinar condimentum nibh, sit amet finibus lorem porta quis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque vitae pharetra ipsum. Sed vel rutrum justo. Praesent quam nulla, fermentum a ligula non, interdum commodo turpis. Praesent et rhoncus massa, at porttitor augue. Ut suscipit pharetra felis quis eleifend. Maecenas ultrices porta lacus, non ornare massa venenatis ac.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script  type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
        </body>
        </html>