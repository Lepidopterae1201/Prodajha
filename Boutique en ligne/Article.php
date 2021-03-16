<?php  
session_start();
require_once('modeles/Article.php');
require_once('modeles/Reviews.php');
require_once('modeles/Panier.php');

date_default_timezone_set('Europe/Paris');

$Panier = new Panier();

$Article = new Article();
$art = $Article->afficherArticle($_GET['idart']);
$magasin = $Article->recupVendeur($_GET['idart']);
$afficher_categories = true;


$Review =  new Review();
$rev = $Review->recupCommentaires($_GET['idart']);

if($_SESSION){
  $idClient = $_SESSION['idClient'];
}else{
  $idClient = False;
};
include('header.html')
?>
  <body>
    <header>
      <?php
        include('navbarHaut.php');
      ?>
    </header>

    <?php include('AjoutConfirm.php')?> 

    <div class="container">
      <div class="row">        
        <!-- Article -->

        <div class="col-lg-9">
          <div class="card mt-4">
            <img class="img-fluid" src="<?php echo $art['image']; ?>" alt="image de l'article"/>
            <div class="card-body">
              <h3 class="card-title"><?php echo $art['nom']; ?></h3>
              <h4> <?php echo $art['prix'];?> € </h4>
              <h5>Vendeurs : <?php echo $magasin['nom']; ?></h5>
              <p class="card-text"><?php echo $art['description'];?></p>
              <br>
              <?php
              if ($_SESSION) {
                if ($art['quantite']<=0) {
              ?>  <p style="color: red">L'article est épuisé</p>  <?php
                }elseif ($Panier->verifPanier($_GET['idart'], $idClient)){
                  ?> <p style="color: green">Vous avez déjà acheté l'article</p> <?php
                }else{?>
                <div id="articleForm">
                  <form id="articleForm" method="POST" action="#">
                    <input type="text" hidden="True" name="idart" value=<?php echo($art['idArticle']);?>>
                    <?php echo "<input type='number' name='qart' min=1 max=".$art['quantite']." value=1>";?>
                    <button class="btn btn-warning" type="submit">Ajouter au panier</button>
                  </form>
                </div><?php
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

              <!--Espace de saisie de commentaire-->

              <?php if($_SESSION){?>
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
                <?php }else{ ?>
                  <h4>Veuillez vous connecter pour envoyer un commentaire</h4>
                  <a class="btn btn-secondary" href="connexion.php?page=Article&idart=<?php echo($_GET['idart'])?>">Se connecter</a>
                <?php } ?>
                <hr/>

              <!--espace commentaire-->

              <div class="conversation">
                <?php
                  $i = 0; 
                    foreach($rev as $review){
                      $i++;
                      $date = new DateTime($review['dateReview']);
                      $dateReview = $date->format('d/m/Y');?>
                      <div class="reviewAutre" >
                        <b><?= $review['pseudo']; ?></b>
                        <small><?= $dateReview; ?></small><br/><br/>
                        <?= $review['contenu']; ?><hr/>
                      </div>
                  <?php } ?>
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
    
    .formulaire.row{
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
      }
    
</style>

<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

<!--script ajax-->
<script>
$(document).ready(function(){
  $("#articleForm").submit(function(e){
    e.preventDefault();
    var idart = $('#articleForm input[name="idart"]').val();
    var qart = $('#articleForm input[name="qart"]').val();
    $.ajax({
      type : "POST",
      url : 'ajax/ajouterInPanier.php',
      data : {
          qart : qart,
          idart : idart,
      },
      dataType:"json",
      success:function(data){
        // ouvre la popup
        $('#AjoutTrue').modal('show');
        document.getElementById("articleForm").innerHTML = "<p style='color: green'>Vous avez déjà acheté l'article</p>";
      } ,
      error: function(){
        console.log("ERREUR");
      }
    });
  });
});
</script>