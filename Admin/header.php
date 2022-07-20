<?php

$user='';
$role='';
$fname='';
if(isset($_SESSION['username'])){
    $user=$_SESSION['username'];
    $fname=$_SESSION['fname'];
    $role=$_SESSION['role'];
}
else 
    header("Location: connexion.php");

if(isset($_GET['deconnexion'])){
    session_destroy ();
    header("Location: connexion.php");
}
$theme = "";
if(isset($_GET['theme'])){
    setcookie('THEME_WEB2022', $_GET['theme'], time() + (86400 * 30), "/"); // 86400s = 1 day
        header("Location: ".$_SERVER["PHP_SELF"]);
}
if(isset($_COOKIE['THEME_WEB2022']))
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
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
                <link rel="icon" href="../images/cloud.png">
</head>
<body class="<?= $theme ?>">	




	<div id="side_menu">
		<div class="container" id="bars" onclick="showMenu()">
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
		  </div>
		<ul>
			<li><a href=""><span class="icon_side_menu"><i class="fas fa-envelope"></i></span><span class="link_side">Inbox</span></a></li>
			<li><a href=""><span class="icon_side_menu"><i class="fas fa-paper-plane"></i></span><span class="link_side">Outbox</span></a></li>
			<li><a href=""><span class="icon_side_menu"><i class="far fa-address-book"></i></span><span class="link_side">Contacts</span></a></li>
			<li><a href=""><span class="icon_side_menu"><i class="fas fa-file-alt"></i></i></span><span class="link_side">Drafts</span></a></li>
			<li><a href=""><span class="icon_side_menu"><i class="fas fa-heart"></i></i></span><span class="link_side">Favourites</span></a></li>
			<li><a href=""><span class="icon_side_menu"><i class="fas fa-star"></i></span><span class="link_side">Starred</span></a></li>
		</ul>

	</div>
	<div id="black_div" onclick="hideMenu()"></div>




	<a id="goToTop" href="#top" ><i class="fas fa-chevron-up"></i></a>
	<div class="myrow" style="padding: 5px;" >
		<div class="mycol-4" id="social_network">			
			<a href="https://www.facebook.com/CirrusSignAgency" class="facebook" target="_blank"><i class="fab fa-facebook-f "></i></a> 
			<a href="https://www.linkedin.com/" class="linkedin" target="_blank"><i class="fab fa-linkedin-in "></i></a> 
			<a href="https://www.youtube.com/" class="youtube" target="_blank"><i class="fab fa-youtube "></i></a> 
			<a href="https://www.instagram.com/" class="instagram" target="_blank"><i class="fab fa-instagram " ></i></a> 
		</div>
		<div class="mycol-4">
			<a href="tel:+213549282661" ><i class="fas fa-phone-alt"></i> +213 (0) 549 28 26 61</a> 
			<a href="mailto:saadioussama09@gmail.com" ><i class="fas fa-envelope"></i> saadioussama09@gmail.com</a>
		</div>
		<div class="mycol-4">
			<span>Bonjour <?= $fname ?></span> 
                        <a style='margin-left:350px; border-radius: 10px;' href="?deconnexion" class="btn btn-danger" ><i class="fas fa-sign-out-alt"></i> DECONNXION</a>
		</div>
	</div>




	<nav class="navbar  sticky-top navbar-expand-lg navbar-light bg-light bg-orange" style="box-shadow: 0px 2px 3px grey;">
		<div class="container-fluid">
		  <a class="navbar-brand" href="#">
			<img src="images/favicon.ico" alt="" style="max-height: 50px;"></a>
		  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			  <li class="nav-item text-center">
                              <a class="nav-link <?php if($page_title=="Accueil")echo "active";?>" aria-current="page" href="index.php">Acceuil</a>
			  </li>
			  <li class="nav-item text-center">
				<a class="nav-link <?= $page_title=="Articles"?"active":"";?>" href="articles.php">Articles</a>
			  </li>
			  <li class="nav-item text-center">
				<a class="nav-link <?php if($page_title=="Clients")echo "active";?>" href="clients.php">Clients</a>
			  </li>
			  <li class="nav-item text-center">
				<a class="nav-link <?php if($page_title=="Commandes")echo "active";?>" href="commandes.php">Commandes</a>
			  </li>
                          
                          <?php if($_SESSION['role']=="admin"){ ?>
			  <li class="nav-item text-center">
				<a class="nav-link <?php if($page_title=="Utilisateurs")echo "active";?>" href="users.php">Utilisateurs</a>
			  </li>
                          <?php } ?>
                          
                          
			  <li class="nav-item dropdown text-center">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				  Themes
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="?theme=green"><span class="color_theme" style="background: #a0cf12;"></span> GREEN</a></li>
				  <li><a class="dropdown-item" href="?theme=red"><span class="color_theme" style="background: #f40524;"></span> RED</a></li>
				  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="?theme="><span class="color_theme" style="background: grey;"></span> DEFAULT</a></li>
				</ul>
			  </li>
			</ul>
		  </div>
		</div>
	  </nav>
        
        
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">×</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>