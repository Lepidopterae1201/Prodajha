<?php  
session_start();
if($_SESSION == False) {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ajout confirmer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="Bootstrap/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

  <body>
      <div style="height: 90vh;" class="d-flex justify-content-center align-items-center">
        <div class="card">
          <div class="card-header" style="background-color: rgb(40,40,40);">
            <h4 style="text-align: center; color: whitesmoke;">Article ajouter au panier !</h4>
          </div>
          <div class="card-body"style="background-color: rgb(84,84,84);" >
            <div class="container">
              <div class="row justify-content-center">
                <h6 style="color: whitesmoke;">Votre article à été ajouté à votre panier avec succès</h6>
              </div>
              <br>
              <div class="container">
                <div class="row">
                  <div class="mx-auto" style="text-align:center; margin-bottom:10px">
                    <a class="btn btn-warning" style="width: 200px;" href='panier.php'>Aller au panier</a>                
                  </div>
                </div>
                <div class="row">
                  <div class="mx-auto" style="text-align:center; margin-bottom:10px">
                    <a class="btn btn-warning" style="width: 200px;" href='index.php'>Continuer vos achats</a>               
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>