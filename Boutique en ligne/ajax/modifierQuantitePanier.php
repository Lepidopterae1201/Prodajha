<?php
session_start();
require_once('../modeles/Panier.php');
require_once('../modeles/Article.php');
$Panier = new Panier();
$Article = new Article();


if(isset($_POST['idA']) && !empty($_POST['idA']) && isset($_POST['qart']) && !empty($_POST['qart'])){
	$idC=$_SESSION['idClient'];
	$idA=$_POST['idA'];
    $quant=$_POST['qart'];
	$quant_max = $Article->recup_max_article($idA);
	if($quant > $quant_max){
		echo json_encode(["succes"=>false]);
	}if($quant<=0){
		echo json_encode(["succes"=>false]);
	}
	else{
		$resultat = $Panier->modifPanier($idA, $idC, $quant);
		if (isset($resultat)) {
			echo json_encode(["succes"=>true]);
		}else{
			echo json_encode(["succes"=>false]);
		}
	}
}else{
	echo json_encode(["succes"=>false]);
}?>