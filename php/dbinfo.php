<?php
date_default_timezone_set('EST'); # setting timezone
$dbusername ='USERNAME HERE';
$password = 'PASSWORD HERE';
$db = 'DB NAME HERE';
$servername = 'IP ADDRESS HERE';
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
