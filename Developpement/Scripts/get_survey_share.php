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

            #Entête Question & Affichage des mustDo
            echo "
            <div class=question-div>  
                <div class=divTitle>";
            if($resultQuestion['mustDo'] == 1){
                echo  "<p>*</p>
                    <!--<input class='Temp' name=mustDo[] type=checkbox value=". $i . " checked disabled>  <input class='Temp' placeholder=Obligatoire READONLY>-->";
            }
            else{
                 echo  "
                     <!--<input class='Temp' name=mustDo[] type=checkbox value=". $i . " disabled>  <input class='Temp' placeholder=Obligatoire READONLY>-->";
			}
            echo "<p class=question-title>". $resultQuestion['question'] ."</p>
            </div>";

            #Réponse Courte
            if($resultQuestion['type'] == "short"){                                    
                echo "
                <div class=question-content>
                    <input class='Underline reponseCourte' name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']  ."_".  $resultQuestion['type']. " placeholder=\"Réponse courte \">
                </div>";
                
            }   
            #Paragraphe
            else if($resultQuestion['type'] == "long"){
                echo "          
                <div class=question-content>
                    <input class='Underline reponseLongue' name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']. "_". $resultQuestion['type'] ." placeholder=\"Réponse longue\">
                    
                    <!-- <textarea name=question".$i." placeholder=\"Réponse longue\" ></textarea> -->

                </div>"; 
            }
            #Choix Multiple
            else if($resultQuestion['type'] == "multiple"){
                echo "                
                <div class=question-content>";

                $sql = "SELECT type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                $select="checked";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "<input name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultSub['type']." type=radio value=".$resultSub['value']." $select><label>". $resultSub['value'] ."</label>";	  
                    $select="";
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
                        <input name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." type=checkbox value=".$resultSub['value']."><input  placeholder='Option' value='". $resultSub['value'] ."' READONLY>
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
                    <select name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultQuestion['type'].">";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "       
                    <option name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions'].">". $resultSub['value'] ."</option>
                    ";
                }
                echo "</select></div></div>";
            }
            #échelle linéaire
            else if($resultQuestion['type'] == "linear-scale"){
                echo "
                <div class=question-content>";

                $sql = "SELECT id_sub_questions, type, value, scale_name FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                $select="checked";

                while($resultSub = $resSub->fetch_assoc()){
                    if($resultSub['type'] == "min-scale"){
                       $minScale = $resultSub['value'];
                       $minScaleName = $resultSub['scale_name'];
                    }
                    else{
                       $maxScale = $resultSub['value'];
                       $maxScaleName = $resultSub['scale_name'];

                    }
                }                
                echo "<p>". $minScaleName ."</p>";
                for($y = $minScale; $y <= $maxScale; $y++){
                    echo "
                        <div>                            
                            <label>". $y ."</label><input name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_linear-scale type=radio value=".$y." $select>
                        </div>";
                    $select="";

                }
                echo "<p>". $maxScaleName ."</p></div>";
            }
            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                echo "
                <div class=question-content>";
                $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'column-multiple'";
                
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=column>";
                $numberOfColumns = 0;
                $columnMultipleValue = [];
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input value='". $resultSub['value'] ."'READONLY></div>";
                        array_push($columnMultipleValue,$resultSub['value']);
                        $numberOfColumns++;
                }
                echo "</div>";
                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                $select="checked";

                echo "<div class=line>";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input value='". $resultSub['value'] ."' READONLY></div>"; 
                    for ($y = 0; $y < $numberOfColumns; $y++){
                        echo "<input name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']." type=radio value='".  $columnMultipleValue[$y] ."_". $resultSub['value']."' $select>";           
                        $select="";
					
                    }
                    $select="checked";

                }
                echo "</div></div>"; 
            }   
            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                echo "
                <div class=question-content>";
                $columnCheckboxValue = [];
                $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'column-checkbox'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=column>";
                $numberOfColumns = 0;
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                         <div>
                            <input value='". $resultSub['value'] ."'READONLY></div>";
                    array_push($columnCheckboxValue,$resultSub['value']);
                    $numberOfColumns++;

                }
                echo "</div>";
                $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'] . " AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input value='". $resultSub['value'] ."'READONLY></div>";
                        for ($y = 0; $y <  $numberOfColumns; $y++){
                            echo "<input name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultSub['type']."_" .$resultSub['id_sub_questions']."_".$y." type=checkbox value='". $columnCheckboxValue[$y] ."_". $resultSub['value']."'>";           
					    }
                }
                echo "</div></div>"; 
            }   
            #Date
            else if($resultQuestion['type'] == "date"){      
                echo "
                <div class=question-content>
                    <input type=date name=question_". $_GET['survey'] ."_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']." min=\"1800-01-01\" max=\"2200-12-31\">
                </div>";
            }  
            #Heure
            else if($resultQuestion['type'] == "hour"){                                    
                echo "
                <div class=question-content>
                    <input type=time name=question_". $_GET['survey'] ."_". $resultQuestion['id_questions'] ."_". $resultQuestion['type'].">       
                </div>";
            }
            echo "</div>";
            $i++;
        }
    }
?>  
