<?php
include 'functions.php';
$id_com = '';
$articles_com = [];
if (isset($_GET["id_com"])) {
    $id_com = $_GET["id_com"];
    $articles_com = getFromDataBase("SELECT ac.*, a.*, (ac.PRIX*ac.QTE)total FROM art_com ac JOIN articles a ON ac.ID_ART=a.ID_ART  WHERE ID_COM='$id_com';");
} else {
    header("Location: commandes.php");
}
$id_art='';$prix_art=0;
$nom_art=''; $photo_art='';
if(isset($_GET["id_art"])&& isset($_GET["add_art"])){
    $id_art=$_GET["id_art"];
    $articles=getFromDataBase("SELECT * FROM articles WHERE ID_ART='$id_art'");
if(count($articles)==1)   {
    $nom_art= $articles[0]['DESI_ART'];
    $photo_art= $articles[0]['PHOTO_ART'];
    $prix_art= $articles[0]['PRIX_GROS'];
    
}
}

$prix=$prix_art;
$qte=0;

if(isset($_GET["id_art"])&& isset($_GET["update_art"])){
    $id_art=$_GET["id_art"];
    $articles=getFromDataBase("SELECT a.*, ac.* FROM articles a JOIN art_com ac ON a.ID_ART=ac.ID_ART WHERE ac.ID_ART='$id_art' AND ac.ID_COM='$id_com'");
if(count($articles)==1)   {
    $nom_art= $articles[0]['DESI_ART'];
    $photo_art= $articles[0]['PHOTO_ART'];
    $prix= $articles[0]['PRIX'];
    $qte= $articles[0]['QTE'];
    
}
}
if(isset($_GET["id_art"])&& isset($_GET["delete"])){
    $id_art=$_GET["id_art"];
    $articles= setInDataBase("DELETE FROM art_com WHERE ID_ART='$id_art' AND ID_COM='$id_com';");
        header("Location: " . $_SERVER["PHP_SELF"] . "?id_com=$id_com&id_art=$id_art&delete_art");
}

$err=[];
if (isset($_POST["submit"])) {
    $prix = traiter_input($_POST["prix"]);
    $qte = traiter_input($_POST["qte"]);   
    $id_art=$_GET["id_art"];
    
    
    if (empty($prix)) {
        $err['prix'] = "Champs obligatoire!!!";
    } elseif (strlen($prix) > 11) {
        $err['prix'] = "Trop long!!!";
    } elseif (!is_numeric($prix)) {
        $err['prix'] = "Seuls les numéros sont autorisés!!!";
    }
    
    if (empty($qte)) {
        $err['qte'] = "Champs obligatoire!!!";
    } elseif (strlen($qte) > 11) {
        $err['qte'] = "Trop long!!!";
    } elseif (!is_numeric($qte)) {
        $err['qte'] = "Seuls les numéros sont autorisés!!!";
    }
    if (count($err) == 0) {
        $stat = "INSERT INTO `art_com` (`ID_ART`, `ID_COM`, `PRIX`, `QTE`, `DATE_AJOUT`, `DATE_APDAT`) "
                . " VALUES ('$id_art', '$id_com', '$prix', '$qte',  '$DATE_AJOUT', '$DATE_UPDAT')";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?id_com=$id_com&nom_art=$nom_art&new_art");
    }
}


$err_update=[];
if (isset($_POST["submit_update"])) {
    $prix = traiter_input($_POST["prix"]);
    $qte = traiter_input($_POST["qte"]);    
    $id_art=$_GET["id_art"];
    
    if (empty($prix)) {
        $err_update['prix'] = "Champs obligatoire!!!";
    } elseif (strlen($prix) > 11) {
        $err_update['prix'] = "Trop long!!!";
    } elseif (!is_numeric($prix)) {
        $err_update['prix'] = "Seuls les numéros sont autorisés!!!";
    }
    
    if (empty($qte)) {
        $err_update['qte'] = "Champs obligatoire!!!";
    } elseif (strlen($qte) > 11) {
        $err_update['qte'] = "Trop long!!!";
    } elseif (!is_numeric($qte)) {
        $err_update['qte'] = "Seuls les numéros sont autorisés!!!";
    }
    if (count($err) == 0) {
        $stat = "UPDATE `art_com` SET `PRIX` = '$prix', `QTE` = '$qte', `DATE_APDAT` = '$DATE_UPDAT' "
                . "WHERE `ID_ART` = '$id_art' AND `ID_COM` = '$id_com'";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?id_com=$id_com&id_art=$id_art&updated_art");
    }
}

$id_cl = "";
$nom_cl = "";
$n_pieces = 0;
$n_art = 0;
$ht = 0;
$clients = getFromDataBase("SELECT cm.*, c.NOM_CL, COUNT(ac.ID_ART) N_ART, SUM(ac.PRIX*ac.QTE) HT , "
        . "SUM(ac.QTE) N_PIECES FROM commandes cm JOIN clients c ON cm.ID_CL=c.ID_CL JOIN art_com ac "
        . "ON cm.ID_COM=ac.ID_COM  WHERE cm.ID_COM='$id_com' GROUP BY cm.ID_COM");
if (count($clients) == 1) {
    $client = $clients[0];
    $id_cl = $client["ID_CL"];
    $nom_cl = $client["NOM_CL"];
    $n_pieces = $client["N_PIECES"];
    $n_art = $client["N_ART"];
    $ht = $client["HT"];
}
$page_title = "Articles";
include 'header.php';
?>
<section class="container-fluid"><bR><bR>    <!-- Button trigger modal -->
    <?php if (isset($_GET["nom_art"]) && isset($_GET["new_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> L'article <b><?= $_GET["nom_art"] ?></b> est ajoutée avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["id_art"]) && isset($_GET["updated_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> L'article N <b><?= $_GET["id_art"] ?></b> est modifée avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["id_art"]) && isset($_GET["delete_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> L'article N <b><?= $_GET["id_art"] ?></b> est suprimée avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <button style="display: none;" type="button" id="addArtBTN" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
    
    <button style="display: none;" type="button" id="updateArtBTN" data-bs-toggle="modal" data-bs-target="#exampleModal2"></button>
    <a class="btn btn-primary" href="choisir_article_commande.php?id_com=<?= $id_com?>">
        + Ajouter un Article
    </a>
    <a  class="btn btn-primary" href="<?= $_SERVER['PHP_SELF'] ?>">
        <i class="fas fa-redo" ></i>
    </a><br><br> 
    <h1 class="text-center">COMMANDE - ARTICLES | <?= $id_com ?><br>
        <span style="font-size: 16px;">Client: <?= $id_cl ?> - <?= $nom_cl ?></span>
    </h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ARTICLE</th>
                <th scope="col">PHOTO</th>
                <th scope="col">PRIX U</th>
                <th scope="col">QTE</th>
                <th scope="col">TOTAL</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($articles_com as $article) { ?>
                <tr>
                    <th scope="row"><?= $article["ID_ART"] ?></th>
                    <td><?= $article["DESI_ART"] ?></td>
                    <td scope="row"><img onclick="showModal(this)" src="<?= $article["PHOTO_ART"]==""?"../images/resourcesdef.png":$article["PHOTO_ART"] ?>" alt="<?= $article["DESI_ART"] ?>" style="max-height: 60px;"></td>
                    <td><?= $article["PRIX"] ?></td>
                    <td><?= $article["QTE"] ?></td>
                    <td><?= $article["total"] ?></td>
                    <td>
                        <a class="btn btn-warning text-white" href="commande_details.php?id_com=<?= $id_com?>&id_art=<?= $article["ID_ART"] ?>&update_art"  ><i class="fas fa-edit"></i></a>
                        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal3" 
                                class="btn btn-danger" data-id_com='<?= $id_com ?>'  data-id_art='<?= $article["ID_ART"] ?>' onclick="deleteCommande(this);">
                            <i class="fas fa-trash"></i></button>
                    </td>
                </tr> 
<?php } ?>
        </tbody>
    </table>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p>
                    <b>Nombre de pieces: </b><?= $n_pieces ?><br>
                    <b>Nombre d'articles: </b><?= $n_art ?><br>
                    <b>Total HT: </b><?= $ht ?><br>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_ajouter_article_commande" class="form" action="<?= $_SERVER['PHP_SELF'] . "?id_com=" . $id_com. "&id_art=" . $id_art ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter l'article N <?= $id_art ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><?= $nom_art ?></h5>
                    <div class="row">
                        <div class="col-sm-6" style="overflow: hidden">
                            <img onclick="showModal(this)" src="<?= $photo_art==""?"../images/resourcesdef.png":$photo_art ?>" alt="<?= $nom_art ?>" style="max-height: 250px;">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control <?php if (isset($err['prix'])) echo"is-invalid"; ?>" id="prix" name="prix" value="<?php echo $prix; ?>" required>
                                <label for="prix">PRIX</label> 
                                <span class="text-danger"><?php if (isset($err['prix'])) echo $err['prix']; ?></span>                          
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control <?php if (isset($err['qte'])) echo"is-invalid"; ?>" id="qte" name="qte" value="<?php echo $qte; ?>" required>
                                <label for="qte">QUANTITE</label> 
                                <span class="text-danger"><?php if (isset($err['qte'])) echo $err['qte']; ?></span>                          
                            </div>


                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm('form_ajouter_article_commande')">Effacer</button>
                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_article_commande" class="form" action="<?= $_SERVER['PHP_SELF'] . "?id_com=" . $id_com. "&id_art=" . $id_art ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier l'article N <?= $id_art ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center"><?= $nom_art ?></h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $photo_art ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control <?php if (isset($err_update['prix'])) echo"is-invalid"; ?>" id="prix" name="prix" value="<?php echo $prix; ?>" required>
                                <label for="prix">PRIX</label> 
                                <span class="text-danger"><?php if (isset($err_update['prix'])) echo $err_update['prix']; ?></span>                          
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control <?php if (isset($err_update['qte'])) echo"is-invalid"; ?>" id="qte" name="qte" value="<?php echo $qte; ?>" required>
                                <label for="qte">QUANTITE</label> 
                                <span class="text-danger"><?php if (isset($err_update['qte'])) echo $err_update['qte']; ?></span>                          
                            </div>


                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm('form_update_article_commande')">Effacer</button>
                    <button type="submit" name="submit_update" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Supprimer un client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer l'article N <b><span id="supp_id_art"></span></b> de la commande <b><?= $id_com ?></b>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NON</button>
                <a href="" id="supp_id_com_oui"  class="btn btn-primary">OUI</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">×</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<script>
	// Get the modal
	var modal = document.getElementById('myModal');
	
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	function showModal(myImg){
		modal.style.display = "block";
		modalImg.src = myImg.src;
		captionText.innerHTML = myImg.alt;
	}
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
		modal.style.display = "none";
	}
	</script>
<?php
include 'footer.php';
?>  
<script>
<?php if (count($err) != 0 || (isset($_GET["id_art"])&& isset($_GET["add_art"]))) { ?>
        $("#form_ajouter_article_commande").addClass("show");
        $("#addArtBTN").click();
<?php } ?>
<?php if (count($err) != 0 || (isset($_GET["id_art"])&& isset($_GET["update_art"]))) { ?>
        $("#form_update_article_commande").addClass("show");
        $("#updateArtBTN").click();
<?php } ?>
    
    
    function deleteCommande(b) {
        $("#supp_id_art").html(b.dataset.id_art);
        $("#supp_id_com_oui").attr("href", "?id_com=" + b.dataset.id_com + "&id_art="+b.dataset.id_art+"&delete");
    }
    </script>
