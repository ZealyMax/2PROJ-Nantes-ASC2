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
                                <a href="home.php">Mes formulaires</a>
                                <a href="../Scripts/disconnect.php">Déconnexion</a>
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
                                    <p id=createTextForm>Cr&eacute;er un formulaire</p>
                                </div>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%d %b %Y %H:%i') as date_ouverture FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY date_ouverture DESC;";
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
                                echo "  <div class=\"child-Form\"  onclick=\"SessionSurvey(". $result['id_surveys'] .")\">"; /*div inside des formulaires à sélectionner*/
                                echo "      <div class=upperBtn></div>

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
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        

        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
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

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</html>
