<?php 
require_once('Modele.php');

class Utilisateurs extends Modele
{
    function connexion($mail){ //récupère les informations pour se connecter
        $req = "SELECT email, password, nom, prenom, idClient, idRole FROM client WHERE email = ?";
        return $this->execRequete($req, [$mail])->fetch();
    }

    function userExist($mail){ //vérifie si un utilisateur utilise l'email passé en argument
        $req = "SELECT email FROM client WHERE email = ?";
        return $this->execRequete($req, [$mail])->fetchAll();
    }

    function inscription($nom, $prenom, $dateNaissance, $mail, $password){ //Permet d'enregistrer un nouvel utilisateur
        $req = "INSERT INTO client(nom, prenom, dateNaissance, email, password) VALUES(?, ?, ?, ?, ?)";
        return $this->execRequete($req, [$nom, $prenom, $dateNaissance, $mail, $password]);
    }
}
?>