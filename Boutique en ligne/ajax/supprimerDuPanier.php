<?php
session_start();
require_once('../modeles/Panier.php');
$Panier = new Panier();

if(isset($_POST['idA']) && !empty($_POST['idA'])){
	$idC=$_SESSION['idClient'];
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