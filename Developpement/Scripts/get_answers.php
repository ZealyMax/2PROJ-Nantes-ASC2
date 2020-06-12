<?php
	$sql= "SELECT id_questions FROM answers WHERE id_surveys =" . $_SESSION['survey'];
	$resAnswers = mysqli_query($conn, $sql);
	
	$array_id_questions = array();
	while ( $resultAnswers = $resAnswers ->fetch_assoc()){
		$nb_question =0;
		if(!in_array($resultAnswers['id_questions'],$array_id_questions))
		{
			array_push($array_id_questions,$resultAnswers['id_questions']);
			$nb_question++;
		} 
	}

	for($x = 0; $x < sizeof($array_id_questions); $x++){

		$sql = "SELECT answer FROM answers WHERE id_surveys =" . $_SESSION['survey']." AND id_questions =" . $array_id_questions[$x];
		$resAnswers = mysqli_query($conn, $sql);

		echo mysqli_error($conn); 
		while ( $resultAnswers = $resAnswers ->fetch_assoc()){		
			echo $resultAnswers['answer'];
			echo "<br>";
			
		}
		
	}
	/*Affichage RC = chaque réponse à la suite
		P = chaque réponse à la suite
		CM = réponse avec graphique camembert (utilier chart.js)

		*/

	echo "<hr>";
?>