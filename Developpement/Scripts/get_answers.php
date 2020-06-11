<?php
	$sql= "SELECT answer FROM answers WHERE id_surveys =" . $_SESSION['survey'];
	$resAnswers = mysqli_query($conn, $sql);
	while ( $resultAnswers = $resAnswers ->fetch_assoc()){
		echo $resultAnswers['answer'];
	}
	echo "<hr>";
?>