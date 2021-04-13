<?php
session_start();
require_once('../modeles/ListeSouhait.php');
$Liste = new ListeSouhait();

if(isset($_POST['idart']) && !empty($_POST['idart'])){ //si tous les champs sont remplis
    $idC=$_SESSION['idClient']; //id client de l'utilisateur
    $idart=$_POST['idart'];// id de l'article
    $souhait = $Liste->articleInListeSouhait($idC, $idart);// on vérifie si l'article est dans la liste de souhait
    if($souhait){ // si l'article est dans la liste de souhait, on le supprime de la liste de souhait
        $resultat = $Liste->suprListeSouhait($idC, $idart);
        if (isset($resultat)) {
            echo json_encode(["succes" => true, "action" => "del"]);
        } else {
            echo json_encode(["succes" => false]);
        }
    }else{ //Si l'article n'est pas dans la liste de souhait, on l'ajoute
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