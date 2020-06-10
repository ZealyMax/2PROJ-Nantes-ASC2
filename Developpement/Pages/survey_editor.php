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
                    <a href=home.php class=Logo><!--Partie gauche du Header, logo + texte-->
                        <img src="../../Design/icons/logo/Logo@2x.png"></img>
                        <p class=txt><b>Online Survey</b></p>
                    </a>

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
                        <!--A compléter-->
                    </button>

                    <div class=sharePopup id=myForm>
                        <button class=shareButton onclick="shareForm()">Partager</button>

                            <form action="/action_page.php" id=divContentToPopup class=divContentToPopup>
                                <h1>Partager</h1>
                                <input type="text" value="http://93.26.58.131/Final_Project/Developpement/Pages/survey_shared.php?survey=<?php echo $_SESSION['survey']?>" name="lien" disabled>
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                    <a class="a2a_button_email"></a>
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                </div>
                                <button type="button" class="btn-cancel" onclick="closeShareForm()">Close</button>
                            </form>
                    </div>

                    <button class=burgerMenu>
                        <!--A compléter-->
                    </button>
                </div>
            </div>

            <div class=Content>
                <div class=mainContent>
                    <div class="survey_editor">
                        <div class="tab">
                            <button id=b1 class="tablinks active" onclick="changeTab(event, 'Question')" id="defaultOpen"> Question </button>
                            <button id=b2 class="tablinks" onclick="changeTab(event, 'Reponse')"> Réponse </button>
                        </div>
                        <div id="Question" class="tabcontent">
                            <form method=POST action=../Scripts/create_form.php>
                                <?php include "../Scripts/get_survey_edit.php" ?>
                                
                            </form>
                        </div>

                        <div id="Reponse" class="tabcontent">
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
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src='../Scripts/focusableQuestions.js'></script>
<script src="../Scripts/dropMenuUser.js"></script>
<script src='../Scripts/survey_editor.js'></script>
<script src='../Scripts/drag_and_drop.js'></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>


