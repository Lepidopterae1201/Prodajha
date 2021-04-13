<?php
require_once("modeles/Article.php");
require_once("modeles/Panier.php");

$Article = new Article();
$Panier = new Panier();

/* pagination */ 
if(isset($_GET['page']) && !empty($_GET['page'])){ //si on est sur une page spécifique
  $currentPage = (int) strip_tags($_GET['page']);
}else{
  $currentPage = 1;
}

// On détermine le nombre d'articles par page
$parPage = 4;

//premier article afficher
$premier = ($currentPage * $parPage) - $parPage;

if (isset($_GET["idcat"])) { //si on a recherché une catégorie, on n'affiche que les articlers de cette catégorie
  $listeArticles = $Article->recupererParCategorie($_GET["idcat"], $premier, $parPage);
  $nbArticle = (int) $Article->compterArticle($_GET["idcat"])["nb_articles"];
}elseif(isset($_GET["search"])){ //si on a fait une recherche
  $listeArticles = $Article->recupererParSearch(urldecode($_GET["search"]), $premier, $parPage);
  $nbArticle = (int) $Article->compterArticle($_GET["search"])["nb_articles"];
}
else{ // si pas de recherche
  $listeArticles = $Article->recupererArticles($premier, $parPage);
  $nbArticle = (int) $Article->compterArticle()["nb_articles"];

}

// On calcule le nombre de pages total
$pages = ceil($nbArticle / $parPage);


if($_SESSION){ //si on est connecté, on prends l'id du client
  $idClient = $_SESSION['idClient'];
}else{ //si on est pas connecté
  $idClient = False;
}
?>
<body>
  <div class="container">
    <div class="row">
      <?php foreach ($listeArticles as $article) { //pour chaque article trouvé ?>        
          <div class="col-md-6">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-4">
                  <a href="article.php?idart=<?php echo($article['idArticle']);?>">
                    <img class="card-img" src="<?php echo($article['image']) ?>"> <!--Image de l'article-->
                  </a>
                </div>  
                <div class="col-8">
                  <div class="card-body">
                    <a href="article.php?idart=<?php echo($article['idArticle']);?>"> <!--id de l'article-->
                      <h5 class="card-title"><?php echo($article['nom']) ?></h5><!--nom de l'article-->
                      <p class="card-text"><?php echo($article['prix']) ?> €</p> <!--prix de l'article-->
                    </a>
                    <hr>
                    <?php
                    if ($Panier->verifPanier($article['idArticle'], $idClient)){ //si on a déjà acheté l'article
                      ?> <p style="color: green">Vous avez déjà acheté l'article</p> <?php
                    }else{
                      if ($_SESSION == False){ //si on n'est pas connecté
                        echo"<p>Veuillez vous connecter pour ajouter au panier</p>";
                      }else{
                        if ($article['quantite'] <= 0) { //si il n'y a plus d'article disponible
                          ?> <p style="color: red">L'article est épuisé</p> <?php                   
                        } 
                      }
                    } ?>
                  </div>                 
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
    </div>
  </div>
</body>

<style>
  img{
    max-width: 100%;
    height: auto;
    vertical-align: middle;
  }
  div.card{
    padding: 10px;
    margin-top: 5px;
  }
</style>