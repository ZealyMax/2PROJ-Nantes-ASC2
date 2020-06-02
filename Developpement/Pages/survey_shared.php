<?php
	include "..\Scripts\connect_database.php";
	
?>
<html lang="fr">
    <style>
        body{
            text-align: center;  
		}
    </style>
    <!--<style>
        .question-div{
            border: 2px solid #666666;
	        background-color:blue;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            /* Required to make elements draggable in old WebKit */
            -khtml-user-drag: element;
            -webkit-user-drag: element;
		}
    </style> -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=100%, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../CSS/Main/global.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/header.css">
        <link rel="stylesheet" type="text/css" href="../CSS/Survey/Editor/content.css">
        <title>Repondre au Formulaire</title>
    </head>
    <body>
        <form action="">
            <?php include "..\Scripts\get_survey_share.php"; ?>
        </form>
    </body>
</html>