<?php 
error_reporting(0);
session_start();
include 'dbinfo.php';
if(!isset($_SESSION['project_id'])){
    header('Location: /login.php');
}

$stmt = $conn->prepare("SELECT `email`,`firstname`,`lastname`,`company` FROM `login_information` WHERE `userid` = ?");
$stmt->bind_param('s',$_SESSION['userid']);
//If the user doesn't exist then we send them back to the login page. 
if(!$stmt->execute()){
  header('Location: /login.php');
}
$stmt->bind_result($email,$firstname,$lastname,$company);
$stmt->fetch();
$userid = $_SESSION['userid'];
?>
