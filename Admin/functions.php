<?php

session_start();
$DATE_AJOUT=date("Y-m-d H:i:s",time());
$DATE_UPDAT=date("Y-m-d H:i:s",time()); 
function pre_r($tab){    
    echo '<pre>';
    print_r($tab);
    echo '</pre>';
}

function getDateFormat($d){
    return date("d-m-Y", strtotime($d));
}

// PDO Method
$delete_succes=TRUE;
$id_new_row='';
function setInDataBase($stat) {
    global $delete_succes,$id_new_row;
    include 'db_info.php';
    try{
    $conn_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
    $conn_db->exec($stat);  
    @$id_new_row = $conn_db->insert_id;  
    } catch(PDOException $e) {
      $delete_succes=FALSE;
    }
    $conn_db = NULL;
}





// Pour repondre au besoin SELECT
function getFromDataBase($stat) {
    include 'db_info.php';
    
    $conn_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd);
    $conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
    
    $result = $conn_db->query($stat);
    $rows = [];
    while ($row = $result->fetch()) {// both num and index_name if you want only index name: $row = $result->fetch(PDO::FETCH_ASSOC)
        $rows[] = $row;
    }
    $conn_db = NULL;
    return $rows;
}



function traiter_input($donnee) {
    $donnee = trim($donnee); // eliminer les espaces tab new line
    $donnee = stripcslashes($donnee); // eliminer les \
    $donnee = htmlspecialchars($donnee); // cenvertir anything else
    $donnee = str_replace("'", "&#039;", $donnee);
    return $donnee;
}



function uploadDoc($file_key, $err, $cap=2,$doc = ["jpg", "png", "jpeg", "gif"]){
    $photo_art="";
if (!empty($_FILES[$file_key]["name"])) {

    $target_dir = "uploads/";
    $photo_art = $target_dir . basename($_FILES[$file_key]["name"]); // uploads/file_name.jpg
    $imageFileType = pathinfo($photo_art, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
// Check if file already exists
// Allow certain file formats
    if ( !in_array($imageFileType, $doc)) {
        $err[$file_key] = "Désolé, seul les fichiers JPG, JPEG, PNG, GIF autorisés!!";
    } else {
        // Check file size
        if ($_FILES[$file_key]["size"] > ($cap*1000000)) {//2000KO = 2MO
           $err[$file_key] = "Désolé, le fichier a de grande capacité. SVP, merci de ne pas dépasser 2MO .";
        } else {
            $file_name='webdev2022_'.$desi_art;
            //$file_name = str_replace(".$imageFileType","",basename($_FILES[$file_key]["name"]));;
            $photo_art = $target_dir . $file_name . ".".$imageFileType;
            $i = 1;
            while (file_exists($photo_art)) {
                $photo_art = $target_dir . $file_name . "_$i.$imageFileType";
                $i++;
            }
        }
    }
// Check if $err['photo_art'] is set to 0 by an error
    if (!isset($err['photo_art'])) {
        if (move_uploaded_file($_FILES[$file_key]["tmp_name"], $photo_art)) {
            //echo "The file ". basename( $_FILES[$file_key]["name"]). " has been uploaded.";
        } else {
            $err['photo_art'] = "Désolé, error uploading .";
        }
    }
}
return $photo_art;
}