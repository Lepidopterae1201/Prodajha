<?php
require_once('Modele.php');

class Review extends Modele{
    
    function recupCommentaires($idart){
        $sql = "SELECT * FROM review WHERE idArticle=? ORDER BY dateReview DESC";
        return $this->execRequete($sql, [$idart])->fetchAll();
    }

    function messageInscription(){
        if ($_GET['message']=='erreur1') {
            return "<p style='color: red;'>Les mots de passes ne correspondent pas</p>";
        }elseif ($_GET['message']=='erreur2') {
            return "<p style='color: red;'>L'utilisateur existe déjà</p>";
        }elseif ($_GET['message']=='erreur3') {
            return "<p style='color: red;'>Veuillez saisir une adresse mail valide</p>";
        }elseif ($_GET['message']=='erreur4') {
            return "<p style='color: red;'>Il manque un ou plusieurs champs</p>";
        }
    }

    function messageConnexion(){
        if ($_GET['message'] == 'erreur1') {
            echo "<p style='color: red;'>L'utilisateur ou le mot de passe est incorrect</p>";
        } elseif ($_GET['message'] == 'erreur2') {
            echo "<p style='color: red;'>Il manque un ou plusieurs champs</p>";
        } elseif ($_GET['message'] == 'succes') {
            echo "<p style='color: green;'>Compte créé avec succès</p>";
        }
    }
}
?>