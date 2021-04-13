<?php
session_start();
require_once('../modeles/Panier.php');
require_once('../modeles/Paiement.php');
require_once('../modeles/Article.php');
$Panier = new Panier();
$Paiement = new Paiement();
$Article = new Article();

//si le formulaire est valide
if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['numero_de_carte']) && !empty($_POST['numero_de_carte']) && isset($_POST['mois']) && !empty($_POST['mois']) && isset($_POST['annee']) && !empty($_POST['annee']) && isset($_POST['cvv']) && !empty($_POST['cvv'])){
 
  // on enregistre les variables       
  $nom = $_POST['nom'];
  $numero_de_carte = $_POST['numero_de_carte'];
  $mois = $_POST['mois'];
  $annee = $_POST['annee'];
  $date = $mois."/".$annee;
  $cvv = $_POST['cvv'];

  //save paiement
  $payer = $Paiement->insertPaiement($nom, $numero_de_carte, $date, $cvv);
  if ($payer !== true){ // si l'enregistrement du paiement s'est mal passé
    header("location:../form_paiement.php?ERREUR=TRUE");
  }else{ // si l'enregistrement s'est bien passé
    $idC = $_SESSION['idClient'];
    #get id of last payment of client
    $lastPaiement = $Paiement->getLastPaiement($nom,$numero_de_carte,$date,$cvv)->fetchAll();
    $idPaiement = $lastPaiement[0]['idPaiement'];
    #save Commande
    $commande = $Paiement->insertCommande($idC, $idPaiement);
    #get id of last commande of client
    $lastCommande = $Paiement->getLastCommande($idC, $idPaiement)->fetchAll();
    $idCommande = $lastCommande[0]['idCommande'];
    #for all articles
    $listArticle = $Panier->getPanier($idC)->fetchAll();
    foreach($listArticle as $article){
      $idart = $article['idArticle'];
      $quant = $article['quantite'];
      $idMarchand = $article['idMagasin'];
      $commandeArticle = $Paiement->insertArticlesCommandes($idCommande, $idart, $idMarchand, $quant); //On enregistre l'article commandé
      if ($commandeArticle !== true){ //si un article ne s'est pas enregistré
        header("location:../form_paiement.php?ERREUR=TRUE");
      }
    }
    if ($commandeArticle === true) { //si le dernier article s'est bien enregistré, on supprime le panier du client
      $deletePanier = $Panier->deletePanier($idC);
      if ($deletePanier === true){ //su le panier s'est bien supprimé
        header('location:../index.php?VALID=TRUE');
      }else{ //si le panier ne s'est pas supprimé
        header("location:../form_paiement.php?ERREUR=TRUE");
      }
    }
  }
}else{ //si le formulaire est mal rempli
  header("location:../form_paiement.php?ERREUR=TRUE");
}
 
?>