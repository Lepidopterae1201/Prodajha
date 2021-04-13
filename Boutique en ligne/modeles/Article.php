<?php

require_once('Modele.php');

class Article extends Modele
{
	function searchArticle($search){ //récupère les articles en fonction de ce qui est entré dans la bar de recherche
		$requete = "SELECT idArticle, nom FROM article WHERE article.nom LIKE ? LIMIT 5";
		return $this->execRequete($requete, ['%'.$search.'%'])->fetchAll(PDO::FETCH_ASSOC);
	}

	function recupererArticles($premier, $dernier){ //récupère tous les articles en fonction de la page où l'on est
		$requete = "SELECT * FROM article ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete)->fetchAll();
	}

	function recupererParCategorie($idcat, $premier, $dernier){ //récupère tous les articles en fonction de la page où l'on est et de la catégorie recherchée
		$requete = "SELECT * FROM article WHERE IdCategorie = ? ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete, [$idcat])->fetchAll();
	}

	function recupererParSearch($search, $premier, $dernier){ //récupère tous les articles en fonction de la page où l'on est et de la recherche passée
		$requete = "SELECT * FROM article WHERE article.nom LIKE ? ORDER BY idArticle DESC LIMIT $premier, $dernier;";
		return $this->execRequete($requete, ['%'.$search.'%'])->fetchAll();
	}

	function afficherArticle($idart){ //récupère un article spécifique
		$requete = "SELECT * FROM article WHERE idArticle = ?";
		return $this->execRequete($requete, [$idart])->fetch();	
	}

	function compterArticle($idcat = NULL, $search = NULL){ //compte le nombre d'article dans la base de donnée
		if ($idcat === NULL){ // si on  recherhce selon une catégorie
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article;";
			return $this->execRequete($requete)->fetch();
		}elseif ($search !== NULL){ // si l'on fait une recherche par la search bar
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article WHERE nom LIKE ?;";
			return $this->execRequete($requete, ['%'.$search.'%'])->fetch();
		}else{ // si pas de recherche
			$requete = "SELECT COUNT(idArticle) AS nb_articles FROM article WHERE IdCategorie = ?;";
			return $this->execRequete($requete, [$idcat])->fetch();
		}
	}

	function recupVendeur($idart){ //récupère le vendeur d'un article
		$requete = "SELECT magasin.nom FROM magasin INNER JOIN article ON magasin.idMagasin = article.idMagasin WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}

	function recup_max_article($idart){ //récupère le nombre d'article que le vendeur possède
		$requete ="SELECT article.quantite FROM article WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}

	function recup_prix_article($idart){//récupère le prix de l'article
		$requete ="SELECT article.prix FROM article WHERE article.idArticle = ?;";
		return $this->execRequete($requete, [$idart])->fetch();
	}
}
?>