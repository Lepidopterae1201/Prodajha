<?php
session_start();
$afficher_searchbar = false;

include('header.html');
include('navbarHaut.php');

?>
<div class="container">
 <div class="c-wrapper">
    <div class="icon-c-wrapper">
    <i class="fas fa-envelope-open"></i>
    <p class='text'>@support</p>
    </div>
 
    <div class='form-c-wrapper'>
      <?php
        if (isset($_GET['ERREUR'])){ //si on n'a pas rempli tous les champs
      ?>
          <div class="alert alert-danger" role="alert">
            Veuillez compléter tous les champs !
          </div>
      <?php
        } 
        if (isset($_GET['VALID'])){ //si le message a été envoyé
      ?>
          <div class="alert alert-success" role="alert">
            Message envoyé avec succès !
          </div>
      <?php
        }
      ?>
        <form  method='POST' action='./traitements/envoi_formulaire.php'>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Sujet" name="sujet"> <!--Sujet du message-->
        </div>
        <div class="form-group">
          <textarea class="form-control"   placeholder="Message" rows="4" name="message"></textarea> <!--Message-->
        </div>
        <button type="submit">Envoyer</button> <!--Envoyer le message-->
      </form>
    </div>
  </div>
</div><!-- // End .container -->


<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

