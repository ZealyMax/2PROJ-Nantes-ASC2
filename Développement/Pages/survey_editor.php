<!DOCTYPE html>

<?php  include('../Scripts/redirect_to_connection.php');
include "../Scripts/connect_database.php" ;?>


<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <title>créer un formulaire</title>
    </head>
    <body>

    <div class="tab">
            <button class="tablinks" onclick="changeTab(event, 'Question')" id="defaultOpen"> Question </button>
            <button class="tablinks" onclick="changeTab(event, 'Réponse')"> Réponse </button>
        </div>
        <?php echo $_SESSION['survey']?>
        <div id="Question" class="tabcontent">
            <form method=POST action=../Scripts/create_form.php>
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
                                    <input name=question[] value='". $resultQuestion['question'] ."'> ";
                                
                            if($resultQuestion['type'] == "short"){                                    
                                echo "
                                <select name=selectType[] class=selector>  
                                    <option value=\"short\">Réponse courte</option>
                                    <option value=\"long\">Paragraphe</option>
                                    <option value=\"multiple\">Choix multiple</option>
                                    <option value=\"checkbox\">Case à cocher</option>
                                    <option value=\"list\">Liste déroulante</option>
                                    <option value=\"linear-scale\">Echelle linéaire</option>
                                    <option value=\"grid-multiple\">Grille à choix multiple</option>
                                    <option value=\"grid-checkbox\">Grille de case à cocher</option>
                                    <option value=\"date\">Date</option>
                                    <option value=\"hour\">Heure</option>
                                </select><button class=rm-div>X</button><br>
                                <div class=question-content><input name=\"short\" placeholder=\"Réponse \" READONLY>  <input type=hidden name=sub_questions[] value='new question'>  </div>  <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>";
							}
                            
                            else if($resultQuestion['type'] == "long"){
                                echo "
                                <select name=selectType[] class=selector>  
                                    <option value=\"short\">Réponse courte</option>
                                    <option value=\"long\" selected=selected>Paragraphe</option>
                                    <option value=\"multiple\">Choix multiple</option>
                                    <option value=\"checkbox\">Case à cocher</option>
                                    <option value=\"list\">Liste déroulante</option>
                                    <option value=\"linear-scale\">Echelle linéaire</option>
                                    <option value=\"grid-multiple\">Grille à choix multiple</option>
                                    <option value=\"grid-checkbox\">Grille de case à cocher</option>
                                    <option value=\"date\">Date</option>
                                    <option value=\"hour\">Heure</option>
                                </select><button class=rm-div>X</button><br>
                                <div class=question-content><textarea name=\"long\" placeholder=\"Réponse \" READONLY></textarea>  <input type=hidden name=sub_questions[] value='new question'>  </div>  <input name=mustDo[] type=checkbox value= >  <input placeholder=Obligatoire READONLY></div>"; 
                            }

                            else if($resultQuestion['type'] == "multiple"){
                                echo "
                                <select name=selectType[] class=selector>  
                                    <option value=\"short\">Réponse courte</option>
                                    <option value=\"long\">Paragraphe</option>
                                    <option value=\"multiple\" selected=selected>Choix multiple</option>
                                    <option value=\"checkbox\">Case à cocher</option>
                                    <option value=\"list\">Liste déroulante</option>
                                    <option value=\"linear-scale\">Echelle linéaire</option>
                                    <option value=\"grid-multiple\">Grille à choix multiple</option>
                                    <option value=\"grid-checkbox\">Grille de case à cocher</option>
                                    <option value=\"date\">Date</option>
                                    <option value=\"hour\">Heure</option>
                                </select><button class=rm-div>X</button><br>
                                <div class=question-content>";

                                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                                $resSub = mysqli_query($conn, $sql);
                                while($resultSub = $resSub->fetch_assoc()){
                                    echo "<div><input name=sub_questions[] type=hidden value='radio'><input type=radio><input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button></div><button class=add-choice>Ajouter</button>";	        
                                }
                                echo "</div>"; 
                            }
                            else if($resultQuestion['type'] == "checkbox"){
                                echo "
                                <select name=selectType[] class=selector>  
                                    <option value=\"short\">Réponse courte</option>
                                    <option value=\"long\">Paragraphe</option>
                                    <option value=\"multiple\">Choix multiple</option>
                                    <option value=\"checkbox\" selected=selected>Case à cocher</option>
                                    <option value=\"list\">Liste déroulante</option>
                                    <option value=\"linear-scale\">Echelle linéaire</option>
                                    <option value=\"grid-multiple\">Grille à choix multiple</option>
                                    <option value=\"grid-checkbox\">Grille de case à cocher</option>
                                    <option value=\"date\">Date</option>
                                    <option value=\"hour\">Heure</option>
                                </select><button class=rm-div>X</button><br>
                                <div class=question-content>";

                                $sql = "SELECT value FROM sub_questions WHERE id_questions =". $resultQuestion['id_questions'];
                                $resSub = mysqli_query($conn, $sql);
                                while($resultSub = $resSub->fetch_assoc()){
                                    echo "<div><input name=sub_questions[] type=hidden value='checkbox'><input type=checkbox><input name=sub_questions[] value='". $resultSub['value'] ."'><button class=rm-div>X</button></div><button class=add-check>Ajouter</button>";
                                }
                                echo "</div>"; 
                            }
                        }
                    }
                    else{
                        echo "<input name=Titre placeholder='Titre'>
                        <input name=Description placeholder='Description'>
                        <input class='btn-add' type=button value=+>
                        <input name=submit type=submit value='Modifier le formulaire'>
                         <div class=form></div>";
                   }
                ?>        
            </form>
        </div>


        <div id="Réponse" class="tabcontent">
            <h1>Test</h1>
        </div>


        <script>
            function changeTab(evt, tabName) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(tabName).style.display = "block";
              evt.currentTarget.className += " active";
            }
            document.getElementById("defaultOpen").click();

        </script>




    </body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src='../Scripts/survey_editor.js'></script>

