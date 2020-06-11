<!DOCTYPE html>
<?php  

?>
<html lang="fr">
    <head>
            <link rel="stylesheet" type="text/css" href="../CSS/Main/global.css">
            <link rel="stylesheet" type="text/css" href="../CSS/Home/homeHeader.css">


    </head>
    <body>
        <div class=Main>
            <div class=Header>
                <div class=contentHead>
                    <a href="overview.php" class=Logo><!--Partie gauche du Header, logo + texte-->
                        <img src="../../Design/icons/logo/Logo@2x.png">
                        <p class=txt><b>Online Survey</b></p>
                    </a>
                
                    <div class=search-Container><!--Partie centrale : zone de recherche de formulaire-->
                        <div>
                            <button class=search-Icon>&nbsp;</button>                                               <!--Ici mettre option pour rechercher avec ce qu'il y a dans l'input-->
                            <input class=Search name="search" type="text" placeholder="Rechercher">
                        </div>
                    </div>
                    <div class=User> <!--Partie droite : zone compte (Home, Déconexion...)-->
                        <div class=dropdown>
                            <button onclick="dropMenuUser()" class="dropButton"></button>
                        
                            <div id="droppedMenu" class="dropdown-Content">
                                <a href="login.php">Se connecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=Content>
                 <div class=mainContent>

                 aa

                 </div>
            </div>




            <div class=Footer> <!--Footer à compléter-->
                <div class=Footer_1>
                    <div class="politique_de_confidentialite">
                        <a href="../Ressources/Politique_de_confidentialite.pdf">Politique de confidentialité</a>
                    </div>
                </div>
                <div class=Footer_2>Some text</div>
            </div>
        </div>
    </body>
    
    <script src="../Scripts/dropMenuUser.js"></script>

</html>