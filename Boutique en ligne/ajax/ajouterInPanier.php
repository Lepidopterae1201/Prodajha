<?php
session_start();
require_once('../modeles/Panier.php');
require_once('../modeles/Article.php');
$Panier = new Panier();
$Article = new Article();

if(isset($_POST['idart']) && !empty($_POST['idart']) && isset($_POST['qart']) && !empty($_POST['qart'])){
	$idC=$_SESSION['idClient'];
	$idArt=$_POST['idart'];
	$qArt=$_POST['qart'];
	$articleCommande = $Article->afficherArticle($idArt);
	$idMagasin = $articleCommande['idMagasin'];
    $resultat = $Panier->ajoutPanier($idC, $idArt, $idMagasin ,$qArt);
    if (isset($resultat)) {
    	echo json_encode(["succes"=>true]);
    }else{
		echo json_encode(["succes"=>false]);
	}
}else{ 
	echo json_encode(["succes"=>false]);
}?>
