<?php
require_once('../modeles/Panier.php');
$Panier = new Panier();


if(isset($_POST['idA']) && !empty($_POST['idA']) && isset($_POST['idC']) && !empty($_POST['idC']) && isset($_POST['idC']) && !empty($_POST['idC'])){
	$idC=$_POST['idC'];
	$idA=$_POST['idA'];
    $quant=$_POST['qart'];
	print_r($idA);
	print_r($idC);
    $request = "UPDATE panier SET quantite=? WHERE idClient=? AND idArticle=?";
        $resultat->execute();
        $resultat = $Panier->modifier($idart, $idClient, $quant);
    if (isset($resultat)) { ?>
    	<p>modification réussie</p>
    	<a href="../panier.php">retour au panier</a><?php
    	header('location:../panier.php');
    }else{ ?>
	<p style="color: red;">Erreur de modification</p>
	<a href="../panier.php">retour au panier</a><?php
	}
}else{ ?>
	<p style="color: red;">Erreur de champ</p>
	<a href="../panier.php">retour au panier</a><?php
}?>