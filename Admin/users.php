<?php
include 'functions.php';

if($_SESSION['role']!="admin")
    header("Location: index.php");


$page_title = "Utilisateurs";
$err = [];
$fname = "";
$lname = "";
$email = "";
$pwd = "";
$role = "";

if (isset($_POST["submit"])) {

    $fname = traiter_input($_POST["fname"]);
    $lname = traiter_input($_POST["lname"]);
    $email = traiter_input($_POST["email"]);
    $pwd = traiter_input($_POST["pwd"]);
    $role = traiter_input($_POST["role"]);


    if (empty($fname)) {
        $err['fname'] = "Champs obligatoire!!!";
    } elseif (strlen($fname) > 100) {
        $err['fname'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
        $err['fname'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }


    if (empty($lname)) {
        $err['lname'] = "Champs obligatoire!!!";
    } elseif (strlen($lname) > 100) {
        $err['lname'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
        $err['lname'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }


    if (empty($email)) {
        $err['email'] = "Champs obligatoire!!!";
    } elseif (strlen($email) > 100) {
        $err['email'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^[a-zA-Z0-9\-_.]+@[a-zA-Z0-9\-_]+\.[a-zA-Z]+$/", $email)) {
        $err['email'] = "Numero invalid!!!";
    }



    if (empty($pwd)) {
        $err['pwd'] = "Champs obligatoire!!!";
    } elseif (strlen($pwd) > 20) {
        $err['pwd'] = "Trop long!!!!!!";
    }


    if (empty($role)) {
        $err['role'] = "Champs obligatoire!!!";
    } elseif (strlen($role) > 20) {
        $err['role'] = "Trop long!!!!!!";
    }

    if (count(getFromDataBase("SELECT * FROM users WHERE USERNAME LIKE '$email'")) != 0)
        $err['email'] = "Cet email existe deja!!!";

    if (count($err) == 0) {
        $stat = "INSERT INTO `users` (`FIRST_NAME`, `LAST_NAME`, `USERNAME`, `PASSWORD`, `ROLE`, `DATE_AJOUT`, `DATE_UPDAT`)"
                . " VALUES ('$fname', '$fname', '$email', MD5('$pwd'), '$role', '$DATE_AJOUT', '$DATE_UPDAT')";
        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?new_user=$fname");
    }
}








$err_update = [];
$id_user_update = "";
$fname_update = "";
$lname_update = "";
$email_update = "";
$pwd_update = "";
$role_update = "";
if (isset($_GET["id_user"]) && isset($_GET["update"])) {
    $id_user = $_GET["id_user"];
    $rows = getFromDataBase("SELECT * FROM users WHERE ID_USER='$id_user'");
    if (count($rows) == 1) {
        $row = $rows[0];
        $id_user_update = $row["ID_USER"];
        $fname_update = $row["FIRST_NAME"];
        $lname_update = $row["LAST_NAME"];
        $email_update = $row["USERNAME"];
        $pwd_update = $row["PASSWORD"];
        $role_update = $row["ROLE"];
    }
}



if (isset($_POST["submit_update"])) {

    $id_user_update = traiter_input($_POST["id_user_update"]);
    $fname_update = traiter_input($_POST["fname_update"]);
    $lname_update = traiter_input($_POST["lname_update"]);
    $email_update = traiter_input($_POST["email_update"]);
    $pwd_update = traiter_input($_POST["pwd_update"]);
    $role_update = traiter_input($_POST["role_update"]);


    if (empty($fname_update)) {
        $err_update['fname_update'] = "Champs obligatoire!!!";
    } elseif (strlen($fname_update) > 100) {
        $err_update['fname_update'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $fname_update)) {
        $err['fname_update'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }

    if (empty($lname_update)) {
        $err_update['lname_update'] = "Champs obligatoire!!!";
    } elseif (strlen($lname_update) > 100) {
        $err_update['lname_update'] = "Trop long!!!";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $lname_update)) {
        $err['lname_update'] = "Seuls les caracteres alphabetiques sont autorisés!!!";
    }



    if (empty($email_update)) {
        $err_update['email_update'] = "Champs obligatoire!!!";
    } elseif (strlen($email_update) > 100) {
        $err_update['email_update'] = "Trop long!!!!!!";
    } elseif (!preg_match("/^[a-zA-Z0-9\-_.]+@[a-zA-Z0-9\-_]+\.[a-zA-Z]+$/", $email_update)) {
        $err_update['email_update'] = "Numero invalid!!!";
    }


    if (empty($pwd_update)) {
        $err_update['pwd_update'] = "Champs obligatoire!!!";
    } elseif (strlen($pwd_update) > 20) {
        $err_update['pwd_update'] = "Trop long!!!!!!";
    }


    if (empty($role_update)) {
        $err_update['role_update'] = "Champs obligatoire!!!";
    } elseif (strlen($role_update) > 20) {
        $err_update['role_update'] = "Trop long!!!!!!";
    }


    $rows_users = getFromDataBase("SELECT * FROM users WHERE USERNAME LIKE '$email_update'");
    if (count($rows_users) > 1)
        $err_update['email_update'] = "Cet email existe deja!!!";
    elseif (count($rows_users) == 1) {
        if ($rows_users[0]["ID_USER"] != $id_user_update)
            $err_update['email_update'] = "Cet email existe deja!!!";
    }



    if (count($err_update) == 0) {
        $stat = "UPDATE `users` SET `FIRST_NAME` = '$fname_update', `LAST_NAME` = '$lname_update', `USERNAME` = '$email_update', "
                . "`PASSWORD` = MD5('$pwd_update'), `ROLE` = '$role_update', `DATE_UPDAT` = '$DATE_UPDAT' WHERE `users`.`ID_USER` = '$id_user_update'";

        setInDataBase($stat);
        header("Location: " . $_SERVER["PHP_SELF"] . "?update_user=$fname_update");
    }
}



include 'header.php';
?>

<section class="container-fluid"><bR>    <!-- Button trigger modal -->
    <?php if (isset($_GET["new_user"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> L'utilisateur <b><?= $_GET["new_user"] ?></b> est ajouté avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($_GET["update_user"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> L'utilisateur <b><?= $_GET["update_user"] ?></b> est modifié avec succée.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <button type="button" class="btn btn-primary" id="addClientBTN" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Ajouter un utilisateur
    </button><br><br> 

    <h1 class="text-center text-uppercase">utilisateurs</h1>
    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOM</th>
                <th scope="col">PRENOM</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ROLE</th>
                <th scope="col">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = getFromDataBase("SELECT * FROM users");
            foreach ($rows as $row) {
                $bg = "";
                if ($_SESSION['username'] == $row["USERNAME"])
                    $bg = "yellow";
                ?>
                <tr style="background: <?= $bg ?>">
                    <td scope="row"><?= $row["ID_USER"] ?></td>
                    <td scope="row"><?= $row["LAST_NAME"] ?></td>
                    <td scope="row"><?= $row["FIRST_NAME"] ?></td>
                    <td scope="row"><?= $row["USERNAME"] ?></td>
                    <td scope="row"><?= $row["ROLE"] ?></td>
                    <td>
                        <a  class="btn btn-warning text-white" href="?id_user=<?= $row["ID_USER"] ?>&update" >
                            <i class="fas fa-edit"></i>
                        </a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err['lname'])) echo"is-invalid"; ?>" id="fname" name="lname" value="<?php echo $lname; ?>" required>
                        <label for="lname">NOM</label> 
                        <span class="text-danger"><?php if (isset($err['lname'])) echo $err['lname']; ?></span>                          
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?php if (isset($err['fname'])) echo"is-invalid"; ?>" id="fname" name="fname" value="<?php echo $fname; ?>" required>
                        <label for="fname">PRENOM</label> 
                        <span class="text-danger"><?php if (isset($err['fname'])) echo $err['fname']; ?></span>                          
                    </div>



                    <div class="row g-2">

                        <div class="form-floating mb-3  col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"  required>
                            <label for="email">EMAIL</label> 
                            <span class="text-danger"><?php if (isset($err['email'])) echo $err['email']; ?></span>                          
                        </div>



                        <div class="form-floating mb-3 col-sm-6">
                            <input type="password" class="form-control" id="pwd" name="pwd" value="<?php echo $pwd; ?>"  >
                            <label for="pwd">MOT DE PASSE</label> 
                            <span class="text-danger"><?php if (isset($err['pwd'])) echo $err['pwd']; ?></span>                          
                        </div>  
                    </div>




                    <div class="row g-2">
                        <div class="col-sm-3">
                            ROLE
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="admin" 
                                       value="admin" <?= ($role == "admin" ) ? "checked" : "" ?> >
                                <label class="form-check-label" for="admin">Administrateur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="editor" 
                                       value="editor" <?= ($role == "editor" || $role == "") ? "checked" : "" ?> >
                                <label class="form-check-label" for="editor">Editeur</label>
                            </div>                         
                            <span class="text-danger"><?php if (isset($err['role'])) echo $err['role']; ?></span>
                        </div>
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
                    <h5 class="modal-title" id="exampleModalLabel2">Modifier un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3" >
                        <strong>ID: </strong><?php echo $id_user_update; ?>
                    </div>
                    <div class="form-floating mb-3" style="display: none;">
                        <input type="text" class="form-control" id="id_user_update" name="id_user_update" style="" value="<?php echo $id_user_update; ?>" required>           
                        <label for="fname_update">ID</label> 
                        <span class="text-danger"><?php if (isset($err_update['id_user_update'])) echo $err_update['id_user_update']; ?></span>                          
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="lname_update" name="lname_update" value="<?php echo $lname_update; ?>"  required>
                        <label for="lname_update">NOM</label> 
                        <span class="text-danger"><?php if (isset($err_update['lname_update'])) echo $err_update['lname_update']; ?></span>                          
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fname_update" name="fname_update" value="<?php echo $fname_update; ?>" required>
                        <label for="fname_update">PRENOM</label> 
                        <span class="text-danger"><?php if (isset($err_update['fname_update'])) echo $err_update['fname_update']; ?></span>                          
                    </div>


                    <div class="row g-2">
                        <div class="form-floating mb-3 col-sm-6">
                            <input type="email" class="form-control" id="email_update" name="email_update" value="<?php echo $email_update; ?>"  required>
                            <label for="email_update">EMAIL</label> 
                            <span class="text-danger"><?php if (isset($err_update['email_update'])) echo $err_update['email_update']; ?></span>                          
                        </div>
                        <div class="form-floating mb-3 col-sm-6">
                            <input type="password" class="form-control" id="pwd_update" name="pwd_update" value=""  >
                            <label for="pwd_update">MOT DE PASSE</label> 
                            <span class="text-danger"><?php if (isset($err_update['pwd_update'])) echo $err_update['pwd_update']; ?></span>                          
                        </div>

                    </div>


                    <div class="row g-2">
                        <div class="col-sm-3">
                            ROLE
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role_update" id="admin_update" 
                                       value="admin" <?= ($role_update == "admin" ) ? "checked" : "" ?> >
                                <label class="form-check-label" for="admin_update">Administrateur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role_update" id="editor_update" 
                                       value="editor" <?= ($role_update == "editor" || $role_update == "") ? "checked" : "" ?> >
                                <label class="form-check-label" for="editor_update">Editeur</label>
                            </div>                         
                            <span class="text-danger"><?php if (isset($err_update['role_update'])) echo $err_update['role_update']; ?></span>
                        </div>
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

</script>