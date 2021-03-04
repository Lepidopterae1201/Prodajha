<?php

require_once('Modele.php');

class Article extends Modele
{
	function searchArticle($search){
		$requete = "SELECT idArticle, nom FROM article WHERE article.nom LIKE ? LIMIT 5";
		return $this->execRequete($requete, ['%'.$search.'%'])->fetchAll(PDO::FETCH_ASSOC);
	}

	function recupererArticles($premier, $dernier){
		$requete = "SELECT * FROM article ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete)->fetchAll();
	}

	function recupererParCategorie($idcat, $premier, $dernier){
		$requete = "SELECT * FROM article WHERE IdCategorie = ? ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete, [$idcat])->fetchAll();
	}

	function recupererParSearch($search, $premier, $dernier){
		$requete = "SELECT * FROM article WHERE article.nom LIKE ? ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete, ['%'.$search.'%'])->fetchAll();
	}

	function afficherArticle($idart){
		$requete = "SELECT * FROM article WHERE idArticle = ?";
		return $this->execRequete($requete, [$idart])->fetch();	
	}

	function compterArticle($idcat = NULL, $search = NULL){
		if ($idcat === NULL){
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article;";
			return $this->execRequete($requete)->fetch();
		}elseif ($search !== NULL){
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article WHERE nom LIKE ?;";
			return $this->execRequete($requete, ['%'.$search.'%'])->fetch();
		}else{
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article WHERE IdCategorie = ?;";
			return $this->execRequete($requete, [$idcat])->fetch();
		}
	}

	function recupVendeur($idart){
		$requete = "SELECT magasin.nom FROM magasin INNER JOIN article ON magasin.idMagasin = article.idMagasin WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}

	function recup_max_article($idart){
		$requete ="SELECT article.quantite FROM article WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}

	function recup_prix_article($idart){
		$requete ="SELECT article.prix FROM article WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}
}
?>