<?php
session_start();
if($_SESSION == False) {
	header("location:index.php");
}else{
require_once('modeles/Panier.php');
$Resultat = new Panier();
$resultat = $Resultat->afficherPanier($_SESSION['idClient']);
$prixTT = 0;
$disabled = 0;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Panier</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
</head>
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
	        		<ul class="list-group list-group-flush">
	        			<li class="list-group-item">
		        				<div class="row">
		        					<div class="col-2">
		        						<img src="<?php echo($article['image']) ?>">
		        					</div>
		        					<div class="col-6">
		        						<h5 class="card-title"><?php echo($article['nom']) ?></h5>
		        						<?php 
		        							if ($article['aQuantite']==0) {
		        								$disabled += 1;
		        								echo "<p style='color: red;''>L'article n'est plus disponible</p>";
		        							}else{
		        								if ($article['aQuantite']<$article['pQuantite']) {
		        									$disabled += 1;
		        									echo "<p style='color: red;''>Il n'y a plus assez d'article. Il n'en reste que " . $article['aQuantite'] . "</p>";
		        								}else{
		        									echo "<p style='color: green;''>Disponible immédiatement</p>";
		        								}
		        							}
		        						?>
		        						<form method="POST" action="traitements\supprimer.php">
		        							<input type="text" hidden="True" name="idA" value=<?php echo($article['idArticle']);?>>
		        							<input type="text" hidden="True" name="idC" value=<?php echo($article['idClient']);?>>
		        							<button class="btn btn-outline-secondary btn-sm" type="submit">supprimer</button>
		        						</form>
		        					</div>
		        					<div class="col-2">
		        						<form method="POST" action="traitements/modifier.php">
		        							<input type="text" hidden="True" name="idA" value=<?php echo($article['idArticle']);?>>
		        							<input type="text" hidden="True" name="idC" value=<?php echo($article['idClient']);?>>
			        						<?php echo "<input type='number' name='qart' min=1 max=".$article['aQuantite']." value=" . $article['pQuantite'] .">";?>
								            <button class="btn btn-outline-secondary btn-sm" type="submit" style="margin-top: 10px;">modifier</button>
							            </form>
		        					</div>
		        					<div class="col-2">
		        						<?php $prix = $article['prix'] * $article['pQuantite'];
		        						echo "<h4>". $prix ." €</h4>"; ?>
		        					</div>
		        					<?php $prixTT += $prix;?>
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
		    					<div class="col-md-12 col-sm-9 col-xs-12">
		    						<?php       						
							  		echo "<h2>Montant Total: ". $prixTT ." €</h>";
							       	?>
			    				</div>
			    				<div class="col-md-12 col-sm-3 col-xs-12" >
			    					<button class="btn btn-warning" <?php if ($disabled>0) {echo "disabled";} ?>>Valider ma commande</button>
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

<!--js bootstrap-->
<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<!--js bootstrap-->
<script src="static/bootstrap/js/bootstrap.min.js"></script>

<?php } ?>