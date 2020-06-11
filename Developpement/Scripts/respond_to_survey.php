<?php 
    include("connect_database.php");
	
    $sql = "SELECT number_answer_sheet FROM answers ORDER BY number_answer_sheet DESC";
    $res = mysqli_query($conn, $sql);
    $resultNumber = $res->fetch_assoc();   
    $number_answer = $resultNumber['number_answer_sheet'] + 1;
    echo $number_answer."<br>";



    foreach ($_POST as $key => $value) {
        $keyArray = [];
        array_push($keyArray, $key);
    }

    for($y =0; $y > sizeof($keyArray) ;$y++){
        echo $keyArray[$y];
	}
    $keySplitIdSurvey = explode("_", $key);
    echo $keySplitIdSurvey[1]."<br>";
    $sql = "SELECT id_questions FROM questions WHERE id_surveys = '". $keySplitIdSurvey[1]."'";
	$resQuestion = mysqli_query($conn, $sql);
    $i = 0;
    while ($resultQuestion = $resQuestion->fetch_assoc()){
        // and foreach ($_POST as $key => $value)
        echo '<p>'.$keyArray[$i].'</p>';
        echo $_POST[$keyArray[$i]] ."<br>";
        echo $resultQuestion['id_questions'];
        $keySplit = explode("_", $keyArray[$i]);
        $answer = $_POST[$key];
            
        if($resultQuestion['id_questions'] == $keySplit[2]){//si l'id de la question de la  réponse est égale à l'id de la question du survey alors on insert
            echo "égale";
            if(isset($keySplit[4])){//si il y a un id_sub_question 
                echo "if";
                $sql ="INSERT INTO answers (id_surveys, id_questions , id_sub_questions, answer,number_answer_sheet) VALUES ('$keySplit[1] ','$keySplit[2]','$keySplit[4]','$answer','$number_answer')";
                $resInsertAnswer = mysqli_query($conn, $sql);
            }

            else{ // si y a pas de id_sub_question
                echo "else";
                $sql ="INSERT INTO answers (id_surveys, id_questions, answer,number_answer_sheet) VALUES ('$keySplit[1]','$keySplit[2]',' $answer','$number_answer')";
                $resInsertAnswer = mysqli_query($conn, $sql);
		    }
            $i++;
            
	    } 
        $sql ="INSERT INTO answers (id_surveys, id_questions , id_sub_questions, answer,number_answer_sheet) VALUES ('$keySplitIdSurvey[1] ',".$resultQuestion['id_questions'].",'null','$number_answer')";
        $resInsertAnswer = mysqli_query($conn, $sql);
    }
?>
