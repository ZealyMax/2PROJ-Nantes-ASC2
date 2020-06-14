<?php
    include "connect_database.php";

    if (isset($_POST['submit'])) {
        if(isset($_POST['remember_me'])){
            setcookie("name", $_POST['login'],0,"/");
            setcookie("remember_me", "checked",0,"/");

		} else {
            setcookie("name", "",0,"/");
            setcookie("remember_me", "",0,"/");
	    }

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
            header("location:../Pages/login.php?error=true");
        }

        if($res===false){

            printf("error: %s\n", mysqli_error($conn));

        }
    }
?>