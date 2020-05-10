<!DOCTYPE html>
<?php  
include "redirect_to_connection.php" ;
include "connect_database.php" ;?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Home</title>
    </head>
    <body>
        <div class=Main>
            <div class=Header>
                <div class=contentHead>
                    <div class=Logo><!--Partie gauche du Header, logo + texte-->
                        <div id=rectangle></div>
                        <p class=txt><b>Online Survey</b></p>
                    </div>
                
                    <div class=Recherche><!--Partie centrale : zone de recherche de formulaire-->
                            <input class=Search name="search" type="text" placeholder="Rechercher">
                    </div>
            
                    <div class=User><!--Partie droite : zone compte (déconexion...)-->
                        <div></div>
                    </div>
                </div>
            
            </div>        
        
            <div class=Content>
                <div class=mainContent>

                    <!--Bouton de tri des formulaires-->
                    <div class=home-Sort-Button role=button> <!--Bouton de tri des formulaires-->
                        <div class=Sort-Btn></div><!--div Icon-->
                        <div class=Sort>Trier</div><!--Texte-->
                    </div>

                    <!--Affichage des formulaires + bouton de création d'un formulaire-->
                    <div class=Select-Form-Section>
                        <div class=parent-Form>
                            <input class=child-Form type="button" onclick="location.href='survey_editor.php'"/>
                        </div>

                        <?php
                            $sql = "SELECT title FROM surveys WHERE id_users = '$_SESSION[id_users]'";
                            $res = mysqli_query($conn, $sql);
                            while ( $result = $res->fetch_assoc()){
                                echo "<div class=\"parent-Form\">"; /*div extern des formulaires à sélectionner*/
                                echo "<div class=\"child-Form\">"; /*div inside des formulaires à sélectionner*/
                                echo "<a>". $result['title'] . "</a>";
                                echo "</div>";
                                echo "</div>";
					        }
                        ?>
                    </div>
                </div>
            </div>
        
            <div class=Footer> <!--Footer à compléter-->
                <div class=Footer_1>
                    Some text
                </div>
                <div class=Footer_2>Some text</div>
            </div>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
</html>
