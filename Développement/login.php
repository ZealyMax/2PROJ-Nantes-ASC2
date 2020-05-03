<!DOCTYPE html>

<?php 
include "connect_database.php";
?>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="login.css">
        <title>Connexion</title>
    </head>
    <body>
        <div class="container">
            <img id="logo" src="./Images/Logo/logoFull.png">
            <div class="formPanel">
                <form action="connect.php" method="post">
                    <h1>Se connecter au créateur de formulaires</h1>
                    <div class="formConnect">
                        <input name="login" type="text" placeholder="Saisissez votre nom d'utilisateur">
                        <input name="password" type="password" placeholder="Saisir le mot de passe">
                        <input name="submit" type="submit" value="Se connecter">
                    </div>
                    <hr>
                    <div class="signin">
                        <p>Vous n'avez pas encore de compte ?</p>
                        <a href="signin.php">Créer un compte</a>
                    </div>
                </form>
            </div>
            <div class="bgImg">
                <img src="./Images/TDL.png">
            </div>
        </div>

    </body>
</html>