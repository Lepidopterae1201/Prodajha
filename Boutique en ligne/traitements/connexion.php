<?php
session_start();
require_once('../modeles/Utilisateurs.php');
$Utilisateurs = new Utilisateurs();

if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])){ //si on a rempli tout le formulaire
        
    $mail = strtolower($_POST['mail']); //mail entré
    $password = $_POST['password']; //mot de passe entré
    $resultat = $Utilisateurs->connexion($mail); //On vérifie si le mail match avec un autre enregistré dans la base de données
    // print_r($resultat);

	if(isset($resultat) == False){ //si aucun match, on envoie le message d'erreur correspondant
        header("location:../connexion.php?message=erreur1");
    }else{
        $passVerif = $resultat['password']; //on récupère le mot de passe hashé du match
        if (password_verify($password, $passVerif)) { // si les deux mots de passes hashés correspondent

            $_SESSION['prenom'] = $resultat['prenom'];
            $_SESSION['nom'] = $resultat['nom'];
            $_SESSION['email'] = $resultat['email'];
            $_SESSION['idClient'] = $resultat['idClient'];
            if ($resultat['idRole'] = 3){
                $_SESSION['admin'] = true;
            }else{
                $_SESSION['admin'] = false;
            }
            
            if (isset($_POST['page']) && isset($_POST['idart'])){ 
                if ($_POST['page']=="Article") { //si on était sur la page d'un article, on retourne sur la page de l'article
                    header("location:../article.php?idart=".$_POST['idart']);
                }
            }else{ //si on n'était pas sur la page d'un article, on retourne à l'accueil
            	header("location:../index.php");
            }
        }else{ //si les mots de passes sont différents
            header("location:../connexion.php?message=erreur1");
        }
    }       
}else{ //s'il manque des informations
    header("location:../connexion.php?message=erreur2");
}

?>