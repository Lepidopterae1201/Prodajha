<?php
require_once('modeles/Modele.php');

class Panier extends Modele
{
    function articleInPanier($idart, $idC){
        $requete = "SELECT * from panier WHERE idArticle=? AND idClient=?;";
        if($this->execRequete($requete, [$idart, $idC])->fetchAll()){
            return True;
        }else{
            return False;
        }
    }
    
    function afficherPanier($idClient){
        $requete = "SELECT panier.idClient, article.idArticle, panier.quantite AS pQuantite,
        article.prix, article.nom, article.image, article.quantite AS aQuantite FROM panier
        INNER JOIN article ON panier.idArticle = article.idArticle WHERE idClient = ?";
        return $this->execRequete($requete, [$idClient])->fetchAll();
    }

    function verifPanier($idart, $idC){
        $requete = "SELECT idArticle FROM panier WHERE idArticle=? AND idClient=?";
        if($this->execRequete($requete, [$idart, $idC])->fetch()){
            return True;
        }else{
            return False;
        }	
    }

    function modifPanier($idart, $idClient, $quant){
        $request = "UPDATE panier SET quantite=? WHERE idClient=? AND idArticle=?";
        return$this->execRequete($requete, [$idart, $idClient, $quant])->fetch();
    }

    function suprPanier($idClient, $idart){
        $request = "DELETE FROM panier WHERE idClient=? AND idArticle=?";
        return $this->execRequete($requete, [$idart, $idClient])->fetch();
}
?>