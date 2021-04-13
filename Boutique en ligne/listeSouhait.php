<?php

session_start();
if ($_SESSION == False) {
	header("location:index.php");
} else {
	require_once('modeles/ListeSouhait.php');
	$Resultat = new ListeSouhait();
	$resultat = $Resultat->afficherListeSouhait($_SESSION['idClient']);
	$afficher_categories = false;
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
			<?php if (empty($resultat)) { ?>
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
			} else {
				foreach ($resultat as $article) { ?>
					<div id="article<?php echo ($article['idArticle']) ?>" class="card" style="margin-bottom: 5px;">
						<div class="card-header">
							<h5 class="card-title"><a href="article.php?idart=<?php echo($article['idArticle']);?>"><?php echo ($article['nom']) ?></a></h5>
						</div>
						<div class="card-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-5 col-md-3">
										<a href="article.php?idart=<?php echo($article['idArticle']);?>">
											<img src="<?php echo ($article['image']) ?>" class="img-fluid">
										</a>
									</div>
									<div class="col-7 col-md-6">
										<div class="row">
											<div class="col-12 col-ld-4">
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
					</div>
				<?php } ?>
			<?php }
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
	</style>

	<script src="static/jquery-3.5.1.min.js"></script>

	<script>
		$(document).ready(function() {
			$(".deleteForm").submit(function(e) {
				var idForm = e.target.id;
				e.preventDefault();
				var idArticle = document.getElementById('idart_' + idForm).value;
				$.ajax({
					type: "POST",
					url: 'ajax/supprimerSouhait.php',
					data: {
						idart: idArticle,
					},
					dataType: "json",
					success: function(data) {
						article = document.getElementById("article" + idArticle);
						article.remove();
					},
					error: function() {
						console.log("ERREUR");
					}
				});
			});
		});
	</script>


<?php } ?>