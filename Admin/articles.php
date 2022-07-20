<?php
include 'functions.php';
$page_title = "Articles";




$err = new ArrayObject();
$desi_art = "";
$desc_art = "";
$photo_art = "";
$prix_gros = "";
$prix_s_gros = "";
$prix_detail = "";
if (isset($_POST["submit"])) {

    $desi_art = traiter_input($_POST["desi_art"]);
    $desc_art = traiter_input($_POST["desc_art"]);
    $prix_gros = traiter_input($_POST["prix_gros"]);
    $prix_s_gros = traiter_input($_POST["prix_s_gros"]);
    $prix_detail = traiter_input($_POST["prix_detail"]);


    if (empty($desi_art)) {
        $err['desi_art'] = "Champs obligatoire!!!";
    } elseif (strlen($desi_art) > 100) {
        $err['desi_art'] = "Trop long!!!";
    }

    if (empty($desc_art)) {
        
    } elseif (strlen($desc_art) > 100) {
        $err['desc_art'] = "Trop long!!!";
    }

    if (empty($prix_gros)) {
        
    } elseif (strlen($prix_gros) > 11) {
        $err['prix_gros'] = "Trop long!!!";
    } elseif (!is_numeric($prix_gros)) {
        $err['prix_gros'] = "Seuls les numéros sont autorisés!!!";
    }

    if (empty($prix_s_gros)) {
        
    } elseif (strlen($prix_s_gros) > 11) {
        $err['prix_s_gros'] = "Trop long!!!";
    } elseif (!is_numeric($prix_s_gros)) {
        $err['prix_s_gros'] = "Seuls les numéros sont autorisés!!!";
    }
    if (empty($prix_detail)) {
        
    } elseif (strlen($prix_detail) > 11) {
        $err['prix_detail'] = "Trop long!!!";
    } elseif (!is_numeric($prix_detail)) {
        $err['prix_detail'] = "Seuls les numéros sont autorisés!!!";
    }

    if (count($err) == 0)
        $photo_art=uploadDoc("photo_art",$err);
    //$photo_art=uploadDoc("photo_art",$err,10, ["pdf"]);
    
    if (count($err) == 0) {
        $stat = "INSERT INTO `articles` (`DESI_ART`, `DESC_ART`, `PHOTO_ART`, `DATE_AJOUT`, `DATE_APDAT`, `PRIX_GROS`, `PRIX_SGROS`, `PRIX_DETAIL`) "
                . "VALUES ('$desi_art', '$desc_art', '$photo_art', '$DATE_AJOUT', '$DATE_UPDAT', '$prix_gros', '$prix_s_gros', '$prix_detail')";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?new_art=$desi_art");
    }
}








$err_update = new ArrayObject();
$desi_art_update = "";
$desc_art_update = "";
$photo_art_update = "";
$prix_gros_update = "";
$prix_s_gros_update = "";
$prix_detail_update = "";
if (isset($_GET["id_art"]) && isset($_GET["update"])) {
    $id_art = $_GET["id_art"];
    $rows = getFromDataBase("SELECT * FROM articles WHERE ID_ART='$id_art'");
    if (count($rows) == 1) {
        $row = $rows[0];
        $id_art_update = $row["ID_ART"];
        $desi_art_update = $row["DESI_ART"];
        $desc_art_update = $row["DESC_ART"];
        $photo_art_update = $row["PHOTO_ART"];
        $prix_gros_update = $row["PRIX_GROS"];
        $prix_s_gros_update = $row["PRIX_SGROS"];
        $prix_detail_update = $row["PRIX_DETAIL"];
    }
}



if (isset($_POST["submit_update"])) {
    $id_art_update = traiter_input($_POST["id_art_update"]);
    $desi_art_update = traiter_input($_POST["desi_art_update"]);
    $desc_art_update = traiter_input($_POST["desc_art_update"]);
    $prix_gros_update = traiter_input($_POST["prix_gros_update"]);
    $prix_s_gros_update = traiter_input($_POST["prix_s_gros_update"]);
    $prix_detail_update = traiter_input($_POST["prix_detail_update"]);

    if (empty($desi_art_update)) {
        $err_update['desi_art_update'] = "Champs obligatoire!!!";
    } elseif (strlen($desi_art_update) > 100) {
        $err_update['desi_art_update'] = "Trop long!!!";
    }

    if (empty($desc_art_update)) {
        
    } elseif (strlen($desc_art_update) > 100) {
        $err_update['desc_art_update'] = "Trop long!!!";
    }

    if (empty($prix_gros_update)) {
        
    } elseif (strlen($prix_gros_update) > 11) {
        $err_update['prix_gros_update'] = "Trop long!!!";
    } elseif (!is_numeric($prix_gros_update)) {
        $err_update['prix_gros_update'] = "Seuls les numéros sont autorisés!!!";
    }

    if (empty($prix_s_gros_update)) {
        
    } elseif (strlen($prix_s_gros_update) > 11) {
        $err_update_update['prix_s_gros_update'] = "Trop long!!!";
    } elseif (!is_numeric($prix_s_gros_update)) {
        $err_update['prix_s_gros_update'] = "Seuls les numéros sont autorisés!!!";
    }
    if (empty($prix_detail_update)) {
        
    } elseif (strlen($prix_detail_update) > 11) {
        $err_update['prix_detail_update'] = "Trop long!!!";
    } elseif (!is_numeric($prix_detail_update)) {
        $err_update['prix_detail_update'] = "Seuls les numéros sont autorisés!!!";
    }

    if (count($err_update) == 0)
        $photo_art_update=uploadDoc("photo_art_update",$err_update);
    
    if($photo_art_update=='')
        $photo_art_update= getFromDataBase("SELECT * FROM articles WHERE ID_ART='$id_art_update';")[0]["PHOTO_ART"];
    
    if (count($err_update) == 0) {
        $stat = "UPDATE `articles` SET `DESI_ART` = '$desi_art_update', `DESC_ART` = '$desc_art_update', `PHOTO_ART` = '$photo_art_update', "
                . "`DATE_APDAT` = '$DATE_UPDAT', `PRIX_GROS` = '$prix_gros_update', `PRIX_SGROS` = '$prix_s_gros_update', "
                . "`PRIX_DETAIL` = '$prix_detail_update' WHERE `articles`.`ID_ART` = '$id_art_update'";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?update_cl=$nom_cl_update");
    }
}
if (isset($_POST["search_btn"])) {
    $str = $_POST["search_info"];
    $rows = getFromDataBase("SELECT * FROM articles WHERE ID_ART='$str' OR DESI_ART LIKE '%$str%';");
} else
    $rows = getFromDataBase("SELECT * FROM articles;");


if (isset($_GET["id_art"]) && isset($_GET["delete"])) {
    $id_art = $_GET["id_art"];
    $rows = setInDataBase("DELETE FROM articles WHERE ID_ART='$id_art';");
    
    if($delete_succes)  header("Location: " . $_SERVER["PHP_SELF"] . "?delete_art=$id_art");
    else                header("Location: " . $_SERVER["PHP_SELF"] . "?nodelete_art=$id_art");
}


include 'header.php';
//pre_r($_FILES);
//echo json_encode($rows);
?>

<section class="container-fluid"><bR>    <!-- Button trigger modal -->
<?php if (isset($_GET["new_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client <b><?= $_GET["new_art"] ?></b> est ajoute avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php } ?>
<?php if (isset($_GET["update_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client <b><?= $_GET["update_art"] ?></b> est modifié avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php } ?>
<?php if (isset($_GET["delete_art"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client dont ID est <b><?= $_GET["delete_art"] ?></b> est supprimé avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php } ?>
<?php if (isset($_GET["nodelete_art"])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client dont ID est <b><?= $_GET["nodelete_art"] ?></b> n'est pas supprimé avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php } ?>
    <button type="button" class="btn btn-primary" id="addClientBTN" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Ajouter un article
    </button><br><br> 
    <form id="form_ajouter_client" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="row">  
            <div class="row offset-4 col-sm-4"> 
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" placeholder="ID, Nom de l'article" aria-label="ID, Nom, email ou téléphone" name="search_info" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-success" name="search_btn" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <h1 class="text-center">ARTICLES</h1>
    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">DESI</th>
                <th scope="col">PHOTO</th>
                <th scope="col">PRIX G</th>
                <th scope="col">PRIX SG</th>
                <th scope="col">PRIX DETAIL</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($rows as $row) { ?>
                <tr>
                    <td scope="row"><?= $row["ID_ART"] ?></td>
                    <td scope="row"><?= $row["DESI_ART"] ?></td>
                    <td scope="row"><img onclick="showModal(this)" src="<?= $row["PHOTO_ART"]==""?"../images/resourcesdef.png":$row["PHOTO_ART"] ?>" alt="<?= $row["DESI_ART"] ?>" style="max-height: 60px;"></td>
                    <td scope="row"><?= $row["PRIX_GROS"] ?></td>
                    <td scope="row"><?= $row["PRIX_SGROS"] ?></td>
                    <td scope="row"><?= $row["PRIX_DETAIL"] ?></td>
                    <td>
                        <a  class="btn btn-warning text-white" href="?id_art=<?= $row["ID_ART"] ?>&update" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal3" class="btn btn-danger" data-id_art='<?= $row["ID_ART"] ?>' onclick="deleteClient(this);"><i class="fas fa-trash"></i></button>

                    </td>
                </tr> 
<?php } ?>
        </tbody>
    </table> 


</section>

<button style="display: none;" type="button" class="btn btn-warning text-white" id="updateClientBTN" data-bs-toggle="modal" data-bs-target="#exampleModal2" ></button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_ajouter_article" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err['desi_art'])) echo"is-invalid"; ?>" id="desi_art" name="desi_art" value="<?php echo $desi_art; ?>" required>
                        <label for="desi_art">Designation</label> 
                        <span class="text-danger"><?php if (isset($err['desi_art'])) echo $err['desi_art']; ?></span>                          
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err['desc_art'])) echo"is-invalid"; ?>" id="desc_art" name="desc_art" value="<?php echo $desc_art; ?>" >
                        <label for="desc_art">Description</label> 
                        <span class="text-danger"><?php if (isset($err['desc_art'])) echo $err['desc_art']; ?></span>                          
                    </div>
                    <div class="mb-3">
                        <label for="photo_art" class="form-label">Choisir une image</label>
                        <input class="form-control" type="file" id="photo_art" name="photo_art" value="<?php echo $photo_art; ?>" >
                        <span class="text-danger"><?php if (isset($err['photo_art'])) echo $err['photo_art']; ?></span> 
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err['prix_gros'])) echo"is-invalid"; ?>" id="prix_gros" name="prix_gros" value="<?php echo $prix_gros; ?>" >
                        <label for="prix_gros">Prix de gros</label> 
                        <span class="text-danger"><?php if (isset($err['prix_gros'])) echo $err['prix_gros']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err['prix_s_gros'])) echo"is-invalid"; ?>" id="prix_s_gros" name="prix_s_gros" value="<?php echo $prix_s_gros; ?>" >
                        <label for="prix_s_gros">Prix semi gros</label> 
                        <span class="text-danger"><?php if (isset($err['prix_s_gros'])) echo $err['prix_s_gros']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err['prix_detail'])) echo"is-invalid"; ?>" id="prix_detail" name="prix_detail" value="<?php echo $prix_detail; ?>" >
                        <label for="prix_detail">Prix detail</label> 
                        <span class="text-danger"><?php if (isset($err['prix_detail'])) echo $err['prix_detail']; ?></span>                          
                    </div>




                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm('form_ajouter_article')">Effacer</button>
                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_article" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Modifier un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3" >
                        <strong>ID: </strong><?php echo $id_art_update; ?>
                    </div>
                    <div class="form-floating mb-3" style="display: none;">
                        <input type="text" class="form-control" id="id_art_update" name="id_art_update" style="" value="<?php echo $id_art_update; ?>" required>           

                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err_update['desi_art_update'])) echo"is-invalid"; ?>" id="desi_art_update" name="desi_art_update" value="<?php echo $desi_art_update; ?>" required>
                        <label for="desi_art_update">Designation </label> 
                        <span class="text-danger"><?php if (isset($err_update['desi_art_update'])) echo $err_update['desi_art_update']; ?></span>                          
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err_update['desc_art_update'])) echo"is-invalid"; ?>" id="desc_art_update" name="desc_art_update" value="<?php echo $desc_art_update; ?>" >
                        <label for="desc_art_update">Description </label> 
                        <span class="text-danger"><?php if (isset($err_update['desc_art_update'])) echo $err_update['desc_art_update']; ?></span>                          
                    </div>
                    <div class="mb-3">
                        <label for="photo_art_update" class="form-label">Choisir une image</label>
                        <input class="form-control" type="file" id="photo_art_update" name="photo_art_update" value="<?php echo $photo_art_update; ?>" >
                        <span class="text-danger"><?php if (isset($err_update['photo_art_update'])) echo $err_update['photo_art_update']; ?></span> 
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err_update['prix_gros_update'])) echo"is-invalid"; ?>" id="prix_gros_update" name="prix_gros_update" value="<?php echo $prix_gros_update; ?>" >
                        <label for="prix_gros_update">Prix de gros</label> 
                        <span class="text-danger"><?php if (isset($err_update['prix_gros_update'])) echo $err_update['prix_gros_update']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err_update['prix_s_gros_update'])) echo"is-invalid"; ?>" id="prix_s_gros_update" name="prix_s_gros_update" value="<?php echo $prix_s_gros_update; ?>" >
                        <label for="prix_s_gros_update">Prix semi gros</label> 
                        <span class="text-danger"><?php if (isset($err_update['prix_s_gros_update'])) echo $err_update['prix_s_gros_update']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control <?php if (isset($err_update['prix_detail_update'])) echo"is-invalid"; ?>" id="prix_detail_update" name="prix_detail_update" value="<?php echo $prix_detail_update; ?>" >
                        <label for="prix_detail">Prix detail</label> 
                        <span class="text-danger"><?php if (isset($err_update['prix_detail_update'])) echo $err_update['prix_detail_update']; ?></span>                          
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="submit_update" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal 2 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Supprimer un article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer l'article dont ID est <b><span id="supp_id_art"></span></b>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NON</button>
                <a href="" id="supp_id_client_oui"  class="btn btn-primary">OUI</a>
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
//pre_r($_POST);
include 'footer.php';
?>  
<script>
<?php if (count($err) != 0) { ?>
        $("#form_ajouter_article").addClass("show");
        $("#addClientBTN").click();
<?php } ?>
<?php if (count($err_update) != 0 || isset($_GET["update"])) { ?>
        $("#updateClientBTN").click();
<?php } ?>

    function deleteClient(b) {
        $("#supp_id_art").html(b.dataset.id_art);
        $("#supp_id_client_oui").attr("href", "?id_art=" + b.dataset.id_art + "&delete");
    }
</script>