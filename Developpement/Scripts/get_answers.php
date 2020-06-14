<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<form>
    <div class=container>
        <div class=headQuestion>
        
                <?php
                    $sql = "SELECT COUNT(id_answer_sheets) as counter FROM answer_sheets WHERE id_surveys=". $_SESSION['survey'];
                    $resCountAnswer = mysqli_query($conn, $sql);
                    echo mysqli_error($conn);
                    if($resultCountAnswer = $resCountAnswer-> fetch_assoc()){
                        echo "<p>Nombre de réponses: " . $resultCountAnswer['counter'] . "</p>";
			        }
                ?>
      
        </div>
        <div class=content-question>
            <div class=form>
                <?php
                    /*
	                $sql= "SELECT id_questions, answer FROM answers WHERE id_surveys =" . $_SESSION['survey'];
	                $resAnswers = mysqli_query($conn, $sql);
	
	                $array_id_questions = array();
                    $array_answers = array();
	                while ( $resultAnswers = $resAnswers ->fetch_assoc()){
		                $nb_question =0;
		                if(!in_array($resultAnswers['id_questions'],$array_id_questions))
		                {
			                array_push($array_id_questions,$resultAnswers['id_questions']);
                            array_push($array_answers,$resultAnswers['answer']);
                            echo $resultAnswers['answer'];
			                echo "<br>";
			
			                $nb_question++;
		                } 
	                }
    
	                for($x = 0; $x < sizeof($array_id_questions); $x++){*/
                    //}
	                $sql = "SELECT id_questions, question, type FROM questions WHERE id_surveys =". $_SESSION['survey'];
	                $resQuestions = mysqli_query($conn, $sql);
	                echo mysqli_error($conn);        
	                while ( $resultQuestions = $resQuestions ->fetch_assoc()){	
            
                        echo "<div class=question-div>
                        <p>".$resultQuestions['question']."</p>";
                        // Réponse courte &  Réponse Longue & Heure & Date
                        if($resultQuestions['type'] == "short" || $resultQuestions['type'] == "long" || $resultQuestions['type'] == "hour" || $resultQuestions['type'] == "date"){ 
                            $sql= "SELECT answer FROM answers WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resAnswers = mysqli_query($conn, $sql);
                            $array_answers = [];
                            while ( $resultAnswers = $resAnswers ->fetch_assoc()){
                                array_push($array_answers, $resultAnswers['answer']);
                            }	
                            $array_sub_count = array_count_values($array_answers);
                            $array_sub = array_unique($array_answers);
                            $array_sub = array_values($array_sub);
                            $array_sub_count = array_values($array_sub_count);
                            for($i = 0; $i < sizeof($array_sub);$i++){
                                echo  "<div><span>" . $array_sub[$i] . "</span>
                                        <span>" . $array_sub_count[$i] ."</span></div>";        
				            }
                        }
                        // Choix Multiple & Liste déroulante
                        else if ($resultQuestions['type'] == "multiple" || $resultQuestions['type'] == "list"){
                            $array_sub = [];
                            $sql= "SELECT answer FROM answers WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resSub = mysqli_query($conn, $sql);
                            while ( $resultSub = $resSub ->fetch_assoc()){
                                array_push($array_sub, $resultSub['answer']);
                            }
                            $array_sub_count = array_count_values($array_sub);

                            $sql= "SELECT value FROM sub_questions WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resSubLabel = mysqli_query($conn, $sql);

                            $array_sub_label = [];

                            while ( $resultSubLabel = $resSubLabel ->fetch_assoc()){
                                array_push($array_sub_label, $resultSubLabel['value']);
                            }
                            displayChart("pie",$array_sub_label, $array_sub_count, $resultQuestions['id_questions']);

                        }

                        // Case à cocher
                        else if ($resultQuestions['type'] == "checkbox"){
                            $array_sub = [];
                            $sql= "SELECT answer FROM answers WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resSub = mysqli_query($conn, $sql);
                            while ( $resultSub = $resSub ->fetch_assoc()){
                                array_push($array_sub, $resultSub['answer']);
                            }
                            $array_sub_count = array_count_values($array_sub);

                            $sql= "SELECT value FROM sub_questions WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resSubLabel = mysqli_query($conn, $sql);

                            $array_sub_label = [];

                            while ( $resultSubLabel = $resSubLabel ->fetch_assoc()){
                                array_push($array_sub_label, $resultSubLabel['value']);
                            }
                            displayChart("horizontalBar",$array_sub_label, $array_sub_count, $resultQuestions['id_questions']);
                        }

                        //Echelle linéaire
                        else if ($resultQuestions['type'] == "linear-scale"){
                            $array_sub = [];
                

                            $sql= "SELECT type, value FROM sub_questions WHERE id_questions =" . $resultQuestions['id_questions'];
	                        $resSubLabel = mysqli_query($conn, $sql);

                            $array_sub_label = [];

                            while ( $resultSubLabel = $resSubLabel ->fetch_assoc()){
                                if($resultSubLabel['type'] == "min-scale"){
                                   $minScale = $resultSubLabel['value'];
                                }
                                else{
                                   $maxScale = $resultSubLabel['value'];
                                }
                    
                            }
                            $array_sub_count = [];
                            for($i = $minScale; $i <= $maxScale; $i++){
                                array_push($array_sub_label, $i);

                                $sql= "SELECT answer FROM answers WHERE id_questions =" . $resultQuestions['id_questions'] ." AND answer =" . $i;
	                            $resSub = mysqli_query($conn, $sql);
                                if($resSub ->fetch_assoc()){
                                    array_push($array_sub_count, 1);
                                    while ( $resultSub = $resSub ->fetch_assoc()){
                                        $array_sub_count[$i-$minScale] ++;
                                    }
                                }
                                else{
                                    array_push($array_sub_count, 0);
					            }
                    
                            }
                            displayChart("bar",$array_sub_label, $array_sub_count, $resultQuestions['id_questions']);

			            }
                        // Grille à choix multiple &  Grille de cases à cocher
                        else if ($resultQuestions['type'] == "grid-multiple" || $resultQuestions['type'] == "grid-checkbox")
                        {
                            $typeSplit = explode('-', $resultQuestions['type']);
                            $type = $typeSplit[1];
                
                            //label des lignes
                            $sql= "SELECT value FROM sub_questions WHERE id_questions =" . $resultQuestions['id_questions'] ." AND type = 'line'";
	                        $resSubLabelLine = mysqli_query($conn, $sql);
                            $array_sub_label_line = [];
                            while ( $resultSubLabelLine = $resSubLabelLine ->fetch_assoc())
                            {
                                array_push($array_sub_label_line, $resultSubLabelLine['value']);
                            }




                            $sql= "SELECT id_sub_questions, value FROM sub_questions WHERE id_questions =" . $resultQuestions['id_questions'] ." AND type = 'column-". $type ."'";
	                        $resSubLabelColumn = mysqli_query($conn, $sql);
                            $array_sub_label_column = [];
                            while ( $resultSubLabelColumn = $resSubLabelColumn ->fetch_assoc())
                            {

                                array_push($array_sub_label_column, $resultSubLabelColumn['value']);
                            }
                
                            $colorLowOpacity = array('rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)');
                            $colorHighOpacity = array('rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)');

                            echo "  <canvas id='myChart".$resultQuestions['id_questions'] ."' width=400 height=400></canvas>
                            <script>
                            var ctx = document.getElementById('myChart".$resultQuestions['id_questions']."').getContext('2d');
                            var myBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: {labels: ['". implode("','",$array_sub_label_line). "'],
                                datasets: [ "; 
                            $resSubLabelColumn = mysqli_query($conn, $sql);

                            for($i =0;$i < sizeof($array_sub_label_line);$i++)
                            {   
                                $array_sub = [];    
                                for ($y =0;$y < sizeof($array_sub_label_column);$y++)
                                {
                                    $sql= "SELECT answer FROM answers WHERE id_questions =" . $resultQuestions['id_questions'] . " AND answer = '".$array_sub_label_column[$y]."_".$array_sub_label_line[$i]."'";
	                                $resSub = mysqli_query($conn, $sql);
                                    while ( $resultSub = $resSub ->fetch_assoc())
                                    {
                                        array_push($array_sub, $resultSub['answer']);
                                    }                               
                                }
                                $array_sub_count = array_count_values($array_sub);
				                    echo "
                                    {
                                            label: '".$array_sub_label_column[$i]."',
                                            data: ['". implode("','",$array_sub_count)."'],
                                            backgroundColor: '".
                                            current($colorLowOpacity)."',
                                         ";
                                            next($colorLowOpacity);
                                    echo "   borderColor: '".
                                            current($colorHighOpacity)."',
                                         ";
                                            next($colorHighOpacity);

                           
                                    echo "   borderWidth: 1
                            
                                        },";    
                            }
                
                            echo  "  ]
                            },  
                                    options: {
                                    barValueSpacing: 20,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true,
                                            }
                                        }]
                                    }
                                }
                            }); 
                            </script>";
                        }    
                                  
                                                 
            
		    
                        echo "</div>";
                    }

                    function displayChart($type,$array_label, $array_count, $id_questions){
                        echo "
                        <canvas id='myChart". $id_questions ."' width=400 height=400></canvas>
                        <script>
                            var ctx = document.getElementById('myChart". $id_questions ."').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: '". $type ."',
                                data: {
                                    labels: ['". implode("','",$array_label). "'],
                                    datasets: [{
                                        label: 'Nombre de réponses',
                                        data: ['". implode("','",$array_count). "'],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>";  
		            }
                ?>  
            </div>
        </div>
    </div>
</form>
