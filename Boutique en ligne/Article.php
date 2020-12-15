<?php  
session_start();
require_once('modeles/Article.php');
require_once('modeles/Reviews.php');
require_once('modeles/Panier.php');

date_default_timezone_set('Europe/Paris');

$Panier = new Panier();

$Article = new Article();
$art = $Article->afficherArticle($_GET['idart']);
$Review =  new Review();
$rev = $Review->recupCommentaires($_GET['idart']);

if($_SESSION){
  $idClient = $_SESSION['idClient'];
}else{
  $idClient = False;
};

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Article</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="Bootstrap/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <?php
        include('navbarHaut.php');
      ?>
    </header>
    <div class="container">
      <div class="row">        
        <!-- Article -->

        <div class="col-lg-9">
          <div class="card mt-4">
            <img class="img-fluid" src="<?php echo $art['image']; ?>" alt="image de l'article"/>
            <div class="card-body">
              <h3 class="card-title"><?php echo $art['nom']; ?></h3>
              <h4> <?php echo $art['prix'];?> € </h4>
              <p class="card-text"><?php echo $art['description'];?></p>
              <br>
              <?php
              if ($_SESSION) {
                if ($art['quantite']<=0) {
              ?>  <p style="color: red">L'article est épuisé</p>  <?php
                }elseif ($Panier->verifPanier($_GET['idart'], $idClient)){
                  ?> <p style="color: green">Vous avez déjà acheté l'article</p> <?php
                }else{
                ?><form method="POST" action="traitements/ajouter.php">
                  <input type="text" hidden="True" name="idart" value=<?php echo($art['idArticle']);?>>
                  <?php echo "<input type='number' name='qart' min=1 max=".$art['quantite']." value=1>";?>
                  <button class="btn btn-warning" type="submit">Ajouter au panier</button>
                </form><?php
                }
              }else{
                ?><a class="btn btn-secondary" href="connexion.php?page=Article&idart=<?php echo($_GET['idart'])?>">Se connecter</a><?php
              }?>
            </div>
          </div>

          <!-- Commentaire -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Product Reviews
            </div>
            <div class="card-body">
              <div class="conversation">
                  <?php
                      $i = 0; 
                      foreach($rev as $review){
                          $i++;
                          $date = new DateTime($review['dateReview']);
                          $dateReview = $date->format('d/m/Y');
                          ?>
                          <div class="reviewAutre" >
                              <b><?= $review['pseudo']; ?></b>
                              <small><?= $dateReview; ?></small><br/><br/>
                              <?= $review['contenu']; ?><hr/>
                          </div>
                          <?php
                      }
                  ?>
              </div>
              <hr>
              <div class="message" id="message">
                  <form method="POST" action="traitements\review.php">
                    <?php
                      if (isset($_GET['message'])) {
                        if ($_GET['message']=='erreur1') {
                          echo"<p style='color: red;'>Le message ou l'auteur est vide</p>";
                        }
                      }
                    ?>
                    <input name="idArticle" hidden="True" value=<?php echo($art["idArticle"]) ?>></input>
                      <div class="row" style="margin: 10px;">
                          <div class="col-md-6">
                              <textarea name="review" class="form-control" style="resize:none; overflow-y: auto;" rows="5" placeholder="Ecrire un message ..."></textarea>
                          </div>
                          <div class="col-md-6">
                            <?php 
                            if($_SESSION){
                              echo'<input type="text" name="pseudo" class="form-control" readonly Value="'.$_SESSION['nom'].' '.$_SESSION['prenom'].'"/>';
                              }else{
                                echo'<input type="text" name="pseudo" class="form-control" placeholder="Nom d\'utilisateur..."/>';
                              }
                              ?>
                              <br/>
                              <button type="submit" class="btn btn-primary" style="width:100%">ENVOYER LE MESSAGE</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--container-->
    </div>
  </body>  
</html>
<style>
    /* unvisited link */
    a:link, a:visited{
    color: black;
    }
        
    .container{
      width: 100%;
      border-radius: 20px;
    }
    
    img{
      width: 50%;
      height: auto;
      margin-left: 25%;
    }

    .form-control{
      height: 50px;
      }

    .formulaireRow{
      margin-top: 50px;
      }
    
    .conversation{
      margin-top: 50px;
      background-color: white;
      height: 70%;
      border-radius: 20px;
      padding:20px;
      overflow-y: auto;
      }

    .message{
      margin-top: 30px;
      background-color: white;
      border-radius: 20px;
      overflow-y: auto;
      }

    .messageAutre{
      background-color: #F5F5F5;
      padding: 10px;
      border-radius: 20px;
      width: 200px;
      margin-top: 10px;
      }​​
    
</style>