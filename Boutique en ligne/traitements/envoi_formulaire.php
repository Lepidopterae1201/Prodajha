<?php
session_start();
require_once('../modeles/clients.php');
$clients = new clients();
$idcli = $_SESSION['idClient'];
if(isset($_POST['message']) && !empty($_POST['message'])){   
  $message = $_POST['message'];
  $sujet = $_POST['sujet'];
  $clients->sendMessage($idcli,$sujet,$message);
  header('location:../contact.php?VALID=TRUE');
}else{
  header("location:../contact.php?ERREUR=TRUE");
}
?>