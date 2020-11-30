<?php

require_once('Modele.php');

class Article extends Modele
{
	function recupererArticles($premier, $dernier){
		$requete = "SELECT * FROM article ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete)->fetchAll();
	}

	function rechecheParCategorie($idcat, $premier, $dernier){
		$requete = "SELECT * FROM article WHERE IdCategorie = ? ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete, [$idcat])->fetchAll();
	}

	function afficherArticle($idart){
		$requete = "SELECT * FROM article WHERE idArticle = ?";
		return $this->execRequete($requete, [$idart])->fetch();	
	}

	function compterArticle($idcat = NULL){
		if ($idcat === NULL){
			$requete = "SELECT COUNT(*) FROM article;";
			return $this->execRequete($requete)->fetch();
		}else{
			$requete = "SELECT COUNT(*) AS nb_articles FROM article WHERE IdCategorie = ?;";
			return $this->execRequete($requete, [$idcat])->fetch();
		}
	}
}
?>