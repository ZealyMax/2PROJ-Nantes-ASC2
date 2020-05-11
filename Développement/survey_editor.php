<!DOCTYPE html>
<?php  include('redirect_to_connection.php') ?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <title>créer un formulaire</title>
    </head>
    <body>
        <form method=POST action=create_form.php>
            <input name=Titre placeholder="Titre">
            <input name=Description placeholder="Description">
            <input class="btn-add" type=button value=+>
            <input name=submit type=submit value="Créer">
            <div class=form>
                
            </div>
        </form>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src='survey_editor.js'></script>
