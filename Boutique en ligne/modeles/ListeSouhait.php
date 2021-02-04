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

}
?>