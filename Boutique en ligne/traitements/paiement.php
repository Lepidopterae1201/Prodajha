<?php
session_start();
require_once('../modeles/Panier.php');
require_once('../modeles/Paiement.php');
require_once('../modeles/Article.php');
$Panier = new Panier();
$Paiement = new Paiement();
$Article = new Article();

if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['numero_de_carte']) && !empty($_POST['numero_de_carte']) && isset($_POST['mois']) && !empty($_POST['mois']) && isset($_POST['annee']) && !empty($_POST['annee']) && isset($_POST['cvv']) && !empty($_POST['cvv'])){
        
  $nom = $_POST['nom'];
  $numero_de_carte = $_POST['numero_de_carte'];
  $mois = $_POST['mois'];
  $annee = $_POST['annee'];
  $date = $mois."/".$annee;
  $cvv = $_POST['cvv'];
  #save payment
  $payer = $Paiement->insertPaiement($nom, $numero_de_carte, $date, $cvv);
  if ($payer !== true){
    header("location:../form_paiement.php?ERREUR=TRUE");
  }else{
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
      $commandeArticle = $Paiement->insertArticlesCommandes($idCommande, $idart, $idMarchand, $quant);
      if ($commandeArticle !== true){
        header("location:../form_paiement.php?ERREUR=TRUE");
      }
    }
    if ($commandeArticle === true) {
      $deletePanier = $Panier->deletePanier($idC);
      if ($deletePanier === true){
        header('location:../index.php?VALID=TRUE');
      }else{
        header("location:../form_paiement.php?ERREUR=TRUE");
      }
    }
  }
}else{
  header("location:../form_paiement.php?ERREUR=TRUE");
}
 
?>