<?php
require_once('../modeles/Reviews.php');
$Review = new Review;

//si le formulaire est bien rempli
if(isset($_POST['review']) && !empty($_POST['review']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['idArticle']) && !empty($_POST['idArticle'])){
    //on  les variables
    $review = $_POST['review'];
    $pseudo = $_POST['pseudo'];
    $idArticle = $_POST['idArticle'];

    $Review->ajoutCommentaire($review, $pseudo, $idArticle); //on ajoute le commentaire

}else{//si le formulaire est mal rempli
    header("location:../article.php?idart=".$_POST['idArticle']."&message=erreur1#message");
}
?>