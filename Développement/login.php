<!DOCTYPE html>

<?php 
include "connect_database.php";
?>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="login.css">
        <title>Connextion</title>
    </head>
    <body>
        <div name="Content">

            <div class="bg-image"></div>

            <div class="bg-login">

                <div class="Logo">
                    <div id="rectangle"></div>
                    <p class="txt">Online Survey</p>
                </div>

                <form>

                    <div class="Credentials">
                        <input class="inputFields" name="login" type="text" placeholder="Username or email">
                        <input class="inputFields" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="Other"></div>
                </form>

            </div>

        </div>

    </body>
</html>

<!---->