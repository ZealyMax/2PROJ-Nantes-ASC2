<?php
    session_start();
    include "connect_database.php";
    switch ($_POST['action']) {
        case "titre" :
            $sql = "SELECT title,id_surveys FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY title DESC";
            break;

        case 'date':  
            $sql = "SELECT title,id_surveys FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY id_surveys DESC";
            break;

        case "perso" :
            $sql = "SELECT title,id_surveys FROM surveys WHERE id_users = '$_SESSION[id_users]' ORDER BY order_surveys DESC";
            break;
    }

    $res = mysqli_query($conn, $sql);
    while ( $result = $res->fetch_assoc()){
        echo "<div id=\"". $result['id_surveys'] ."\" class=\"parent-Form\" draggable='true'>"; /*div extern des formulaires à sélectionner*/ 
        echo "<button class=\"rm-survey\" onclick=RemoveSurvey(". $result['id_surveys'] .")>X</button>"; #bouton remove
        echo "<div class=\"child-Form\" type=\"button\" onclick=\"SessionSurvey(". $result['id_surveys'] .")\">"; /*div inside des formulaires à sélectionner*/
        echo "<div id=upperBtn>&nbsp;</div>";
        echo "<p id=downBtn>". $result['title'] . "</p>";
        echo "</div>";
        echo "</div>";
    }

?>
