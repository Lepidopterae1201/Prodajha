<?php

require_once('Modele.php');

class ListeSouhait extends Modele
{
    
    function ajouterListeSouhait($idart, $idC){
        $request = "INSERT INTO listesouhait (idClient, idArticle) VALUES (?, ?) ";
        try{
            $this->execRequete($request, [$idC, $idart]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    function afficherListeSouhait($idC){
        $requete = "SELECT idArticle, article.prix, article.nom, article.image, article.quantite FROM listesouhait
        INNER JOIN article ON listesouhait.idArticle = article.idArticle WHERE idClient = ?";
        return $this->execRequete($requete, [$idC])->fetchAll();
    }

    function articleInListeSouhait($idC, $idart){
        $requete = "SELECT * from listesouhait WHERE idClient=? AND idArticle=?;";
        if($this->execRequete($requete, [$idC, $idart])->fetchAll()){
            return True;
        }else{
            return False;
        }
    }

    function suprListeSouhait($idC, $idart){
        $request = "DELETE FROM listesouhait WHERE idClient=? AND idArticle=?";
        return $this->execRequete($request, [$idC, $idart]);
    }

}
?>