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

                <div id="Content">
                    <form action="../Scripts/connect.php" method="post">

                        <div class="Credentials">
                            <input class="inputFields login" name="login" type="text" placeholder="Username or email">
                            <input class="inputFields password" name="password" type="password" placeholder="Password">
                        </div>

                        <div class="Other">
                            <label class="container">Remember me
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>

                            <input class="btn" name="submit" type="submit" value="LOGIN">

                            <div class="links">
                                <a id="signIn">Sign up</a>
                                <a id="fPassword">Forgot your password ?</a>
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
    <script src='../Scripts/switchLogin.js'></script>

</html>