<?php
session_start();
if($_SESSION == False) {
	header("location:index.php");
}else{
require_once('modeles/Panier.php');
$Resultat = new Panier();
$resultat = $Resultat->afficherPanier($_SESSION['idClient']);
$afficher_categories = false;
?>
<script>
	let disabled_map = new Map;
	var prix = new Map;
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
				<?php if(empty($resultat)){ ?>
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
				}else{
				foreach ($resultat as $article) {
				?>
				<div id="article<?php echo($article['idArticle'])?>" class="card" style="margin-bottom: 5px;">
					<div class="card-header">
						<h5 class="card-title"><?php echo($article['nom']) ?></h5>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-5 col-md-3">
									<img src="<?php echo($article['image']) ?>" class="img-fluid" >
								</div>
								<div class="col-7 col-md-6">
									<div class="row">
										<div id="prix_article<?php echo($article['idArticle'])?>" class="col-12">
											<script>
												document.write('<h5><?php echo round($article['prix'] * $article['pQuantite'],2);?>€</h5>')
												prix.set("article<?php echo $article['idArticle'];?>", <?php echo $article['prix'] * $article['pQuantite']?>);
											</script>
										</div>
									</div>
									<div class="row">
										<div class="col-8 col-md-8">
											<form method="POST" action="traitements/modifierQuantitePanier.php">
												<input id="idA_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo $article['idArticle'];?>>
												<input id="idC_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idC" value=<?php echo $article['idClient'];?>>
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
												if ($article['aQuantite']==0) {
													?><script>disabled_map.set("article<?php echo $article['idArticle']?>",true);</script>
													<p id="message_article<?php echo($article['idArticle'])?>" style='color: red;'>L'article n'est plus disponible</p>
											<?php
												}else{
													if ($article['aQuantite']<$article['pQuantite']) {
														?><script>disabled_map.set("article<?php echo $article['idArticle']?>",true)</script>
														<p id="message_article<?php echo($article['idArticle'])?>" style='color: red;'>Il n'y a plus assez d'article. Il n'en reste que  <?php echo $article['aQuantite'] ?> </p>
											<?php
													}else{
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
			<?php } } ?>
	    	</div>
	    	<div class="col-md-3 ">
		    	<div class="card mt-2">
		    		<div class="card-body">
						<div class="row">
							<div id="prixTT" class="col-md-12 col-sm-9 col-xs-12">
								<script>
									function calcul_PrixTT(){
										let prixTT = 0;
										prix.forEach(value => prixTT += value);
										return Math.round(prixTT*100)/100;
									}
									var prixTT = calcul_PrixTT();
									document.write('<h2>Montant Total: '+prixTT +'€</h2>');
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
		if (value === true){
			$("#buy_button").prop("disabled", true);
			return true
		}
		$("#buy_button").prop("disabled", false);
	}

	//bouton article_moins.click
	function article_moins(idart){
		idInput = 'nbr_article'+idart;
		var nbr_article = document.getElementById(idInput).value;
		nbr_article = parseInt(nbr_article);
		if (nbr_article > 1){
			nbr_article -=1;
			document.getElementById(idInput).value = nbr_article;
			nbr_article_change(idInput);
		}
	}

	//bouton article_plus.click
	function article_plus(idart){
		idInput = 'nbr_article'+idart;
		var nbr_article = document.getElementById(idInput).value;
		nbr_article = parseInt(nbr_article);
		if (nbr_article <= document.getElementById(idInput).getAttribute('max')){
			nbr_article +=1;
			document.getElementById(idInput).value = nbr_article;
			nbr_article_change(idInput);
		}
	}
</script>

<!--script ajax-->
<script>
// fonction requete ajax modification du nombre d'article
function nbr_article_change(idInput){
	var value = document.getElementById(idInput).value;
	if(value < 1){
		document.getElementById(idInput).value = 1;
		value = 1;
	}else if(value > parseInt(document.getElementById(idInput).getAttribute('max'))){
		document.getElementById(idInput).value = document.getElementById(idInput).getAttribute('max');
		value = document.getElementById(idInput).getAttribute('max');
	}
	var idArticle = document.getElementById('idA_'+idInput).value;
	var idClient = document.getElementById('idC_'+idInput).value;
	var prixArticle = document.getElementById('prix_'+idInput).value;
	$.ajax({
		type : "POST",
		url : 'ajax/modifierQuantitePanier.php',
		data : {
			idC : idClient,
			idA : idArticle,
			qart : value
		},
		dataType:"json",
		success:function(data){
			// recalcul du prix
			nouveau_prix = value * prixArticle;
			nouveau_prix.toFixed(2);
			prix.set("article"+idArticle, nouveau_prix)
			prixTT = calcul_PrixTT();
			document.getElementById('prix_article'+idArticle).innerHTML = "<h5>" + prix.get("article"+idArticle) + "€</h5>"
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total: " + prixTT + "€</h2>";
			//vérification d'erreur
			if(value <= document.getElementById(idInput).getAttribute('max') && disabled_map.get("article"+idArticle) === true){
				disabled_map.set("article"+idArticle, false);
				document.getElementById('message_article'+idArticle).innerHTML = "<p style='color: green;''>Disponible immédiatement</p>";
				disabled_map.forEach(disable_verify);
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
		var idForm = e.target.id;
		e.preventDefault();
		var idArticle = document.getElementById('idA_'+idForm).value;
		var idClient = document.getElementById('idC_'+idForm).value;
		$.ajax({
		type : "POST",
		url : 'ajax/supprimerDuPanier.php',
		data : {
			idC : idClient,
			idA : idArticle,
		},
		dataType:"json",
		success:function(data){
			// supprimer la visibilité de l'article
			article = document.getElementById("article"+idArticle);
			article.remove();
			// recalcul du prix
			prix.delete("article"+idArticle);
			prixTT = calcul_PrixTT();
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total: " + prixTT + "€</h2>";
			// vérification si un message d'erreur
			if(disabled_map.get("article"+idArticle) === true){
						disabled_map.set("article"+idArticle, false);
						disabled_map.forEach(disable_verify);
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
		nbr_article_change(idInput);
	});
});
</script>
<?php } //end "if connected"?>