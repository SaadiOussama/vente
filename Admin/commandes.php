<?php
include 'functions.php';
//setInDataBase("ALTER TABLE `commandes` CHANGE `DATE_APDAT` `DATE_UPDAT` DATETIME NOT NULL;");
$page_title = "Commandes";
$rows_clients = getFromDataBase("SELECT * FROM clients;");
$err = [];
$id_cl = "";
$desc_com = "";
$etat_com = "";
$date_com = "";
$date_livr = "";
$lieu_livr = "";

$mesg = "";
if (isset($_POST["submit"])) {

    $id_cl = traiter_input($_POST["id_cl"]);
    $desc_com = traiter_input($_POST["desc_com"]);
    $etat_com = traiter_input($_POST["etat_com"]);
    $date_com = traiter_input($_POST["date_com"]);
    $date_livr = traiter_input($_POST["date_livr"]);
    $lieu_livr = traiter_input($_POST["lieu_livr"]);


    if (empty($id_cl)) {
        $err['id_cl'] = "Champs obligatoire!!!";
    } elseif (strlen($id_cl) > 11) {
        $err['id_cl'] = "Trop long!!!";
    } elseif (!preg_match("/^[0-9]+$/", $id_cl)) {
        $err['id_cl'] = "Seuls les numéros sont autorisés!!!";
    }

    if (empty($desc_com)) {
        
    } elseif (strlen($desc_com) > 200) {
        $err['desc_com'] = "Trop long!!!!!!";
    }


    if (empty($etat_com)) {
        $err['etat_com'] = "Champs obligatoire!!!";
    } elseif (strlen($etat_com) > 50) {
        $err['etat_com'] = "Trop long!!!";
    } elseif (!preg_match("/^(livr)|(non_livr)|(annul)$/", $etat_com)) {
        $err['etat_com'] = "Champ invalid!!!";
    }


    if (empty($date_com)) {
        $err["date_com"] = "Champ obligatoire !!!";
    } elseif (!preg_match("/^[0-9]{4}(\-|\/)[0-9]{2}(\-|\/)[0-9]{2}$/", $date_com)) {
        $err["date_com"] = "Veillez saisir la date SVP !!!";
    }

    if (empty($date_livr)) {
        $err["date_livr"] = "Champ obligatoire !!!";
    } elseif (!preg_match("/^[0-9]{4}(\-|\/)[0-9]{2}(\-|\/)[0-9]{2}$/", $date_livr)) {
        $err["date_livr"] = "Veillez saisir la date SVP !!!";
    }

    if (empty($lieu_livr)) {
        $err['lieu_livr'] = "Champs obligatoire!!!";
    } elseif (strlen($lieu_livr) > 200) {
        $err['lieu_livr'] = "Trop long!!!!!!";
    }
    if (count($err) == 0) {
        $stat = "INSERT INTO `commandes` ( `ID_CL`, `DESC_COM`, `ETAT_COM`, `DATE_COM`, `DATE_LIVR`, `LIEU_LIVR`, `DATE_AJOUT`, `DATE_UPDAT`)"
                . " VALUES ( '$id_cl', '$desc_com', '$etat_com', '$date_com', '$date_livr', '$lieu_livr', '$DATE_AJOUT', '$DATE_UPDAT')";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?id_cl=$id_cl&new_com");
    }
}








$err_update = [];
$id_cl_update = "";
$desc_com_update = "";
$etat_com_update = "";
$date_com_update = "";
$date_livr_update = "";
$lieu_livr_update = "";
if (isset($_GET["id_com"]) && isset($_GET["update"])) {
    $id_com = $_GET["id_com"];
    $rows = getFromDataBase("SELECT * FROM commandes WHERE ID_COM='$id_com'");
    if (count($rows) == 1) {
        $row = $rows[0];
        $id_com_update = $row["ID_COM"];
        $id_cl_update = $row["ID_CL"];
        $desc_com_update = $row["DESC_COM"];
        $etat_com_update = $row["ETAT_COM"];
        $date_com_update = $row["DATE_COM"];
        $lieu_livr_update = $row["LIEU_LIVR"];
        $date_livr_update = $row["DATE_LIVR"];
    }
}



if (isset($_POST["submit_update"])) {

    $id_com_update = traiter_input($_POST["id_com_update"]);
    $id_cl_update = traiter_input($_POST["id_cl_update"]);
    $desc_com_update = traiter_input($_POST["desc_com_update"]);
    $etat_com_update = traiter_input($_POST["etat_com_update"]);
    $date_com_update = traiter_input($_POST["date_com_update"]);
    $date_livr_update = traiter_input($_POST["date_livr_update"]);
    $lieu_livr_update = traiter_input($_POST["lieu_livr_update"]);


    if (empty($id_cl_update)) {
        $err['id_cl_update'] = "Champs obligatoire!!!";
    } elseif (strlen($id_cl_update) > 11) {
        $err['id_cl_update'] = "Trop long!!!";
    } elseif (!preg_match("/^[0-9]+$/", $id_cl_update)) {
        $err['id_cl_update'] = "Seuls les numéros sont autorisés!!!";
    }

    if (empty($desc_com_update)) {
        
    } elseif (strlen($desc_com_update) > 200) {
        $err['desc_com'] = "Trop long!!!!!!";
    }


    if (empty($etat_com_update)) {
        $err['etat_com_update'] = "Champs obligatoire!!!";
    } elseif (strlen($etat_com_update) > 50) {
        $err['etat_com_update'] = "Trop long!!!";
    } elseif (!preg_match("/^(livr)|(non_livr)|(annul)$/", $etat_com_update)) {
        $err['etat_com_update'] = "Champ invalid!!!";
    }


    if (empty($date_com_update)) {
        $err["date_com_update"] = "Champ obligatoire !!!";
    } elseif (!preg_match("/^[0-9]{4}(\-|\/)[0-9]{2}(\-|\/)[0-9]{2}$/", $date_com_update)) {
        $err["date_com_update"] = "Veillez saisir la date SVP !!!";
    }

    if (empty($date_livr_update)) {
        $err["date_livr_update"] = "Champ obligatoire !!!";
    } elseif (!preg_match("/^[0-9]{4}(\-|\/)[0-9]{2}(\-|\/)[0-9]{2}$/", $date_livr_update)) {
        $err["date_livr_update"] = "Veillez saisir la date SVP !!!";
    }

    if (empty($lieu_livr_update)) {
        $err['lieu_livr_update'] = "Champs obligatoire!!!";
    } elseif (strlen($lieu_livr_update) > 200) {
        $err['lieu_livr_update'] = "Trop long!!!!!!";
    }
    if (count($err_update) == 0) {
        $stat = "UPDATE `commandes` SET `ID_CL` = '$id_cl_update', `DESC_COM` = '$desc_com_update', `ETAT_COM` = '$etat_com_update', "
                . "`DATE_COM` = '$date_com_update', `DATE_LIVR` = '$date_livr_update', `LIEU_LIVR` = '$lieu_livr_update', "
                . " `DATE_UPDAT` = '$DATE_UPDAT' WHERE `commandes`.`ID_COM` = '$id_com_update'";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?update_com=$id_com_update");
    }
}


if (isset($_POST["search_btn"])) {
    $str = $_POST["search_info"];
    $rows = getFromDataBase("SELECT cm.*, c.NOM_CL, COUNT(ac.ID_ART) N_ART, SUM(ac.PRIX*ac.QTE) HT , "
            . "SUM(ac.QTE) N_PIECES FROM commandes cm  JOIN clients c ON cm.ID_CL=c.ID_CL LEFT JOIN art_com ac"
            . "ON cm.ID_COM=ac.ID_COM WHERE cm.ID_CL='$str' OR c.NOM_CL LIKE '%$str%' OR ETAT_COM LIKE '%$str%'"
            . " OR DATE_COM LIKE '%$str%' OR DATE_LIVR LIKE '%$str%' OR LIEU_LIVR LIKE '%$str%' GROUP BY cm.ID_COM ;");
} else
    $rows = getFromDataBase("SELECT cm.*, c.NOM_CL, COUNT(ac.ID_ART) N_ART, SUM(ac.PRIX*ac.QTE) HT , SUM(ac.QTE) N_PIECES "
            . "FROM commandes cm  JOIN clients c ON cm.ID_CL=c.ID_CL LEFT JOIN art_com ac ON cm.ID_COM=ac.ID_COM GROUP BY cm.ID_COM");


if (isset($_GET["id_com"]) && isset($_GET["delete"])) {
    $id_com = $_GET["id_com"];
    $rows = setInDataBase("DELETE FROM commandes WHERE ID_COM='$id_com';");
    
    if($delete_succes)  header("Location: " . $_SERVER["PHP_SELF"] . "?delete_com=$id_com");
    else                header("Location: " . $_SERVER["PHP_SELF"] . "?nodelete_com=$id_com");
}


include 'header.php';
//pre_r($rows);
//echo json_encode($rows);
?>

<section class="container-fluid"><bR>    <!-- Button trigger modal -->
    <?php if (isset($_GET["new_com"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> La commande est ajoutée au client dont son ID est <b><?= $_GET["id_cl"] ?></b> ajoutée avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["update_com"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> La commande N <b><?= $_GET["update_com"] ?></b> est modifié avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["delete_com"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> La commande N <b><?= $_GET["delete_com"] ?></b> est supprimée avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["nodelete_com"])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> La commande N <b><?= $_GET["nodelete_com"] ?></b> n'est pas supprimée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <button type="button" class="btn btn-primary" id="addComBTN" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Ajouter une commande
    </button>
    <a  class="btn btn-primary" href="<?= $_SERVER['PHP_SELF'] ?>">
       <i class="fas fa-redo" ></i>
    </a><br><br> 
    <form id="form_ajouter_client" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="row">  
            <div class="row offset-4 col-sm-4"> 
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" placeholder="ID, Nom, date ou etat de commande" aria-label="ID, Nom, date ou etat de commande" name="search_info" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-success" name="search_btn" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <h1 class="text-center">COMMANDES</h1>
    <table class="table table-hover table-striped dataTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">CLIENT</th>
                <th scope="col">ETAT COM</th>
                <th scope="col">N ART</th>
                <th scope="col">N PIECES</th>
                <th scope="col">HT</th>
                <th scope="col">DATE COM</th>
                <th scope="col">DATE LIVR</th>
                <th scope="col">LIEU LIVR</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td scope="row"><?= $row["ID_COM"] ?></td>
                    <td scope="row"><?= $row["ID_CL"] ?> - <?= $row["NOM_CL"] ?></td>
                    <td scope="row"><?php                            switch ($row["ETAT_COM"]) {
                                case 'livr': echo '<i class="fas fa-check-circle fa-2x" data-bs-toggle="tooltip"  title="Livrée" style="color:green;"></i>';
                                    break;
                                case 'non_livr': echo '<i class="fas fa-clock fa-2x" data-bs-toggle="tooltip"  title="Non Livrée" style="color:orange;"></i>';
                                    break;
                                case 'annul': echo '<i class="fas fa-times-circle fa-2x" data-bs-toggle="tooltip"  title="Annulée" style="color:red;"></i>';
                                    break;
                                default:
                                    break;
                            }  ?></td>
                    <td scope="row"><?= $row["N_ART"] ?></td>
                    <td scope="row"><?= $row["N_PIECES"]==NULL?0:$row["N_PIECES"] ?></td>
                    <td scope="row"><?= $row["HT"]==NULL?0:$row["HT"] ?></td>
                    <td scope="row"><?= $row["DATE_COM"] ?></td>
                    <td scope="row"><?= $row["DATE_LIVR"] ?></td>
                    <td scope="row"><?= $row["LIEU_LIVR"] ?></td>
                    <td>
                        <a  class="btn btn-warning text-white" href="?id_com=<?= $row["ID_COM"] ?>&update" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal3" 
                                class="btn btn-danger" data-id_com='<?= $row["ID_COM"] ?>' onclick="deleteCommande(this);"><i class="fas fa-trash"></i></button>

                                <a  class="btn btn-primary text-white" href="commande_details.php?id_com=<?= $row["ID_COM"] ?>" >
                            <i class="fas fa-info"></i>
                        </a>

                        <div class="dropdown" style="display: inline-block">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-print"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="print_commande.php?id_com=<?= $row["ID_COM"] ?>" target="_blanck">Bon de livraison</a></li>
                                <li><a class="dropdown-item" href="#">Facture HT</a></li>
                                <li><a class="dropdown-item" href="#">Facture TTC</a></li>
                            </ul>
                        </div>
                    </td>
                </tr> 
            <?php } ?>
        </tbody>
    </table> 


</section>

<button style="display: none;" type="button" class="btn btn-warning text-white" id="updateComBTN" data-bs-toggle="modal" data-bs-target="#exampleModal2" ></button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_ajouter_commande" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <select class="form-select  <?php  if(isset($err['id_cl']))echo"is-invalid"; ?>" id="id_cl" name="id_cl" aria-label="Floating label select example">
                            <option selected>Choisir un client</option>
                            <?php foreach ($rows_clients as $client) { ?>
                                <option value="<?= $client["ID_CL"] ?>" <?= $id_cl == $client["ID_CL"] ? "selected" : "" ?>>
                                    <?= $client["ID_CL"] ?> - <?= $client["NOM_CL"] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="id_cl">CLIENT</label>
                        <span class="text-danger"><?php if (isset($err['id_cl'])) echo $err['id_cl']; ?></span>  
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            Etat de commmande
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com" id="etat_com2" 
                                       value="non_livr" <?= ($etat_com == "non_livr" || $etat_com == "") ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com2">Non Livrée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com" id="etat_com1" 
                                       value="livr" <?= $etat_com == "livr" ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com1">Livrée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com" id="etat_com3" 
                                       value="annul" <?= $etat_com == "annul" ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com3">Annulée</label>
                            </div>                            
                            <span class="text-danger"><?php if (isset($err['etat_com'])) echo $err['etat_com']; ?></span>
                        </div>
                    </div>




                    <div class="form-floating mb-3">
                        <input type="date" class="form-control <?php  if(isset($err['date_com']))echo"is-invalid"; ?>" id="date_com" name="date_com" value="<?php echo $date_com; ?>" required>
                        <label for="date_com">Date de commande</label> 
                        <span class="text-danger"><?php if (isset($err['date_com'])) echo $err['date_com']; ?></span>                          
                    </div>


                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date_livr" name="date_livr" value="<?php echo $date_livr; ?>" required>
                        <label for="date_livr">Date de livraison</label> 
                        <span class="text-danger"><?php if (isset($err['date_livr'])) echo $err['date_livr']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lieu_livr" name="lieu_livr" value="<?php echo $lieu_livr; ?>" required>
                        <label for="lieu_livr">Lieu de livraison</label> 
                        <span class="text-danger"><?php if (isset($err['lieu_livr'])) echo $err['lieu_livr']; ?></span>                          
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control"  id="desc_com" name="desc_com" style="height: 100px"><?php echo $desc_com; ?></textarea>
                        <label for="desc_com">Descreption</label>
                        <span class="text-danger"><?php if (isset($err['desc_com'])) echo $err['desc_com']; ?></span>                          
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm('form_ajouter_commande')">Effacer</button>
                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_commande" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Modifier une commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3" >
                        <strong>ID: </strong><?php echo $id_com_update; ?>
                    </div>
                    <div class="form-floating mb-3" style="display: none;">
                        <input type="text" class="form-control" id="id_com_update" name="id_com_update" style="" value="<?php echo $id_com_update; ?>" required>           
                        <label for="nom_com_update">ID</label> 
                        <span class="text-danger"><?php if (isset($err_update['id_com_update'])) echo $err_update['id_com_update']; ?></span>                          
                    </div>

                    <div class="form-floating">
                        <select class="form-select" id="id_cl_update" name="id_cl_update" aria-label="Floating label select example">
                            <option selected>Choisir un client</option>
                            <?php foreach ($rows_clients as $client) { ?>
                                <option value="<?= $client["ID_CL"] ?>" <?= $id_cl_update == $client["ID_CL"] ? "selected" : "" ?>>
                                    <?= $client["ID_CL"] ?> - <?= $client["NOM_CL"] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="id_cl_update">CLIENT</label>
                        <span class="text-danger"><?php if (isset($err_update['id_cl_update'])) echo $err_update['id_cl_update']; ?></span>  
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            Etat de commmande
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com_update" id="etat_com2_update" 
                                       value="non_livr" <?= ($etat_com_update == "non_livr" || $etat_com_update == "") ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com2_update">Non Livrée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com_update" id="etat_com1_update" 
                                       value="livr" <?= $etat_com_update == "livr" ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com1_update">Livrée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat_com_update" id="etat_com3_update" 
                                       value="annul" <?= $etat_com_update == "annul" ? "checked" : "" ?> >
                                <label class="form-check-label" for="etat_com3_update">Annulée</label>
                            </div>                            
                            <span class="text-danger"><?php if (isset($err_update['etat_com_update'])) echo $err_update['etat_com_update']; ?></span>
                        </div>
                    </div>




                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date_com_update" name="date_com_update"
                               value="<?php echo $date_com_update; ?>" required>
                        <label for="date_com_update">Date de commande</label> 
                        <span class="text-danger"><?php if (isset($err_update['date_com_update'])) echo $err_update['date_com_update']; ?></span>                          
                    </div>


                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date_livr_update" name="date_livr_update" 
                               value="<?php echo $date_livr_update; ?>" required>
                        <label for="date_livr_update">Date de livraison</label> 
                        <span class="text-danger"><?php if (isset($err_update['date_livr_update'])) echo $err_update['date_livr_update']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lieu_livr_update" name="lieu_livr_update" value="<?php echo $lieu_livr_update; ?>" required>
                        <label for="lieu_livr_update">Lieu de livraison</label> 
                        <span class="text-danger"><?php if (isset($err_update['lieu_livr_update'])) echo $err_update['lieu_livr_update']; ?></span>                          
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control"  id="desc_com_update" name="desc_com_update" style="height: 100px"><?php echo $desc_com_update; ?></textarea>
                        <label for="desc_com_update">Descreption</label>
                        <span class="text-danger"><?php if (isset($err_update['desc_com_update'])) echo $err_update['desc_com_update']; ?></span>                          
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
                <h5 class="modal-title" id="exampleModalLabel2">Supprimer un client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer la commande dont ID est <b><span id="supp_id_com"></span></b>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NON</button>
                <a href="" id="supp_id_com_oui"  class="btn btn-primary">OUI</a>
            </div>
        </div>
    </div>
</div>
<?php
//pre_r($_POST);
include 'footer.php';
?>  
<script>
<?php if (count($err) != 0) { ?>
        $("#form_ajouter_commande").addClass("show");
        $("#addComBTN").click();
<?php } ?>
<?php if (count($err_update) != 0 || isset($_GET["update"])) { ?>
        $("#updateComBTN").click();
<?php } ?>

    function deleteCommande(b) {
        $("#supp_id_com").html(b.dataset.id_com);
        $("#supp_id_com_oui").attr("href", "?id_com=" + b.dataset.id_com + "&delete");
    }
</script>