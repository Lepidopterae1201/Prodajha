<?php
require_once('Modele.php');

class Review extends Modele{

    function recupCommentaires($idart){
        $sql = "SELECT * FROM review WHERE idArticle=? ORDER BY dateReview DESC";
        return $this->execRequete($sql, [$idart])->fetchAll();
    }
}
?>