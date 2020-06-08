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
        alert("test");
        //alert(document.forms.answerForm.elements.length);
        var x =0 ;
        var nb_question = "question"+x;
        for(x = 0; x < document.forms.answerForm.elements.length; x++){
            alert(nb_question);

            alert(document.forms.answerForm.elements[nb_question].value);
            nb_question = "question"+x;
           
		}
        alert(document.forms.answerForm.elements.question0.value);
        //var selectFormElement = document.forms["answerForm"].elements[blablabl]; Vincent test cette syntaxe
        if(true){
        
            //document.getElementsByClassName("answerForm").submit();
            document.forms["answerForm"].submit();
        }
    }
</script>