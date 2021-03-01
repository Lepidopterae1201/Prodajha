<?php
session_start();
if($_SESSION == False) {
	header("location:index.php");
}else{
require_once('modeles/Panier.php');
$Resultat = new Panier();
$resultat = $Resultat->afficherPanier($_SESSION['idClient']);
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
	        	<div class="card content">
	        		<div class="card-header">
	        			<div class="container">
		        			<div class="row">
		        				<div class="col-8">
		        					<p class="">articles</p>
		        				</div>
		        				<div class="col-2">
		        					<p class="">nombre</p>
		        				</div>
		        				<div class="col-2">
		        					<p class="">prix</p>
		        				</div>
		        			</div>
		        		</div> 
	        		</div>     		
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
	        		<ul id="article<?php echo($article['idArticle'])?>" class="list-group list-group-flush">
	        			<li class="list-group-item">
							<div class="row">
								<div class="col-2">
									<img src="<?php echo($article['image']) ?>">
								</div>
								<div class="col-6">
									<h5 class="card-title"><?php echo($article['nom']) ?></h5>
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
									<form id="delete<?php echo($article['idArticle'])?>" class="deleteForm" method="POST" action="traitement\supprimerDuPanier.php">
										<input id="idA_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo($article['idArticle']);?>>
										<input id="idC_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idC" value=<?php echo($article['idClient']);?>>
										<button  class="btn btn-outline-secondary btn-sm" type="submit">supprimer</button>
									</form>
								</div>
								<div class="col-2">
									<form method="POST" action="traitements/modifierQuantitePanier.php">
										<input id="idA_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo $article['idArticle'];?>>
										<input id="idC_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idC" value=<?php echo $article['idClient'];?>>
										<input id="prix_nbr_article<?php echo($article['idArticle'])?>" type="text" hidden="True" name="prix" value=<?php echo $article['prix'];?>>
										<input id="nbr_article<?php echo($article['idArticle'])?>" class="nbr_article_modif" type='number' name='qart' min=1 max=<?php echo ($article['aQuantite'] . " value=" . $article['pQuantite'])?>>
										<div class="row" style="margin-top: 10px; margin-left:3px;">
											<button id="<?php echo($article['idArticle'])?>" class="nbrArticleMoins btn btn-sm" type="button" style="margin: 3px;">-</button>
											<button id="<?php echo($article['idArticle'])?>" class="nbrArticlePlus btn btn-sm" type="button" style="margin: 3px;">+</button>
										</div>
									</form>
								</div>
								<div id="prix_article<?php echo($article['idArticle'])?>" class="col-2">
									<script>
										document.write('<p><?php echo $article['prix'] * $article['pQuantite'];?>€</p>')
										prix.set("article<?php echo $article['idArticle'];?>", <?php echo $article['prix'] * $article['pQuantite']?>);
									</script>
								</div>
							</div>
		        		</li>
		        	</ul>
	        	<?php } } ?>
	        	</div>
	    	</div>
	    	<div class="col-md-3">
		    	<div class="card mt-2">
		    		<div class="card-body">
						<div class="row">
							<div id="prixTT" class="col-md-12 col-sm-9 col-xs-12">
								<script>
									function calcul_PrixTT(){
										prixTT = 0
										listPrix = prix.values();
										prix.forEach(value => prixTT += value)
										return prixTT;
									}
									var prixTT = calcul_PrixTT();
									document.write('<h2 >Montant Total: '+prixTT +'€</h2>');
								</script>
							</div>
							<div class="col-md-12 col-sm-3 col-xs-12" >
								<button id="buy_button" class='btn btn-warning'>Valider ma commande</button>
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
		max-height: 100px;
		width: auto;
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
		console.log(disabled_map);
		if (value === true){
			$("#buy_button").prop("disabled", true);
			return true
		}
		$("#buy_button").prop("disabled", false);
	}
</script>

<!--script ajax-->
<script>
$(document).ready(function(){

	console.log(disabled_map);
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
			PrixTT = calcul_PrixTT();
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total: "+prixTT+"€</h2>";
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

	// si l'on modifie le nombre d'article
	$(".nbr_article_modif").bind('keyup mouseup', function(e){
		var idInput = e.target.id;
		var value = document.getElementById(idInput).value;
		if(value <= 0){
			console.log('value<=0');
			$('#'+idInput).val = 1;
		// }else if(value> document.getElementById(idInput).getAttribute('max')){
		// 	console.log('value>max');
		// 	$('#'+idInput).val = document.getElementById(idInput).getAttribute('max');
		}else{
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
					prix.set("article"+idArticle, value * prixArticle)
					prixTT = calcul_PrixTT();
					document.getElementById('prix_article'+idArticle).innerHTML = "<p>" + prix.get("article"+idArticle) + "€</p>"
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
	});
});
</script>
<?php } //end "if connected"?>