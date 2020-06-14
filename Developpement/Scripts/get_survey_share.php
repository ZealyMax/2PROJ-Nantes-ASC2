<?php 
    if(isset($_GET['survey'])){
        $sql = "SELECT question, id_questions, type, mustDo FROM questions WHERE id_surveys =". $_GET['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        $i = 0;
        while ( $resultQuestion = $resQuestion ->fetch_assoc()){


            #Entête Question & Affichage des mustDo
            echo "
            <div class=question-div>  
                <div class=divTitle>";
            if($resultQuestion['mustDo'] == 1){
                echo  "<p class=mustDoStar>*</p>
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
                    <input class='Underline reponseCourte' type=text name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']  ."_".  $resultQuestion['type']. " placeholder=\"Réponse courte \">
                </div>";
                
            }

            #Paragraphe
            else if($resultQuestion['type'] == "long"){
                echo "          
                <div class=question-content>
                    <input class='Underline reponseLongue' type=text name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']. "_". $resultQuestion['type'] ." placeholder=\"Réponse longue\">
                    
                    <!-- <textarea name=question".$i." placeholder=\"Réponse longue\" ></textarea> -->

                </div>"; 
            }

            #Choix Multiple
            else if($resultQuestion['type'] == "multiple"){
                displayCheckOrMultiple("multiple",$resultQuestion['id_questions'],$conn, "radioChoixMultiple", "radio", "cMult","");
            }

            #Case à cocher
            else if($resultQuestion['type'] == "checkbox"){
                displayCheckOrMultiple("checkbox",$resultQuestion['id_questions'],$conn, "Checkbox", "checkbox","cacBtn","cacBtnContainer");

            }
            
            #liste
            else if($resultQuestion['type'] == "list"){
                echo "
                <div class='question-content listeDeroulante'>
                    <select name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_". $resultQuestion['type']."  select=select>
                    <option>S&eacute;lectionnez</option>";

                $sql = "SELECT id_sub_questions, type, value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "       
                    <option>". $resultSub['value'] ."</option>
                    ";
                }
                echo "</select><div class='select_arrow'></div></div>";
            }

            #échelle linéaire
            else if($resultQuestion['type'] == "linear-scale"){
                echo "
                <div class='question-content echelleLineaire'>";

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
                echo "
                <div class='eLineaireContent'>
                <div class='echelleELContainer flexColumn'>
                    <p class=echelleEL>". $minScaleName ."</p>
                </div>";
                for($y = $minScale; $y <= $maxScale; $y++){
                    echo "
                        <label class='btnContainer flexColumn eLineaire' for='eLin".$y."'>
                            <p>". $y ."</p>
                            <input class=radioChxMultiple id=eLin".$y." name=question_". $_GET['survey'] ."_".$resultQuestion['id_questions']."_linear-scale type=radio value=".$y." $select>
                            <span class='checkmark cMult eLin'></span>
                        </label>";
                    $select="";
                }
                echo "  <div class='echelleELContainer flexColumn'>
                            <p class=echelleEL>". $maxScaleName ."</p>
                        </div></div></div>";
            }

            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                displayGrid("multiple", $resultQuestion['id_questions'], $conn, "radioChoixMultiple", "radio", "cMult", "");
            }

            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                displayGrid("checkbox",$resultQuestion['id_questions'], $conn, "Checkbox","checkbox", "cacBtn", "cacBtnContainer");
            }

            #Date
            else if($resultQuestion['type'] == "date"){      
                echo "
                <div class=question-content>
                    <input class=Underline type=date name=question_". $_GET['survey'] ."_". $resultQuestion['id_questions'] ."_". $resultQuestion['type']." min=\"1800-01-01\" max=\"2200-12-31\">
                </div>";
            }  

            #Heure
            else if($resultQuestion['type'] == "hour"){                                    
                echo "
                <div class=question-content>
                    <input class=Underline type=time name=question_". $_GET['survey'] ."_". $resultQuestion['id_questions'] ."_". $resultQuestion['type'].">       
                </div>";
            }
            echo "</div>";
            $i++;
        }
    }


    function displayCheckOrMultiple($type, $id_questions, $conn, $class, $typeInput,$classSpan, $cacBtnContainer){
        echo "                
            <div class='question-content flexColumn'>";
        $sql = "SELECT id_sub_questions,type, value FROM sub_questions WHERE id_questions =". $id_questions;
        $resSub = mysqli_query($conn, $sql);
        $select="checked";
        while($resultSub = $resSub->fetch_assoc()){
            echo "
            <label class='btnContainer ".$cacBtnContainer."' for='chxMultipleOpt".$resultSub['id_sub_questions']."'>". $resultSub['value'];
                if($type == "multiple"){
                    echo "<input class=". $class ." id=chxMultipleOpt".$resultSub['id_sub_questions']." name=question_". $_GET['survey'] ."_".$id_questions."_". $resultSub['type']." type=". $typeInput . " value=".$resultSub['value']." ". $select. ">";
                }
                else{
                    echo "<input class=". $class ." id=chxMultipleOpt".$resultSub['id_sub_questions']." name=question_". $_GET['survey'] ."_".$id_questions."_". $resultSub['type']."_". $resultSub['id_sub_questions'] ." type=". $typeInput . " value=".$resultSub['value'].">";   
				}
                echo "<span class='checkmark ". $classSpan."'></span>
            </label>
            ";	  
            $select="";
        }
        echo "</div>";
	}



    function displayGrid($type, $id_questions, $conn, $class, $typeInput, $classSpan, $cacBtnContainer){
        echo "<div class='question-content Grille'>";                                                           
        $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $id_questions . " AND type = 'column-". $type ."'";
        $resColumn = mysqli_query($conn, $sql);

        echo "<div style='grid-row:1; grid-column:1;' class='column col0'>&nbsp;</div>";
        $columnGrid = 2;
        $lineGrid = 2;

        while($resultColumn = $resColumn->fetch_assoc()){
            echo "
            <div style='grid-row:1; grid-column:". $columnGrid.";'>
                <p>". $resultColumn['value'] ."</p>
            </div>";
            $columnGrid++;
        }

        $columnGrid = 1;

        $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $id_questions . " AND type = 'line'";
        $resLine = mysqli_query($conn, $sql);

        while($resultLine = $resLine->fetch_assoc()){
            $sql = "SELECT id_sub_questions, type,value FROM sub_questions WHERE id_questions =". $id_questions . " AND type = 'column-". $type."'";
            $resColumn2 = mysqli_query($conn, $sql);
            do{
                if( $columnGrid == 1){
                    echo "
                        <div style='grid-row:".$lineGrid."; grid-column:". $columnGrid.";'>
                            <p>". $resultLine['value'] ."</p>
                        </div>";
                }
                else{
                    echo "
                        <div style='grid-row:".$lineGrid."; grid-column:". $columnGrid.";'>";
                        echo "<label class='btnContainer ".$cacBtnContainer."' for='chxMultipleOpt_".$resultColumn['type']."_".$lineGrid."_".$columnGrid."_".$resultLine['id_sub_questions']."'>";
                        $select = "checked"; 
                        if($type == "multiple"){ 
                            echo "<input class=". $class ." id='chxMultipleOpt_".$resultColumn['type']."_".$lineGrid."_".$columnGrid."_".$resultLine['id_sub_questions']."' name=question_". $_GET['survey'] ."_".$id_questions."_grid-".$type."_". $resultLine['id_sub_questions']." type=". $typeInput ." value='".$resultColumn['value']."_". $resultLine['value'] ."'" . $select .">";
                        }
                        else{
                            echo "<input class=". $class ." id='chxMultipleOpt_".$resultColumn['type']."_".$lineGrid."_".$columnGrid."_".$resultLine['id_sub_questions']."' name=question_". $_GET['survey'] ."_".$id_questions."_grid-".$type."_". $resultLine['id_sub_questions']."_".$columnGrid." type=". $typeInput ." value='".$resultColumn['value'] ."_". $resultLine['value'] ."'>";
						}
                            echo "<span class='checkmark ".$classSpan. "'></span>
                        </label></div>";
                        $select = "";
				}
                $columnGrid++;

            }while($resultColumn = $resColumn2->fetch_assoc());
            $columnGrid = 1;
            $lineGrid++;

            }
        echo "</div>"; 
        }
?>  
