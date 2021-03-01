<?php  
session_start();
include('header.html');

$afficher_categories = true
?>
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
<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

</html>