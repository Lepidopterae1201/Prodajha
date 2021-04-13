<?php 
require_once('Modele.php');

class Categorie extends Modele{
	function recupererCategories(){ //récupère toutes les catégories disponibles
		$requete = "SELECT * FROM categorie";
		return $this->execRequete($requete)->fetchAll();
	}
}
?>