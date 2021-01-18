<?php
require_once("modeles/Message.php");
$Message = new Message();

?>
<html>
    <head>
        <title>Connection</title>
        <meta charset="utf8" />
        <link rel="stylesheet" href="Bootstrap\bootstrap.min.css">
        <script src="Bootstrap\bootstrap.min.js"></script>
    </head>
    <body style="display:flex;">
        <div class="container" style="text-align:center; margin-top:10%; margin-bottom:auto">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7" style="background-color:rgb(44, 44, 44); height: 100%; border-radius: 25px">
                    <form method="POST" autocomplete="off" action="traitements\connexion.php">
                        <div class="row">
                            <div class="col-12 placeholder-shown">
                                <h2 class="text-warning" style=" margin-top:15px">Connectez vous</h2>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-10" style="margin-right:auto; margin-left:auto">
                                <?php if (isset($_GET['message'])) { 
                                    echo ($Message->messageConnexion($_GET['message']));
                                } ?>
                                <input type="text" name="mail" class="form-control" placeholder="Adresse Mail" style="text-align:center; margin-bottom:40px;" required autofocus/>
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" style="text-align:center; margin-bottom:20px;" required autofocus/>
                            </div>
                        </div>
                        <?php if (isset($_GET['page']) && isset($_GET['idart'])) {
                            echo "<input type='text' hidden name='page' value='".$_GET['page']."'>
                                <input type='text' hidden name='idart' value='".$_GET['idart']."'>";
                        } ?>
                        <div class="row formulaireRow">
                            <div class="col-12" style="margin-top:-10px; margin-bottom:30px;">
                                <button type="submit" class="btn btn-outline-warning" style="width:30%; margin-right:10px; margin-left:10px; padding:10px;">CONNECTION</button>
                                <hr>
                                <p class="text-warning">Vous n'avez pas de compte ?</p>
                                <a href="inscription.php" class="text-warning" style="width:30%; padding:10px; text-decoration:underline">Inscrivez vous !</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </body>
    <style>
        .form-control{
            height: 50px;
        }

        .formulaireRow{
            margin-top: 50px;
        }

        body{
            height: 100%;
        }
    </style>
</html>