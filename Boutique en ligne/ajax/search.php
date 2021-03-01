<?php
require_once('../modeles/Article.php');
$Article = new Article;

if (isset($_POST['search']) && !empty($_POST['search'])){
    $resultat = $Article->searchArticle($_POST['search']);
    echo json_encode($resultat);
}
?>