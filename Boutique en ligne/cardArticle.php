<?php
require_once("modeles/Article.php");
require_once("modeles/Panier.php");

$Article = new Article();
$Panier = new Panier();

/* pagination */ 
if(isset($_GET['page']) && !empty($_GET['page'])){
  $currentPage = (int) strip_tags($_GET['page']);
}else{
  $currentPage = 1;
}

// On détermine le nombre d'articles par page
$parPage = 4;

//premier article afficher
$premier = ($currentPage * $parPage) - $parPage;

if (isset($_GET["idcat"])) {
  $listeArticles = $Article->rechecheParCategorie($_GET["idcat"], $premier, $parPage);
  $nbArticle = (int) $Article->compterArticle($_GET["idcat"])["nb_articles"];
}else{
  $listeArticles = $Article->recupererArticles($premier, $parPage);
  $nbArticle = (int) $Article->compterArticle()["nb_articles"];

}

// On calcule le nombre de pages total
$pages = ceil($nbArticle / $parPage);


if($_SESSION){
  $idClient = $_SESSION['idClient'];
}else{
  $idClient = False;
}
?>
<body>
  <div class="container">
    <div class="row">
      <?php foreach ($listeArticles as $article) { ?>        
          <div class="col-md-6">
            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div class="col-4">
                  <a href="article.php?idart=<?php echo($article['idArticle']);?>">
                  <img class="card-img" src="<?php echo($article['image']) ?>">
                  </a>
                </div>  
                <div class="col-8">
                  <div class="card-body">
                    <a href="article.php?idart=<?php echo($article['idArticle']);?>">
                      <h5 class="card-title"><?php echo($article['nom']) ?></h5>
                      <p class="card-text"><?php echo($article['prix']) ?> €</p>
                    </a>
                    <hr>
                    <?php
                    if ($Panier->verifPanier($article['idArticle'], $idClient)){
                      ?> <p style="color: green">Vous avez déjà acheté l'article</p> <?php
                    }else{
                      if ($_SESSION == False){
                        echo"<p>Veuillez vous connecter pour ajouter au panier</p>";
                      }else{
                        if ($article['quantite']>0) {
                        ?>
                        <!-- <form method="POST" action="traitements\ajouter.php">
                          <input type="text" hidden="True" name="idart" value=<?php// echo($article['idArticle']); ?>>
                          <input type="text" hidden="True" name="qart" value=1>
                          <button class="btn btn-warning" type="submit">ajouter au panier</button>
                        </form>  -->
                        <?php
                        }else{
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