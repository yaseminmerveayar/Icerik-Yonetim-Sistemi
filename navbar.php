<?php
  $q = $db->prepare("SELECT value FROM settings WHERE name=:name");
  $q->execute(array('name'=>"navbarColor"));

  $navbarColor = $q->fetch(); 
?>
<nav class="navbar navbar-expand-lg navbar-dark <?= $navbarColor[0] ?>">
      <div class="container">
        <a class="navbar-brand" href="#">Container</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- foreach döngüsü ile li kısımlarını döndür -->
            <!-- dropdown içim kişiden seçmesini iste o kısmı aydı döndür db de keyword ver  -->
            <!-- başlık text resim için araştırma yap  -->
            <?php

            $q = $db->prepare("SELECT * FROM tabs ");
            $q->execute();

            $tabs = $q->fetchAll(); 

            foreach ($tabs as $key) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='pages/".$key['name']."'>".$key['name']."</a>
                      </li>";
            }
            ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu" aria-labelledby="dropdown07">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    