<?php
    session_start();
    require("database.php");
    $errMessage = array();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link href="../style/form.css" rel="stylesheet">

    <title>Login</title>
</head>
<body>
<?php
        
    if(isset($_POST['mail']) && isset($_POST['password'])){
        $password = hash("sha256", $_POST['password']);

        $q = $db->prepare("SELECT * FROM users WHERE mail= :mail AND password= :password");
        $q->execute(array('mail'=>$_POST['mail'], 'password'=>$password));

        $results = $q->fetch(); 

        if(isset($results[0])){
            $_SESSION['MESSAGE'] = "";
            $_SESSION['ERROR'] = "";
            $_SESSION['LOGGED'] = true;

            header("Location: index.php"); 
                exit();
        }else{
            $errMessage = "Kullanıcı adı veya şifre yanlış!";
            
        }
    }

    ?>
    <section class=" vh-100">

    <div class="container-fluid h-custom mt-5">
    <?php  
        if (!empty($errMessage)) {
            echo "<div class='alert alert-danger text-center m-5' role='alert'>
                $errMessage
                </div>";
        }
    ?>
        <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
        <div class="col-md-9 col-lg-6 col-xl-5 mt-5">
            <img src="../images/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-5">
            <form class="bg-white" method="POST">

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="mail" name="mail" class="form-control form-control-lg"
                placeholder="Eposta adresinizi giriniz" />
                <label class="form-label" for="mail">Email adresi</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                placeholder="Şifrenizi giriniz" />
                <label class="form-label" for="password">Şifre</label>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
                <button class="btn btn-primary btn-lg" type="submit"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Giriş Yap</button>

            </div>

            </form>
        </div>
        </div>
    </div>

    </section>
        
</body>
</html>