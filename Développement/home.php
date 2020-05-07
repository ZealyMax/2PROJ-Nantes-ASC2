<!DOCTYPE html>
<?php  
include "redirect_to_connection.php" ;
include "connect_database.php" ;?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <input type="button" onclick="location.href='survey_editor.php'" value="Créer un formulaire" />
        <p>Liste des formulaires récents</p>
        <p>Trier par:</p>
        <nav>
            <ul>
                <?php 
                    $sql = "SELECT title FROM surveys WHERE id_users = '$_SESSION[id_users]'";
                    $res = mysqli_query($conn, $sql);
                    while ( $result = $res->fetch_assoc()){
                        echo "<a>". $result['title'] . "</a>";
					}
                ?>
            </ul>
        </nav>
    </body>
</html>