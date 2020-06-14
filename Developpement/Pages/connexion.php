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
        <div class=Content>

            <div class=bg-image></div>

            <div class=bg-login>

                <div class=Logo-div>
                    <div class=white-rect>
                        <img class=Logo src='../../../Design/icons/logoTypo/LogoTypo@1x.png'>
                    </div>
                </div>
                
                        <div id=Content>
                            <form action="..\Scripts\create_account.php" method=post>
                                <div class=Credentials>
                                    <input class=inputFields name=login type=text placeholder=Username>
                                    <input class=inputFields name=mail type=text placeholder=Email>
                                    <input class=inputFields name=password type=password placeholder=Password>
                                    <input class=inputFields name=confirmPassword type=password placeholder='Confirm password'>
                                </div>
                                <div class=Other>
                                    <input class=btn name=submit type=submit value='CREATE ACCOUNT'>
                                    <div class=links>
                                        <a href='login.php' id=connect >&larr; Back to login</a>
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