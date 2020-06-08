<?php 
	echo "t'es sur le respond_to_survey.php";

	/*$sql = "INSERT INTO answers (id_surveys,id_question) VALUES (". $_POST['question'][1] .")";
	$res = mysqli_query($conn, $sql);*/

    foreach ($_POST as $key => $value) {
        echo '<p>'.$key.'</p>';
        foreach($value as $k => $v){
            echo '<p>'.$k.'</p>';
            echo '<p>'.$v.'</p>';
            echo '<hr />';
        }
    }
?>
