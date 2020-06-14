<?php 
    include("connect_database.php");
    $keyArray = [];
    foreach ($_POST as $key => $value) {
        echo $key ."<br>";
        echo $_POST[$key]. "<br><hr>";
    }
    $keySplitIdSurvey = explode("_", $key);
    echo $keySplitIdSurvey[1]."<br>";

    $sql = "INSERT INTO answer_sheets(id_surveys) VALUES ('$keySplitIdSurvey[1]')";
    $res = mysqli_query($conn, $sql);
    echo mysqli_error($conn); 

    $sql = "SELECT id_answer_sheets FROM answer_sheets ORDER BY id_answer_sheets DESC";
    $res = mysqli_query($conn, $sql);
    echo mysqli_error($conn); 

    $resultNumber = $res->fetch_assoc();   
    $number_answer = $resultNumber['id_answer_sheets'];
    echo $number_answer."<br>";
    /*
    $sql = "SELECT id_questions, type FROM questions WHERE id_surveys = ". $keySplitIdSurvey[1];
	$resQuestion = mysqli_query($conn, $sql);
    echo mysqli_error($conn); 

    while ($resultQuestion = $resQuestion->fetch_assoc()){
        if($resultQuestion['type'] == "checkbox" || $resultQuestion['type'] == "grid-checkbox" || $resultQuestion['type'] == "grid-multiple"){
            $sql = "SELECT id_sub_questions FROM sub_questions where id_questions =". $resultQuestion['id_questions'];
            $resSub = mysqli_query($conn, $sql);
            echo mysqli_error($conn);
            while($resultSub = $resSub->fetch_assoc()){
                echo "0 checkbox <br>";
                $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets, id_sub_questions) VALUES ('$keySplitIdSurvey[1]', ".$resultQuestion['id_questions'].", '$number_answer', ".$resultSub['id_sub_questions'].")";
                $resInsertVide = mysqli_query($conn, $sql);
                echo mysqli_error($conn); 
            }

        } else{
            echo "0  reste <br>";
            
            $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets) VALUES ('$keySplitIdSurvey[1]', ".$resultQuestion['id_questions'].", '$number_answer')";
            $resInsertVide = mysqli_query($conn, $sql);
            echo mysqli_error($conn);  
		}
    }*/
  
    foreach ($_POST as $key => $value) {
        $keySplit = explode("_", $key);
        if (str_replace(' ', '', $_POST[$key]) != "" && $_POST[$key] != "" && $_POST[$key] != "Sélectionnez"){
            if($keySplit[3] == "checkbox" || $keySplit[3] == "grid-checkbox" || $keySplit[3] == "grid-multiple"){
                echo "update checkbox <br>";
                //$sql = "UPDATE answers SET answer = '". $_POST[$key] ."', empty = 0 WHERE id_questions = ". $keySplit[2]." AND id_answer_sheets =". $number_answer." AND id_sub_questions =". $keySplit[4];    
                $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets, id_sub_questions, answer) VALUES ('$keySplitIdSurvey[1]', '$keySplit[2]', '$number_answer', '$keySplit[4]' , '". $_POST[$key] . "')";
                $resInsertVide = mysqli_query($conn, $sql);
                echo mysqli_error($conn);
		    }
            else{
                echo "update reste <br>";
                //$sql = "UPDATE answers SET answer = '". $_POST[$key] ."', empty = 0 WHERE id_questions = ". $keySplit[2]." AND id_answer_sheets =". $number_answer;   
                $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets, answer) VALUES ('$keySplitIdSurvey[1]', '$keySplit[2]', '$number_answer', '". $_POST[$key] . "')";
                $resInsertVide = mysqli_query($conn, $sql);
                echo mysqli_error($conn);
			}
        }
    }
?>
