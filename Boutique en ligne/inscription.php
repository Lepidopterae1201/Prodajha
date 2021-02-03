<?php
require_once("modeles/Message.php");
$Message = new Message();
?>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf8" />
        <link rel="stylesheet" href="Bootstrap\bootstrap.min.css">
    </head>
    <body style="display:flex; text-align:center; background-color:rgb(84, 84, 84)">
        <div class="container" style="margin-top:2%; margin-bottom:auto;">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7 border border-warning" id ="formContainer">
                    <form autocomplete="off" method="POST" action="traitements/inscription.php">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2 class="text-warning">INSCRIPTION</h2>
                            </div>
                        </div>                      
                        <div class="row formulaireRow">
                            <div class="col-12" style="margin-bottom: 15px;">
                                <?php if (isset($_GET['message'])){
                                    echo($Message->messageInscription($_GET['message']));
                                        }    ?>
                                <input type="text" name="nom" class="form-control" placeholder="Nom" required autofocus />
                            </div>
                            <div class="col-12" style="margin-bottom: 15px;">
                                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required autofocus/>
                            </div>
                            <div class="col-12" style="margin-bottom: 15px;">
                                <input type="date" name="dateNaissance" class="form-control" placeholder="Date de naissance" required autofocus/>
                            </div>
                            <div class="col-12" style="margin-bottom: 15px;">
                                <input type="text" name="mail" class="form-control" placeholder="Adresse Mail" required autofocus/>
                            </div>
                            <div class="col-12" style="margin-bottom: 15px;">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autofocus/>
                            </div>
                            <div class="col-12">
                                <input type="password" name="passwordVerif" class="form-control" placeholder="Vérification Mot de passe" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-12">
                                <button type="submit" class="btn btn-outline-warning" style="width:30%; margin-bottom:30px; padding:10px;">INSCRIPTION</button>
                                <p class="text-warning">Déjà un compte ? </p>
                                <a href="connexion.php" class="text-warning" style="text-decoration:underline">Connectez vous !</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </body>
    <style>
        .container{
            width: 100%;
            border-radius: 20px;
        }

        .form-control{
            height: 50px;
        }

        .formulaireRow{
            margin-top: 50px;
        }

        #formContainer{
            background-color:rgb(44, 44, 44);
            height: 100%;
            border-radius:25px;
            padding:30px;
        }
    </style>
    <!--js bootstrap-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    
</html>
