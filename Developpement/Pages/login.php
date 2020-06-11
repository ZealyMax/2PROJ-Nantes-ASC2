<!DOCTYPE html>

<?php 
include "../Scripts/connect_database.php";
?>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../CSS/Login/login.css">
        <title>Connexion</title>
    </head>
    <body>
        <div class="Content">

            <div class="bg-image"></div>

            <div class="bg-login">

                <div class="Logo">
                    <div id="rectangle"></div>
                    <p class="txt">Online Survey</p>
                </div>

                <!-- ICIICICICICIIC  -->
                <div class="Back_to_overview">
                    <a href="../Pages/overview.php">Retour à la présentation de l'outil</a>
                </div>

                <div id="Content">
                    <form action="../Scripts/connect.php" method="post">

                        <div class="Credentials">
                            <?php
                                $value = "";
                                if (isset($_COOKIE["name"])){
                                    $value = htmlspecialchars($_COOKIE["name"]);
                                } 

                                echo "<input class='inputFields login' name='login' type='text' placeholder='Nom d&#039utilisateur ou e-mail' value='".$value."'>";
                                ?>
                            <input class="inputFields password" name="password" type="password" placeholder="Mot de passe">
                        </div>

                        <div class="Other">
                            <label class="container">Se souvenir de moi
                                <input name="remember_me" type="checkbox">
                                <span class="checkmark"></span>
                            </label>

                            <input class="btn" name="submit" type="submit" value="S'identifier">

                            <div class="links">
                                <a id="signIn">S'enregistrer</a>
                                <a id="fPassword">Mot de passe oublier ?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src='../Scripts/switch_login.js'></script>

</html>