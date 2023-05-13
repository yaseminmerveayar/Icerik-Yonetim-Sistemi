<?php
  // $q = $db->prepare("SELECT value FROM settings WHERE name=:name");
  // $q->execute(array('name'=>"navbarColor"));

  // $navbarColor = $q->fetch(); 
?>

<!-- style="background-color:aliceblue;" -->
<nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <?php

            $dir    = 'pages';
            $scanned_directory = array_diff(scandir($dir), array('..', '.'));

            foreach ($scanned_directory as $key ) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='pages/".$key."'>".$key."</a>
                      </li>";
            }
            ?>


<!-- eklenecek -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu" aria-labelledby="dropdown07">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li> -->
          </ul>

        </div>
      </div>
    </nav>

    

    