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
                    <div class=Logo>
                        <div id=rectangle></div>
                        <p class=txt><b>Online Survey</b></p>
                    </div>
                
                    <div class=Recherche>
                            <input class=Search name="search" type="text" placeholder="Rechercher">
                    </div>
            
                    <div class=User>
                        <div></div>
                    </div>
                </div>
            
            </div>        
        
            <div class=Content>
                <div class=mainContent>
                    <p>Trier par:</p>
                    <div class=homeSelectButton>
                        <input type="button" onclick="location.href='survey_editor.php'" value="Créer un formulaire" />
                        <p>Liste des formulaires récents</p>
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
                    </div>
                </div>
            </div>        
            <div class=Footer>
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