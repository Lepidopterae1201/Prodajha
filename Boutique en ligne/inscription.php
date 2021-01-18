<?php
require_once("modeles/Message.php");
$Message = new Message();
?>
<html>
    <head>
        <title>Inscription</title>
        <meta charset="utf8" />
        <link rel="stylesheet" href="Bootstrap\bootstrap.min.css">
        <script src="Bootstrap\bootstrap.min.js"></script>
    </head>
    <body style="display:flex; text-align:center">
        <div class="container" style="margin-top:3%; margin-bottom:auto">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7" style="background-color:rgb(44, 44, 44); height: 100%; border-radius: 25px; padding:30px;">
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
                            <div class="col-12" style="margin-bottom: 15px;">
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
    </style>
</html>