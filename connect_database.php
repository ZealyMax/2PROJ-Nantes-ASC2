<?php 
$dbhost="localhost"; //replace with your hostname

$dbuser = "root"; //replace with your admin username

$dbpass = ""; //password of your admin

$db = "survey";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if ($conn === false) {
	die("Connect failed: %s\n". $conn -> error);
}

?>