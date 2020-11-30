<?php 
require_once('Modele.php');

class Categorie extends Modele{
	function recupererCategories(){
		$requete = "SELECT * FROM categorie";
		return $this->execRequete($requete)->fetchAll();
	}
}
?>