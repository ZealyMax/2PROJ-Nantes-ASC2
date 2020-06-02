<?php 
    if(isset($_GET['survey'])){
        $sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_GET['survey'];
        $resSurvey = mysqli_query($conn, $sql);
        $resultSurvey = $resSurvey->fetch_assoc();

        echo "
        <div class=container>
            <div class=headQuestion>
                <p class=mainTitle name=Titre>". $resultSurvey['title']."</p>
                <p class=mainDesc name=Description>". $resultSurvey['description'] ."</p>
            </div>
            <div class=contentQuestion>
            <div class=form>";
        $sql = "SELECT question, id_questions, type, mustDo FROM questions WHERE id_surveys =". $_GET['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        $i = 0;
        while ( $resultQuestion = $resQuestion ->fetch_assoc()){
            #Entête Question
            echo "<div class=question-div>  
                    <input name=question[] value='". $resultQuestion['question'] ."' READONLY>";
            #Réponse Courte
            if($resultQuestion['type'] == "short"){                                    
                echo "
                 <div class=question-content>
                    <input name=\"short\" placeholder=\"Réponse courte \">          
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
                        <input type=radio disabled><input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."' READONLY><button class=rm-div>X</button></div>";	        
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
                        <input type=checkbox disabled><input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."' READONLY><button class=rm-div>X</button></div>";
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
                        <input name=sub_questions[] placeholder='Option' value='". $resultSub['value'] ."' READONLY><button class=rm-div>X</button></div>";
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
                       $minScale = $resultSub['value'];
                    }
                    else{
                       $maxScale = $resultSub['value'];
                    }
                }
                for($i = $minScale; $i <= $maxScale; $i++){
                    echo "
                        <div>
                            <p>". $i ."</p><input type=radio>
                        </div>";
                }
                echo "</div>";
            }
            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                $closeDivLine = false;
                while($resultSub = $resSub->fetch_assoc()){
                    if($resultSub['type'] == "column-multiple"){
                        if ($closeDivLine == false){
                            echo "</div><button class=add-line>Ajouter</button></div><div class=column>";
                            $closeDivLine = true;              
						}
                        echo "
                            <div>
                            <input type=radio disabled><input name=sub_questions[] type=hidden value='column-multiple'>
                            <input name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>"; 
                    }
                    
                    else{
                         echo "
                         <div>
                            <input name=sub_questions[] type=hidden value='line'>
                            <input name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
				    }
                }
                echo "<button class=add-column-multiple>Ajouter</button></div>"; 
            }   
            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value, type FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                echo "<div class=line>";
                $closeDivLine = false;
                while($resultSub = $resSub->fetch_assoc()){
                    if($resultSub['type'] == "column-checkbox"){
                        if ($closeDivLine == false){
                            echo "</div><button class=add-line>Ajouter</button></div><div class=column>";
                            $closeDivLine = true;              
						}
                        echo "
                            <div>
                            <input type=checkbox disabled><input name=sub_questions[] type=hidden value='column-checkbox'>
                            <input name=sub_questions[] placeholder='Ligne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>"; 
                    }
                    
                    else{
                         echo "
                            <div><input name=sub_questions[] type=hidden value='line'>
                            <input name=sub_questions[] placeholder='Colonne' value='". $resultSub['value'] ."'><button class=rm-div>X</button></div>";
				    }
                }
                echo "<button class=add-column-checkbox>Ajouter</button></div>"; 
            }   
            #Date
            if($resultQuestion['type'] == "date"){                                    
                echo "
                <div class=question-content>
                    <p>JJ MM YYYY</p>
                    <input name=day><p>/</p><input name=month><p>/</p><input name=year>          
                </div>";
            }  
            #Heure
            if($resultQuestion['type'] == "hour"){                                    
                echo "
                <div class=question-content>
                    <p>Heure</p>
                    <input name=\"hour\"><p>:</p><input name=minutes>       
                </div>";
            } 
            #Affichage des mustDo
            if($resultQuestion['mustDo'] == 1){
                echo  "<input type=hidden name=sub_questions[] value='new question'>
                    <input name=mustDo[] type=checkbox value=". $i . " checked disabled>  <input placeholder=Obligatoire READONLY></div>";
            }
            else{
                 echo  "<input type=hidden name=sub_questions[] value='new question'>
                     <input name=mustDo[] type=checkbox value=". $i . " disabled>  <input placeholder=Obligatoire READONLY></div>";
			}
            $i++;
        }
    }
    #si $_SESSION['survey'] = 0 : l'utilisateur est en création
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
                    <input name=submit type=submit value='Modifier le formulaire'>
                </div>
                <div class=form></div>
            </div>
        </div>";
    }
?>  