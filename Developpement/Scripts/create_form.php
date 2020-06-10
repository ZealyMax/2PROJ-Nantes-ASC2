<?php
    include "connect_database.php";
    session_start();
    if($_SESSION['survey'] != 0){
        $sql = "SELECT id_questions FROM questions WHERE id_surveys =" .$_SESSION['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        if($resQuestion -> num_rows > 0){
            while($resultQuestion = $resQuestion -> fetch_assoc()){
                $sql = "DELETE FROM sub_questions WHERE id_questions =" . $resultQuestion['id_questions'];
                $resDeleteSub = mysqli_query($conn, $sql);
		    }
            $sql = "DELETE FROM questions WHERE id_surveys =" . $_SESSION['survey'];
            $resDeleteQuestion = mysqli_query($conn,$sql);
        }
        $sql = "DELETE FROM surveys WHERE id_surveys=" . $_SESSION['survey'];
        $resDeleteSurvey = mysqli_query($conn, $sql);
	}
    if (isset($_POST['Titre'])) {
        $titre = $_POST['Titre'];
        if (isset($_POST['Description'])){
            $description = $_POST['Description'];
            $sql = "INSERT INTO surveys (title, description, id_users, date_ouverture) VALUES ('$titre', '$description', $_SESSION[id_users], NOW())"; 
		}
        else{
            $sql = "INSERT INTO surveys (title, id_users, date_ouverture) VALUES ('$titre', $_SESSION[id_users], NOW())"; 
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

                        $indexSubQuestionsValue = $indexSubQuestions +1;
                        $typeSubQuestion = $_POST['sub_questions'][$indexSubQuestions];
                        $valueSubQuestion =  $_POST['sub_questions'][$indexSubQuestionsValue]; 


                        $sql = "INSERT INTO sub_questions (id_questions, type, value) VALUES ('$id_questions', '$typeSubQuestion', '$valueSubQuestion')";
                        $res = mysqli_query($conn, $sql);
                        $indexSubQuestions += 2;
                    }
			    }
                $indexSubQuestions += 1;
		    }
        }
        unset($_SESSION['survey']);
        header('location:../Pages/home.php');   
    }
?>
<!--<a href=../Pages/home.php>Next</a>->
