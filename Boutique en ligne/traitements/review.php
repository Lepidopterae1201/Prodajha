<?php
require_once('../modeles/Reviews.php');
$Review = new Review;

if(isset($_POST['review']) && !empty($_POST['review']) && isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['idArticle']) && !empty($_POST['idArticle'])){
    $review = $_POST['review'];
    $pseudo = $_POST['pseudo'];
    $idArticle = $_POST['idArticle'];
    echo "<p>review=".$review."</p>";
    echo "<p>pseudo=".$pseudo."</p>";
    echo "<p>idArticle=".$idArticle."</p>";

    $Review->ajoutCommentaire($review, $pseudo, $idArticle);

    echo "<a href = ../article.php?idart=".$idArticle;
    header("location:../article.php?idart=".$idArticle);

}else{
    ?>
    Erreur : Le message ou l'auteur est vide<br/>
    <a href="../article.php?idart=<?php echo($_POST['idArticle']) ?>&message=erreur1#message">Retour à l'accueil</a>
    <?php
    header("location:../article.php?idart=".$_POST['idArticle']."&message=erreur1#message");
}
?>