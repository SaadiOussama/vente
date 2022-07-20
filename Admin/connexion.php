<?php
include 'functions.php';
$page_title = "Connexion";
$err = [];
$email = "";
$pwd = "";
if (isset($_POST["submit"])) {
    $email = traiter_input($_POST["email"]);
    $pwd = traiter_input($_POST["pwd"]);
    $users= getFromDataBase("SELECT * FROM users WHERE 	USERNAME LIKE '$email' AND PASSWORD LIKE MD5('$pwd');");
    if(count($users)==0)$err['pwd']="Email ou mot de passe est incorrect";
    else{
        $_SESSION['username']=$email;
        $_SESSION['fname']=$users[0]["FIRST_NAME"];
        $_SESSION['role']=$users[0]['ROLE'];
        $_SESSION['time_connection']=time();    
        header("Location: index.php");
    }    
}


if(isset($_SESSION['username']))   
        header("Location: index.php");


$theme = "";
if (isset($_GET['theme'])) {
    setcookie('THEME_WEB2022', $_GET['theme'], time() + (86400 * 30), "/"); // 86400s = 1 day
    header("Location: " . $_SERVER["PHP_SELF"]);
}
if (isset($_COOKIE['THEME_WEB2022']))
    $theme = $_COOKIE['THEME_WEB2022'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $page_title?> | webdev2022</title>
        <link rel="icon" href="../images/favicon.ico">
        <link rel="stylesheet" href="../css/all.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="../css/responsive-calendar.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <style>
            body{
                background: var(--color-font-link);
            }
            #form_container{
                padding: 30px;
                background: whitesmoke;
                border-radius: 10px;
                
            }
        </style>
    </head>
    <body class="<?= $theme ?>">	

        <div class="container-fluid" style="padding-top: 100px;">
            <div class="row">
                <div class="offset-4 col-sm-4">
                    <!-- zone de connexion -->

                    <div id="form_container">
                        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                            <img style="width: 70px; height: 70px; transform: translateX(250px);" src="../images/cloud.png">
                            <h1 class="text-center">Connexion</h1>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                                <label for="email">Email </label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="pwd" name="pwd" value="<?= $pwd ?>">
                                <label for="pwd">Mot de passe</label>
                        <span class="text-danger"><?php if (isset($err['pwd'])) echo $err['pwd']; ?></span>                          
                    
                            </div>
                            
                            <div class="mt-3 d-grid gap-2">
                                <input class="btn btn-success" type="submit" name='submit' value='LOGIN' >
                            </div>
                            
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>