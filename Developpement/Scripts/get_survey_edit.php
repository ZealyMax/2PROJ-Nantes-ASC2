<?php 
    if($_SESSION['survey'] != 0){
        $sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_SESSION['survey'];
        $resSurvey = mysqli_query($conn, $sql);
        $resultSurvey = $resSurvey->fetch_assoc();

        echo " 
        <div class=container>
            <div class=headQuestion>
                <input class=mainTitle name=Titre placeholder='Titre du formulaire' value='". $resultSurvey['title'] ."'>
                <input class=mainDesc name=Description placeholder='Description du formulaire' value='". $resultSurvey['description'] ."'>
            </div>
            <div class=contentQuestion>
                <div class=module>
                    <input class='btn-add' type=button value=+>
                    <input name=submit type=submit value='Modifier le formulaire'>
                </div>
                <div class=form>";


        $sql = "SELECT question, id_questions, type, mustDo FROM questions WHERE id_surveys =". $_SESSION['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        $i = 0;
        while ( $resultQuestion = $resQuestion ->fetch_assoc()){
            #Entête Question
           
            /*echo "<script>document.getElementbyClassName('btn-add').click();</script>";*/
            //echo "<h1>test</h1>"
            echo "<div class='question-div' draggable='true'>
                        <input class=question-title name=question[] value='". $resultQuestion['question'] ."'>
                        <select class=select-choice name=selectType[] class=selector>  
                            <option value=\"short\""; if ($resultQuestion['type'] == "short") echo 'selected'; echo">Réponse courte</option>
                            <option value=\"long\""; if ($resultQuestion['type'] == "long") echo 'selected' ;echo">Paragraphe</option>
                            <option value=\"multiple\""; if ($resultQuestion['type'] == "multiple") echo 'selected' ;echo">Choix multiple</option>
                            <option value=\"checkbox\""; if ($resultQuestion['type'] == "checkbox") echo 'selected' ;echo">Case à cocher</option>
                            <option value=\"list\""; if ($resultQuestion['type'] == "list") echo 'selected' ;echo">Liste déroulante</option>
                            <option value=\"linear-scale\""; if ($resultQuestion['type'] == "linear-scale") echo 'selected' ;echo">Echelle linéaire</option>
                            <option value=\"grid-multiple\""; if ($resultQuestion['type'] == "grid-multiple") echo 'selected' ;echo">Grille à choix multiple</option>
                            <option value=\"grid-checkbox\""; if ($resultQuestion['type'] == "grid-checkbox") echo 'selected' ;echo">Grille de case à cocher</option>
                            <option value=\"date\""; if ($resultQuestion['type'] == "date") echo 'selected' ;echo">Date</option>
                            <option value=\"hour\""; if ($resultQuestion['type'] == "hour") echo 'selected' ;echo">Heure</option>
                        </select>
                   ";
            #Réponse Courte
            if($resultQuestion['type'] == "short" || $resultQuestion['type'] == "date"  || $resultQuestion['type'] == "hour" ){                                    
                echo "
                 <div class=question-content>
                    <input name=\"short\" placeholder=\"Réponse courte \" READONLY>          
                </div>";
            }   
            #Paragraphe
            else if($resultQuestion['type'] == "long"){
                echo "          
                <div class=question-content>
                    <textarea name=\"long\" placeholder=\"Réponse longue\" READONLY></textarea>      
                </div>"; 
            }
            #Choix Multiple
            else if($resultQuestion['type'] == "multiple"){
                echo "                
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input name=sub_questions[] type=hidden value='radio'>
                        <input type=radio disabled><input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";	        
                }
                echo "<button class=add-choice>Ajouter</button></div>"; 
            }
            #Case à cocher
            else if($resultQuestion['type'] == "checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                    <div>
                        <input name=sub_questions[] type=hidden value='checkbox'>
                        <input type=checkbox disabled><input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "<button class=add-check>Ajouter</button></div>"; 
            }
            #liste
            else if($resultQuestion['type'] == "list"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                    <div>
                        <input name=sub_questions[] type=hidden value='list'>
                        <input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "<button class=add-list>Ajouter</button></div>"; 
            }
            #échelle linéaire
            else if($resultQuestion['type'] == "linear-scale"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    if($resultSub['type'] == "min-scale"){
                        echo "
                            <input name=sub_questions[] type=hidden value=min-scale>
                            <select name=sub_questions[] class=min-scale>";

                        for($i = 0; $i < 2; $i++){

                            if($i == $resultSub['value']){
                                echo "<option selected>". $i ."</option>";
							}
                            else{
                                echo "<option>". $i ."</option>";
                            }
                        }
                        echo "</select>";
                    }

                    else{
                        echo "
                            <input name=sub_questions[] type=hidden value=max-scale>
                            <select name=sub_questions[] class=max-scale>";

                        for($i = 2; $i < 11; $i++){
                            if($i == $resultSub['value']){
                                echo "<option selected>". $i ."</option>";
							}
                            else{
                                echo "<option>". $i ."</option>";
                            }
                        }
                        echo "</select>";
                    }
                }
                echo "</div>";
            }
            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                while($resultSub = $resSub->fetch_assoc()){
                     echo "
                         <div>
                            <input name=sub_questions[] type=hidden value='line'>
                            <input name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "</div><button class=add-line>Ajouter</button></div>
                      <div class=column>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'column-multiple'";
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input type=radio disabled><input name=sub_questions[] type=hidden value='column-multiple'>
                        <input name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "<div><button class=add-column-multiple>Ajouter</button></div></div>"; 
            }   
            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'line'";
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                while($resultSub = $resSub->fetch_assoc()){
                     echo "
                         <div>
                            <input name=sub_questions[] type=hidden value='line'>
                            <input name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "</div><button class=add-line>Ajouter</button></div>
                      <div class=column>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions = ". $resultQuestion['id_questions'] . "    AND type = 'column-checkbox'";
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <div>
                        <input type=checkbox disabled><input name=sub_questions[] type=hidden value='column-checkbox'>
                        <input name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
                }
                echo "<div><button class=add-column-multiple>Ajouter</button></div></div>"; 
            }  
            #Affichage des mustDo
            if($resultQuestion['mustDo'] == 1){
                echo  "<hr style=height:1px;border-width:0;color:gray;background-color:gray><div class=requiered-field><input type=hidden name=sub_questions[] value='new question'>
                    <span>Obligatoire</span><input class=check-requiered name=mustDo[] type=checkbox value=". $i . " checked> <button class=rm-div>X</button></div></div>";
            }
            else{
                echo  "<hr style=height:0.5px;border-width:0;color:gray;background-color:gray><div class=requiered-field><input type=hidden name=sub_questions[] value='new question'>
                    <span>Obligatoire</span><input class=check-requiered name=mustDo[] type=checkbox value=". $i . "> <button class=rm-div>X</button></div></div>";
			}
            $i++;                                                                          
        }
    }
    else{
        echo " 
        <div class=container>
            <div class=headQuestion>
                <input class=mainTitle name=Titre placeholder='Titre du formulaire'>
                <input class=mainDesc name=Description placeholder='Description du formulaire'>
            </div>
            <div class=contentQuestion>
                <div class=module>
                    <input class='btn-add' type=button value=+>
                    <input name=submit type=submit value='Créer le formulaire'>
                </div>
                <div class=form>
            </div>
        </div>";
    }
?>  