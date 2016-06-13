<?php

$servername = "localhost";
//$username 	= "root";
//$password 	= "";
$username 	= "askarali_randy";
$password  	= "randy27bast";
$db 		= "askarali_whitevp1_whitevps2";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully<br>";

?>