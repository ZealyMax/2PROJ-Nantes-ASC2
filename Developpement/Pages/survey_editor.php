<!DOCTYPE html>
<?php  
include('../Scripts/redirect_to_connection.php');
include "../Scripts/connect_database.php" ;?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/Main/global.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/header.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/content.css">
        <title>créer un formulaire</title>
    </head>
    <body>
        <div class=Main>
            <div class=Header>
                <div class=contentHead>
                    <div class=Logo>
                        <a href=home.php><!--Partie gauche du Header, logo + texte-->
                            <div id=rectangle></div>
                            <p class=txt><b>Online Survey</b></p>
                        </a>
                    </div>

                    <div class=formTitle>
                        <div>
                            <h1 id=formHeaderName>Titre du formulaire</h1>
                            <h2>-</h2>
                            <h2 id=formHeaderStatus>Enregistré</h2>
                            <!--Faire en sorte d'avoir le titre du formulaire ici-->
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

            <div class=secondHeader>
                <div class=contentSecondHeader>
                    <button class=overview>
                        
                    </button>
                    <button class=shareButton style="display:block;" onclick="shareForm()">Partager</button> <!-- TODO: enlever display:none   -->
                        <div class="share-popup" id="myForm">
                            <form action="/action_page.php" class="share-container">
                                <h1>Partager</h1>

                                <!-- TODO: TROUVER LE LIEN DE PARTAGE   -->
                                <input type="text" value="lien de partage" name="lien" disabled>

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
                    <button class=burgerMenu>
                        
                    </button>
                </div>
            </div>

            <div class=Content>
                <div class=mainContent>
                    <div class="survey_editor">
                        <div class="tab">
                            <button class="tablinks" onclick="changeTab(event, 'Question')" id="defaultOpen"> Question </button>
                            <button class="tablinks" onclick="changeTab(event, 'Réponse')"> Réponse </button>
                        </div>
                        <div id="Question" class="tabcontent">
                            <form method=POST action=../Scripts/create_form.php>
                               <?php include "../Scripts/getSurvey.php" ?>
                            </form>
                        </div>

                        <div id="Réponse" class="tabcontent">
                            <h1>Test</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function changeTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
</script>
<script>
    function shareForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeShareForm() {
    document.getElementById("myForm").style.display = "none";
    }
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src='../Scripts/survey_editor.js'></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>

