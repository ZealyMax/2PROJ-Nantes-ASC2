<?php
    session_start();
    include "connect_database.php";
    switch ($_POST['action']) {
        case "titre" :
            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%e %b %Y %k:%i') as date_ouverture FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY title;";
            
                break;
        case 'date':  
            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%d %b %Y %k:%i') as date_ouverture FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY date_ouverture DESC;";            break;
            break;
        case "perso" :
            $sql = "SELECT title,id_surveys,DATE_FORMAT(date_ouverture, '%e %b %Y %k:%i') as date_ouverture FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY order_surveys;";
            break;
    }
    $res = mysqli_query($conn, $sql);
    date_default_timezone_set('Europe/Paris');
    while ( $result = $res->fetch_assoc()){
    
        if(substr($result['date_ouverture'],0,1) == "0"){
            $dateOuverture = substr($result['date_ouverture'], 1, 11);
        }
        else {
            $dateOuverture = substr($result['date_ouverture'], 0, 11);
        }
        if($dateOuverture == date('j M Y')){
            $dateOuverture = substr($result['date_ouverture'], -5);
        }
        echo "<div id=\"". $result['id_surveys'] ."\" class=\"parent-Form\" draggable='true'>"; /*div extern des formulaires à sélectionner*/ 
        echo "  <div class=\"child-Form\" type=\"button\" onclick=\"SessionSurvey(". $result['id_surveys'] .")\">"; /*div inside des formulaires à sélectionner*/
        echo "      <div class=upperBtn></div>

                    <div class=downBtn>
                        <div class=titleForm>
                            <p title='". $result['title'] . "'>". $result['title'] . "</p>         <!--Titre du formulaires-->
                        </div>

                        <div class=moreInfoForm>
                            <p title='". $dateOuverture . "'>". $dateOuverture . "</p>
                            <div class=dropdownForm>
                                <button class=\"more\" onclick=dropMenuForm(". $result['id_surveys'] .")></button>
                                <div id=droppedMenuForm". $result['id_surveys'] ." class=dropdownFormContent>
                                    <button onclick=\"wantToDelete('". $result['id_surveys'] ."')\"></button>
                                    <button style=\"display:block;\" onclick=RemoveSurvey(". $result['id_surveys'] .")>SUPPRIMER</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>";
    }

?>
