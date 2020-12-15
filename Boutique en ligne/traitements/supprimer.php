<?php
require_once('../modeles/Panier.php');
$Panier = new Panier();

if(isset($_POST['idA']) && !empty($_POST['idA']) && isset($_POST['idC']) && !empty($_POST['idC'])){
	$idC=$_POST['idC'];
	$idA=$_POST['idA'];
	print_r($idA);
	print_r($idC);
    $resultat = $Panier->suprPanier($idC, $idA);
    if (isset($resultat)) { ?>
    	<p>Suppression réussie</p>
    	<a href="../panier.php">retour au panier</a><?php
    	header('location:../panier.php');
    }else{ ?>
	<p style="color: red;">Erreur de suppression</p>
	<a href="../panier.php">retour au panier</a><?php
	}
}else{ ?>
	<p style="color: red;">Erreur de champ</p>
	<a href="../panier.php">retour au panier</a><?php
}?>