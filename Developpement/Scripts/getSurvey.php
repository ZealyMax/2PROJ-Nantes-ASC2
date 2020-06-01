<?php 
    if($_SESSION['survey'] != 0){
        $sql = "SELECT title, description FROM surveys WHERE id_surveys =". $_SESSION['survey'];
        $resSurvey = mysqli_query($conn, $sql);
        $resultSurvey = $resSurvey->fetch_assoc();

        echo "<input name=Titre value='". $resultSurvey['title'] ."'>
        <input name=Description value='". $resultSurvey['description'] ."'>
        <input class='btn-add' type=button value=+>
        <input name=submit type=submit value='Modifier le formulaire'>
        <div class=form>";

        $sql = "SELECT question, id_questions, type FROM questions WHERE id_surveys =". $_SESSION['survey'];
        $resQuestion = mysqli_query($conn, $sql);
        while ( $resultQuestion = $resQuestion ->fetch_assoc()){
            echo "<div class=question-div>  <br>  <br>   
                    <input name=question[] value='". $resultQuestion['question'] ."'>
                    <select name=selectType[] class=selector>  
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
                </select><button class=rm-div>X</button><br>";
            #Réponse Courte
            if($resultQuestion['type'] == "short"){                                    
                echo "
                 <div class=question-content>
                    <input name=\"short\" placeholder=\"Réponse \" READONLY>          
                </div> <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'>";
            }   
            #Paragraphe
            else if($resultQuestion['type'] == "long"){
                echo "          
                <div class=question-content>
                    <textarea name=\"long\" placeholder=\"Réponse \" READONLY></textarea>      
                </div>  <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'>"; 
            }
            #Choix Multiple
            else if($resultQuestion['type'] == "multiple"){
                echo "                
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <input name=sub_questions[] type=hidden value='radio'>
                        <input type=radio><input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button>";	        
                }
                echo "<button class=add-choice>Ajouter</button></div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> "; 
            }
            #Case à cocher
            else if($resultQuestion['type'] == "checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <input name=sub_questions[] type=hidden value='checkbox'>
                        <input type=checkbox><input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button>";
                }
                echo "<button class=add-check>Ajouter</button></div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> "; 
            }
            #liste
            else if($resultQuestion['type'] == "list"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <input name=sub_questions[] type=hidden value='list'>
                        <input type=checkbox><input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button>";
                }
                echo "<button class=add-check>Ajouter</button></div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> "; 
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
                        /*for($i = 0; i < 2; $i++){
                            if($i == $resultSub['value']){
                                echo "<option selected>". $i ."</option>";
							}
                            else{
                                echo "<option>". $i ."</option>";
                            }

                        }*/
                        echo "</select>";
                    }
                    else{
                        echo "
                            <input name=sub_questions[] type=hidden value=max-scale>
                            <select name=sub_questions[] class=max-scale>";
                        /*for($i = 0; i < 10; $i++){
                            if($i == $resultSub['value']){
                                echo "<option selected>". $i ."</option>";
							}
                            else{
                                echo "<option>". $i ."</option>";
                            }
                            echo "for max";

                        }*/
                        echo "</select>";
                    }
                }
                echo "</div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> ";
            }
            #Grille de choix multiple
            else if($resultQuestion['type'] == "grid-multiple"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <input name=sub_questions[] type=hidden value='line'>
                        <input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button>";
                }
                echo "<button class=add-check>Ajouter</button></div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> "; 
            }   
            #Grille de case à cocher
            else if($resultQuestion['type'] == "grid-checkbox"){
                echo "
                <div class=question-content>";

                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                $resSub = mysqli_query($conn, $sql);
                while($resultSub = $resSub->fetch_assoc()){
                    echo "
                        <input name=sub_questions[] type=hidden value='line'>
                        <input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button>";
                }
                echo "<button class=add-check>Ajouter</button></div>
                <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>
                <input type=hidden name=sub_questions[] value='new question'> "; 
            }   
        }
    }
    #si $_SESSION['survey'] = 0 / si l'utilisateur est en création
    else{
        echo "<input name=Titre placeholder='Titre'>
        <input name=Description placeholder='Description'>
        <input class='btn-add' type=button value=+>
        <input name=submit type=submit value='Modifier le formulaire'>
        <div class=form></div>";
    }
?>  