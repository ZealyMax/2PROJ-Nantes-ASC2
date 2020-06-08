<?php 
	echo "t'es sur le respond_to_survey.php";
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO answers (id_surveys,id_question) VALUES ()";
		$res = mysqli_query($conn, $sql);
	}
?>