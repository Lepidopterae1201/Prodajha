<?php
session_start();

// CODE POUR DECONNECTER L'UTILISATEUR
session_destroy();

header('location:../connexion.php');
?>