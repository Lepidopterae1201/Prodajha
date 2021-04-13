<?php
if(isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['sujet']) && !empty($_POST['sujet'])){ //si on a rempli tous le formulaire
  session_start();
  require_once('../modeles/clients.php');
  $idc = $_SESSION['idClient']; //id client de l'utilisateur 
  $message = $_POST['message']; //Message
  $sujet = $_POST['sujet']; //Sujet du message
  $clients = new clients();
  $clients->sendMessage($idc,$sujet,$message); //On envoie le message
  header('location:../contact.php?VALID=TRUE');
}else{ //si on n'a pas rempli tout le formulaire
  header("location:../contact.php?ERREUR=TRUE");
}
?>