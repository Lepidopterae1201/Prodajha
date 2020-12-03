<?php
session_start();
require_once('../modeles/Modele.php');
$Panier = new Panier();

if(isset($_POST['idart']) && !empty($_POST['idart']) && isset($_POST['qart']) && !empty($_POST['qart'])){
	$idC=$_SESSION['idClient'];
	$idArt=$_POST['idart'];
	$qArt=$_POST['qart'];
    $resultat = $Panier->ajoutPanier($idC, $idArt, $qArt);
    if (isset($resultat)) { ?>
    	<!-- <p>Insertion réussie</p> -->
		<!-- <a href="../AjoutConfirm.php">Page de succès</a> -->
		<?php
    	header('location:../AjoutConfirm.php');
    }else{ ?>
		<p style="color: red;">Erreur d'insertion</p>
		<a href="../index.php">retour au menu</a><?php
	}
}else{ ?>
	<p style="color: red;">Erreur de champ</p>
	<a href="../index.php">retour au menu</a><?php
}?>
