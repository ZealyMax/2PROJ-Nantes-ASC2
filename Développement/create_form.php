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
        header("location:home.php")
    }
?>