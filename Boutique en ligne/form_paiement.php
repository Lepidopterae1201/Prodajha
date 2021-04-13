<?php
session_start();
$afficher_searchbar = false;

include('header.html');
include('navbarHaut.php');

?>
<body>
  <div class="container">
    <div class="row">
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
                  <select name="mois">
                    <option value="">Mois</option>
                    <?php
                    for ($i=1; $i<13; $i++){
                      echo("<option value='".strval($i)."'>". strval($i)."</option>");
                    }
                    ?>
                  </select>
                  <select name="annee">
                      <option value="">Année</option>
                        <?php
                        for ($i=2021; $i<2042; $i++){
                          echo "<option value='".strval($i)."'>".strval($i)."</option>";
                        }
                        ?>
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
  </body>
  </html>

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

<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>
</html>
