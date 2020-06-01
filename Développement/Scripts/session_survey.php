<?php 
	session_start();
	if(isset($_POST['action'])){
		$_SESSION['survey'] = $_POST['action'] ;
		echo $_SESSION['survey'];
	}
?>