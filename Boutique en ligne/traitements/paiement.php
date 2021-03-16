<?php
session_start();
require_once('../modeles/Panier.php');
$panier = new Panier();
if(isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['numero_de_carte']) && !empty($_POST['numero_de_carte']) && isset($_POST['mois']) && !empty($_POST['mois']) && isset($_POST['annee']) && !empty($_POST['annee']) && isset($_POST['cvv']) && !empty($_POST['cvv'])){
        
    $nom = $_POST['nom'];
    $numero_de_carte = $_POST['numero_de_carte'];
    $mois = $_POST['mois'];
    $annee = $_POST['annee'];
    $cvv = $_POST['cvv'];
    $date = $mois."/".$annee;
 
     
 
              
              $panier->paiement($nom,$numero_de_carte,$date,$cvv);
              header('location:../index.php?VALID=TRUE');
 
    }
    else{
      header("location:../form_paiement.php?ERREUR=TRUE");
    }
 
?>