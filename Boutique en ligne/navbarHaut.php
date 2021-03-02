<?php
require_once("modeles/Categorie.php");
$Categorie = new Categorie();
$resultatCat = $Categorie->recupererCategories();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<a class="navbar-brand" href="index.php">
		<img src="logo_Prodajha.png" style="height: 50px; width:auto; margin-left:0" class="float-left" alt="Prodajha" >
	</a>

	<!--categories dropdown-->
	<?php if ($afficher_categories == true){
		?>
		<div class="input-group" style="margin-left:30px; margin-right:30px;">
		<!--Navigation par catégorie-->
			<div class="input-group-prepend">
				<button class="btn btn-outline-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégories</button>
				<div class="dropdown-menu bg-secondary">
					<a class="dropdown-item text-light" href="index.php">Toutes</a>
					<div class="dropdown-divider"></div>
					<?php foreach ($resultatCat as $categorie) {
						echo"<a class='dropdown-item text-light'
						href='index.php?idcat=".$categorie['idCategorie']."'>"
						.$categorie['nom']."
						</a>";
					} ?>
				</div>
			</div>
			<!--barre de navigation-->
			<input id="search_bar" type="text" class="form-control" placeholder="Rechercher..." list="search_data">
			<!--résultats recherche-->
			<datalist id="search_data">
					
			</datalist>
			<div class="input-group-append">
				<button class="btn btn-outline-warning" type="submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
						<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
					</svg>
				</button>
			</div>
		</div>
		<?php
	}
		if($_SESSION) { ?>

		<!--panier button-->
		<a class="btn btn-warning ml-auto mr-2" href="panier.php">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
			</svg>
		</a>

		<!--user button-->
		<ul class="nav nav-pill" style="margin-left: 10px;">
			<li class="nav-item dropdown">
				<button type="button" class="dropdown-toggle btn btn-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				</svg>
				</button>
				<div class="dropdown-menu dropdown-menu-right bg-secondary">
					<a class="dropdown-item disabled" href="">Mon profil</a>
					<a class="dropdown-item text-light" href="listeSouhait.php">Liste de Souhait</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item text-light" href="traitements\deconnexion.php">Déconnexion</a>
				</div>
			</li>		
		</ul>
		<?php
		} else {
			if (isset($_GET['idart'])) {
				?><a class="btn btn-secondary ml-auto" href="connexion.php?page=Article&idart=<?php echo($_GET['idart'])?>">Se connecter</a><?php
			}else{
				?><a class="btn btn-secondary ml-auto" href="connexion.php">Se connecter</a><?php
			}
		}
		?>
</nav>

<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<script>
	$(document).ready(function(){
		$('#search_bar').on('input', function(){
			search = $('#search_bar').val();
			console.log(search)

			$.ajax({
				type : "POST",
				url : 'ajax/search.php',
				data : {
					search: search
				},
				dataType:"json",
				success:function(data){
					document.getElementById('search_data').innerHTML = "";
					data.forEach((article)=>{
						document.getElementById('search_data').innerHTML += "<option id='"+ article.idArticle +"' class='search-data' value='"+ article.nom +"'></option>";
					})
				},
				error: function(){
					console.log("ERREUR");
				}
			});
		})
	})
</script>