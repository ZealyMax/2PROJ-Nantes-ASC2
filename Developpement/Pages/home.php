<!DOCTYPE html>
<?php  
include "../Scripts/redirect_to_connection.php" ;
include "../Scripts/connect_database.php" ;?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../CSS/Main/global.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Home/homeHeader.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Home/homeContent.css">
        <title>Home</title>
    </head>
    <body>
        <div class=Main>
            <div class=Header>
                <div class=contentHead>
                    <a href="home.php" class=Logo><!--Partie gauche du Header, logo + texte-->
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
                                <a href="home.php">Home</a>
                                <a href="login.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        
            <div class=Content>
                <div class=mainContent>
                    
                    <div id='poubelle' >
                        <button id='b_poubelle'>Poubelle</button>
                    </div>
                    <!--<button class=shareButton style="display:block;" onclick="shareForm()">Partager</button>        A SUPPRIMER
                        <div class="share-popup" id="myForm">
                            <form action="/action_page.php" class="share-container">
                                <h1>Partager</h1>

                                <input type="text" value="http://93.26.58.131/Final_Project/Developpement/Pages/survey_shared.php?survey=<?php echo $_SESSION['survey']?>" name="lien" disabled>

                                <div  id="divContentToPopup">
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_button_email"></a>
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                    </div>
                                </div>
                                <button type="button" class="btn cancel" onclick="closeShareForm()">Close</button>
                            </form>
                        </div>
                        <div id='partage' class='partage'>
                            <button id='b_partage'>Partager</button>
                        </div>-->
                    <!--Bouton de tri des formulaires-->
                    <div class=home-Sort-Button> <!--Bouton de tri des formulaires-->
                        <select id="cars">
                          <option value="titre">Titre</option>
                          <option value="date" selected>Date</option>
                          <option value="perso">Personnalisé</option>
                        </select>
                    </div>

                    <!--Affichage des formulaires + bouton de création d'un formulaire-->
                    <div class=Select-Form-Section id=Select-Form-Section>

                        <div class=parent-Form> <!--Bouton ajouter formulaire    style=\"background-color:red;\"-->
                            <div class="child-Form createForm" type="button" onclick="SessionSurvey(0)">
                                <div id=createForm>&nbsp;</div>
                                <div id=underCreate>
                                    <p>Cr&eacute;er un formulaire</p>
                                </div>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%e %b %Y %k:%i') as date_ouverture FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY date_ouverture DESC;";
                            $res = mysqli_query($conn, $sql);
                            date_default_timezone_set('Europe/Paris');
                            while ( $result = $res->fetch_assoc()){
                                if(substr(substr($result['date_ouverture'],0,11),-1) == " "){
                                    $dateOuverture = substr($result['date_ouverture'], 0, 10);
                                }
                                else {
                                    $dateOuverture = substr($result['date_ouverture'], 0, 11);
                                }
                                if($dateOuverture == date('j M Y')){
                                    $dateOuverture = substr($result['date_ouverture'], -5);
                                }

                                echo "<div id=\"". $result['id_surveys'] ."\" class=\"parent-Form\" draggable='true'>"; /*div extern des formulaires à sélectionner*/ 
                                echo "  <div class=\"child-Form\"  onclick=\"SessionSurvey(". $result['id_surveys'] .")\">"; /*div inside des formulaires à sélectionner*/
                                echo "      <div class=upperBtn></div>

                                            <div class=downBtn>
                                                <div class=titleForm>
                                                    <p title='". $result['title'] . "'>". $result['title'] . "</p>         <!--Titre du formulaires-->
                                                </div>

                                                <div class=moreInfoForm>
                                                    <p title='". $dateOuverture . "'>". $dateOuverture . "</p>
                                                    <div class=dropdownForm>
                                                        <button class=\"more\" onclick=dropMenuForm(". $result['id_surveys'] .")></button>
                                                        <div id=droppedMenuForm". $result['id_surveys'] ." class=dropdownFormContent>
                                                            <button onclick=\"wantToDelete('". $result['id_surveys'] ."')\"></button>
                                                            <button style=\"display:block;\" onclick=RemoveSurvey(". $result['id_surveys'] .")>SUPPRIMER</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>";
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
    <script src="../Scripts/dropMenuUser.js"></script>
    <script src='../Scripts/drag_and_drop.js'></script>
    <script src='../Scripts/homeDesign.js'></script>
    <script>

    function SessionSurvey(id){
        $.ajax({
            type: 'POST',
            url: '../Scripts/session_survey.php',
            data:{action: id},
            success:function(data) {
                window.location.href = "survey_editor.php";
            }
        })
    }
    
    $(document).on('change', 'select', function () {
        $.ajax({
            type: 'POST',
            url: '../Scripts/select_surveys.php',
            data:{action: $(this).children('option:selected').val()},
            success:function(data) {
                document.getElementById("Select-Form-Section").innerHTML = "\
                <div class=parent-Form>\
                    <div class=child-Form type='button' onclick='SessionSurvey(0)'>\
                            <div id=createForm>&nbsp;</div>\
                            <div id=underCreate>\
                            <p>Cr&eacute;er un formulaire</p>\
                            </div></div>\
                        </div>" + data;
            }
        })
            
    });
       
    </script>
</html>
