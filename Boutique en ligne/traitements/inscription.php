<?php
require_once('../modeles/Utilisateurs.php');
$Utilisateurs = new Utilisateurs();

if(isset($_POST['mail']) && !empty($_POST['mail']) &&
    isset($_POST['password']) && !empty($_POST['password']) && 
    isset($_POST['passwordVerif']) && !empty($_POST['passwordVerif']) &&
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['prenom']) && !empty($_POST['prenom'])){
        
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = strtolower($_POST['mail']);
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerif'];

    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if($password != $passwordVerify){
                ?>
                <p>Les mots de passes ne correspondent pas</p>
                <a href="../inscription.php?message=erreur1">Retour à l'inscription</a>
                <?php
                header('location:../inscription.php?message=erreur1');
            }else{
                
                $req = "SELECT email FROM client WHERE email = ?";
                $resultat = $Utilisateurs->userExist($mail);

                if(sizeof($resultat) > 0){
                    ?>
                    <p>L'utilisateur existe déjà</p>
                    <a href="../inscription.php?message=erreur2">Retour à l'inscription</a>
                    <?php
                    header('location:../inscription.php?message=erreur2');
                }else{
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    $Utilisateurs->inscription($nom, $prenom, $mail, $password);
                    
                    header('location:../connexion.php?message=succes');
                }
            }
    }else{
        ?>
        <p>Veuillez saisir une adresse mail valide</p>
        <a href="../inscription.php?message=erreur3">Retour à l'inscription</a>
        <?php
        header('location:../inscription.php?message=erreur3');
    }        
}else{
    ?>
    <p>Il manque un ou plusieurs champs</p>
    <a href="../inscription.php?message=erreur4">Retour à l'inscription</a>
    <?php
    header('location:../inscription.php?message=erreur4');
}

?>