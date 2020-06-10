<?php 
    include("connect_database.php");
	/*$sql = "INSERT INTO answers (id_surveys,id_question) VALUES (". $_POST['question'][1] .")";
	$res = mysqli_query($conn, $sql);*/
    $sql ="SELECT number_answer_sheet FROM answers ORDER BY number_answer_sheet DESC";
    $res = mysqli_query($conn, $sql);
    $resultNumber = $res->fetch_assoc();   
    $number_answer = $resultNumber['number_answer_sheet'] + 1;
    
    foreach ($_POST as $key => $value) {
        echo '<p>'.$key.'</p>';
        echo $_POST[$key] ."<br>";
        $keySplit = explode("_", $key);
        echo $keySplit[1] .  "<hr />";
        if(isset($keySplit[3])){//si il y a un id_sub_question 
            //à compléter en fonction du type et en fonction de $_POST[$key]
            //$sql ="INSERT INTO answers (number_answer_sheet, id_question , i) VALUES (". $number_answer .",". $keySplit[1] .")";
            //$res = mysqli_query($conn, $sql);
        }

        else{ // si y a pas de id_sub_question
            //à compléter en fonction du type et en fonction de $_POST[$key]
            //$sql ="INSERT INTO answers (number_answer_sheet, id_question , i) VALUES (". $number_answer .",". $keySplit[1] .")";
            //$res = mysqli_query($conn, $sql);
		}
	}   
?>
