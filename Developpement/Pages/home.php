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
        <title>Online Survey - Home</title>
        
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <!--HTML2CANVAS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
                            <button class=search-Icon>&nbsp;</button>
                            <input class=Search name="search" type="text" placeholder="Rechercher">
                        </div>
                    </div>
                    
                    <div class=User> <!--Partie droite : zone compte (Home, Déconexion...)-->
                        <div class=dropdown>
                            <button onclick="dropMenuUser()" class="dropButton"></button>
                        
                            <div id="droppedMenu" class="dropdown-Content">
                                <a href="home.php">Mes formulaires</a>
                                <a href="../Scripts/disconnect.php">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class=Content>
                <div class=mainContent>
                    <div class='headForButtons'>
                        <div id='poubelle'>
                            <button id='b_poubelle'>&nbsp;</button>
                        </div>
                        <div class=listeDeroulante> <!--Bouton de tri des formulaires-->
                            <select id="cars">
                              <option value="titre">Titre</option>
                              <option value="date" selected>Date</option>
                              <option value="perso">Personnalisé</option>
                            </select>
                            <div class='select_arrow'></div>
                        </div>
                    </div>

                    <!--Affichage des formulaires + bouton de création d'un formulaire-->
                    <div class=Select-Form-Section id=Select-Form-Section>

                        <div class=parent-Form> <!--Bouton ajouter formulaire-->
                            <div class="child-Form createForm" type="button" onclick="SessionSurvey(0)">
                                <div id=createForm>&nbsp;</div>
                                <div id=underCreate>
                                    <p id=createTextForm>Cr&eacute;er un formulaire</p>
                                </div>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%d %b %Y %H:%i') as date_ouverture, image FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY date_ouverture DESC;";
                            $res = mysqli_query($conn, $sql);
                            date_default_timezone_set('Europe/Paris');
                            while ( $result = $res->fetch_assoc()){
                                if(substr($result['date_ouverture'],0,1) == "0"){
                                    $dateOuverture = substr($result['date_ouverture'], 1, 11);
                                }
                                else {
                                    $dateOuverture = substr($result['date_ouverture'], 0, 11);
                                }
                                if($dateOuverture == date('j M Y')){
                                    $dateOuverture = substr($result['date_ouverture'], -5);
                                }

                                echo "<div id=\"". $result['id_surveys'] ."\" class=\"parent-Form\" draggable='true'>"; /*div extern des formulaires à sélectionner*/ 
                                echo "  <div class=child-Form onclick=SessionSurvey(". $result['id_surveys'] .")>"; /*div inside des formulaires à sélectionner*/
                                echo "      <div class=upperBtn><img src='". $result['image'] ."'/></div>

                                            <div class=downBtn>
                                                <div class=titleForm>
                                                    <p title='". $result['title'] . "'>". $result['title'] . "</p>         <!--Titre du formulaires-->
                                                </div>

                                                <div class=moreInfoForm>
                                                    <p title='". $dateOuverture . "'>". $dateOuverture . "</p>

                                                    <div class=dropdownForm>
                                                        <button class=more onclick=dropMenuForm(". $result['id_surveys'] .")></button>
                                                        <div id=droppedMenuForm". $result['id_surveys'] ." class=dropdownFormContent>
                                                            <button onclick=wantToDelete('". $result['id_surveys'] ."')></button>
                                                            <button onclick=RemoveSurvey(". $result['id_surveys'] .")>SUPPRIMER</button>
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
        </div>
        

        
    </body>
    
    <script src="../Scripts/dropMenuUser.js"></script>
    <script src='../Scripts/drag_and_drop.js'></script>
    <script src='../Scripts/homeDesign.js'></script>
    <script>
    function SessionSurvey(id){
        window.onclick = function (event) {
            if (event.target.matches('.more') || event.target.matches('.dropdownFormContent')) {
            }else if(event.target.matches('.upperBtn') || event.target.matches('.downBtn')){
	            $.ajax({
                    type: 'POST',
                    url: '../Scripts/session_survey.php',
                    data:{action: id},
                    success:function(data) {
                        window.location.href = "survey_editor.php";
                    }
                })
            }else if(event.target.matches('#createForm') || event.target.matches('#underCreate') || event.target.matches('#createTextForm')){
	            $.ajax({
                    type: 'POST',
                    url: '../Scripts/session_survey.php',
                    data:{action: 0},
                    success:function(data) {
                        window.location.href = "survey_editor.php";
                    }
                })
            }else{
                var dropdowns = document.getElementsByClassName("dropdownFormContent");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
            }
        }
			}
        }

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
