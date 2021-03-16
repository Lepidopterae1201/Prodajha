<?php
require_once('../modeles/ListeSouhait.php');
$Liste = new ListeSouhait();

if(isset($_POST['idart']) && !empty($_POST['idart'])){
    $idC=$_POST['idC'];
    $idart=$_POST['idart'];
    $souhait = $Liste->articleInListeSouhait($idC, $idart);
    if($souhait){
        $resultat = $Liste->suprListeSouhait($idC, $idart);
        if (isset($resultat)) {
            echo json_encode(["succes" => true, "action" => "del"]);
        } else {
            echo json_encode(["succes" => false]);
        }
    }else{
        $resultat = $Liste->ajouterListeSouhait($idart, $idC);
        if (isset($resultat)) {
            echo json_encode(["succes" => true, "action" => "add"]);
        } else {
            echo json_encode(["succes" => false]);
        }
    } 
}else{
    echo json_encode(["succes"=>false]);
}