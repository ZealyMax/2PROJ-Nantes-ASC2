<?php 
    include "connect_database.php";
    if (isset($_POST['submit'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		$sql = "SELECT login, password,id_users FROM users WHERE login = '$login' AND password = '$password'";
		$res = mysqli_query($conn, $sql);
		if ($res->num_rows== 0){
			$sql = "INSERT INTO users (login, password) VALUES ('$login','$password')";
			$res = mysqli_query($conn, $sql);
			$sql = "SELECT id_users FROM users WHERE login = '$login' AND password = '$password' ORDER BY id_users DESC ";
			$res = mysqli_query($conn, $sql);
			$result = $res->fetch_assoc();				
			session_start();
			$_SESSION['id_users'] = $result['id_users'];
			header("location:../Pages/home.php");
		}
		else{
			header("location:../Pages/login.php?error=1");
		}
		if($res===false){

			printf("error: %s\n", mysqli_error($conn));
		}
	}

?>