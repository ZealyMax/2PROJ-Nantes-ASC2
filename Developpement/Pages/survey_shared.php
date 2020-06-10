<?php
	include "..\Scripts\connect_database.php";
	
?>
<html lang="fr">
    <style>
        body{
            text-align: center;  
		}
    </style>
    <!--<style>
        .question-div{
            border: 2px solid #666666;
	        background-color:blue;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            /* Required to make elements draggable in old WebKit */
            -khtml-user-drag: element;
            -webkit-user-drag: element;
		}
    </style> -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/Main/global.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/header.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/content.css">
        <title>Repondre au Formulaire</title>
    </head>
    <body>
          <?php  if(isset($_GET['survey'])){
                    $sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_GET['survey'];
                    $resSurvey = mysqli_query($conn, $sql);
                    if ($resultSurvey = $resSurvey->fetch_assoc()) {
                        echo " <form name=answerForm method=POST action='../Scripts/respond_to_survey.php'>
                                    <div class=container>
                                    <div class=headQuestion>
                                        <p class=mainTitle name=Titre>" . $resultSurvey['title']. "</p>
                                        <p class=mainDesc name=Description>". $resultSurvey['description'] ."</p>
                                        <input type=button value='Répondre' onclick='mustDoVerif()'>
                                    </div>
                                    <div class=contentQuestion>
                                    <div class=form>";

                        include "..\Scripts\get_survey_share.php"; 

                        echo "</form>"; 
                    }
                    else{
                        echo "<h2>Error 404</h2>";        
					}
                }
                else{
                    echo "<h2>Error 404</h2>";
                }?>
       
    </body>
</html>
<script>
    function mustDoVerif(){

        var mustDo = document.getElementsByName("mustDo[]");
        var retry = false;          
        for(var x = 0; x < mustDo.length; x++){
            if (mustDo[x].parentNode.children[1].children[0].placeholder == "day" && mustDo[x].checked == true){
                if(mustDo[x].parentNode.children[1].children[0].value == "jj/mm/yyyy"){
                    retry =true;
                    alert('retry = true loloololol');
                    break;     
				} 

            }
            if (mustDo[x].parentNode.children[1].children[0].placeholder == "hour" && mustDo[x].checked == true){
                for (var i = 0; i < 3;i += 2){
                    if(mustDo[x].parentNode.children[1].children[i].value == ""){
                        retry =true;
                        alert('retry = true lolololol');
                        break;     
					} 
				}
            }
            else if(mustDo[x].parentNode.children[1].children[0].value == "" && mustDo[x].checked == true){
                retry =true;
                alert('retry = true loloololol');
                break; 
            }
 
        }
        if(retry == false){
            document.forms["answerForm"].submit();
        }
    }
    function controlHour(name){
        if (name.value > 23){
            name.value = 23;
        }
        else if(name.value < 0){
            name.value = 0;
        }
	}
    function controlMinute(name){
        if (name.value > 59){
            name.value = 59;
        }
        else if(name.value < 0){
            name.value = 0;
        }
	}
</script>