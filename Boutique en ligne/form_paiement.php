<?php
session_start();
$afficher_categories = false;

include('header.html');
include('navbarHaut.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Checkout example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #input-date{
          display:flex;
      }
      .btn.btn-primary
      {
          margin:15px;
          height:40px;
          text-align:center;
      }
      form{
          margin: 100px;
      }



    </style>

    
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body> 

          <h4 class="mb-3" style="margin-left:100px; margin-top:50px;">Paiement</h4>
        <form action="traitements/paiement.php" method="POST">
          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Carte de crédit</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Carte de débit</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-3">
              <label for="cc-name" class="form-label">Nom</label>
              <input type="text" name="nom" class="form-control" id="cc-name" placeholder="Entrez votre nom" required>
              <small class="text-muted">Nom complet</small>
            </div>

            <div class="col-md-3">
              <label for="cc-number" class="form-label">Numéro de carte</label>
              <input type="text" name="numero_de_carte" class="form-control" id="cc-number" placeholder="XXXX XXXX XXXX XXXX" required>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Date d'expiration</label>
                <div id="input-date" class="input-group">
                <select name="mois" id="pet-select">
                <option value="">Mois</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select name="annee" id="pet-select">
                <option value="">Année</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
            </select>
                </div>
            
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" name="cvv" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
              </div>
            </div>
          </div>


          <button class="btn btn-primary" type="submit">Valider</button>
        </form>
      </div>
    </div>
  </main>
  </body>
  </html>


<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

      <script src="form-validation.js"></script>


      <script>
  const divAlt = document.querySelector('.alert.alert-success')
  const icon = document.querySelector('.icon-c-wrapper')
  if (divAlt){
    icon.innerHTML = '<i class="fas fa-envelope"></i>'
  }

</script>

</html>
