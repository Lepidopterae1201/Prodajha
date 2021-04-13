<?php

session_start();
if ($_SESSION == False) { //si on est pas connecté
	header("location:index.php");
} else {
	require_once('modeles/ListeSouhait.php'); //si on est connecté"
	$Resultat = new ListeSouhait();
	$resultat = $Resultat->afficherListeSouhait($_SESSION['idClient']); //Tous les articles de la liste de souhait
	$afficher_searchbar = false; //On n'affiche pas la barre de recherche
?>
	<html>
	<?php include('header.html'); ?>
	<body>
		<header>
			<?php
			include('navbarHaut.php');
			?>
		</header>
		<div class="col-md-8">
			<?php if (empty($resultat)) { // si aucun article dans la liste de souhait ?>
				<ul class="list-group list group-flush">
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-9 col-xs-12">
								<h5 class="mr-auto">Votre liste de souhait est vide</h5>
							</div>
							<div class="col-sm-3 col-xs-12">
								<a class="btn btn-warning ml-auto" href="index.php">Retour à l'accueil</a>
							</div>
						</div>
					</li>
				</ul>
				<?php
			} else { // s'il y a au moins un article dans la liste de souhait
				foreach ($resultat as $article) { //Pour chaque résultat de la recherche ?>
					<div id="article<?php echo ($article['idArticle']) ?>" class="card" style="margin-bottom: 5px;">
						<div class="card-header"> 
							<h5 class="card-title"><a href="article.php?idart=<?php echo($article['idArticle']);?>"><?php echo ($article['nom']) ?></a></h5> <!--Nom de l'article-->
						</div>
						<div class="card-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-5 col-md-3">
										<a href="article.php?idart=<?php echo($article['idArticle']);?>">
											<img src="<?php echo ($article['image']) ?>" class="img-fluid"> <!--image de l'article-->
										</a>
									</div>
									<div class="col-7 col-md-6">
										<div class="row">
											<!--Aller sur la page de l'article-->
											<a class="btn btn-warning btn-sm" href="article.php?idart=<?php echo($article['idArticle']);?>">Voir l'article</a>
										</div>
										<div class="row">
											<!--Bouton supprimer de la liste de souhait-->
											<form id="delete<?php echo ($article['idArticle']) ?>" class="deleteForm" method="POST" action="#">
												<input id="idart_delete<?php echo ($article['idArticle']) ?>" type="text" hidden="True" name="idart" value=<?php echo ($article['idArticle']); ?>>
												<button class="btn btn-outline-secondary btn-sm" type="submit">supprimer</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } //end foreach
				} //end else il y a au moins un article dans la liste de souhait
			?>
		</div>
	</body>

	</html>

	<style type="text/css">
		img {
			max-height: 150px;
		}

		.content {
			margin: 10px;
		}
 		
		 /* unvisited link */
		a:link,
		a:visited {
			color: black;
  		}
	</style>

	<script src="static/jquery-3.5.1.min.js"></script>

	<script>
		$(document).ready(function() {
			$(".deleteForm").submit(function(e) { //Quand on supprime l'article de la liste de souhait
				var idForm = e.target.id; //id de la card
				e.preventDefault();
				var idArticle = document.getElementById('idart_' + idForm).value; //id de l'article
				$.ajax({
					type: "POST",
					url: 'ajax/supprimerSouhait.php', //suppression de l'article de la liste de souhait
					data: {
						idart: idArticle,
					},
					dataType: "json",
					success: function(data) {
						article = document.getElementById("article" + idArticle);
						article.remove(); //suppression de la card de l'article supprimé
					},
					error: function() {
						console.log("ERREUR");
					}
				});
			});
		});
	</script>
<?php } ?>