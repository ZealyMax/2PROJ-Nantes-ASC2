
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="login.css">
        <title>ToDoU2/Inscription</title>
    </head>
    <body>
        <div class="container">
            <img id="logo" src="./Images/Logo/logoFull.png">
            <div class="formPanel">
                <form action="create_account.php" method="post">
                    <h1>Inscrivez vous à ToDoU2</h1>
                    <?php 
                        if($_GET['error'] == "1"){
                            echo "Le compte que vous avez voulu créer existe déjà.";
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
        </div>
    </body>
</html>