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
    <body>
        <h1 class="text-center">Connexion</h1>
        <hr>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-6" style="background-color:lightblue; height: 100%; border-radius: 20px">
                    <form method="POST" autocomplete="off" action="traitements\connexion.php">
                        <div class="row">
                            <div class="col-sm-12 placeholder-shown">
                                <h2>Formulaire de connexion</h2>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <?php if (isset($_GET['message'])) { 
                                    echo ($Message->messageConnexion($_GET['message']));
                                } ?>
                                <input type="text" name="mail" class="form-control" placeholder="Adresse Mail" required autofocus/>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required autofocus/>
                            </div>
                        </div>
                        <?php if (isset($_GET['page']) && isset($_GET['idart'])) {
                            echo "<input type='text' hidden name='page' value='".$_GET['page']."'>
                                <input type='text' hidden name='idart' value='".$_GET['idart']."'>";
                        } ?>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" style="width:100%">CONNECTION</button>
                            </div>
                        </div>
                        <div class="row formulaireRow">
                            <div class="col-sm-12">
                                <a href="inscription.php" class="btn btn-success" style="width:100%;">INSCRIPTION</a>
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
    </style>
</html>