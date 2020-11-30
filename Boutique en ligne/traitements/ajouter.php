<?php
session_start();
require_once('../config/bdd.php');

if(isset($_POST['idart']) && !empty($_POST['idart']) && isset($_POST['qart']) && !empty($_POST['qart'])){
	$idC=$_SESSION['idClient'];
	$idart=$_POST['idart'];
	$qart=$_POST['qart'];
    $request = "INSERT INTO panier VALUES (?, ?, ?) ";
        $resultat = getBdd()->prepare($request);
        $resultat->bindParam(1, $idC);
        $resultat->bindParam(2, $idart);
        $resultat->bindParam(3, $qart);
        $resultat->execute();
        $resultat1 = $resultat->fetch();
    if (isset($resultat1)) { ?>
    	<p>Insertion réussie</p>
    	<a href="../AjoutConfirm.php">Page de succès</a><?php
    	header('location:../AjoutConfirm.php');
    }else{ ?>
	<p style="color: red;">Erreur d'insertion</p>
	<a href="../index.php">retour au menu</a><?php
	}
}else{ ?>
	<p style="color: red;">Erreur de champ</p>
	<a href="../index.php">retour au menu</a><?php
}?>
