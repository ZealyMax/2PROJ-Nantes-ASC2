<?php
    include "connect_database.php";
    session_start();
    if (isset($_POST['submit'])) {
        $titre = $_POST['Titre'];
        if (isset($POST['Description'])){
            $description = $POST['Description'];
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
        for($i = 0; $i < count($_POST['question']); $i++){  
            $question = $_POST['question'][$i];
            $mustDo = $_POST['mustDo'][$i];
            $sql = "INSERT INTO questions (id_surveys, question, mustDo) VALUES ('$id_surveys', '$question', '$mustDo')";
            $res = mysqli_query($conn, $sql);
		}
        

       header("location:home.php");
       }
?>