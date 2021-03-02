<?php

session_start();
if($_SESSION == False) {
	header("location:index.php");
}else{
require_once('modeles/ListeSouhait.php');
$Resultat = new ListeSouhait();
$resultat = $Resultat->afficherListeSouhait($_SESSION['idClient']);
}

include('header.html');
$afficher_categories = false;
require_once("modeles/Article.php");

$Article = new Article()
?>

<body>
	<header>
		<?php include('navbarHaut.php') ?>
	</header>
	<div class="container">
		<div class="row">
			<?php foreach ($Article as $article) { ?>
			<div class="coll-md-6" style="max-width: 540px;">
				<div class="row no-gitters">
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