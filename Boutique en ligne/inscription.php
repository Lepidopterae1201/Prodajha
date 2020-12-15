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
    <body style="padding:10px; text-align:center">
        <h1>Inscription</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-md-offset-3" style="background-color:lightblue; height: 100%; border-radius: 20px">
                    <form autocomplete="off" method="POST" action="traitements/inscription.php">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h2>Formulaire d'inscription</h2>
                            </div>
                        </div>                      
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <?php if (isset($_GET['message'])){
                                    echo($Message->messageInscription($_GET['message']));
                                        }    ?>
                                <input type="text" name="nom" class="form-control" placeholder="Nom" required autofocus />
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="text" name="mail" class="form-control" placeholder="Adresse Mail" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="password" name="passwordVerif" class="form-control" placeholder="Vérification Mot de passe" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" style="width:100%">INSCRIPTION</button>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <a href="connexion.php" class="btn btn-primary" style="width:100%;">CONNECTION</a>
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