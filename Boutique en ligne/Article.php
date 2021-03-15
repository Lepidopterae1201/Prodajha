<?php
session_start();
require_once('modeles/Article.php');
require_once('modeles/Reviews.php');
require_once('modeles/Panier.php');
require_once('modeles/ListeSouhait.php');

date_default_timezone_set('Europe/Paris');

$Panier = new Panier();




$Article = new Article();
$art = $Article->afficherArticle($_GET['idart']);
$magasin = $Article->recupVendeur($_GET['idart']);
$afficher_categories = true;


$Review =  new Review();
$rev = $Review->recupCommentaires($_GET['idart']);

if ($_SESSION) {
  $idClient = $_SESSION['idClient'];
} else {
  $idClient = False;
};
$Liste = new ListeSouhait();
$souhait = $Liste->articleInListeSouhait($idClient, $_GET['idart']);


include('header.html')
?>

<body>
  <header>
    <?php
    include('navbarHaut.php');
    ?>
  </header>

  <?php include('AjoutConfirm.php') ?>

  <div class="container">
    <div class="row">
      <!-- Article -->

      <div class="col-lg-9">
        <div class="card mt-4">
          <img class="img-fluid" src="<?php echo $art['image']; ?>" alt="image de l'article" />
          <div class="card-body">
            <h3 class="card-title"><?php echo $art['nom']; ?></h3>
            <h4> <?php echo $art['prix']; ?> € </h4>
            <h5>Vendeurs : <?php echo $magasin['nom']; ?></h5>
            <p class="card-text"><?php echo $art['description']; ?></p>
            <br>
            <?php
            if ($_SESSION) {
              if ($art['quantite'] <= 0) {
            ?> <p style="color: red">L'article est épuisé</p> <?php
                                                            } elseif ($Panier->verifPanier($_GET['idart'], $idClient)) {
                                                              ?> <p style="color: green">Vous avez déjà acheté l'article</p> <?php
                                                                                                                            } else { ?>
                <div class="row g-3">
                  <div id="articleForm">
                    <div class="col-auto">
                      <input id="idArt" type="text" hidden="True" name="idart" value=<?php echo ($art['idArticle']); ?>>
                      <?php echo "<input id='qArt' type='number' name='qart' min=1 max=" . $art['quantite'] . " value=1>"; ?>
                      <button id="get_in_panier" class="btn btn-warning" type="submit">Ajouter au panier</button>

                    </div>
                  </div>

                  <div id="articleSouhait">
                    <div class="col-auto">
                      <input id="idArt" type="text" hidden="True" name="idart" value=<?php echo ($art['idArticle']); ?>>
                      <?php if ($souhait == True) { ?>
                        <button id="Souhait" class="btn btn-warning" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                          </svg>
                        </button> <?php
                                                                                                                              } else { ?>
                        <button id="Souhait" class="btn btn-warning" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                          </svg>
                        </button> <?php } ?>
                    </div>
                  </div>
                </div>
              <?php
                                                                                                                            }
                                                                                                                          } else {
              ?><a class="btn btn-secondary" href="connexion.php?page=Article&idart=<?php echo ($_GET['idart']) ?>">Se connecter</a><?php
                                                                                                                                  } ?>
          </div>
        </div>

        <!-- Commentaire -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Product Reviews
          </div>
          <div class="card-body">

            <!--Espace de saisie de commentaire-->

            <?php if ($_SESSION) { ?>
              <div class="message" id="message">
                <form method="POST" action="traitements\review.php">
                  <?php
                  if (isset($_GET['message'])) {
                    if ($_GET['message'] == 'erreur1') {
                      echo "<p style='color: red;'>Le message ou l'auteur est vide</p>";
                    }
                  }
                  ?>
                  <input name="idArticle" hidden="True" value=<?php echo ($art["idArticle"]) ?>></input>
                  <div class="row" style="margin: 10px;">
                    <div class="col-md-6">
                      <textarea name="review" class="form-control" style="resize:none; overflow-y: auto;" rows="5" placeholder="Ecrire un message ..."></textarea>
                    </div>
                    <div class="col-md-6">
                      <?php
                      if ($_SESSION) {
                        echo '<input type="text" name="pseudo" class="form-control" readonly Value="' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . '"/>';
                      } else {
                        echo '<input type="text" name="pseudo" class="form-control" placeholder="Nom d\'utilisateur..."/>';
                      }
                      ?>
                      <br />
                      <button type="submit" class="btn btn-primary" style="width:100%">ENVOYER LE MESSAGE</button>
                    </div>
                  </div>
                </form>
              </div>
            <?php } else { ?>
              <h4>Veuillez vous connecter pour envoyer un commentaire</h4>
              <a class="btn btn-secondary" href="connexion.php?page=Article&idart=<?php echo ($_GET['idart']) ?>">Se connecter</a>
            <?php } ?>
            <hr />

            <!--espace commentaire-->

            <div class="conversation">
              <?php
              $i = 0;
              foreach ($rev as $review) {
                $i++;
                $date = new DateTime($review['dateReview']);
                $dateReview = $date->format('d/m/Y/ G:i'); ?>
                <div class="reviewAutre">
                  <b><?= $review['pseudo']; ?></b>
                  <small><?= $dateReview; ?></small><br /><br />
                  <?= $review['contenu']; ?>
                  <hr />
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
  a:link,
  a:visited {
    color: black;
  }

  .container {
    width: 100%;
    border-radius: 20px;
  }

  img {
    width: 50%;
    height: auto;
    margin-left: 25%;
  }

  .form-control {
    height: 50px;
  }

  .formulaire.row {
    margin-top: 50px;
  }

  .conversation {
    margin-top: 50px;
    background-color: white;
    height: 70%;
    border-radius: 20px;
    padding: 20px;
    overflow-y: auto;
  }

  .message {
    margin-top: 30px;
    background-color: white;
    border-radius: 20px;
    overflow-y: auto;
  }

  .messageAutre {
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
  $(document).ready(function() {
    $("#get_in_panier").on('click', function() {
      var idart = $('#idArt').val();
      var qart = $('#qArt').val();
      $.ajax({
        type: "POST",
        url: 'ajax/ajouterInPanier.php',
        data: {
          qart: qart,
          idart: idart,
        },
        dataType: "json",
        success: function(data) {
          document.getElementById("articleForm").innerHTML = "<p style='color: green'>Vous avez déjà acheté l'article</p>";
        },
        error: function() {
          console.log("ERREUR");
        }
      });
    });
  });

  $(document).ready(function() {
    $("#Souhait").on('click', function() {
      var idart = $('#idArt').val();
      var idclient = <?php echo $idClient ?>;
      $.ajax({
        type: "POST",
        url: 'ajax/listeSouhait.php',
        data: {
          idart: idart,
          idC: idclient,
        },
        dataType: "json",
        success: function(data) {
          console.log(data.action);
          if (action = 'del') {
            document.getElementById("articleSouhait").children = '<svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-star" viewBox = "0 0 16 16"> <path d = "M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" / > </svg>'
          }else if(action = 'add'){
            document.getElementById("articleSouhait").children = '<svg xmlns="http: //www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path d = "M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" / > </svg>';
          }
        },
        error: function() {
          console.log("ERREUR");
        }
      })
    })
  })

</script>