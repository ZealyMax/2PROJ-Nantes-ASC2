<?php
	session_start();
	if(!isset($_SESSION['id_users'])){
		header('location:login.php');
	}
?>