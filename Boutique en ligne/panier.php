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
	var disabled = 0;
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
					<?php
					$disabled += 1;
					}else{
					foreach ($resultat as $article) {
	        		?>
	        		<ul id="article<?php echo($article['idArticle'])?>" class="list-group list-group-flush deleteForm">
	        			<li class="list-group-item">
							<div class="row">
								<div class="col-2">
									<img src="<?php echo($article['image']) ?>">
								</div>
								<div class="col-6">
									<h5 class="card-title"><?php echo($article['nom']) ?></h5>
									<?php 
										if ($article['aQuantite']==0) {
											?><script>disabled+=1;</script><?php
											echo "<p style='color: red;''>L'article n'est plus disponible</p>";
										}else{
											if ($article['aQuantite']<$article['pQuantite']) {
												?><script>disabled+=1;</script><?php
												echo "<p style='color: red;''>Il n'y a plus assez d'article. Il n'en reste que " . $article['aQuantite'] . "</p>";
											}else{
												echo "<p style='color: green;''>Disponible immédiatement</p>";
											}
										}
									?>
									<form id="delete<?php echo($article['idArticle'])?>" method="POST" action="traitement\supprimerDuPanier.php">
										<input id="idA_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idA" value=<?php echo($article['idArticle']);?>>
										<input id="idC_delete<?php echo($article['idArticle'])?>" type="text" hidden="True" name="idC" value=<?php echo($article['idClient']);?>>
										<button  class="btn btn-outline-secondary btn-sm" type="submit">supprimer</button>
									</form>
								</div>
								<div class="col-2">
									<form method="POST" action="traitements/modifier.php">
										<input type="text" hidden="True" name="idA" value=<?php echo $article['idArticle'];?>>
										<input type="text" hidden="True" name="idC" value=<?php echo $article['idClient'];?>>
										<input id='nbrArticle<?php $article['idArticle'];?>' type='number' name='qart' min=1 max=<?php echo ($article['aQuantite'] . " value=" . $article['pQuantite'])?>>
										<button class="btn btn-outline-secondary btn-sm" type="submit" style="margin-top: 10px;">modifier</button>
									</form>
								</div>
								<div class="col-2">
									<script>
									var nbr = document.getElementById('nbrArticle<?php $article['idArticle'];?>').value;
										if( nbr < 1){
											nbr = 1;
										}
										document.write('<p><?php echo $article['prix'] * $article['pQuantite'];?>€</p>')
										prix.set("article<?php echo $article['idArticle'];?>", <?php echo $article['prix'] * $article['pQuantite']?>);
										console.log(prix);
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
											console.log(listPrix);
											prix.forEach(value => prixTT += value)
											return prixTT;
										}
										var prixTT = calcul_PrixTT();
										document.write('<h2 >Montant Total: '+prixTT +'€</h2>');
									</script>
			    				</div>
			    				<div class="col-md-12 col-sm-3 col-xs-12" >
									<script>
									 	if(disabled>0){
											 document.write("<button class='btn btn-warning' disabled>Valider ma commande</button>");
											}else{
												document.write("<button class='btn btn-warning'>Valider ma commande</button>");
											}
									</script>
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

<!--script ajax-->
<script>
$(document).ready(function(){
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
			prix.delete("article"+idArticle);
			PrixTT = calcul_PrixTT();
			document.getElementById('prixTT').innerHTML = "<h2>Montant Total:" + PrixTT + " €</h2>";
		},
		error: function(){
			console.log("ERREUR");
		}
		});
	});
});
</script>
<?php } //end "if connected"?>