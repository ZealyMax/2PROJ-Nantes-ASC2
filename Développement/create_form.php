<?php
    include "connect_database.php";
    session_start();
    if (isset($_POST['submit'])) {
        $titre = $_POST['Titre'];
        if (isset($_POST['Description'])){
            $description = $_POST['Description'];
            $sql = "INSERT INTO surveys (title, description, id_users) VALUES ('$titre', '$description', $_SESSION[id_users])";
		}
        else{
            $sql = "INSERT INTO surveys (title, id_users) VALUES ('$titre', $_SESSION[id_users])";  
		}
        $res = mysqli_query($conn, $sql);
        $sql = "SELECT id_surveys FROM surveys WHERE id_users = $_SESSION[id_users] ORDER BY id_surveys DESC";  
        $res = mysqli_query($conn, $sql);
        $result = $res->fetch_assoc();
        $id_surveys = $result['id_surveys'];
        $mustDoArray = [];
        if(isset($_POST['mustDo'])){
            for($i = 0; $i < count($_POST['mustDo']); $i++){  
                $mustDo = $_POST['mustDo'][$i];
                if (isset($mustDoPrevious)){
                    for($y = 0; $y < $mustDo - $mustDoPrevious-1; $y++){
                        array_push($mustDoArray, 0);  
			        }
                }
                else{
                    for($y = 0; $y < $mustDo; $y++){
                        array_push($mustDoArray, 0);  
			        }
			    }
                array_push($mustDoArray, 1);  
                $mustDoPrevious = $mustDo;
            }
        }


        if(isset($_POST['question'])){

            $indexSubQuestions = 0;

            for($i = 0; $i < count($_POST['question']); $i++){  

                $question = $_POST['question'][$i];
                $type = $_POST['selectType'][$i];


                if(isset($mustDoArray[$i])){
                    $sql = "INSERT INTO questions (id_surveys,  question, type, mustDo) VALUES ('$id_surveys', '$question', '$type' ,'$mustDoArray[$i]')";
                    $res = mysqli_query($conn, $sql);
                }

<<<<<<< Updated upstream:Développement/create_form.php
       header("location:home.php");
       }
?>
=======
                else{
                    $sql = "INSERT INTO questions (id_surveys, question, type, mustDo) VALUES ('$id_surveys', '$question', '$type', 0)";
                    $res = mysqli_query($conn, $sql); 
			    }



                if($type == "multiple" || $type == "grid-multiple" || $type == "grid-checkbox" || $type == "list" || $type == "checkbox" || $type == "linear-scale"){

                    $sql = "SELECT id_questions FROM questions WHERE id_surveys = $id_surveys ORDER BY id_questions DESC";  
                    $res = mysqli_query($conn, $sql);

                    $result = $res->fetch_assoc();
                    $id_questions = $result['id_questions'];

                    while($_POST['sub_questions'][$indexSubQuestions] != 'new question'){

                        $indexSubQuestionsValue = $indexSubQuestions +1;
                        $typeSubQuestion = $_POST['sub_questions'][$indexSubQuestions];
                        $valueSubQuestion =  $_POST['sub_questions'][$indexSubQuestionsValue]; 

                        $sql = "INSERT INTO sub_questions (id_questions, type, value) VALUES ('$id_questions', '$typeSubQuestion', '$valueSubQuestion')";
                        $res = mysqli_query($conn, $sql);
                        $indexSubQuestions += 2;
                    }
                    $indexSubQuestions += 1;
			    }
		    }
        }
        if($_SESSION){
            unset($_SESSION['survey']);
        }
    }
?>
<a href=../Pages/home.php>Next</a>
>>>>>>> Stashed changes:Développement/Scripts/create_form.php
