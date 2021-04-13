<?php
session_start();
if($_SESSION == False) {
	header("location:index.php");
}else{
require_once('modeles/Panier.php');
$Resultat = new Panier();
$resultat = $Resultat->afficherPanier($_SESSION['idClient']);
$afficher_searchbar = false;
?>
<script>
	let disabled_map = new Map; // dictionnaire contenant toutes les erreurs du panier pour disable ou non le boutton de "passer la commande"
	var prix = new Map; //dictionnaire des prix pour calculer le prix total
</script>
<?php include('header.html'); ?>
  <body>
    <header>
      <?php
        include('navbarHaut.php');
      ?>
    </header>
    <br>
    <div class="content">
	    <div class="row">      
	      	<div class="col-md-8">    		
				<?php 
				if(empty($resultat)){ //s'il n'y a pas d'article dans le panier?>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<div class="row">
								<div class="col-sm-9 col-xs-12">
								<h5 class="mr-auto">Votre panier est vide</h5>
								</div>
								<div class="col-sm-3 col-xs-12">
								<a class="btn btn-warning ml-auto" href="index.php">Faire des achats</a>
								</div>
							</div>
						</li>
					</ul>
					<script>
						disabled_map.set("nothing", true);
					</script>
				<?php
				}else{ //s'il y a au moins un article dans le panier
					foreach ($resultat as $article) { //pour chaque article dans le panier
					?>
					<div id="article<?php echo($article['idArticle'])?>" class="card" style="margin-bottom: 5px;">
						<div class="card-header">
							<h5 class="card-title"><?php echo($article['nom']) ?></h5> <!--Nom de l'article-->
						</div>
						<div class="card-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-5 col-md-3">
										<img src="<?php echo($article['image']) ?>" class="img-fluid" > <!--image de l'article-->
									</div>
									<div class="col-7 col-md-6">
										<div class="row">
											<div id="prix_article<?php echo($article['idArticle'])?>" class="col-12"> <!--prix de l'article-->
												<script>
													//on affiche le prix
													document.write('<h5><?php echo round($article['prix'] * $article['pQuantite'],2);?>€</h5>')
													//on ajoute le prix au dictionnaire
													prix.set("article<?php echo $article['idArticle'];?>", <?php echo $article['prix'] * $article['pQuantite']?>);
												</script>
											</div>
										</div>
										<div class="row">
											<div class="col-8 col-md-8">
												<form method="POST" action="traitements/modifierQuantitePanier.php"> <!--Modifier le nombre d'article dans le panier-->
													<input id="idA_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo $article['idArticle'];?>>
													<input id="prix_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="prix" value=<?php echo $article['prix'];?>>
													<div class="input-group">
														<input id="nbr_article<?php echo($article['idArticle'])?>" class="nbr_article_modif form-control" type='number' name='qart' min=1 max=<?php echo ($article['aQuantite'] . " value=" . $article['pQuantite'])?>>
														<div class="input-group-append">
															<button class="nbrArticleMoins btn btn-outline-dark" type="button" onclick="article_moins(<?php echo($article['idArticle'])?>)">-</button>
															<button class="nbrArticlePlus btn btn-outline-dark" type="button" onclick="article_plus(<?php echo($article['idArticle'])?>)">+</button>
														</div>
													</div>
												</form>
											</div>
											<div class="col-12 col-md-4">
												<form id="delete<?php echo($article['idArticle'])?>" class="deleteForm" method="POST" action="traitement\supprimerDuPanier.php">
													<input id="idA_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo($article['idArticle']);?>>
													<input id="idC_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idC" value=<?php echo($article['idClient']);?>>
													<button  class="btn btn-outline-secondary btn-sm" type="submit">supprimer</button>
												</form>
											</div>
										</div>
										<div class="row">
											<div class="col-12">	
												<?php 
													if ($article['aQuantite']==0) { //s'il n'y a plus d'article
														?><script>disabled_map.set("article<?php echo $article['idArticle']?>",true);</script>
														<p id="message_article<?php echo($article['idArticle'])?>" style='color: red;'>L'article n'est plus disponible</p>
												<?php
													}else{
														if ($article['aQuantite']<$article['pQuantite']) { // si le nombre d'article dans le panier est supérieur au nombre d'article disponible
															?><script>disabled_map.set("article<?php echo $article['idArticle']?>",true)</script>
															<p id="message_article<?php echo($article['idArticle'])?>" style='color: red;'>Il n'y a plus assez d'article. Il n'en reste que  <?php echo $article['aQuantite'] ?> </p>
												<?php
														}else{ //si l'article est disponible
												?>
															<p id="message_article<?php echo($article['idArticle'])?>" style='color: green;'>Disponible immédiatement</p>
												<?php
														}
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php 
				} 
			} 
			?>
	    	</div>
	    	<div class="col-md-3 ">
		    	<div class="card mt-2">
		    		<div class="card-body">
						<div class="row">
							<div id="prixTT" class="col-md-12 col-sm-9 col-xs-12">
								<script>
									function calcul_PrixTT(){ //calcul le prix total
										let prixTT = 0;
										prix.forEach(value => prixTT += value); //additionne les prix de chaque article
										return Math.round(prixTT*100)/100; //arrondi le résultat
									}
									var prixTT = calcul_PrixTT();
									document.write('<h2>Montant Total: '+prixTT +'€</h2>'); //écrit le prix total
								</script>
							</div>
							<div class="col-md-12 col-sm-3 col-xs-12" >
							<a href="form_paiement.php"><button id="buy_button" class='btn btn-warning'>Valider ma commande</button></a>	
							</div>
						</div>		        	
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
</body>
</html>
<style type="text/css">
	img{
		max-height: 150px;
	}
	.content{
		margin: 10px;
	}
</style>
<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

<!-- scripts js-->
<script>
	// verification si un article est disable dans le dictionnaire
	function disable_verify(value, key, map){
		if (value === true){ // si une valeur est à true, on disable le bouton de passage de commande
			$("#buy_button").prop("disabled", true);
			return true
		}
		$("#buy_button").prop("disabled", false); // si aucune erreur, on autorise le passage de commande
	}

	//bouton article_moins.click
	function article_moins(idart){
		idInput = 'nbr_article'+idart;
		var nbr_article = document.getElementById(idInput).value; //on récupère la quantité de l'article modifié
		nbr_article = parseInt(nbr_article);
		if (nbr_article > 1){ //si le nombre d'article a commandé est supérieur à 1
			nbr_article -=1; //on soustrait 1 au nombre d'article commandé
			document.getElementById(idInput).value = nbr_article;
			nbr_article_change(idInput); //on lance la fonction ajax
		}
	}

	//bouton article_plus.click
	function article_plus(idart){
		idInput = 'nbr_article'+idart;
		var nbr_article = document.getElementById(idInput).value; //on récupère la quantité de l'article modifié
		nbr_article = parseInt(nbr_article);
		if (nbr_article <= document.getElementById(idInput).getAttribute('max')){ //si le nombre d'article a commandé ne dépasse pas le maximum autorisé
			nbr_article +=1; //on ajoute 1 au nombre d'article commandé
			document.getElementById(idInput).value = nbr_article;
			nbr_article_change(idInput); //on lance la fonction ajax
		}
	}
</script>

<!--script ajax-->
<script>
// fonction requete ajax modification du nombre d'article
function nbr_article_change(idInput){
	var value = document.getElementById(idInput).value; //on récupère la quantité de l'article modifié
	if(value < 1){ // s'il y a moins d'1 article, on le définit à 1
		document.getElementById(idInput).value = 1;
		value = 1;
	}else if(value > parseInt(document.getElementById(idInput).getAttribute('max'))){ //s'il la quantité d'article est supérieur au nombre d'article possible, on le défini au max
		document.getElementById(idInput).value = document.getElementById(idInput).getAttribute('max');
		value = document.getElementById(idInput).getAttribute('max');
	}
	var idArticle = document.getElementById('idA_'+idInput).value; //on récupère l'id de l'article
	var prixArticle = document.getElementById('prix_'+idInput).value; //on récupère le prix de l'article
	$.ajax({
		type : "POST",
		url : 'ajax/modifierQuantitePanier.php',
		data : {
			idA : idArticle,
			qart : value
		},
		dataType:"json",
		success:function(data){
			// recalcul du prix
			nouveau_prix = value * prixArticle;
			nouveau_prix.toFixed(2); //prix avec 2 décimales
			prix.set("article"+idArticle, nouveau_prix) //On change le prix de l'article dans le dictionnaire
			prixTT = calcul_PrixTT(); //on recalcule le prix total
			//on modifie le prix de l'article
			document.getElementById('prix_article'+idArticle).innerHTML = "<h5>" + prix.get("article"+idArticle) + "€</h5>"
			//On modifie le prix total
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total: " + prixTT + "€</h2>";
			//vérification de si l'article est enregistré comme erreur dans le dictionnaire disable_map
			if(value <= document.getElementById(idInput).getAttribute('max') && disabled_map.get("article"+idArticle) === true){ //si l'article était considéré comme une erreur et qu'il ne l'est plus
				disabled_map.set("article"+idArticle, false); //on l'inscrit comme n'étant plus une erreur
				document.getElementById('message_article'+idArticle).innerHTML = "<p style='color: green;''>Disponible immédiatement</p>";
				disabled_map.forEach(disable_verify); // on relance la vérification d'erreur
			}
			
		},
		error: function(){
			console.log("ERREUR");
		}
	});
}

$(document).ready(function(){

	disabled_map.forEach(disable_verify);

	// si l'on supprime un article
  	$(".deleteForm").submit(function(e){
		var idForm = e.target.id; //on récupère l'id l'article modifié
		e.preventDefault();
		var idArticle = document.getElementById('idA_'+idForm).value; //on récupère l'id de l'article
		$.ajax({
		type : "POST",
		url : 'ajax/supprimerDuPanier.php',
		data : {
			idA : idArticle,
		},
		dataType:"json",
		success:function(data){
			// supprimer la visibilité de l'article
			article = document.getElementById("article"+idArticle);
			article.remove();
			// recalcul du prix
			prix.delete("article"+idArticle); //on supprime l'article du dictionnaire des prix
			prixTT = calcul_PrixTT(); //on recalcul le prix total
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total: " + prixTT + "€</h2>";
			// vérification si un message d'erreur
			if(disabled_map.get("article"+idArticle) === true){ //si l'article était enregistré comme une erreur, on let set comme n'en étant plus une
						disabled_map.set("article"+idArticle, false); //on l'inscrit comme n'étant plus une erreur
						disabled_map.forEach(disable_verify); // on relance la vérification d'erreur
					}
		},
		error: function(){
			console.log("ERREUR");
		}
		});
	});

	// si l'on modifie l'input du nombre d'article
	$(".nbr_article_modif").on('change', function(e){
		var idInput = e.target.id;
		nbr_article_change(idInput); //on lance la fonction ajax
	});
});
</script>
<?php } //end "if connected"?>