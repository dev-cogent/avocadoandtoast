<?php 
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_General_Information'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
