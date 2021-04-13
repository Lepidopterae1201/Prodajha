<?php
require_once('Modele.php');

class Panier extends Modele
{
    
    function afficherPanier($idC){ //Afficher tous les articles d'un panier
        $requete = "SELECT panier.idClient, article.idArticle, panier.quantite AS pQuantite,
        article.prix, article.nom, article.image, article.quantite AS aQuantite FROM panier
        INNER JOIN article ON panier.idArticle = article.idArticle WHERE idClient = ?";
        return $this->execRequete($requete, [$idC])->fetchAll();
    }

    function verifPanier($idart, $idC){ //Vérifier si un article est dans le panier
        $requete = "SELECT idArticle FROM panier WHERE idArticle=? AND idClient=?";
        if($this->execRequete($requete, [$idart, $idC])->fetch()){
            return True;
        }else{
            return False;
        }	
    }

    function ajoutPanier($idC, $idart, $idMagasin, $qart){ //ajoute un article au panier
        $request = "INSERT INTO panier (idClient, idArticle, idMagasin, quantite) VALUES (?, ?, ?, ?) ";
        try{
            $this->execRequete($request, [$idC, $idart, $idMagasin, $qart]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function modifPanier($idart, $idC, $quant){ //modifie la quantitée d'article dans le panier
        $request = "UPDATE panier SET quantite=? WHERE idClient=? AND idArticle=?";
        return $this->execRequete($request, [$quant, $idC, $idart]);
    }

    function suprPanier($idC, $idart){ //supprime un article du panier
        $request = "DELETE FROM panier WHERE idClient=? AND idArticle=?";
        return $this->execRequete($request, [$idC, $idart]);
    }

    function getPanier($idC){ //récupère le panier du client
        $request = "CALL get_panier(?)";
        return $this->execRequete($request, [$idC]);
    }

    function deletePanier($idC){ //supprime le panier d'un client
        $request = "CALL deletePanier(?)";
        try{
            $this->execRequete($request, [$idC]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }
}
?>