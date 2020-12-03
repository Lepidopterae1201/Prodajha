<?php
require_once('Modele.php');

class Review extends Modele{

    function recupCommentaires($idart){
        $sql = "SELECT * FROM review WHERE idArticle=? ORDER BY dateReview DESC";
        return $this->execRequete($sql, [$idart])->fetchAll();
    }

    function affichCommentaires($review, $pseudo, $idart){
        $sql = "INSERT INTO review (contenu, pseudo, dateReview, idArticle) VALUES(?, ?, NOW(),?)";
        return $this->execRequete($sql, [$review, $pseudo, $idart]);
    }
}
?>