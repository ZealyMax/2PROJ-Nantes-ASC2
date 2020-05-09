<!DOCTYPE html>
<?php  include('redirect_to_connection.php') ?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <title>créer un formulaire</title>
    </head>
    <body>
        <div class=question style="display:none">
            <br>
            <input name=question-desc placeholder="Question"> 
            <select class=selector>
                <option value="short">Réponse courte</option>
                <option value="long">Paragraphe</option>
                <option value="multiple">Choix multiple</option>
                <option value="checkbox">Case à cocher</option>
                <option value="list">Liste déroulante</option>
                <option value="linear-scale">Echelle linéaire</option>
                <option value="grid-multiple">Grille à choix multiple</option>
                <option value="grid-checkbox">Grille de case à coher</option>
                <option value="date">Date</option>
                <option value="hour">Heure</option>
            </select><button class=rm-div>X</button><br>
            <div class=question-content>
                <input placeholder="Réponse">
            </div>
            <input name=mustDo[] type=checkbox><input placeholder=Obligatoire READONLY>
        </div>
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
