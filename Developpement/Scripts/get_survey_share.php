<?php 
    if(isset($_GET['survey'])){
        $sql = "SELECT question, id_questions, type, mustDo FROM questions WHERE id_surveys =". $_GET['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        $i = 0;
        while ( $resultQuestion = $resQuestion ->fetch_assoc()){

/*
*****
*********
            Penser à supprimer tous les commentaires inutiles (HTML & PHP compris)
*********
*****
*/

            #Entête Question
            echo "<div class=question-div>  
                    <input class=question-title value='". $resultQuestion['question'] ."' READONLY>";

            #Réponse Courte
            if($resultQuestion['type'] == "short"){                                    
                echo "
                <div class=question-content>
                    <!-- <input type=hidden name=question[] value=". $resultQuestion['id_questions'] ."> -->
                    <input class='Underline reponseCourte' name=question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type'] ." placeholder=\"Réponse courte \">
                </div>";
                
            }   
            #Paragraphe
            else if($resultQuestion['type'] == "long"){
                echo "          
                <div class=question-content>
                    <textarea name=question_".$resultQuestion['id_questions']. "_". $resultQuestion['type'] ." placeholder=\"Réponse longue\" ></textarea> 
                    
                    <!-- <textarea name=question".$i." placeholder=\"Réponse longue\" ></textarea> -->

                </div>"; 
            }
            #Choix Multiple
            else if($resultQuestion['type'] == "multiple"){
                echo "                
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                $y = 0;
                while($resultSub = $resSub->fetch_assoc()){
                    echo "<input name=question_".$resultQuestion['id_questions']."_". $resultSub['type']." type=radio value=".$resultSub['id_sub_questions']."><label>". $resultSub['value'] ."</label>";	  
                        $y++;
                }
                echo "</div>";
            }
            #Case à cocher
            else if($resultQuestion['type'] == "checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                $y=0;
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                    <div>
                        <input name=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." type=checkbox ><input  placeholder='Option' value='". $resultSub['value'] ."' READONLY>
                    </div>";
                        $y++;
                }
                echo "</div>";
            }
            
            #liste
            else if($resultQuestion['type'] == "list"){
                echo "
                <div class=question-content>
                    <div>
                    <select name=question_".$resultQuestion['id_questions']."_". $resultQuestion['type'].">";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "       
                    <option name=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions'].">". $resultSub['value'] ."</option>
                    ";
                }
                echo "</select></div></div>";
            }
            #échelle linéaire
            else if($resultQuestion['type'] == "linear-scale"){
                echo "
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    if($resultSub['type'] == "min-scale"){
                       $minScale = $resultSub['value'];
                    }
                    else{
                       $maxScale = $resultSub['value'];
                    }
                }
                for($y = $minScale; $y <= $maxScale; $y++){
                    echo "
                        <div>                            
                            <label>". $y ."</label><input name=question_".$resultQuestion['id_questions']."_linear-scale type=radio>
                        </div>";
                }
                echo "</div>";
            }
            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                echo "
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                $numberOfLines = 0;
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                         <div>
                            <input name=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." placeholder='Colonne' value='". $resultSub['value'] ."'READONLY></div>";
                            $numberOfLines++;
                }
                echo "</div>";
                 $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'column-multiple'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=column>";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input  placeholder='Ligne' value='". $resultSub['value'] ."' READONLY></div>"; 
                    for ($y = 0; $y < $numberOfLines; $y++){
                        echo "<input name=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." type=radio>";           
					}
                }
                echo "</div></div>"; 
            }   
            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                 echo "
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                         <div>
                            <inputname=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." placeholder='Colonne' value='". $resultSub['value'] ."'READONLY></div>";
                }
                echo "</div>";
                 $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'column-checkbox'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=column>";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input name=question_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." placeholder='Ligne' value='". $resultSub['value'] ."'READONLY></div>";
                        for ($y = 0; $y < $numberOfLines; $y++){
                            echo "<input type=checkbox>";           
					    }
                }
                echo "</div></div>"; 
            }   
            #Date
            else if($resultQuestion['type'] == "date"){      
                echo "
                <div class=question-content>
                    <input type=date name=question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']." placeholder=day>
                </div>";
            }  
            #Heure
            else if($resultQuestion['type'] == "hour"){                                    
                echo "
                <div class=question-content>
                    <input type=number min=0 max=23 name=question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']."_heure placeholder=hour onkeyup=controlHour(question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']."_heure)><p>:</p><input type=number min=0 max=59 name=question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']."_minutes placeholder=minutes onkeyup=controlMinute(question_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']."_minutes)>       
                </div>";
            } 
            #Affichage des mustDo et fermeture des div
            if($resultQuestion['mustDo'] == 1){
                echo  "
                    <input name=mustDo[] type=checkbox value=". $i . " checked disabled>  <input placeholder=Obligatoire READONLY>";
            }
            else{
                 echo  "
                     <input name=mustDo[] type=checkbox value=". $i . " disabled>  <input placeholder=Obligatoire READONLY>";
			}
            echo "</div>";
            $i++;
        }
    }
?>  
