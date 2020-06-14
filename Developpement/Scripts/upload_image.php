<?php 
    include("connect_database.php");
    if(isset($_POST['action'])){
        $sql = "UPDATE surveys SET image = '".$_POST['action']."' WHERE id_surveys = '". $_POST['survey']."'";
        $res = mysqli_query($conn, $sql);
        echo mysqli_error($conn);
    }
?>