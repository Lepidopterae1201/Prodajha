<?php
require_once("modeles/Categorie.php");
$Categorie = new Categorie();
$resultatCat = $Categorie->recupererCategories();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">

	<!--Logo retour à l'accueil-->
	<a class="navbar-brand" href="index.php">
		<img src="logo_Prodajha.png" style="height: 50px; width:auto; margin-left:0" class="float-left" alt="Prodajha" >
	</a>

	<!--collapse button-->
	<button class="navbar-toggler ml-auto col" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
		<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
	</svg>
  	</button>

	<!--panier et user-->
	<?php
	if($_SESSION) { ?>
		<div class="btn-group ml-auto mr-2 col-2 order-md-last">
			<!--panier button-->
			<a class="btn btn-warning" href="panier.php">
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
						<a class="dropdown-item text-light" href="contact.php">Support</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item text-light" href="traitements\deconnexion.php">Déconnexion</a>
					</div>
				</li>		
			</ul>
		</div>
	<?php
	} else { ?>
	<div class="align-item-center ml-auto mr-2">
		<?php
	if (isset($_GET['idart'])) {
		?><a class="btn btn-secondary" href="connexion.php?page=Article&idart=<?php echo($_GET['idart'])?>">Se connecter</a><?php
	}else{
		?><a class="btn btn-secondary" href="connexion.php">Se connecter</a><?php
	}
	?></div>
<?php 
	} ?>

	<div class="collapse navbar-collapse" id="navbar">
		<!--Recherche-->
		<?php if ($afficher_searchbar == true){?>
			<div class="input-group input-group-sm">
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
					<button id="search_button" class="btn btn-outline-warning" type="button">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg>
					</button>
				</div>
			</div>
	<?php } ?>
	</div>
</nav>

<!--librairie jquery-->
<script src="static/jquery-3.5.1.min.js"></script>

<script>
	//fonction lancement de recherche
	function go_search(search){
		window.location.href = "index.php?search=" + search;
	}

	$(document).ready(function(){
		$('#search_bar').on('input', function(){ //quand on écrit dans la barre de recherche
			if($('#search_bar').val() != ""){
				search = $('#search_bar').val();
				var x = 0;

				$.ajax({
					type : "POST",
					url : 'ajax/search.php',
					data : {
						search: encodeURI(search)
					},
					dataType:"json",
					success:function(data){
						document.getElementById('search_data').innerHTML = "";
						data.forEach((article)=>{ //pour chaque élément de recherche, on l'ajoute au recherches trouvées
							document.getElementById('search_data').innerHTML += "<option id=\"recherche"+ x +"\" class=\"search-value\" value=\""+ article.nom +"\" onclick=\"go_search(" + article.nom + ")\"></option>";
						})
						if(document.querySelectorAll('.search-value').length == 1){ //si le nombre d'article recherché affiché est égale à 1
							if($('.search-value').val() === search){ //si la recherche est exactement la même que le nom de l'article recherché
								go_search(search); //on lance la recherhce
							}
						}
					},
					error: function(){
						console.log("ERREUR");
					}
				});
			}
		})

		$("#search_button").on('click', function(){ //quand on clique sur le bouton de lancement de recherche, on lance la recherche
			search = $('#search_bar').val()
			go_search(search);
		})
	})
</script>