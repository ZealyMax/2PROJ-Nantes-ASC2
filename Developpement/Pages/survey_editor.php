<!DOCTYPE html>
<?php  
include('../Scripts/redirect_to_connection.php');
include "../Scripts/connect_database.php" ;
?>
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
                            <h1 id=formHeaderName>
                                <?php
                                    $sql = "SELECT title FROM surveys where id_surveys=". $_SESSION['survey'];
                                    $resTitle = mysqli_query($conn,$sql);
                                    if($resultTitle = $resTitle -> fetch_assoc()){
                                        echo $resultTitle['title'];
									}
                                    else{
                                        echo 'Titre du formulaire';
                                    }
                                ?>
                            </h1>
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

            <div class=secondHeader>
                <div class=contentSecondHeader>

                    <div class=sharePopup id=myForm>
                        <button onclick="shareForm()" class=shareButton>Partager</button>
                    </div>
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
                            <?php include "../Scripts/get_answers.php" ?>
                        </div>
                    </div>
                </div>
            </div>
            <div action="/action_page.php" id=divContentToPopup class=divContentToPopup>
                <div class=Popup>
                    <div class=popupContent>
                        <div class=popupContentInside>
                            <div class=popupHead>
                                <h1>Envoyer le formulaire</h1>
                                <button type="button" class="btn-close" onclick="closeShareForm()">X</button>
                            </div>
                            <p>Lien</p>
                            <div class=contentOfPopup>
                                <input id=linkToCopy title="http://93.26.58.131/Developpement/Pages/survey_shared.php?survey=<?php echo $_SESSION['survey']?>" value="http://93.26.58.131/Developpement/Pages/survey_shared.php?survey=<?php echo $_SESSION['survey']?>">
                                <button id=btnCopyToClipboard title="Copier dans le presse-papier" onclick="copyToClipboard()"></button>
                            </div>
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://93.26.58.131/Developpement/Pages/survey_shared.php?survey=<?php echo $_SESSION['survey']?>" data-a2a-title="R&eacute;pondez au questionnaire suivant : <?php echo $resultSurvey['title']?>">
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
document.getElementById("Reponse").style.display = "none";
    function changeTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");

        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
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
<script src='../Scripts/copyToClipboard.js'></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>


