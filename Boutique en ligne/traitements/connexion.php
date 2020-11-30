<?php
require_once('../config/bdd.php');

if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])){
        
    $mail = strtolower($_POST['mail']) ;
    $password = $_POST['password'];

    $req = "SELECT email, password, nom, prenom, idClient FROM client WHERE email = ?";
            $resultat = getBdd()->prepare($req);
            $resultat->bindParam(1, $mail);
            $resultat->execute();
            $resultat = $resultat->fetch();
        print_r($resultat);
		if(isset($resultat) == False){
		?>
            <p>L'utilisateur ou le mot de passe est incorrect</p>
            <a href="../connexion.php?message=erreur1">Retour à l'inscription</a>
        <?php
            header("location:../connexion.php?message=erreur1");
        }else{
            $passVerif = $resultat['password'];
            if (password_verify ( $password , $passVerif )) {

            	session_start();

            	$_SESSION['prenom'] = $resultat['prenom'];
            	$_SESSION['nom'] = $resultat['nom'];
                $_SESSION['email'] = $resultat['email'];
                $_SESSION['idClient'] = $resultat['idClient'];
            if (isset($_POST['page']) && isset($_POST['idart'])){
                if ($_POST['page']=="Article") {
                    header("location:../article.php?idart=".$_POST['idart']);
                }
            }else{
            	header("location:../index.php");
            }
            }else{
            	?>
            	<p>L'utilisateur ou le mot de passe est incorrect</p>
            	<a href="../connexion.php?message=erreur1">Retour à l'inscription</a>
            	<?php
                header("location:../connexion.php?message=erreur1");
            }
        }       
}else{
    ?>
    <p>Il manque un ou plusieurs champs</p>
    <a href="../connexion.php?message=erreur2">Retour à l'inscription</a>
    <?php
    header("location:../connexion.php?message=erreur2");
}

?>