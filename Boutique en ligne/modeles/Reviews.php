<?php
require_once('Modele.php');

class Review extends Modele{

    function recupCommentaires($idart){ //récupérer tous les commentaires d'un article
        $sql = "SELECT * FROM review WHERE idArticle=? ORDER BY dateReview DESC";
        return $this->execRequete($sql, [$idart])->fetchAll();
    }

    function ajoutCommentaire($review, $pseudo, $idart){ //ajouter un commentaire à un article
        $sql = "INSERT INTO review (contenu, pseudo, dateReview, idArticle) VALUES(?, ?, NOW(),?)";
        return $this->execRequete($sql, [$review, $pseudo, $idart]);
    }
}
?>