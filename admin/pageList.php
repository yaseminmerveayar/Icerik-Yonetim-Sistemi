<?php 
    session_start();
    require('database.php');

    if (!$_SESSION['LOGGED']) {
        header("Location: login.php"); 
        exit();
    }

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../style/dashboard.css" rel="stylesheet">

    <title>Admin - Page List</title>
</head>
<body>
    <?php  include("navbar.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <?php  include("menu.php"); ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Sayfa Listesi</h1>
                </div>
                <div class="container-fluid m-2">
                    <div class="row">
                        <div class="col">
                        <table class="table table-hover table-striped ">
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Sekme Adı</th>
                            <th scope="col">Tip</th>
                            <th scope="col">Başlık</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $select = $db->prepare("SELECT * FROM pages ");
                            $select->execute();

                            $pages = $select->fetchAll();

                            foreach ($pages as $key ) {
                                $select = $db->prepare("SELECT * FROM tabs WHERE id=? ");
                                $select->execute([$key['tab_id']]);

                                $tab = $select->fetch();

                                echo '<tr>
                                <td>
                                <td>'.$tab['name'].'</td>
                                <td>'.$tab['type'].'</td>
                                <td>'.$key['title'].'</td>
                                <td><div class="d-grid gap-2 d-md-flex justify-content-md-end mr-4"><button type="button" class="btn btn-danger btn-sm" onClick="location.href=`deletePage.php?id='.$key["tab_id"].'`">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                              </svg></button></div></td>
                            </tr>';
                            }
                            

                            ?>
                            
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php  include("adminJs.html"); ?>
</body>
</html>