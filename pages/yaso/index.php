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
    <link href="style/navbar.css" rel="stylesheet">

    <title>yaso</title>
</head>
<body>
<?php include("../../navbar.php"); ?>
    <main role="main">
        <div class="container-fluid m-5">
            <div class="row mx-4">
                <div class="col mx-4">
                    <h1 class=" my-3">Bu Bir Başlık 2 </h1>
                    <div class="mr-5">
                    <p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae tempor turpis, id fringilla est. Duis venenatis tortor maximus sapien commodo, et vulputate eros facilisis. Vivamus quis pulvinar nisl. Nunc nec sapien at lorem varius malesuada nec eu magna. Proin ullamcorper lacinia risus, in consectetur orci condimentum in. Phasellus fringilla sed lorem aliquam hendrerit. Nunc vitae neque vel augue sodales congue a at metus. Quisque pretium nisl non lacus dictum, at ornare nulla egestas. Morbi placerat, mauris a fermentum consectetur, purus ipsum consequat mi, a molestie nunc felis sed risus. Sed elementum et justo nec bibendum. Aliquam erat volutpat. Donec mi orci, pretium sit amet nisl eu, pharetra aliquet tellus. Sed ut dignissim mauris. Cras vitae vulputate arcu. Integer eget tempor mi.</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;">Phasellus leo sapien, laoreet a nunc sit amet, malesuada sodales odio. Aenean congue nibh non lacinia accumsan. Curabitur ligula orci, dictum eu nisi ac, scelerisque placerat orci. Donec tincidunt quis augue eget vulputate. Ut aliquam lacinia tincidunt. Ut lacinia mi ut leo venenatis, a mattis nunc maximus. Etiam ut dui tincidunt, pharetra est vitae, viverra enim. Ut auctor dictum leo a vestibulum.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script  type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>