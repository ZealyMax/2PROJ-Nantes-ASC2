<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="login.css">
        <title>Online Survey#SignIn</title>
    </head>
    <body>
        <div name="Content">

            <div class="bg-image"></div>

            <div class="bg-login">

                <div class="Logo">
                    <div id="rectangle"></div>
                    <p class="txt">Online Survey</p>
                </div>

                <div id="Content">
                    <form action="create_account.php" method="post">

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
                                <a id="connect" >&larr; Back to login</a>
                                <a id="fPassword" href="">Forgot your password ?</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
        <!--
        <div class="container">
            <img id="logo" src="./Images/Logo/logoFull.png">
            <div class="formPanel">
                <form action="create_account.php" method="post">
                    <h1>Inscrivez vous à ToDoU2</h1>
                    <?php 
                        if($_GET['error'] == "1"){
                            echo "Nom d'utilisateur ou email déjà utilisé.";
                        }
                    ?>
                    <div class="formConnect">
                        <input name="login" type="text" placeholder="Saisissez un nom d'utilisateur">
                        <input name="password" type="password" placeholder="Entrez un mot de passe">
                        <input name="submit" type="submit" value="S'inscrire">
                    </div>
                    <hr>
                    <div class="signin">
                        <a href="login.php">Vous avez déjà un compte ? Connectez vous</a>
                    </div>
                </form>
            </div>
            <div class="bgImg">
                <img src="./Images/TDL.png">
            </div>
        </div>-->
    </body>
</html>