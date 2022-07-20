<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>First html title</title>
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <style>
        #side_menu{
            position: fixed;
            overflow-y: auto;
            overflow-x: hidden;
            width: 60px;
            height: 100vh;
            background: rgb(240, 240, 240);
            box-shadow: 0px 0px 6px grey;
            z-index: 999999;
            padding: 10px;
            transition: 0.3s;
        }
        .show_side_menu{
            width:200px !important
        }
        .link_side{
            padding: 20px;
            margin-left: 10px;
        }
        #side_menu ul{
            padding-left: 0;
            padding-top: 30px;
            list-style-type: none;
            margin: 0;
        }
        #side_menu ul li a{
            display: block;
            border-radius: 5px;
            transition: .3s;
            padding: 10px 20px 10px 5px;
            white-space: nowrap;
        }
        #side_menu ul li a:hover{
            background: rgb(218, 218, 218);
        }
        .icon_side_menu{
            display: inline-block;
            width: 30px;
            text-align:center;
        }
        #black_div{
            position: fixed;
            width: 100%;
            height: 100%;
            background: #000000a6;
            z-index: 99999;
            display: none;
        }
        .show_black_div{
            display: block !important;
        }
    </style>

    <!--  <div id="side_menu">
                    <span class="btn btn-link" onclick="showMenu()"><i class="fas fa-bars"></i></span>
              <ul>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-envelope"></i></span><span class="link_side">Inbox</span></a></li>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-paper-plane"></i></span><span class="link_side">Outbox</span></a></li>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-address-book"></i></span><span class="link_side">Contacts</span></a></li>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-file-alt"></i></span><span class="link_side">Drafts</span></a></li>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-heart"></i></span><span class="link_side">Favourites</span></a></li>
                    <li><a href=""><span class="icon_side_menu"><i class="fas fa-star"></i></span><span class="link_side">Starred</span></a></li>
              </ul>
      </div>!-->
    <div id="black_div" onclick="hideMenu()"></div>

    <script>
        function showMenu() {
            document.getElementById('side_menu').classList.toggle('show_side_menu');
            document.getElementById('black_div').classList.toggle('show_black_div');
        }

        function hideMenu() {
            document.getElementById('side_menu').classList.toggle('show_side_menu');
            document.getElementById('black_div').classList.toggle('show_black_div');

        }
    </script>

    <body>
        <a id="goToTop" href="#top"><i class="fas fa-chevron-up"></i></a>
        <div class="myrow" style="padding: 5px;;" id="social_network">
            <div class="mycol-4">
                <a href="https://www.facebook.com/"  class="facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/" class="linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com/" class="youtube" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://www.instagram.com" class="instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
            <div class="mycol-8">
                <a href="tel:+213549282661" style="text-decoration: none; color: black;"><i class="fas fa-phone-alt"></i>+213 (0) 549282661</a>
                <a href="mailto:saadioussama09@gmail.com" style="text-decoration: none; color: black;"><i class="fas fa-envelope"></i>saadioussama09@gmail.com</a>
            </div>
        </div>    

        <style>
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 999999; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }

            /* Modal Content (image) */
            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
            }

            /* Caption of Modal Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }

            /* Add Animation */
            .modal-content, #caption {
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }

            @-webkit-keyframes zoom {
                from {
                    -webkit-transform:scale(0)
                }
                to {
                    -webkit-transform:scale(1)
                }
            }

            @keyframes zoom {
                from {
                    transform:scale(0)
                }
                to {
                    transform:scale(1)
                }
            }

            /* The Close Button */
            .close {
                position: absolute;
                top: 15px;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;
            }

            .close:hover,
            .close:focus {
                color: #bbb;
                text-decoration: none;
                cursor: pointer;
            }



            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                }
            }
        </style>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>



        <nav class="navbar  sticky-top navbar-expand-lg navbar-light bg-light bg-orange" style="box-shadow: 0px 2px 3px grey;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/Logo_Appel.png" alt="" style="max-height: 50px;"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item text-center">
                            <a class="nav-link active" aria-current="page" href="index.html">Acceuil</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="portfolio.html">Portfolio</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="services.html">Services</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown text-center">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown text-center">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produits
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Collection 1</a></li>
                                <li><a class="dropdown-item" href="#">Collection 2</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Collection 3</a></li>
                            </ul>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <h1 class="text-center">Learning PHP</h1>
            <?php
            echo 'MY FIRST PHP CODE';
            echo '<br><b>My Second php code</b>';
            echo '<br><b class="testAddClass">My Third PHP code</b>';
            echo '<br><b style="color:red;">My fourth PHP code</b>';

            //declaration des veriables
            $nom_produit = "Galaxy s7";
            $annee_sortie = "2016";
            $prix = 749.99;
            $fin_serie = false;
            $br = "<br>";
            echo $br . "Nom de produit: " . $nom_produit . $br;

            echo $annee_sortie . $br;
            echo '$prix<br>';
            echo "$prix<br>";
            echo 'test' . '<br>';
            echo "text" . "<br>" . "<hr>";
            echo "Mon telephone prefere est " . "$nom_produit" . "<hr>";
            echo "Mon telephone prefere est " . $nom_produit;
            echo "Mon telephone prefere est $nom_produit<hr>";

            //declaration des constante
            //les constantes avec deux methodes
            const BR = "<br>"; //define('BR' , '<br>');
            define('HR', '<hr>'); //const HR = "<hr>";
            const TVA = 0.19;

            $prenom = "Oussama";
            $nom = "Saadi";
            echo $prenom . " " . $nom . BR;
            echo "$prenom $nom" . HR;

            //les type des variables

            var_dump($nom_produit);
            var_dump($annee_sortie);
            var_dump($prix);
            var_dump($fin_serie);

            echo "<h1 style='text-align:center;'>$prenom $nom</h1>";
            echo "<h1>$prenom $nom</h1>";
            echo '</h1>' . $prenom . '' . $nom . '</h1>';
            $color = "green"
            ?>

            <h1 style='text-align: center; color:<?php echo $color ?>'><?php echo $nom_produit; ?></h1>
            <h1 style='text-align: center; color:<?= $php ?>'><?= $nom_produit ?></h1>

            <?php
// les expression
//if
            $temp = 45;
            if ($temp > 30) {
                echo"il fait chaud";
            } elseif ($temp > 15) {
                echo "il fait beau";
            } else {
                echo "il fait froid";
            }

            echo $br;
            echo HR;

//swithch case
            $my_car = "Renault";
            switch ($my_car) {
                case "Renault":
                    echo "$my_car, Ma voiture est francaise";
                    break;
                case "BMW":
                    echo "$my_car, Ma voiture est allemande";
                    break;
                case "Ford":
                    echo "$my_car, Ma voiture est americane";
                    break;
                default:
                    echo "$my_car, Ma voiture est indienne";
                    break;
            }

//les fonctions
            function newLine() {
                echo '<hr>';
            }

            newLine();
            newLine();
            newLine();

            print_r($GLOBALS);
            newLine();
            echo $GLOBALS ['prenom'] . ' - ' . $prenom;
            newLine();
            echo $GLOBALS ['prenom'] . ' - ' . $prenom;
            newLine();

// les varibles globales et les variable locales
//$i,$j sont les variables globales
            $i = 100;
            $j = 1000;

//utilisation des variables globales dans une fonction
            function addtest($x, $y) {
                $z = $x + $y; // $z est une variable locale
                global $i, $j;
                return $z + $i + $j;
            }

            echo addtest($i, $j);

//les tableaux

            $phones = array();
            $phones = []; // 2 facons pour declarer tableau vide
            $phones = array("OPPO", "MTOROLLA", "APPLE");
            $phones[] = "mi";
            newLine();
            var_dump($phones);

            newLine();
            print_r($phones);

            function pre_r($tab) {
                echo '<pre>';
                print_r($tab);
                echo'</pre>';
            }

            pre_r($phones);

            echo "l'index 0 a la valeur $phones[0]" . BR;
            echo "l'index 1 a la valeur " . $phones[1] . BR;
            echo "l'index 2 a la valeur " . $phones[2] . BR;
            echo "l'index 3 a la valeur " . $phones[3] . BR;

            $phones1 = array("iphone 12", "iphone 13", "iphone 13 pro", 2018, True, FALSE, $phones);
            pre_r($phones);
            echo $phones1[6][1];

// la boucle for
            $colors = array("red", "green", "black", "orange");
            pre_r($colors);

            for ($i = 0; $i < count($colors); $i++) {
                echo "<p style='color:$colors[$i];'>$i: Ta color est: $colors[$i]</P>" . BR;
            }


            $student = array('id' => 10, 'first_name' => 'Abdou', 'last_name' => 'Derdour');
            $student1 = array(10, 'Abdou', 'Derdour');
            echo '<h3>Afiichage $student</h3>';
            pre_r($student);
            echo $student['id'] . BR;
            echo $student['first_name'] . BR;
            echo $student['last_name'] . BR;
            pre_r($student1);
            echo $student1[0] . BR;
            echo $student1[1] . BR;
            echo $student1[2] . BR;

            echo '<h3>Affichage $student1 for ($i = 0; $i < count($student1); $i++)</h3>';
            for ($i = 0; $i < count($student1); $i++) {
                echo "$i : $student1[$i]" . BR;
            }

            echo '<h3>Affichage $student foreach ($student as $i => $value)</h3>';
            foreach ($student as $key => $value) {
                echo "$key :  $value" . BR;
            }

            echo '<h3>Affichage $student foreach ($student as  $value)</h3>';
            foreach ($student as $value) {
                echo "Value : $value" . BR;
            }

            echo '<h3>Affichage $student1 foreach ($student1 as  $value)</h3>';
            foreach ($student1 as $value) {
                echo "Value : $value" . BR;
            }



            $students = Array(
                Array('id' => 1, 'first_name' => 'Abdou', 'last_name' => 'derdour'),
                Array('id' => 2, 'first_name' => 'Med', 'last_name' => 'Bousalem'),
                Array('id' => 3, 'first_name' => 'Amine', 'last_name' => 'Adouane'),
                Array('id' => 4, 'first_name' => 'Adel', 'last_name' => 'Serir'),
                Array('id' => 5, 'first_name' => 'Fayrouz', 'last_name' => 'Ait')
            );

            pre_r($students);

            echo '<h3>Affichage $student1 foreach ($students as $student )</h3>';
            foreach ($students as $student) {
                echo "student :" . $student["id"] . BR;
                echo "student :" . $student["first_name"] . BR;
                echo "student :" . $student["last_name"] . BR;
            }

// 2 solustion
            echo HR;
            foreach ($students as $student) {
                echo "student :" . BR;
                foreach ($student as $key => $value) {
                    echo " $key : $value" . BR;
                }
            }


            $i = 0;
            while ($i < count($colors)) {
                echo "$i : $colors[$i]" . BR;
                $i++;
            }


            $i = count($colors) - 1;
            while ($i >= 0) {
                echo "$i : $colors[$i]" . BR;
                $i--;
            }


            echo '<h3>Ne pas afficher la deuxieme couleur</h3>';
            $i = 0;
            while ($i < count($colors)) {
                if ($i == 1) {
                    $i++;
                    continue;
                }
                echo "$i : $colors[$i]" . BR;
                $i++;
            }

            for ($i = 0; $i < count($colors); $i++) {
                if ($i == 1)
                    continue;
                echo "$i : Ta couleur est : $colors[$i]" . BR;
            }

            foreach ($colors as $key => $color) {
                if ($key == 1)
                    continue;
                echo "$key : Ta couleur est : $color" . BR;
            }

            echo '<h3>Afficher les deux premieres couleurs</h3>';
            $i = 0;
            while ($i < count($colors)) {
                if ($i == 2)
                    break;
                echo "$i : $colors[$i]" . BR;
                $i++;
            }

            for ($i = 0; $i < count($colors); $i++) {
                if ($i == 2)
                    break;
                echo "$i : Ta couleur est : $colors[$i]" . BR;
            }


            echo($_SERVER['PHP_SELF'] . "<br>");
            $t = time(); //timestamp is number
            echo($_SERVER['REQUEST_TIME'] . " - " . $t . "<br>"); //timestamp
            echo date("d/m/Y") . BR; //  date selon le format day d, month m, year Y
            echo date("d/m/Y", time()) . BR;
            echo date("h:i") . BR;
            echo date("l D d-m-Y") . BR;

            $d = strtotime("tomorrow");
            echo date("Y-m-d h:i:sa", $d) . "<br>";
//$d=strtotime("25-12-2002");
            echo date("Y-m-d h:i:sa", $d) . "<br>";
            echo date("d/m/Y h:i:sa", 3213123);

            foreach ($_SERVER as $index => $value) {
                echo "$index : $value" . BR;
            }


            echo BR . 'GET ' . BR;
            pre_r($_GET);
            echo 'REQUEST ' . BR;
            pre_r($_REQUEST);
            echo 'POST ' . BR;
            pre_r($_POST);
            
            if (isset($_GET["staticEmail"]))
                echo 'staticEmail: ' . $_GET["staticEmail"] . BR;
            if (isset($_GET["inputPassword"]))
                echo 'inputPassword: ' . $_GET["inputPassword"] . BR;
            
            if (isset($_POST["staticEmail"])) {
                echo 'staticEmail: ' . $_POST["staticEmail"] . BR;
            }
            if (isset($_POST["inputPassword"])) {
                echo 'inputPassword: ' . $_POST["inputPassword"] . BR;
            }

            if (isset($_POST["username"])) {
                echo 'username: ' . $_POST["username"] . BR;
            }
            if (isset($_POST["fullname"])) {
                echo 'fullname: ' . $_POST["fullname"] . BR;
            }
            if (isset($_POST["emailaddress"])) {
                echo 'email address: ' . $_POST["emailaddress"] . BR;
            }
            if (isset($_POST["password"])) {
                echo 'password: ' . $_POST["password"] . BR;
            }
            ?>

            <form action="<?= $_SERVER["PHP_SELF"] ?>?id=12&name=sasas" method="POST">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="staticEmail" name="staticEmail" placeholder="email@example.com">
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
                    </div>
                </div><br>
                <div class="form-group row">
                    <div class="offset-md-2 col-sm-10">
                <!--        <input type="submit" class="btn btn-primary" name="submit" value="SUBMIT" >-->
                        <button class="btn btn-primary" name="submit">SUBMIT</button>
                    </div>
                </div>
            </form>
            
            <hr>
            
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" class="onlowrus-center-on-div" style="border-radius: 20px; box-shadow: 0px 0px 10px gray;min-height: 500px; width: 400px;">
            <div style="padding: 30px;">
                <div class="row">
                    <div class="mb-3 col-lg-6 m-0">
                        <label for="username" class="form-label color-black">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-6 m-0">
                        <label for="fullname" class="form-label color-black">Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label color-black">Email address</label>
                    <input type="email" class="form-control"  name="emailaddress" id="email" aria-describedby="emailHelp">
                </div>
              
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label color-black">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
               
                <div class="text-center" style="margin-top: 30px;">
                    <button type="submit"  name="submit" class="btn btn-primary">Create Account</button>
                </div>
            </div>

        </form>
        </section>

        <script src="js/bootstrap.bundle.js"></script>
        <script src="js/jquery-3.6.0.min.js"></script>


    </body>			
</html>