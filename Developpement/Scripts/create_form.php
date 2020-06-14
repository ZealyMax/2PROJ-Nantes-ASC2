 <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

        <!--HTML2CANVAS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<?php
    include "connect_database.php";
    session_start();
    if($_SESSION['survey'] != 0){
        $sql = "DELETE FROM surveys WHERE id_surveys=" . $_SESSION['survey'];
        $resDeleteSurvey = mysqli_query($conn, $sql);
	}
    if (isset($_POST['submit'])) {
        $titre = $_POST['Titre'];
        $description = $_POST['Description'];
        if ($titre == ""){           
            $sql = "INSERT INTO surveys (title, description, id_users, date_ouverture) VALUES ('Formulaire sans titre', '$description', $_SESSION[id_users], NOW())"; 
		}
        else{
            $sql = "INSERT INTO surveys (title, description, id_users, date_ouverture) VALUES ('$titre','$description', $_SESSION[id_users], NOW())"; 
		}
        $res = mysqli_query($conn, $sql);
        $sql = "SELECT id_surveys FROM surveys WHERE id_users = $_SESSION[id_users] ORDER BY id_surveys DESC";  
        $resSurvey = mysqli_query($conn, $sql);
        $resultSurvey = $resSurvey->fetch_assoc();
        $id_surveys = $resultSurvey['id_surveys'];
        $mustDoArray = [];
        if(isset($_POST['mustDo'])){
            for($i = 0; $i < count($_POST['mustDo']); $i++){  
                
                if (isset($mustDoPrevious)){
                    for($y = $mustDoPrevious+10; $y < $_POST['mustDo'][$i]; $y++){
                        array_push($mustDoArray, 0);  
			        }
                }
                else{
                    for($y = 0; $y < $_POST['mustDo'][$i]; $y++){
                        array_push($mustDoArray, 0);  
			        }
			    }
                array_push($mustDoArray, 1);  
                $mustDoPrevious = $_POST['mustDo'][$i];
            }
        }
        //print_r($mustDoArray);
        

        if(isset($_POST['question'])){
            
            $indexSubQuestions = 0;
            for($i = 0; $i < count($_POST['question']); $i++){  

                $question = $_POST['question'][$i];
                $type = $_POST['selectType'][$i];


                if(isset($mustDoArray[$i])){
                    $sql = "INSERT INTO questions (id_surveys,  question, type, mustDo) VALUES ('$id_surveys', '$question', '$type' ,'$mustDoArray[$i]')";
                    $res = mysqli_query($conn, $sql);
                }

                else{
                    $sql = "INSERT INTO questions (id_surveys, question, type, mustDo) VALUES ('$id_surveys', '$question', '$type', 0)";
                    $res = mysqli_query($conn, $sql); 
			    }



                if($type == "multiple" || $type == "grid-multiple" || $type == "grid-checkbox" || $type == "list" || $type == "checkbox" || $type == "linear-scale"){

                    $sql = "SELECT id_questions FROM questions WHERE id_surveys = $id_surveys ORDER BY id_questions DESC";  
                    $resQuestion = mysqli_query($conn, $sql);
                    $resultQuestion = $resQuestion->fetch_assoc();

                    $id_questions = $resultQuestion['id_questions'];
                    
                    while($_POST['sub_questions'][$indexSubQuestions] != 'new question'){
                        if($type == "linear-scale"){
                            $indexSubQuestionsValue = $indexSubQuestions + 2;
                            $typeSubQuestion = $_POST['sub_questions'][$indexSubQuestions];
                            $scaleSubQuestion = $_POST['sub_questions'][$indexSubQuestions +1];
                            $valueSubQuestion =  $_POST['sub_questions'][$indexSubQuestionsValue]; 
                            $sql = "INSERT INTO sub_questions (id_questions, type, value, scale_name) VALUES ('$id_questions', '$typeSubQuestion', '$valueSubQuestion', '$scaleSubQuestion')";
                            $res = mysqli_query($conn, $sql);
                            $indexSubQuestions += 3;

                        }
                        else{
                            $indexSubQuestionsValue = $indexSubQuestions +1;
                            $typeSubQuestion = $_POST['sub_questions'][$indexSubQuestions];
                            $valueSubQuestion =  $_POST['sub_questions'][$indexSubQuestionsValue]; 


                            $sql = "INSERT INTO sub_questions (id_questions, type, value) VALUES ('$id_questions', '$typeSubQuestion', '$valueSubQuestion')";
                            $res = mysqli_query($conn, $sql);
                            $indexSubQuestions += 2;
                        }
                    }
			    }
                $indexSubQuestions += 1;
		    }
        }
        unset($_SESSION['survey']);
        $_SESSION['survey'] = $id_surveys;
        $_GET['survey']=$_SESSION['survey'];
        $_GET['capture'] = true;
        include("../Pages/survey_shared.php");
        echo "
        
        <script>
        function getScreen()
        {
            html2canvas(document.getElementsByClassName('survey_shared')[0], 
            {
                dpi:192,
                onrendered: function(canvas) 
                {
                    /*console.log(canvas.toDataURL('../Ressources/BG_Form/png'));*/
                    //var image = canvas.toDataURL('../Ressources/BG_Form/png');
                    
                    $.ajax(
                    {
                        type: 'POST',
                        url: 'upload_image.php',
                        data:{action: canvas.toDataURL('../Ressources/BG_Form/png'),
                            survey: ". $_SESSION['survey'].",
                        },
                        success:function(data){
                            document.getElementsByClassName('survey_shared')[0].style.display = 'none';
                            window.location.href = '../Pages/survey_editor.php';    
                        },
                        
                    });
				}
                
            });
        } 
        getScreen();
        
        </script>"; 
    }
?>
