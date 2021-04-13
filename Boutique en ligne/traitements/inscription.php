<?php
require_once('../modeles/Utilisateurs.php');
$Utilisateurs = new Utilisateurs();

//si on a rempli tout le formulaire
if(isset($_POST['mail']) && !empty($_POST['mail']) &&
    isset($_POST['password']) && !empty($_POST['password']) && 
    isset($_POST['passwordVerif']) && !empty($_POST['passwordVerif']) &&
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['prenom']) && !empty($_POST['prenom']) &&
    isset($_POST['dateNaissance']) && !empty($_POST['dateNaissance'])){
    
    //attribution des variables des informations du post
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $mail = strtolower($_POST['mail']);
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerif'];

    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) { //si l'email est valide
            if($password != $passwordVerify){
                header('location:../inscription.php?message=erreur1');
            }else{
                $resultat = $Utilisateurs->userExist($mail); //on vérifie si quelqu'un s'est déjà connecté avec cet email

                if(sizeof($resultat) > 0){ //si aucun utilisateur utilise cet email
                    header('location:../inscription.php?message=erreur2');
                }else{ //si l'email est utilisé
                    $password = password_hash($password, PASSWORD_BCRYPT); //On hash le mot de passe
                    $Utilisateurs->inscription($nom, $prenom, $dateNaissance, $mail, $password); //on enregistre l'utilisateur
                    header('location:../connexion.php?message=succes');
                }
            }
    }else{ //si l'email n'est pas valide
        header('location:../inscription.php?message=erreur3');
    }        
}else{ //si on n'a pas rempli tout le formulaire
    header('location:../inscription.php?message=erreur4');
}

?>