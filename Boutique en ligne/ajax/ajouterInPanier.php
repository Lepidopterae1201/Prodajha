<?php
session_start();
require_once('../modeles/Panier.php');
$Panier = new Panier();

if(isset($_POST['idart']) && !empty($_POST['idart']) && isset($_POST['qart']) && !empty($_POST['qart'])){
	$idC=$_SESSION['idClient'];
	$idArt=$_POST['idart'];
	$qArt=$_POST['qart'];
    $resultat = $Panier->ajoutPanier($idC, $idArt, $qArt);
    if (isset($resultat)) {
    	echo json_encode(["succes"=>true]);
    }else{
		echo json_encode(["succes"=>false]);
	}
}else{ 
	echo json_encode(["succes"=>false]);
}?>
