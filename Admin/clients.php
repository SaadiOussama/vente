<?php
include 'functions.php';
$page_title = "Clients";
$err = [];
$nom_cl = "";
$adr_cl = "";
$tel_cl = "";
$tel_cl2 = "";
$tel_cl3 = "";
$email_cl = "";
$desc_cl = "";

$mesg = "";
if (isset($_POST["submit"])) {

    $nom_cl = traiter_input($_POST["nom_cl"]);
    $adr_cl = traiter_input($_POST["adr_cl"]);
    $tel_cl = traiter_input($_POST["tel_cl"]);
    $tel_cl2 = traiter_input($_POST["tel_cl2"]);
    $tel_cl3 = traiter_input($_POST["tel_cl3"]);
    $email_cl = traiter_input($_POST["email_cl"]);
    $desc_cl = traiter_input($_POST["desc_cl"]);


    if (empty($nom_cl)) {
        $err['nom_cl'] = "Champs obligatoire!!!";
    } elseif (strlen($nom_cl) > 100) {
        $err['nom_cl'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nom_cl)) {
        $err['nom_cl'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }


    if (empty($tel_cl)) {
        $err['tel_cl'] = "Champs obligatoire!!!";
    } elseif (strlen($tel_cl) > 20) {
        $err['tel_cl'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl)) {
        $err['tel_cl'] = "Numero invalid!!!";
    }

    if (empty($tel_cl2)) {
        
    } elseif (strlen($tel_cl2) > 20) {
        $err['tel_cl2'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl2)) {
        $err['tel_cl2'] = "Numero invalid!!!";
    }

    if (empty($tel_cl3)) {
        
    } elseif (strlen($tel_cl3) > 20) {
        $err['tel_cl3'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl3)) {
        $err['tel_cl3'] = "Numero invalid!!!";
    }

    if (empty($email_cl)) {
        $err['email_cl'] = "Champs obligatoire!!!";
    } elseif (strlen($email_cl) > 100) {
        $err['email_cl'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^[a-zA-Z0-9\-_.]+@[a-zA-Z0-9\-_]+\.[a-zA-Z]+$/", $email_cl)) {
        $err['email_cl'] = "Numero invalid!!!";
    }

    if (empty($adr_cl)) {
        $err['adr_cl'] = "Champs obligatoire!!!";
    } elseif (strlen($adr_cl) > 200) {
        $err['adr_cl'] = "Trop long!!!!!!";
    }

    if (empty($desc_cl)) {
        
    } elseif (strlen($desc_cl) > 200) {
        $err['desc_cl'] = "Trop long!!!!!!";
    }

    if (count($err) == 0) {
        $stat = "INSERT INTO clients (NOM_CL, ADRESSE_CL, TEL1, TEL2, TEL3, EMAIL, DESC_CL, DATE_AJOUT, DATE_UPDAT)"
                . "VALUES ('$nom_cl', '$adr_cl', '$tel_cl', '$tel_cl2', '$tel_cl3', '$email_cl', '$desc_cl', '$DATE_AJOUT', '$DATE_UPDAT')";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?new_cl=$nom_cl");
    }
}








$err_update = [];
$id_cl_update = "";
$nom_cl_update = "";
$adr_cl_update = "";
$tel_cl_update = "";
$tel_cl2_update = "";
$tel_cl3_update = "";
$email_cl_update = "";
$desc_cl_update = "";
if (isset($_GET["id_cl"]) && isset($_GET["update"])) {
    $id_cl = $_GET["id_cl"];
    $rows = getFromDataBase("SELECT * FROM clients WHERE ID_CL='$id_cl'");
    if (count($rows) == 1) {
        $row = $rows[0];
        $id_cl_update = $row["ID_CL"];
        $nom_cl_update = $row["NOM_CL"];
        $adr_cl_update = $row["ADRESSE_CL"];
        $tel_cl_update = $row["TEL1"];
        $tel_cl2_update = $row["TEL2"];
        $tel_cl3_update = $row["TEL3"];
        $email_cl_update = $row["EMAIL"];
        $desc_cl_update = $row["DESC_CL"];
    }
}



if (isset($_POST["submit_update"])) {

    $id_cl_update = traiter_input($_POST["id_cl_update"]);
    $nom_cl_update = traiter_input($_POST["nom_cl_update"]);
    $adr_cl_update = traiter_input($_POST["adr_cl_update"]);
    $tel_cl_update = traiter_input($_POST["tel_cl_update"]);
    $tel_cl2_update = traiter_input($_POST["tel_cl2_update"]);
    $tel_cl3_update = traiter_input($_POST["tel_cl3_update"]);
    $email_cl_update = traiter_input($_POST["email_cl_update"]);
    $desc_cl_update = traiter_input($_POST["desc_cl_update"]);


    if (empty($nom_cl_update)) {
        $err_update['nom_cl_update'] = "Champs obligatoire!!!";
    } elseif (strlen($nom_cl_update) > 100) {
        $err_update['nom_cl_update'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nom_cl_update)) {
        $err['nom_cl_update'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }


    if (empty($tel_cl_update)) {
        $err_update['tel_cl_update'] = "Champs obligatoire!!!";
    } elseif (strlen($tel_cl_update) > 20) {
        $err_update['tel_cl_update'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl_update)) {
        $err_update['tel_cl_update'] = "Numero invalid!!!";
    }

    if (empty($tel_cl2_update)) {
        
    } elseif (strlen($tel_cl2_update) > 20) {
        $err_update['tel_cl2_update'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl2_update)) {
        $err_update['tel_cl2_update'] = "Numero invalid!!!";
    }

    if (empty($tel_cl3_update)) {
        
    } elseif (strlen($tel_cl3_update) > 20) {
        $err_update['tel_cl3_update'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^((0|\+213|00213)((5|6|7)[0-9]{8})|[0-9]{8})$/", $tel_cl3_update)) {
        $err_update['tel_cl3_update'] = "Numero invalid!!!";
    }

    if (empty($email_cl_update)) {
        $err_update['email_cl_update'] = "Champs obligatoire!!!";
    } elseif (strlen($email_cl_update) > 100) {
        $err_update['email_cl_update'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^[a-zA-Z0-9\-_.]+@[a-zA-Z0-9\-_]+\.[a-zA-Z]+$/", $email_cl_update)) {
        $err_update['email_cl_update'] = "Numero invalid!!!";
    }

    if (empty($adr_cl_update)) {
        $err_update['adr_cl_update'] = "Champs obligatoire!!!";
    } elseif (strlen($adr_cl_update) > 200) {
        $err_update['adr_cl_update'] = "Trop long!!!!!!";
    }

    if (empty($desc_cl_update)) {
        
    } elseif (strlen($desc_cl_update) > 200) {
        $err_update['desc_cl_update'] = "Trop long!!!!!!";
    }

    if (count($err_update) == 0) {
        $stat = "UPDATE `clients` SET `NOM_CL` = '$nom_cl_update', `ADRESSE_CL` = '$adr_cl_update', `TEL1` = '$tel_cl_update', "
                . "`TEL2` = '$tel_cl2_update', `TEL3` = '$tel_cl3_update', `EMAIL` = '$email_cl_update', `DESC_CL` = '$desc_cl_update' ,"
                . " `DATE_UPDAT` = '$DATE_UPDAT'  WHERE `ID_CL` = $id_cl_update ";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?update_cl=$nom_cl_update");
    }
}
if (isset($_POST["search_btn"])){
    $str=$_POST["search_info"];
    $rows = getFromDataBase("SELECT c.*, COUNT(cm.ID_COM) QTE_COM FROM clients c LEFT JOIN commandes cm ON c.ID_CL=cm.ID_CL WHERE c.ID_CL='$str' OR NOM_CL LIKE '%$str%' OR EMAIL LIKE '%$str%'"
            . " OR TEL1 LIKE '%$str%' OR TEL2 LIKE '%$str%' OR TEL3 LIKE '%$str%' OR ADRESSE_CL LIKE '%$str%'GROUP BY c.ID_CL;");
}else
    $rows = getFromDataBase("SELECT c.*, COUNT(cm.ID_COM) QTE_COM FROM clients c LEFT JOIN commandes cm ON c.ID_CL=cm.ID_CL GROUP BY c.ID_CL;");


if (isset($_GET["id_cl"]) && isset($_GET["delete"])) {
    $id_cl = $_GET["id_cl"];
    $rows = setInDataBase("DELETE FROM clients WHERE ID_CL='$id_cl';");
        
    if($delete_succes)  header("Location: " . $_SERVER["PHP_SELF"] . "?delete_cl=$id_cl");
    else                header("Location: " . $_SERVER["PHP_SELF"] . "?nodelete_cl=$id_cl");
}


include 'header.php';
//pre_r($rows);
//echo json_encode($rows);
?>

<section class="container-fluid"><bR>    <!-- Button trigger modal -->
    <?php if (isset($_GET["new_cl"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client <b><?= $_GET["new_cl"] ?></b> est ajoute avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["update_cl"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client <b><?= $_GET["update_cl"] ?></b> est modifié avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["delete_cl"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client dont ID est <b><?= $_GET["delete_cl"] ?></b> est supprimé avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["nodelete_cl"])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Le client dont ID est <b><?= $_GET["nodelete_cl"] ?></b> n'est pas supprimé avec succee.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <button type="button" class="btn btn-primary" id="addClientBTN" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Ajouter un client
    </button><br><br> 
    <form id="form_ajouter_client" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="row">  
            <div class="row offset-4 col-sm-4"> 
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" placeholder="ID, Nom, email, téléphone ou adresse" aria-label="ID, Nom, email ou téléphone" name="search_info" aria-describedby="button-addon2">
                    <button type="submit" class="btn btn-outline-success" name="search_btn" id="button-addon2"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <p><?= $mesg ?></p>
    <h1 class="text-center">CLIENTS</h1>
    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOM</th>
                <th scope="col">ADRESSE</th>
                <th scope="col">TEL1</th>
                <th scope="col">TEL2</th>
                <th scope="col">TEL3</th>
                <th scope="col">EMAIL</th>
                <th scope="col">QTE_COM</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td scope="row"><?= $row["ID_CL"] ?></td>
                    <td scope="row"><?= $row["NOM_CL"] ?></td>
                    <td scope="row"><?= $row["ADRESSE_CL"] ?></td>
                    <td scope="row"><?= $row["TEL1"] ?></td>
                    <td scope="row"><?= $row["TEL2"] ?></td>
                    <td scope="row"><?= $row["TEL3"] ?></td>
                    <td scope="row"><?= $row["EMAIL"] ?></td>
                    <td scope="row"><?= $row["QTE_COM"] ?></td>
                    <td>
                        <a  class="btn btn-warning text-white" href="?id_cl=<?= $row["ID_CL"] ?>&update" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal3" class="btn btn-danger" data-id_cl='<?= $row["ID_CL"] ?>' onclick="deleteClient(this);"><i class="fas fa-trash"></i></button>
                        
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
        <form id="form_ajouter_client" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php  if(isset($err['nom_cl']))echo"is-invalid"; ?>" id="nom_cl" name="nom_cl" value="<?php echo $nom_cl; ?>" required>
                        <label for="nom_cl">Nom complet</label> 
                        <span class="text-danger"><?php if (isset($err['nom_cl'])) echo $err['nom_cl']; ?></span>                          
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="adr_cl" name="adr_cl" value="<?php echo $adr_cl; ?>"  required>
                        <label for="adr_cl">Adresse</label> 
                        <span class="text-danger"><?php if (isset($err['adr_cl'])) echo $err['adr_cl']; ?></span>                          
                    </div>

                    <div class="row g-2">
                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control <?php  if(isset($err['tel_cl']))echo"is-invalid"; ?>" id="tel_cl" name="tel_cl" value="<?php echo $tel_cl; ?>"  required>
                            <label for="tel_cl">Téléphone 1</label> 
                            <span class="text-danger"><?php if (isset($err['tel_cl'])) echo $err['tel_cl']; ?></span>                          
                        </div>



                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control" id="tel_cl2" name="tel_cl2" value="<?php echo $tel_cl2; ?>"  >
                            <label for="tel_cl2">Téléphone 2</label> 
                            <span class="text-danger"><?php if (isset($err['tel_cl2'])) echo $err['tel_cl2']; ?></span>                          
                        </div>




                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control" id="tel_cl3" name="tel_cl3" value="<?php echo $tel_cl3; ?>"  >
                            <label for="tel_cl3">Téléphone 3</label> 
                            <span class="text-danger"><?php if (isset($err['tel_cl3'])) echo $err['tel_cl3']; ?></span>                          
                        </div>

                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_cl" name="email_cl" value="<?php echo $email_cl; ?>"  required>
                        <label for="email_cl">Email</label> 
                        <span class="text-danger"><?php if (isset($err['email_cl'])) echo $err['email_cl']; ?></span>                          
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control"  id="desc_cl" name="desc_cl" style="height: 100px"><?php echo $desc_cl; ?></textarea>
                        <label for="desc_cl">Descreption</label>
                        <span class="text-danger"><?php if (isset($err['desc_cl'])) echo $err['desc_cl']; ?></span>                          
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm('form_ajouter_client')">Effacer</button>
                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_update_client" class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Modifier un client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3" >
                        <strong>ID: </strong><?php echo $id_cl_update; ?>
                    </div>
                    <div class="form-floating mb-3" style="display: none;">
                        <input type="text" class="form-control" id="id_cl_update" name="id_cl_update" style="" value="<?php echo $id_cl_update; ?>" required>           
                        <label for="nom_cl_update">ID</label> 
                        <span class="text-danger"><?php if (isset($err_update['id_cl_update'])) echo $err_update['id_cl_update']; ?></span>                          
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nom_cl_update" name="nom_cl_update" value="<?php echo $nom_cl_update; ?>" required>
                        <label for="nom_cl_update">Nom complet</label> 
                        <span class="text-danger"><?php if (isset($err_update['nom_cl_update'])) echo $err_update['nom_cl_update']; ?></span>                          
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="adr_cl_update" name="adr_cl_update" value="<?php echo $adr_cl_update; ?>"  required>
                        <label for="adr_cl_update">Adresse</label> 
                        <span class="text-danger"><?php if (isset($err_update['adr_cl_update'])) echo $err_update['adr_cl_update']; ?></span>                          
                    </div>

                    <div class="row g-2">
                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control" id="tel_cl_update" name="tel_cl_update" value="<?php echo $tel_cl_update; ?>"  required>
                            <label for="tel_cl_update">Téléphone 1</label> 
                            <span class="text-danger"><?php if (isset($err_update['tel_cl_update'])) echo $err_update['tel_cl_update']; ?></span>                          
                        </div>



                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control" id="tel_cl2_update" name="tel_cl2_update" value="<?php echo $tel_cl2_update; ?>"  >
                            <label for="tel_cl2_update">Téléphone 2</label> 
                            <span class="text-danger"><?php if (isset($err_update['tel_cl2_update'])) echo $err_update['tel_cl2_update']; ?></span>                          
                        </div>




                        <div class="form-floating mb-3 col-sm-4">
                            <input type="text" class="form-control" id="tel_cl3_update" name="tel_cl3_update" value="<?php echo $tel_cl3_update; ?>"  >
                            <label for="tel_cl3_update">Téléphone 3</label> 
                            <span class="text-danger"><?php if (isset($err_update['tel_cl3_update'])) echo $err_update['tel_cl3_update']; ?></span>                          
                        </div>

                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email_cl_update" name="email_cl_update" value="<?php echo $email_cl_update; ?>"  required>
                        <label for="email_cl_update">Email</label> 
                        <span class="text-danger"><?php if (isset($err_update['email_cl_update'])) echo $err_update['email_cl_update']; ?></span>                          
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control"  id="desc_cl_update" name="desc_cl_update" style="height: 100px"><?php echo $desc_cl_update; ?></textarea>
                        <label for="desc_cl_update">Descreption</label>
                        <span class="text-danger"><?php if (isset($err_update['desc_cl_update'])) echo $err_update['desc_cl_update']; ?></span>                          
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
                    <p>Voulez vous vraiment supprimer le client dont ID est <b><span id="supp_id_client"></span></b>
                    </p>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NON</button>
                    <a href="" id="supp_id_client_oui"  class="btn btn-primary">OUI</a>
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
        $("#form_ajouter_client").addClass("show");
        $("#addClientBTN").click();
<?php } ?>
<?php if (count($err_update) != 0 || isset($_GET["update"])) { ?>
        $("#updateClientBTN").click();
<?php } ?>
    
    function deleteClient(b){
        $("#supp_id_client").html(b.dataset.id_cl);
        $("#supp_id_client_oui").attr("href","?id_cl="+b.dataset.id_cl+"&delete");
    }
</script>