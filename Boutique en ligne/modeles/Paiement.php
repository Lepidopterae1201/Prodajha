<?php
require_once('Modele.php');

class Paiement extends Modele
{
    function Insertpaiement($nom, $numero_de_carte, $date_expiration, $cvv){ //insère un paiement
        $request = "INSERT INTO paiement (nom, numero_de_carte, date_expiration, cvv) VALUES (?, ?, ?, ?) ";
        try{
            $this->execRequete($request, [$nom, $numero_de_carte, $date_expiration, $cvv]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

    function getLastPaiement($nom, $numero_de_carte, $date_expiration, $cvv){ //récupère la dernière commande
        $request = "CALL getLastPaiement(?, ?, ?, ?)";
        try{
            $resultat = $this->execRequete($request, [$nom, $numero_de_carte, $date_expiration, $cvv]);
            return $resultat;
        }catch(Exception $e){
            return false;
        }
    }

    function insertCommande($idC, $idPaiement){ //insère une commande
        $request = "CALL insertCommande(?,?)";
        try{
            $this->execRequete($request, [$idC, $idPaiement]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

    function getLastCommande($idC, $idPaiement){ //récupère la dernière commande
        $request = "CALL getLastCommande(?,?)";
        try{
            $resultat = $this->execRequete($request, [$idC, $idPaiement]);
            return $resultat;
        }catch(Exception $e){
            return false;
        }
    }

    function insertArticlesCommandes($idCommande, $idArt, $idMarchand, $quant){ //insere l'article commandé
        $request = "CALL insertArticlesCommandes(?,?,?,?)";
        try{
            $this->execRequete($request, [$idCommande, $idArt, $idMarchand, $quant]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }
    
}
?>