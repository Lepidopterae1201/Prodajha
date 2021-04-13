<?php
    require_once('Modele.php');

    class Message extends Modele{

        function messageInscription(){ //récupère le message d'erreur au moment de l'inscription en fonction de l'erreur passé en get
                if ($_GET['message']=='erreur1') {
                    return "<p style='color: red;'>Les mots de passes ne correspondent pas</p>";
                }elseif ($_GET['message']=='erreur2') {
                    return "<p style='color: red;'>L'utilisateur existe déjà</p>";
                }elseif ($_GET['message']=='erreur3') {
                    return "<p style='color: red;'>Veuillez saisir une adresse mail valide</p>";
                }elseif ($_GET['message']=='erreur4') {
                    return "<p style='color: red;'>Il manque un ou plusieurs champs</p>";
                }
            }

            function messageConnexion(){ // récupère le message d'erreur ou de succes au moment de la connection en fonction de l'erreur passé en get
                if ($_GET['message'] == 'erreur1') {
                    echo "<p style='color: red;'>L'utilisateur ou le mot de passe est incorrect</p>";
                } elseif ($_GET['message'] == 'erreur2') {
                    echo "<p style='color: red;'>Il manque un ou plusieurs champs</p>";
                } elseif ($_GET['message'] == 'succes') {
                    echo "<p style='color: green;'>Compte créé avec succès</p>";
                }
            }
    }
?>