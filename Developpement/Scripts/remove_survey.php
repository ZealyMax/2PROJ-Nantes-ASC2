<?php    
    include "connect_database.php";
    session_start();
    $sql = "SELECT id_questions FROM questions WHERE id_surveys =" . $_POST['action'];
    $resQuestion = mysqli_query($conn, $sql);
    if($resQuestion -> num_rows > 0){
        while($resultQuestion = $resQuestion -> fetch_assoc()){
            $sql = "DELETE FROM sub_questions WHERE id_questions =" . $resultQuestion['id_questions'];
            $resDeleteSub = mysqli_query($conn, $sql);
		}
        $sql = "DELETE FROM questions WHERE id_surveys =" . $_POST['action'];
        $resDeleteQuestion = mysqli_query($conn,$sql);
    }
    $sql = "DELETE FROM surveys WHERE id_surveys=" . $_POST['action'];
    $resDeleteSurvey = mysqli_query($conn, $sql);
?>