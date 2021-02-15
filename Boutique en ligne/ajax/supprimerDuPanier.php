<?php
require_once('../modeles/Panier.php');
$Panier = new Panier();

if(isset($_POST['idA']) && !empty($_POST['idA']) && isset($_POST['idC']) && !empty($_POST['idC'])){
	$idC=$_POST['idC'];
	$idart=$_POST['idA'];
    $resultat = $Panier->suprPanier($idC, $idart);
    if (isset($resultat)) { 
		echo json_encode(["succes"=>true]);
    }else{ 
		echo json_encode(["succes"=>false]);
	}
}else{ 
	echo json_encode(["succes"=>false]);
}?>