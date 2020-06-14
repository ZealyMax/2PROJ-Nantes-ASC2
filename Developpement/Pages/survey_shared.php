<?php
	include "..\Scripts\connect_database.php";
	
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Shared/sharedContent.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Shared/saving.css">
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <title>Repondre au Formulaire</title>
    </head>
    <body>
        <?php
            if (isset($_GET['capture'])){
                echo "<div class=waitingForSave>
                        <div class=contentSaving>
                            <p>SAVING</p>
                            <div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>
                    </div>";
            }
        ?>
        <div class=Content>
            <div class=mainContent>
                <div class="survey_shared">
                    <?php  
                        
                        if(isset($_GET['survey'])){
                            $sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_GET['survey'];
                            $resSurvey = mysqli_query($conn, $sql);
                            if ($resultSurvey = $resSurvey->fetch_assoc()) {
                                echo " <form name=answerForm method=POST action='../Scripts/respond_to_survey.php'>
                                            <div class=container>
                                                <div class=headQuestion>
                                                    <p class=mainTitle name=Titre>" . $resultSurvey['title']. "</p>
                                                    <p class=mainDesc name=Description>". $resultSurvey['description'] ."</p>
                                                    <p style='color:crimson;'>*Obligatoire</p>
                                                </div>
                                                <div class=contentQuestion>
                                                    <div class='form'>";
                                                        include "..\Scripts\get_survey_share.php";
                                                    echo "<input class=sendAnswerButton type=button value='Envoyer' onclick='mustDoVerif()'>
                                                    </form>"; 
                            }else{
                                echo "<h2>Error 404</h2>";        
	                        }
                        }else{
                            echo "<h2>Error 404</h2>";
                    }?>
                </div>
            </div>
        </div>
        
    </body>
</html>
<script>
    function mustDoVerif(){
        
        var mustDo = document.getElementsByClassName("mustDoStar");
        var retry = false;  
        $("form:first :input").each(function() {           
            if($(this).closest(".question-div").children().children().attr('class') == "mustDoStar"){
                if($(this).attr('type') == "text" || $(this).attr('type') == "date" || $(this).attr('type') == "time" ){
                    if($(this).val() == ""){
                        retry = true;
					}
                } 
                else if($(this).attr('select') == 'select'){
                    if($(this).val() == "Sélectionnez"){
                        retry = true;
                    }
                }
            }
        });

        if(retry == false){
            document.forms["answerForm"].submit();
        }
    }
</script>