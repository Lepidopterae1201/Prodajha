<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Accueil</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <?php
        include('navbarHaut.php');
      ?>
    </header>
    <?php
      include('cardArticle.php');
    ?>
      <nav>
        <ul class="pagination justify-content-center">
          <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
          <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
              <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
          </li>
          <?php for($page = 1; $page <= $pages; $page++): ?>
              <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
              <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                  <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
              </li>
          <?php endfor ?>
              <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
              <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
              <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
          </li>
        </ul>
      </nav>
  </body>
  <style>

    /* unvisited link */
    a:link, a:visited{
    color: black;
    }
        
    .container{
      width: 100%;
      border-radius: 20px;
      }

    .form-control{
      height: 50px;
      }

    .formulaireRow{
      margin-top: 50px;
      }

    .pagination{
      text-align: center;
    }
  </style>
  <!--js bootstrap-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</html>