<?php
require_once('Modele.php');

class Paiement extends Modele
{
    function insertArticlesCommandes($idCommande, $idArt, $idMarchand, $quant){
        $request = "CALL insertArticlesCommandes(?,?,?,?)";
        try{
            $this->execRequete($request, [$idCommande, $idArt, $idMarchand, $quant]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

    function getLastCommande($idC, $idPaiement){
        $request = "CALL getLastCommande(?,?)";
        try{
            $resultat = $this->execRequete($request, [$idC, $idPaiement]);
            return $resultat;
        }catch(Exception $e){
            return false;
        }
    }

    function insertCommande($idC, $idPaiement){
        $request = "CALL insertCommande(?,?)";
        try{
            $this->execRequete($request, [$idC, $idPaiement]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }

    function getLastPaiement($nom, $numero_de_carte, $date_expiration, $cvv){
        $request = "CALL getLastPaiement(?, ?, ?, ?)";
        try{
            $resultat = $this->execRequete($request, [$nom, $numero_de_carte, $date_expiration, $cvv]);
            return $resultat;
        }catch(Exception $e){
            return false;
        }
    }

    function Insertpaiement($nom, $numero_de_carte, $date_expiration, $cvv){
        $request = "INSERT INTO paiement (nom, numero_de_carte, date_expiration, cvv) VALUES (?, ?, ?, ?) ";
        try{
            $this->execRequete($request, [$nom, $numero_de_carte, $date_expiration, $cvv]);
            return true;
        }catch(Exception $e){
            return $e;
        }
    }
}
?>