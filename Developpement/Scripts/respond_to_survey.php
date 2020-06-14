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

  
    foreach ($_POST as $key => $value) {
        $keySplit = explode("_", $key);
        if (str_replace(' ', '', $_POST[$key]) != "" && $_POST[$key] != "" && $_POST[$key] != "Sélectionnez"){
            if($keySplit[3] == "checkbox" || $keySplit[3] == "grid-checkbox" || $keySplit[3] == "grid-multiple"){
                echo "update checkbox <br>";
                $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets, id_sub_questions, answer) VALUES ('$keySplitIdSurvey[1]', '$keySplit[2]', '$number_answer', '$keySplit[4]' , '". $_POST[$key] . "')";
                $resInsertVide = mysqli_query($conn, $sql);
                echo mysqli_error($conn);
		    }
            else{
                echo "update reste <br>";
                $sql = "INSERT INTO answers (id_surveys, id_questions, id_answer_sheets, answer) VALUES ('$keySplitIdSurvey[1]', '$keySplit[2]', '$number_answer', '". $_POST[$key] . "')";
                $resInsertVide = mysqli_query($conn, $sql);
                echo mysqli_error($conn);
			}
        }
    }

    header("location:../Pages/survey_sent.php");
?>
