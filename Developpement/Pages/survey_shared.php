<?php
	include "..\Scripts\connect_database.php";
	
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Shared/sharedContent.css">
        <title>Repondre au Formulaire</title>
    </head>
    <body>

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
        for(var x = 0; x < mustDo.length; x++){
            if(mustDo[x].parentNode.parentNode.children[1].children[0].value == "" && mustDo[x].parentNode.parentNode.children[1].children[0].value == "Sélectionnez"){
                retry =true;
                alert('retry = true loloololol');
                break; 
            }
        }
        if(retry == false){
            document.forms["answerForm"].submit();
        }
    }
</script>