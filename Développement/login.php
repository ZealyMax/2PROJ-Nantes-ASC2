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

                    <div class="Other">
                        <label class="container">Remember me
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>

                        <input class="btn" name="submit" type="submit" value="LOGIN">

                        <div class="links">
                            <a id="signIn" href="./signIn.php">Sign up</a>
                            <a id="fPassword" href="">Forgot your password ?</a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </body>
</html>

<!---->