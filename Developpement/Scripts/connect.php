<?php
    include "connect_database.php";
    if (isset($_POST['submit'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $sql = "SELECT login, password, id_users FROM users WHERE login = '$login' AND password = '$password'";
        $res = mysqli_query($conn, $sql);
        if($res->num_rows > 0) {
            $result = $res->fetch_assoc();
            session_start();
            $_SESSION['id_users'] = $result['id_users'];
            header("location:../Pages/home.php");
        }
        else{
            echo "Veuillez vérifier votre identifiant et votre mot de passe <br>
            <a href='../Pages/login.php'>Retour à la connexion</a>";
        }

        if($res===false){

            printf("error: %s\n", mysqli_error($conn));

        }
    }
?>