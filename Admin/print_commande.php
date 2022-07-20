<?php
include "functions.php";
$id_com='';
$nom_cl='';
if(!isset($_GET['id_com']))
    header("Location: commandes.php");
$id_com=$_GET['id_com'];

$client=getFromDataBase("SELECT cl.* FROM commandes com JOIN clients cl ON com.ID_CL=cl.ID_CL WHERE ID_COM='".$id_com."'");
  if(count($client)==0){
    header("Location: commandes.php");
  }
$nom_cl=$client[0]['NOM_CL'];

$total_ht= getFromDataBase("SELECT SUM(QTE*PRIX) TOTAL_HT FROM art_com WHERE ID_COM='$id_com';")[0]["TOTAL_HT"];

$stat="SELECT * FROM articles a JOIN art_com ac ON a.ID_ART=ac.ID_ART WHERE ac.ID_COM='$id_com';";
$articles_tab=getFromDataBase($stat);
?>
<!DOCTYPE html>
<html>
<head>
	<title>WEB2022 - Print commande</title>
	<link rel="icon" href="../images/favicon.ico">
		<link rel="stylesheet" href="../css/all.css">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/responsive-calendar.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <div id="print_zone">
<section class="container">
<br>
<h1 class="text-center">Bon de Livraison N°<b><?= $id_com  ?></b><br><?=  "Client: $nom_cl" ?></span></h1>
<br>
<br>
<p style="text-align: right">Le <?= date("d-m-Y");?></p>
    
</section>
<section class="container">
    <table  class="table table-hover">
        <thead>
            <tr>
                <th>REF</th>
                <th>NOM</th>
                <th>P.U</th>
                <th>QTE</th>
                <th>P.T</th>
            </tr>
        </thead>
        <tbody>

<?php foreach($articles_tab as $article){ ?>
            <tr>
                <td><?= $article["ID_ART"] ?></td>
                <td><?= $article["DESI_ART"] ?></td>
                <td><?= $article["PRIX"] ?></td>
                <td><?= $article["QTE"] ?></td>
                <td><?= $article["PRIX"]*$article["QTE"] ?></td>
               
            </tr>

            <?php }?>
            
            <tr style="font-weight: bolder; color: white; background: #7d7d7d;">
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL HT</td>
                <td><?= $total_ht ?></td>
               
            </tr>

        </tbody>
    </table>
</section>
    </div>


<script src="js/script.js"></script>
<script>window.print();
</script>
</body>
</html>