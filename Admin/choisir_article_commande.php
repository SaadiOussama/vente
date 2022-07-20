<?php
include 'functions.php';
$id_com='';
$articles_com=[];
if(isset($_GET["id_com"])){
    $id_com=$_GET["id_com"];
    $articles_com= getFromDataBase("SELECT * FROM articles WHERE ID_ART NOT IN (SELECT ID_ART FROM art_com WHERE ID_COM='$id_com')");
}else{    
    header("Location: commandes.php");
}
$page_title="Choix d'Articles";
include 'header.php';
?>
<section class="container-fluid"><bR>
     
    <h1 class="text-center">COMMANDE - ARTICLES | <?= $id_com ?>
    </h1>
    <table class="table table-hover">
     <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOM</th>
      <th scope="col">PHOTO</th>
      <th scope="col">PRIX GROS</th>
      <th scope="col">PRIX S-GROS</th>
      <th scope="col">PRIX DETAIL</th>
      <th scope="col">ACTIONS</th>
    </tr>
  </thead>
  <tbody>
      <?php      foreach ($articles_com as $article) {?>
    <tr>
      <th scope="row"><?= $article["ID_ART"] ?></th>
      <td><?= $article["DESI_ART"] ?></td>
                    <td scope="row"><img onclick="showModal(this)" src="<?= $article["PHOTO_ART"]==""?"../images/resourcesdef.png":$article["PHOTO_ART"] ?>" alt="<?= $article["DESI_ART"] ?>" style="max-height: 60px;"></td>
                    <td><?= $article["PRIX_GROS"] ?></td>
      <td><?= $article["PRIX_SGROS"] ?></td>
      <td><?= $article["PRIX_DETAIL"] ?></td>
      <td>
          <a class="btn btn-primary text-white" href="commande_details.php?id_com=<?= $id_com?>&id_art=<?= $article["ID_ART"] ?>&add_art" ><i class="fas fa-plus"></i></a>
      </td>
    </tr> 
      <?php } ?>
  </tbody>
 </table>
        </section>

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
   