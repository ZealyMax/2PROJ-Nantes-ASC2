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
                for (var i = 0; i < 5;i += 2){
                    if(mustDo[x].parentNode.children[1].children[i].value == ""){
                        retry =true;
                        alert('retry = true loloololol');
                        break;     
					} 
				}
            }
            if (mustDo[x].parentNode.children[1].children[0].placeholder == "hour" && mustDo[x].checked == true){
                for (var i = 0; i < 3;i += 2){
                    if(mustDo[x].parentNode.children[1].children[i].value == ""){
                        retry =true;
                        alert('retry = true loloololol');
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

        //alert(document.forms.answerForm.elements.length);
        /*var x =0 ;
        var nb_question = "question"+x;
        for(x = 0; x < document.forms.answerForm.elements.length; x++){
            alert(nb_question);

            //alert(document.forms.answerForm.elements[nb_question].value);
            nb_question = "question"+x;
           
		}
        alert(document.forms[answerForm].elements[nb_question].value);*/
        //var selectFormElement = document.forms["answerForm"].elements[blablabl]; Vincent test cette syntaxe

       
        /*var splitquestion = document.forms.answerForm.elements[2].name.split("_");
        var id_question = splitquestion[1];
        var test_nb = 0;

        while(test_nb != mustDo.length){
            alert(document.forms.answerForm.elements[test_nb].name);
            test_nb++;
        }

        while(test_nb != mustDo.length){
            try{
                if(document.forms.answerForm.elements["question-" + id_question].value == "" && mustDo[test_nb].checked == true){
                    retry = true;
                    alert('retry = true loloololol');
                    break;
                } 
            } catch {
                alert("no value");        
			}
            id_question++;          
            test_nb++;
		}*/

       /* 
       var nb_val = 0;
        var test_id = 0;
        while(test_id != mustDo.length){
            alert(nb_val);
            if(typeof document.forms.answerForm.elements["question" + nb_val].value === "undefined"){

               if( document.forms.answerForm.elements["question" + nb_val].value == "" && mustDo[nb_val].checked == true){

                   retry =true;
                   alert('retry = true loloololol');
                   break;

                } 
                nb_val++;

            }
            test_id++;
		}*/
    }
</script>